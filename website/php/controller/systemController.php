<?php
    include("entity/commodity.class");
    include("entity/portfolio.class");

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