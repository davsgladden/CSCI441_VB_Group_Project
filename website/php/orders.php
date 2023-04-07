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

    #tables{
        display: flex;
        align-items: flex-start;
        flex-direction: row;
        justify-content: center;
        padding: 15px;
        flex-grow: 1;
        flex-wrap: wrap;

    }
    #forms{
        display: flex;
        align-items: flex-start;
        flex-direction: row;
        justify-content: left;
        padding: 15px;
        flex-grow: 1;
    }
    

    table,chart {
        font-family: arial, sans-serif;
        border-collapse: collapse;
    }

    select {
        width: 100%;
        min-width: 15ch;
        max-width: 30ch;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        cursor: pointer;
        line-height: 1.1;
        border: 1px solid grey;
}
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
    table{
        width: 65%
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .center {
        display: inline-block;
        align-items: left;
        width: 50%;
    }

    .submit {
        background-color: #549bf7; /* Black */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
}
    .button{
        background-color: #549bf7; /* Black */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        margin-left: 600px;
    }
    .break {
    flex-basis: 100%;
    height: 0;
    }

</style>
<body>
    <?php include_once("navbar.php");?>

    <br>
    <p>Hello, <?php echo $user_data->get_UserName(); ?>.<br>
    <div id="forms">
        <form class= "center">
            <select>
                <option selected="selected">Choose a commodity</option>
                <?php
                    // Iterating through the Commodity object array
                    foreach(array_filter($commodityArr) as $commodity){
                        echo "<option value='($commodity->Symbol)'>$commodity->Symbol</option>";
                    }
                ?>
            </select>
            <input class="submit" type="submit" value="Submit">
        </form>
        <form method="post">
                <button class="button"><a href="ticket.php" target="myiFrame">Sell</a></button>
            </form>
    </div>
    <br>
    <div id="tables">
        <table>
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

            <?php //plotting the chart  ?>
            <script src="//code.jquery.com/jquery-1.9.1.js"></script>
            <script src="//cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>
            <canvas id="myChart" class="center" style="width:100%;max-width:700px"></canvas>
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
    <iframe width="700" height ="315" class="center" name="myiFrame" id="myiFrame" ></iframe>
        </table>
</body>
</html>