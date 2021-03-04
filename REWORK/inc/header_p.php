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
        <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
        <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
    <nav class="navbar navbar-light bg-dark justify-content-between">
    <h5 class="text-center"><span class="text-warning">MFA<?php echo $mfa; ?></span> ĆELIJA <span class="text-warning"><?php echo $cell; ?></span>
    - <?php echo $ime." ".$prezime.", ID: ".$id_card; ?></h5>
    <h5 class="text-success date-time"><span id="date-time">Datum: <?php echo strftime("%d.%m.%Y."); ?></span>
      &nbsp; <a href='<?php echo "../scripts/script_MFA_logOut?BR=".$_SESSION['mfa']."&CELL=".$_SESSION['cell']; ?>' class="btn btn-md btn-danger float-right"><b>Odjava</b></a></h5>
    </nav>