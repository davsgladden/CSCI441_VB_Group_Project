<?php
    include("entity/commodity.php");
    include("entity/commodityHistory.php");
    include("entity/performanceFeedback.php");
    include("entity/portfolio.php");
    include("entity/traineeComments.php");
    include("entity/traineeManagement.php");
    include("entity/trainingRegimen.php");
    include("entity/transactionHistory.php");
    include("entity/users.php");
    include("entity/userType.php");
    include("commoditiesAPI.php");

    /** User functions **/
    /**  Pull portfolio data with total value **/
    function getPortfolioInfo($con,$id){
        try {
            $query = "Select UserID, Symbol, CommodityName, Amount, PurchaseAvg,
                        cast(CurrentPrice as decimal(10,2)) as CurrentPrice,
                        cast(Amount * CurrentPrice as decimal(10,2)) as TotalValue
                      From portfolio p
                        join commodity c
                        on p.commodityid = c.commodityid
                      WHERE UserID = '$id'";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) > 0){
                return mysqli_fetch_all($result, MYSQLI_ASSOC);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * pull available funds plus total value aggregate
     * @throws Exception
     */
    function getAccountTotal($con, $portfolio, $funds) {
        try {
            //aggregate total value and return sum with available funds
            if ($portfolio < 1) return null;
            $AmountTotal = 0;
            foreach($portfolio as $result) {
                $AmountTotal += $result['TotalValue'];
            }
            return $AmountTotal + $funds;
        }
            catch (Exception $e) {
                echo $e->getMessage();
            }
        }

    //todo: update shell function with implementation code
    function getPortfolioHistory($con, $id) {
        try {

        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //todo: update shell function with implementation code
    function resetPortfolio($con, $id) {
        try {

        }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

/**
 * @param $con
 * @param TransactionHistory $transaction
 * @return void
 * @throws Exception
 * Processes purchase orders from the user
 */
function purchaseOrder($con, TransactionHistory $transaction)
{
    try {
        //updateCommodityPrice($con,$ticket->get_Symbol(),$endpoint,$access_key);
        //update available funds
        $user = fetchUser($con, "ID = $transaction->UserID");
        $portfolio = fetchPortfolio($con, "UserID = $user->ID");

        $currFunds = $user->get_AvailableFunds();
        if ($currFunds < $transaction->get_TransactionPrice()) {
            throw new Exception("Purchase total exceeds current funds");
        }

        //update funds
        $user->set_AvailableFunds($user->get_AvailableFunds() - $transaction->get_TransactionPrice());
        updateUser($con, $user);

        //insert transaction history
        insertTransactionHistory($con, $transaction);

        ///compare portfolio key with ticket commodity
        $keyExists = 0;
        if (is_array($portfolio)) {
            foreach (array_filter($portfolio) as $compare) {
                if ($compare->CommodityID === $transaction->get_CommodityID()) {
                    $keyExists = 1;
                }
            }
        } else if ($portfolio->get_CommodityID() === $transaction->get_CommodityID()) {
            $keyExists = 1;
        }

        if ($keyExists == 0) {
            //insert portfolio
            $newPortfolio = new Portfolio();
            $newPortfolio->set_UserID($user->get_ID());
            $newPortfolio->set_CommodityID($transaction->get_CommodityID());
            $newPortfolio->set_Amount($transaction->get_Amount());
            $newPortfolio->set_PurchaseAvg($transaction->get_Price()); //Initial position, avg will be price of transaction.
            $newPortfolio->set_PositionStarted($transaction->get_TransactionDate());
            $newPortfolio->set_LastUpdated($transaction->get_TransactionDate());
            insertPortfolio($con, $newPortfolio);
        } else {
            if (is_array($portfolio)) {
                foreach (array_filter($portfolio) as $p) {
                    if ($p->CommodityID === $transaction->get_CommodityID()) {
                        $port = $p;
                    }
                }
            } else {
                $port = $portfolio;
            }
            //update portfolio
            $average = calcPurchaseAvg($con, $transaction);
            $port->set_Amount($port->get_Amount() + $transaction->get_Amount());
            $port->set_PurchaseAvg($average['PurchaseAvg']);
            $port->set_LastUpdated($transaction->get_TransactionDate());
            updatePortfolio($con, $port);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

    function calcPurchaseAvg($con, TransactionHistory $transaction){
        try {
            $query = "Select sum(transactionPrice) / sum(amount) as PurchaseAvg
                        from TransactionHistory 
                        where UserID = $transaction->UserID 
                            and CommodityID = $transaction->CommodityID 
                                and OrderType = 'Buy'";
            $result = mysqli_query($con, $query);
            if($result && mysqli_num_rows($result) > 0){
                return mysqli_fetch_array($result, MYSQLI_ASSOC);
            }
            
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

/**
 * @param $con
 * @param TransactionHistory $transaction
 * @return void
 * @throws Exception
 * Processes sell orders from the user
 */
function sellOrder($con, TransactionHistory $transaction)
{
    try {
        //updateCommodityPrice($con,$ticket->get_Symbol(),$endpoint,$access_key);
        //update available funds
        $user = fetchUser($con, "ID = $transaction->UserID");
        $portfolio = fetchPortfolio($con, "UserID = $user->ID");

        ///compare portfolio key with ticket commodity
        $port = new Portfolio;
        if (is_array($portfolio)) {
            foreach (array_filter($portfolio) as $p) {
                if ($p->CommodityID === $transaction->get_CommodityID()) {
                    $port = $p;
                }
            }
        } else {
            $port = $portfolio;
        }
        if ($port->Amount < $transaction->get_amount()) {
            throw new Exception("Sell amount exceeds current amount owned");
        } else {
            //Update funds
            $user->set_AvailableFunds($user->get_AvailableFunds() + $transaction->get_TransactionPrice());
            updateUser($con, $user);

            //insert transaction history
            insertTransactionHistory($con, $transaction);

            //update portfolio
            $port->set_Amount($port->get_Amount() - $transaction->get_Amount());
            $port->set_LastUpdated($transaction->get_TransactionDate());
            updatePortfolio($con, $port);
        }
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}

    //get latest price from API, updates db with new price, and insert new price history in db
    function updateCommodityPrice($con, $symbol,$endpoint,$access_key){
        try {
            $Commodity = fetchCommodity($con, "Symbol='$symbol'");
            insertCommodityHistory($con, $Commodity); //function created in history entity
            updateCommodity($con, $Commodity,$endpoint,$access_key); //function created in commodity entity
            return $Commodity;
        }catch (exception $e){
            echo $e->getMessage();
        }
    }

