<?php
session_start();

include("connection.php");
include("functions.php");
include("controller/systemController.php");

    if (isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
    }
    /** fetch commodities for dropdown list */
    $commodityArr = fetchCommodity($con);

    /** fetch selected commodity for chart */
    $selectedCommodity = new Commodity();
    if (isset($_POST['commodity'])) {
        $selectedCommodity = fetchCommodity($con, "CommodityID = '$_POST[commodity]'");
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Orders</title>
</head>
<style>
    p {
        padding: 15px;
        font-size: 20px;
    }

    .hello {
        font-family: Verdana, Arial;
    }

    #tables {
        display: flex;
        align-items: flex-start;
        flex-direction: row;
        justify-content: center;
        padding: 15px;
        flex-grow: 1;
        flex-wrap: wrap;

    }

    #forms {
        display: flex;
        align-items: flex-start;
        flex-direction: row;
        justify-content: left;
        padding: 15px;
        flex-grow: 1;

    }


    table, chart, CanvasJS {
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
        font-family: Verdana, Arial;
    }
    caption {
        border: 1px solid #bdbdbd;
        text-align: center;
        padding: 8px;
        font-weight: bold;
        font-family: Verdana, Arial;
        color: white;
        background-color: #595959;
    }

    table {
        width: 65%
    }

    tr:nth-child(odd) {
        background-color: #dddddd;
    }

    .center {
        display: inline-block;
        align-items: left;
        width: 50%;
        font-family: Verdana, Arial;
    }

    .submit {
        background-color: #549bf7; /* Black */
        border: grey;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        font-family: Verdana, Arial;
        cursor: pointer !important;
        border-radius: 0.25em;
    }

    .submit:hover {
        background-color: #5A5A5A;
    }

    .button {
        background-color: #549bf7; /* Black */
        border: grey;
        color: white;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 18px;
        margin-left: 400px;
        font-family: Verdana, Arial;
        border-radius: 0.25em;
    }

    .button a {
        color: white;
    }

    .button:hover {
        background-color: #5A5A5A;
    }

    #container {
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
    }

    #container div {
        padding: 2px;
        margin: 10px;
    }

    .top-left, .top-right {
        flex: 1 1 0;
    }

    .bottom {
        flex: 100%;
        order: 3;
    }
</style>
<body>
<?php include_once("navbar.php"); ?>

<br>
<p class="hello">Hello, <?php echo $user_data->get_UserName(); ?>.<br>
<p class="hello">Please select a commodity in the list below to view history chart, or use the Create Trade button to create an order ticket.</p>
<div id="forms">
    <form class="center" method="post" action="">
        <select id="commodity" name="commodity">
            <option value="" selected="selected">Choose a commodity</option>
            <?php
            // Iterating through the Commodity object array
            foreach (array_filter($commodityArr) as $commodity) {
                echo "<option value='$commodity->CommodityID'>$commodity->Symbol</option>";
            }
            ?>
        </select>
        <input class="submit" id="submitChart" type="submit" value="Submit" ;>
    </form>
    <form method="post">
        <button class="button"><a href="ticket.php" target="myiFrame">Create Trade</a></button>
    </form>
</div>
<br>
<!--containers for chart, order, table-->
<div></div>
<div id="container">
    <div class="top-left">
        <div id="chartContainer" style="width:100%;max-width:inherit;height:500px"></div>
    </div>
    <div class="top-right">
        <iframe style="width:95%;max-width:700px" height="600px" class="center" name="myiFrame" id="myiFrame"></iframe>
    </div>
    <!--table of current prices -->
    <div class="bottom" id="tables">
        <table>
            <caption>Current Commodity Prices</caption>
            <?php
            echo '<th>Symbol</th>
              <th>Commodity Name</th>
              <th>Current Price</th>';
            if ($commodityArr > 1)
                // $commodity = new Commodity();
                foreach (array_filter($commodityArr) as $commodity) {
                    echo '
                    <tr>
                        <td>' . $commodity->get_Symbol() . '</td>
                        <td>' . $commodity->get_CommodityName() . '</td>
                        <td>' . $commodity->get_CurrentPrice() . '</td>
                    </tr>
                    ';
                }

            //get history for selected commodity
            $xValues = array();
            $yValues = array();
            if (!is_array($selectedCommodity) && $selectedCommodity->CommodityID > 0) {
                $commodityHistory = fetchCommodityHistory($con, "CommodityID = '.$selectedCommodity->CommodityID.'");

                $data = [];
                foreach (array_filter($commodityHistory) as $history) {
                    $xValues[] = $history->get_DateCreated();
                    $yValues[] = $history->get_Price();
                }
            }
            ?>

            <?php //plotting the chart  ?>
            <script type="text/javascript" src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
            <script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.stock.min.js"></script>
            <script type="text/javascript">
                window.onload = function () {
                    var dataPoints = [];

                    var stockChart = new CanvasJS.StockChart("chartContainer", {
                        title: {
                            text: "<?php echo "$selectedCommodity->CommodityName History" ?>"
                        },
                        charts: [{
                            data: [{
                                type: "area",
                                dataPoints: dataPoints
                            }]
                        }]
                    });

                    var data = [];
                    var dataSeries = {type: "area"};
                    const x2 = <?php echo json_encode($xValues) ?>;
                    const y2 = <?php echo json_encode($yValues) ?>;
                    for (var i = 0; i < y2.length; i += 1) {
                        dataPoints.push({x: new Date(x2[i]), y: Number(y2[i])});
                    }
                    dataSeries.dataPoints = dataPoints;
                    data.push(dataSeries);

                    stockChart.render();
                };
            </script>
        </table>
    </div>
</body>
</html>