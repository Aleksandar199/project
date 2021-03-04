
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="900">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Ivan Funcik">
        <title>FTQ FCA</title>

        <!--bootstrap-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
        <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
    <nav class="navbar navbar-light bg-secondary justify-content-between">
      <a class="navbar-brand"><img src="../Images/aptiv.svg" alt="Aptiv"></a>
      <h4 class="text-light">Korisnik: <?php echo $_SESSION['username']. ", ID: ".$_SESSION['user_ID_CARD']; ?></h4>
      <a href="../scripts/logOut.php" class="btn btn-lg btn-dark border-danger text-danger">Odjavite se</a> 
    </nav>
    