<?php
session_start();

include("connection.php");
include("functions.php");
include("controller/systemController.php");

if (isset($_SESSION['user_id'])) {
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
    body {
        margin-left: 100px;
    }

    p {
        font-size: 18px;
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
    }

    .button a {
        color: white;
    }

    .button:hover {
        background-color: #5A5A5A;
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

    input {
        min-width: 15ch;
        max-width: 30ch;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
        line-height: 1.1;
        border: 1px solid grey;
    }

    form {
        font-size: 18px;
        max-width: 100%;
        border-radius: 0.25em;
        padding: 0.25em 0.5em;
        font-size: 1.25rem;
    }
</style>
<body>
<p>Current comments on transaction history id: <?php echo $transactionHistory->get_TransactionHistoryID(); ?></p>
<table class="center">
    <?php
    if (is_array($comments) && !empty(array_filter($comments))) {
        echo '
              <th>Comment</th>
              <th>Comment Date</th>';
        foreach (array_filter($comments) as $rows) {
            echo '
            <tr>
                <td>' . $rows->get_Comment() . '</td>
                <td>' . $rows->get_DateCreated() . '</td>
            </tr>
            ';
        }
    } else if (!is_array($comments) && !empty($comments)) {
        echo '<th>Comment</th>
              <th>Comment Date</th>
            <tr>
                <td>' . $comments->get_Comment() . '</td>
                <td>' . $comments->get_DateCreated() . '</td>
            </tr>';
    } else {
        echo '<p>' . "No Comments exist for: ", $transactionHistory->get_TransactionHistoryID() . '</p>';
    }
    ?>
</table>
<p>To add a comment for this transaction, please enter a comment below:</p>
<form class="center" method="post" action="submitComment.php">
    <label for="comment"><p>Comment:</p></label>
    <input type="text" id="comment" name="comment">
    <br><br>
    <input class="submit" type="submit" id="submitComment" name="submitComment" value="Add Comment">
    <?php $newComment = new TraineeComments();
    $newComment->set_TraineeUserID($transactionHistory->get_UserID());
    $newComment->set_TransactionHistoryID($transactionHistory->get_TransactionHistoryID());
    $newComment->set_ManagerUserID(0); //TODO update to also populate with managerID if user is a manager ?>
    <input type='hidden' name="var" id="var" value='<?php echo json_encode($newComment); ?>'>
</form>
</body>
</html>