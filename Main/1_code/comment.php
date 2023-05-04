<?php
    session_start();

    include("connection.php");
    include("functions.php");
    include("controller/systemController.php");

    if(isset($_SESSION['user_id'])) {
        $user_data = fetchUser($con, "UserID = $_SESSION[user_id]");
    }

    $transactionHistory = new TransactionHistory();
    $comments = new TraineeComments();
    if (isset($_POST['historyID'])) {
        $transactionHistory = fetchTransactionHistory($con, "TransactionHistoryID = '$_POST[historyID]'");
        $comments = fetchTraineeComments($con, "TransactionHistoryID = '$_POST[historyID]'");
    }

?>
<!DOCTYPE html>
<html>
<head>
    <title>Ticket</title>
</head>
<style>
    body{margin-left: 100px;}
    p{
        padding: 1px;
        font-size: 20px;
    }
    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    .submit {
        background-color: #549bf7; /* Aqua */
        border: grey;
        color: black;
        padding: 10px 24px;
        text-align: center;
        text-decoration: none;
        font-size: 12px;
    }

    select {
        width: 75%;
        min-width: 15ch;
        max-width: 25ch;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        cursor: pointer;
        line-height: 1.1;
        border: 1px solid grey;
        margin: 0px;
    }
    input{
        min-width: 15ch;
        max-width: 30ch;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        line-height: 1.1;
        border: 1px solid grey;
    }
    form{
        font-size: 18px;
        max-width: 100%;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
    }
</style>
<body>
<p>Current comments on transaction history id: <?php echo $transactionHistory->get_TransactionHistoryID(); ?><br>
<table class="center">
    <?php
    if (is_array($comments) && !empty(array_filter($comments))) {
        echo '
              <th>Comment</th>
              <th>Comment Date</th>';
        foreach (array_filter($comments) as $rows) {
            echo '
            <tr>
                <td>'.$rows->get_Comment().'</td>
                <td>'.$rows->get_DateCreated().'</td>
            </tr>
            ';
        }
    } else if(!is_array($comments) && !empty($comments)){
        echo '<th>Comment</th>
              <th>Comment Date</th>
            <tr>
                <td>'.$comments->get_Comment().'</td>
                <td>'.$comments->get_DateCreated().'</td>
            </tr>';
    } else {
        echo "No Comments exist for: ", $transactionHistory->get_TransactionHistoryID();
    }
    ?>
</table>
<br>
        Adding comment to transaction. Please fill out the form below:</p>
    <form class = "center" method="post" action="submitComment.php">
        Enter a comment for this transaction: <br>
        <label for="comment">Comment:  </label>
        <input type="text" id="comment" name="comment">
        <br><br>
        <input class="submit" type="submit" id="submitComment" name="submitComment" value="Add Comment">
         <?php $newComment = new TraineeComments();
            $newComment->set_TraineeUserID($transactionHistory->get_UserID());
            $newComment->set_TransactionHistoryID($transactionHistory->get_TransactionHistoryID());
            $newComment->set_ManagerUserID(0);?>
        <input type='hidden' name="var" id="var" value='<?php echo json_encode($newComment); ?>'>
    </form>
</body>
</html>