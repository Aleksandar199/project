<?php require "../scripts/script_MFA_verify_card.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="900">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/ticket.ico" type="image/x-icon" />
        <meta name="author" content="Ivan Funcik">
        <title>MFA<?php echo $_SESSION['mfa']; ?> | VERIFIKACIJA POTVRDE</title>
       
         <!--bootstrap-->
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
        <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
    <div id="container">
    
    <br><br><br>
     <h2 class="text-center text-warning">MFA<?php echo $_SESSION['mfa']; ?> - VERIFIKACIJA</h2>
     <div class="card-logIn-verify">
        <div class="card-logIn text-center">
               <h5 class="text-warning text-center">Skenirajte Vašu ID karticu kako bi potvrdili.</h5>
              <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                  <input class="text-center form-control" type="password" name="RF_TAG" autofocus placeholder="******">
              </form>
        	  <h5 class="text-danger"><?php echo $msg; ?></h5>
           </div>
        </div>
      </div>

<?php require "../inc/footer.php"; ?>