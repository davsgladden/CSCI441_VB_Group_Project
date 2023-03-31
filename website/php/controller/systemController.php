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

    //Pull portfolio data with total value
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
          throw $e;
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
        throw $e;
        }
    }

?>