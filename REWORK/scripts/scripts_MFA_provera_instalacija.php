<?php 
require_once "../scripts/db_conn_rework.php";
error_reporting(0);


$scan = $_POST['harness_scan'];

$data = strstr($scan, '.', true); //get string before dot
$bgcolor = "lightgray";

if(isset($_POST['harness_scan'])){

    $sql = "SELECT * FROM rework.ftq_rew_v WHERE HarnessNumber='$data' AND (CardStatus='REWORK' OR CardStatus='TEST')";
    $result = mysqli_query($conn_rew, $sql);
    $res = mysqli_num_rows($result);

    if($res > 0){//crven
                  $sql2 = "INSERT INTO rework.MFA_packing_check (`ID`, `Date`, `HarnessNumber`, `Status`) VALUES (null, null, '$data', 'NOK')";
                  $result2 = mysqli_query($conn_rew, $sql2);
          
                  $bgcolor = "#ff8080";
                  $msgS = "<h1 class='text-danger text-center'>WARN!</h1>";
    }
    else{//zelen
                   $sql2 = "INSERT INTO rework.MFA_packing_check (`ID`, `Date`, `HarnessNumber`, `Status`) VALUES (null, null, '$data', 'OK')";
                   $result2 = mysqli_query($conn_rew, $sql2);
          
                  $bgcolor = "#99ffbb";
                  $msgS = "<h1 class='text-success text-center'>OK!</h1>";
    }
}

?>