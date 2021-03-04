<?php 
session_start();
error_reporting(0);
require_once "../scripts/db_conn_rework.php";
require_once "../scripts/db_conn_ftqfca.php";


//Ako nije ulogovan, vraca ga na LogIn.
if(empty($_SESSION['log_in']))
{
    header("Location: ../index");
    exit;
}

?>

<?php require "../inc/header_l.php"; ?>

<div class="container">
<br><br>
<h2 class="text-center">>> Izaberite Liniju <<</h2><br>
    <div class="row">
       <div class="col">
          <a href="ftq_fca_insert?line=FH01-52197565" class="btn btn-lg btn-primary form-control">1. FH01-52197565</a>
       </div>
       <div class="col">
          <a href="ftq_fca_insert?line=FH02-52197563" class="btn btn-lg btn-primary form-control">2. FH02-52197563</a>
       </div>
    </div>
    <br><br>
    <div class="row">
       <div class="col">
          <a href="ftq_fca_insert?line=FH03-52197566" class="btn btn-lg btn-primary form-control">3. FH03-52197566</a>
       </div>
       <div class="col">
          <a href="ftq_fca_insert?line=FH04-52197564" class="btn btn-lg btn-primary form-control">4. FH04-52197564</a>
       </div>
    </div>
    <br>
    <a href="show_data" class="btn btn-lg btn-success form-control">PRIKAZ PODATAKA UNOSA</a>
</div>
<?php require "../inc/footer.php"; ?>