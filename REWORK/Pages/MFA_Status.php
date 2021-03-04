<?php 

error_reporting(0);
  require_once "../scripts/db_conn_logs.php";
  require_once "../scripts/db_conn_rework.php";


?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="900">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/ticket.ico" type="image/x-icon" />
        <meta name="author" content="Ivan Funcik">
        <title>MFA | STATUS</title>
        
         <!--bootstrap-->
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
         <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
      <div class="container">
      <h1 class="text-center text-warning">MFA STATUS</h1><br><br>
         <div class="row">
            <div class="col">
                <a href="MFA300_UsersLogs" class="btn btn-lg btn-primary form-control">MFA300 - LOG</a><br><br><br>
                <a href="<?php echo "http://10.239.172.30/FTQ_MFA300_GRAF2_24H_ctrl";?>" class="btn btn-lg btn-info form-control">MFA300 - GRAF</a>
            </div>
            <div class="col">
                <a href="MFA310_UsersLogs" class="btn btn-lg btn-primary form-control">MFA310 - LOG</a><br><br><br>
                <a href="" class="btn btn-lg btn-info form-control">MFA310 - GRAF</a>
            </div>
            <div class="col">
                <a href="MFA320_UsersLogs" class="btn btn-lg btn-primary form-control">MFA320 - LOG</a><br><br><br>
                <a href="<?php echo "http://10.239.172.30/FTQ_MFA320_GRAF2_24H_ctrl";?>" class="btn btn-lg btn-info form-control">MFA320 - GRAF</a>
            </div>
         </div>
            
      </div>


<?php require "../inc/footer.php"; ?>