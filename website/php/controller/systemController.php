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

    //todo: update function to aggregate portfolio amounts with commodity prices to get total amounts
      function aggAcctTotal($portfolio)
      {
        if ($portfolio < 1) return null;
        $AmountTotal = 0;
        foreach($portfolio as $result) {
            $AmountTotal += $result['Amount'];
             }
        return $AmountTotal;
      }
?>