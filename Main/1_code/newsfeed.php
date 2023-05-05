<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
        $newsFeed = getNewsFeedHistory($con,$user_data->get_ID());
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Newsfeed</title>
</head>
<style>
    p{
        padding: 15px;
        font-size: 20px;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
        font-family: Verdana, Arial;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .submit {
        background-color: #549bf7; /* Black */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 12px;
        font-family: Verdana, Arial;
    }
    .center {
        display: inline-block;
        align-items: left;
        width: 50%;
    }

</style>
<body>
<?php include_once("navbar.php");?>

<br>
<p>Hello, <?php echo $user_data->get_UserName(); ?></p>

<div>
    <table class="center">
    <form method="post" action="comment.php" target="myiFrame">
        <?php
        echo '<th>History</th>
              <th>Comment(s) exists</th>
              <th>View/Add Comment</th>';
        if ($newsFeed > 1)
            foreach(array_filter($newsFeed) as $rows){
                if($rows['OrderType'] == "Sell"){
                    $Transaction = "sold";
                } else $Transaction = "purchased";
                echo '
            <tr>
            <td>User '.$rows['UserName'].' '.$Transaction.' '.$rows['Amount'].' shares of '.$rows['CommodityName'].'
                    at '.$rows['Price'].' a share on '.$rows['TransactionDate'].'</td>
                <td>'.$rows['CommentExists'].'</td>
                <td>
                    <button type="submit" id='.$rows['TransactionHistoryID'].' name="historyID" value = '.$rows['TransactionHistoryID'].' class="submit">
                        Add/View Comment
                    </button>
                </td>
            </tr>
              
            ';
            }
        ?>
    </form>
    </table>
    <!--TODO: adjust iframe to display to the right of history table-->
    <iframe width="700" height ="425" class="center" name="myiFrame" id="myiFrame" ></iframe>
        </div>
</body>
</html>