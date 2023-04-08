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
    include("controller/commoditiesAPI.php");

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

    //todo: update shell function with implementation code
    function purchaseOrder($con, $transaction) {
        try {
            //updateCommodityPrice($con,$ticket->get_Symbol(),$endpoint,$access_key);
            //update available funds
            $user = fetchUser($con, "ID = $transaction->UserID");
            $portfolio = fetchPortfolio($con, "UserID = $user->ID");

            $currFunds = $user->get_AvailableFunds();
            if ($currFunds < $transaction->get_total()){
                throw Exception("Purchase total exceeds current funds");
            }
            ///compare portfolio key with ticket commodity
            foreach(array_filter($portfolio) as $p){
                if($p->CommodityID === $transaction->get_CommodityID()){
                    //Update funds
                    $user->set_AvailableFunds($user->get_AvailableFunds() - $transaction->get_TransactionPrice());
                    updateUser($con, $user);

                    //insert transaction history
                    insertTransactionHistory($con, $transaction);

                    echo 'portfolio'; echo "<br>";
                    //update portfolio
                    $p->set_Amount($p->get_Amount() - $transaction->get_Amount());
                    $p->set_PurchaseAvg(($p->get_PurchaseAvg() + $transaction->get_TransactionPrice())/2);
                    $p->set_LastUpdated($transaction->get_TransactionDate());
                    updatePortfolio($con, $p);

                    }
                }
            }
        catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //todo: update shell function with implementation code
    function sellOrder($con, TransactionHistory $transaction) {
        try {
            //updateCommodityPrice($con,$ticket->get_Symbol(),$endpoint,$access_key);
            //update available funds
            $user = fetchUser($con, "ID = $transaction->UserID");
            $portfolio = fetchPortfolio($con, "UserID = $user->ID");

            ///compare portfolio key with ticket commodity
            foreach(array_filter($portfolio) as $p){
                if($p->CommodityID === $transaction->get_CommodityID()){
                    if($p->Amount < $transaction->get_amount()){
                        throw new Exception("Sell amount exceeds current amount owned");
                    }
                    else {
                        //Update funds

                        $user->set_AvailableFunds($user->get_AvailableFunds() + $transaction->get_TransactionPrice());
                        updateUser($con, $user);

                        //insert transaction history
                        insertTransactionHistory($con, $transaction);

                        //update portfolio
                        $p->set_Amount($p->get_Amount() - $transaction->get_Amount());
                        $p->set_LastUpdated($transaction->get_TransactionDate());
                        updatePortfolio($con, $p);
                    }
                }
            }
        }
        catch (Exception $e) {
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

