<?php require "../scripts/scripts_MFA_provera_instalacija.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/ticket.ico" type="image/x-icon" />
        <meta name="author" content="Ivan Funcik">
        <title>MFA | Provera Instalacija - Packing</title>
        
         <!--bootstrap-->
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
         <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body style = "background: <?php echo $bgcolor; ?>;">
      <div class="container">
          <br><br><br>
         <h2 class="text-center text-dark">MFA Provera Instalacija - PACKING</h2>
         <div class="card-logIn-verify">
            <div class="card-logIn text-center">
                   <h5 class="text-warning text-dark">Skenirajte Broj Manifesta.</h5>
                  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
                      <input class="text-center form-control border-dark" type="text" name="harness_scan" autofocus placeholder="scan.." maxlength="14" required autocomplete="off">
                  </form>
            	  <h5 class="text-danger"><?php echo $msg; ?></h5>
               </div>
            </div>
            <br>
           <?php echo " <h1 class='text-success'>".$msgS."</h1>"; ?>
      </div>


<?php require "../inc/footer.php"; ?>
