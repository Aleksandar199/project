<?php 
  $cell = $_GET['CELL'];
  $mfa = $_GET['BR'];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="900">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/ticket.ico" type="image/x-icon" />
        <meta name="author" content="Ivan Funcik">
        <title>MFA<?php echo $mfa; ?> | <?php echo $cell; ?></title>

        <!--bootstrap-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="bootstrap-4.6.0-dist/css/bootstrap.min.css">
        <script src="bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="CSS/style.css">
    </head>
    <body>
    <nav class="navbar navbar-light bg-dark justify-content-between">
      <a class="navbar-brand"><img src="Images/aptiv.svg" alt="Aptiv"></a>
      <div class="date-time-div"><h4 class="text-success date-time">Datum: <span id="date-time"><?php echo strftime("%d.%m.%Y."); ?></span></h4></div>
      <a class="navbar-brand float-right"><img src="Images/MFA_logo.png" width="50px" height="50px" alt="Mercedes"></a>
    </nav>
    