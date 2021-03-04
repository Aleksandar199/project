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

$ID_FR = $_COOKIE['ID_FR'];
$IDOP = $_COOKIE['IDOperater'];
$RF_TAG = $_POST['RF_TAG'];

$query1 = "SELECT * FROM rework.employee WHERE ID_CARD='$IDOP' AND RF_TAG='$RF_TAG'";
$result1 = mysqli_query($conn_rew, $query1);

  if(isset($_POST['RF_TAG'])){
      //Ako je prihvacen
      if($_COOKIE['verify'] == "DA"){
          if(mysqli_num_rows($result1) > 0){
            $query2 =  "UPDATE ftq_rew_v SET Signature='DA', RP=1 WHERE ID_FR='$ID_FR'";
            $result2 = mysqli_query($conn_rew, $query2);

            setcookie("verify", "", time() - (3600 * 9));
            header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/Pages/MFA_Info?BR=".$_COOKIE['mfa']."&CELL=".$_COOKIE['cell']);
          }
      }
       //Ako je odbijen
      if($_COOKIE['verify'] == "NE"){
             if(mysqli_num_rows($result1) > 0){
               $query2 =  "UPDATE ftq_rew_v SET Signature='ODB', RP=1 WHERE ID_FR='$ID_FR'";
               $result2 = mysqli_query($conn_rew, $query2);

               setcookie("verify", "", time() - (3600 * 9));
               header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/Pages/MFA_Info?BR=".$_COOKIE['mfa']."&CELL=".$_COOKIE['cell']);
              } 
      }
      if($_POST['RF_TAG'] == ""){
        $msg = "Polje za unos ID kartice je prazno!";
      }
      else{
        $msg = "Broj ID kartice koju ste skenirali se ne poklapa, molimo da skenirate Vašu ID karticu!";
      }
  }
       
?>