<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");
    $id = "";
    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");

        if($user_data->get_UserTypeID() == 1) {
         $newsFeed = getNewsFeedHistory($con, $user_data->get_ID());
     } else if($user_data->get_UserTypeID() == 2) {
         $newsFeed = getNewsFeedHistory($con, getTraineeIds($con, $user_data->get_ID()));
      }
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
    table {
        width: 100%;
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
        padding: 5px 5px;
        text-align: center;
        text-decoration: none;
        font-size: 14px;
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
        cursor: pointer !important;
        font-family: Verdana, Arial;
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
        margin: 2px;
    }

    .top-left, .top-right {
        flex: 1 0;
    }
    .hello {
        font-family: Verdana, Arial;
    }
    h2{
        padding: 15px;
        font-family: Verdana, Arial;
    }
</style>
<body>
<?php include_once("navbar.php");?>

<br>
<h2>Newsfeed Page</h2>
<div id="container">
    <div class="top-left" style="width:100%;max-width:inherit;height:100%;max-height:inherit;">
        <table class="center" style="width:100%;max-width:inherit;height:100%;max-height:inherit;">
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
    </div>
    <div class="top-right">
        <iframe style="width:100%;max-width:inherit;height:100%;min-height:500px;max-height:inherit;" class="center" name="myiFrame" id="myiFrame" ></iframe>
    </div>
    </div>
</body>
</html>