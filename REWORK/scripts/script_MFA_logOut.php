<?php
require_once "../scripts/db_conn_logs.php";

        //get ID_LOG
        $ID_LOG = $_COOKIE['ID_LOG'];
        //SET STATUS 0 ALL
        $sql1 = "UPDATE logs.mfa".$_COOKIE['mfa']."  SET `STATUS`='0' WHERE `ID_LOG`>1 AND `POST`='".$_COOKIE['cell']."'";
        $result1 = mysqli_query($conn_logs, $sql1);

        $LOG_OUT_date = date('Y-m-d H:i:s');
        //UPDATE LOG OUT 
        $sql3 = "UPDATE logs.mfa".$_COOKIE['mfa']."  SET `LOGOUT`=' $LOG_OUT_date' WHERE `ID_LOG`='$ID_LOG' AND `POST`='".$_COOKIE['cell']."'";
        $result3 = mysqli_query($conn_logs, $sql3);
      
        setcookie("logged_in", "", time() - (3600 * 9));
	setcookie("cell", "", time() - (3600 * 9));
	setcookie("mfa", "", time() - (3600 * 9));
        setcookie("verify", "", time() - (3600 * 9));

        header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/MFA_LogIn?BR=".$_COOKIE['mfa']."&CELL=".$_COOKIE['cell']);
?>

