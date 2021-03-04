<?php 

require_once "../scripts/db_conn_logs.php";
require_once "../scripts/db_conn_rework.php";
error_reporting(0);

//Ako nije ulogovan, vraca ga na LogIn.
if(empty($_COOKIE['logged_in']))
{
    header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/MFA_LogIn?BR=".$_GET['BR']."&CELL=".$_GET['CELL']);
    exit;
}

$ID_FR = $_GET['ID_FR'];
$result = mysqli_query($conn_rew, "SELECT * FROM ftq_rew_v WHERE ID_FR=$ID_FR");
 
//prihvacen
if(isset($_POST['update'])){

        setcookie("verify", "DA", time() + (3600 * 9));
        header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/Pages/mfa_verify_card");
 }
 //odbijen
 if(isset($_POST['update_NO'])){

        setcookie("verify", "NE", time() + (3600 * 9));
        header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/Pages/mfa_verify_card");
 }

?>