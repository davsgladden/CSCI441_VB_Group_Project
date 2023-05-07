<?php

session_start();

include("connection.php");
include("functions.php");
include("controller/systemController.php");

$trainee = null;
if (isset($_POST['trainee'])) {
    $trainee = $_POST['trainee'];
}
echo $trainee;
$traineeManage = new TraineeManagement();
if (isset($_POST['addTrainee'])) {
    $res = json_decode($_POST['addTrainee'], true);
    $traineeManage = getTraineeManagement($res); //sets up the trainee management object
}

$traineeManage->set_TraineeUserID($trainee);
        try {
            if ($traineeManage->get_TraineeUserID() !== null) {
                insertTraineeManagement($con, $traineeManage);
            } 
        } catch (Exception $e) {
            echo $e->getMessage();
        }
?>
<script>
    function clickAlert() {
        parent.location.reload();
    }
</script>
<!DOCTYPE html>
<html>
<body onload="clickAlert();">

</body>
</html>
