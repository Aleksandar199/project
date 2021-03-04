
<?php
session_start();
error_reporting(0);
require_once "scripts/db_conn_rework.php";

$RF_TAG = $_POST['RF_TAG'];

$query  = "SELECT * FROM rework.employee WHERE RF_TAG='$RF_TAG'";
$result = mysqli_query($conn_rew, $query);

while($res = mysqli_fetch_assoc($result)){
   $user_ID_CARD = $res['ID_CARD'];
   $user_name = $res['Name'];
   $user_surname = $res['Surname'];
}
                     

if(isset($_POST['RF_TAG'])){
    
    if(mysqli_num_rows($result) == 0) {
      $msg = "KORISNIK NE POSTOJI U BAZI!\nMolimo Vas pokušajte ponovo.";
    }
    else{
        $_SESSION['log_in'] = 1;
        $_SESSION['user_ID_CARD'] = $user_ID_CARD;
        $_SESSION['username'] = $user_name. " " .$user_surname;
        header("Location: Pages/ftq_fca");
    }
}



?>
        <?php require "inc/header.php"; ?>

        <div class="container cont-ind">
        <h2 class="text-primary text-center">FTQ FCA - LogIn</h2>
           <div class="card-logIn text-center">
               <h5 class="text-primary text-center">Molimo Vas skenirajte Vašu ID karticu.</h5>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <input class="text-center form-control" type="password" name="RF_TAG" autofocus required placeholder="******">
              </form>
        	  <h5 class="text-danger"><?php echo $msg; ?></h5>
           </div>
        </div
