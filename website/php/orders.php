<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

if(isset($_SESSION['user_id'])) {
    $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
    $commodityArr = fetchCommodity($con);
}


?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
</head>
<style>
    p{
        padding: 15px;
        font-size: 20px;
    }

    table,form,chart {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 65%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .center {
        margin-left: auto;
        margin-right: auto;
    }


</style>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <p>Hello, <?php echo $user_data->get_UserName(); ?>.<br>
    <div>
        <form class = "center">
            <select>
                <option selected="selected">Choose a commodity</option>
                <?php
                    // Iterating through the Commodity object array
                    foreach(array_filter($commodityArr) as $commodity){
                        echo "<option value='($commodity->Symbol)'>$commodity->Symbol</option>";
                    }
                ?>
            </select>
            <input type="submit" value="Submit">
        </form>
    </div>
    <br>
    <div>
        <table class="center">
            <?php
            echo '<th>Symbol</th>
              <th>Commodity Name</th>
              <th>Current Price</th>';
            if ($commodityArr > 1)
               // $commodity = new Commodity();
                foreach(array_filter($commodityArr) as $commodity){
                    echo '
                    <tr>
                        <td>'.$commodity->get_Symbol().'</td>
                        <td>'.$commodity->get_CommodityName().'</td>
                        <td>'.$commodity->get_CurrentPrice().'</td>
                    </tr>
                    ';
                }
            ?>
            <br>
            <?php
            //get history for selected commodity
            $commodityHistory = fetchCommodityHistory($con, "CommodityID = 3"); //todo: make dynamic
               $xValues = array();
               $yValues = array();

               foreach(array_filter($commodityHistory) as $history){
                   $xValues[] = substr($history->get_DateCreated(),0,10);
                   $yValues[] = $history->get_Price();
                }
            ?>
            <form method="post">
                <button class="button"><a href="ticket.php" target="myiFrame">Sell</a></button>
            </form>
            <?php //plotting the chart  ?>
            <script src="//code.jquery.com/jquery-1.9.1.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
            <canvas id="myChart" class="center" style="width:100%;max-width:600px"></canvas>
            <script>
                const x = <?php echo json_encode($xValues) ?>;
                const y = <?php echo json_encode($yValues) ?>;

                new Chart("myChart", {
                    type: "line",
                    data: {
                        labels: x,
                        datasets: [{
                            fill: true,
                            lineTension: 0,
                            backgroundColor: "rgba(0,0,255,1.0)",
                            borderColor: "rgba(0,0,255,0.1)",
                            data: y
                        }]
                    },
                    options: {
                        title: {display: true, text: '<?php echo "Corn History" ?>'}, //todo: make dynamic
                        legend: {display: false},
                        scales: {
                            yAxes: [{ticks: {min: 6, max:6.8}}], //todo: make dynamic
                        }
                    }
                });
           </script>

            <iframe width="560" height ="315" class="center" name="myiFrame" id="myiFrame" ></iframe>
        </table>
</body>
</html>