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
//Redirekt na svoju celiju pri namernom unoselju linka tudje celije.
if($_COOKIE['cell'] != $_GET['CELL'] OR $_COOKIE['mfa'] != $_GET['BR']){
    header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/Pages/MFA_Info?BR=".$_COOKIE['mfa']."&CELL=".$_COOKIE['cell']);
}

//get INFO
$sql1 = "SELECT * FROM logs.mfa".$_COOKIE['mfa']." WHERE  `Post` = '".$_COOKIE['cell']."' AND `STATUS`='1'";
$result1 = mysqli_query($conn_logs, $sql1);
while($res = mysqli_fetch_assoc($result1)){ 
  $ime = $res['NAME'];
  $prezime = $res['SURNAME'];
  $id_card = $res['ID_CARD'];
  $_COOKIE['ID_LOG'] = $res['ID_LOG'];
}

//GET DEFECT CODE AND NUMBER
$sql2 = "SELECT `DefectCode`, COUNT(*) AS Broj FROM rework.ftq_rew_v WHERE `Line`='mfa".$_COOKIE['mfa']."' AND `Post`='".$_COOKIE['cell']."' GROUP BY `DefectCode` ORDER BY Broj DESC LIMIT 5";
$result2 = mysqli_query($conn_rew, $sql2);

//GET USER DEF CODE
$sql3 = "
SELECT `DefectCode`, COUNT(*) AS Broj
FROM rework.ftq_rew_v WHERE `IDOperater`=(SELECT ID_CARD FROM logs.mfa".$_COOKIE['mfa']." WHERE  `Post`='".$_COOKIE['cell']."' AND `STATUS`='1')
GROUP BY `DefectCode`
ORDER BY Broj DESC
LIMIT 5";
$result3 = mysqli_query($conn_rew, $sql3);

//GET GRESKE
$sql4= "
SELECT * FROM rework.ftq_rew_v WHERE 
`Signature` = 'NE' AND `Line`='MFA".$_COOKIE['mfa']."' AND 
`Post` = '".$_COOKIE['cell']."' AND
`IDOperater`= (SELECT ID_CARD FROM logs.mfa".$_COOKIE['mfa']." WHERE  `Post` = '".$_COOKIE['cell']."' AND `STATUS`='1')";

$result4 = mysqli_query($conn_rew, $sql4);

?>

