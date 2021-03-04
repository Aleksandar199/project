<?php 
  error_reporting(0);
  require_once "../scripts/db_conn_logs.php";
  require_once "../scripts/db_conn_rework.php";

  $xml = simplexml_load_file("../mfa.xml") or die("Error: Cannot create object :(");

  $sql = "SELECT count(*) AS total FROM logs.mfa320 WHERE Status=1";
  $result = mysqli_query($conn_rew, $sql);
  $res =  mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="900">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/ticket.ico" type="image/x-icon" />
        <meta name="author" content="Ivan Funcik">
        <title>MFA320 | LOGS</title>
       
         <!--bootstrap-->
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
        <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
      <div class="container">

                  <table class="table table-striped table-dark">
                    <thead>
                      <tr>
                        <th scope="col" colspan="5" class="text-center text-warning"><h3 class="float-left text-success">Prijavljeni: <?php echo $res['total']; ?>/25</h3><h3>MFA320 - Lista prijavljenih korisnika</h3></th>
                      </tr>
                    </thead>
                    <tbody>
                        <tr class="text-warning text-center">
                          <th>#</th>
                          <th>Ćelija</th>
                          <th>Ime</th>
                          <th>Prezime</th>
                          <th>Datum logovanja</th>
                        </tr>
                      <?php  
                      $i = 1;
                             foreach($xml->mfa[2]->mfa320 as $m){
                               $sql1 = "SELECT * FROM logs.mfa320 WHERE Status=1 AND Post='$m->celija'";
                               $result1 = mysqli_query($conn_rew, $sql1);
                               
                               echo " <tr class='text-center'>";
                               echo "<th>$i</th>";
                               echo "<th>$m->celija</th>";
                               
                               while($res = mysqli_fetch_assoc($result1)){
                                echo "<th>".$res['NAME']."</th>";
                                echo "<th>".$res['SURNAME']."</th>";
                                echo "<th>".$res['LOGIN']."</th>";
                               }

                               echo " </tr>";
                               $i++;
                            }
                       ?>
                    </tbody>
                  </table>
      </div>


<?php require "../inc/footer.php"; ?>