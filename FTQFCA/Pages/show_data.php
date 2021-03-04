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

$sql = "SELECT * FROM ftq_fca.unos ORDER BY datum_popunjavanja DESC";
$result = mysqli_query($conn_fca, $sql);

?>

<?php require "../inc/header_l.php"; ?>

<div class="container-fluid">
<br><br>

<h2 class="text-center">>> Prikaz Podataka Unosa <<</h2><br>

<a href="ftq_fca" class="btn btn-primary btn-md"><- Nazad</a>
<br><br>
<table class="table table-hover table-dark text-center">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Linija</th>
      <th scope="col">Tim</th>
      <th scope="col">Smena</th>
      <th scope="col">Datum proizvodnje</th>
      <th scope="col">Datum popunjavanja</th>
      <th scope="col">Mesec</th>
      <th scope="col">Nedelja</th>
      <th scope="col">Mesto detektovanja defekta</th>
      <th scope="col">Mesto nastanka defekta</th>
      <th scope="col">Kod defekta</th>
      <th scope="col">Opis defekta</th>
      <th scope="col">Broj instalacije</th>
      <th scope="col">Pozicija defekta 1</th>
      <th scope="col">ID Tim Lidera</th>
      <th scope="col">ID Operatera</th>
      <th scope="col">Rework-Skart:</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $i = 1;
    while($res = mysqli_fetch_assoc($result)){
        $date_ac_y = substr($res['datum_popunjavanja'], 0, 4); //get year
        $date_ac_m = substr($res['datum_popunjavanja'], 5, 2); //get month
        $date_ac_d = substr($res['datum_popunjavanja'], 8, 2); //get day
        $date_ac_time = substr($res['datum_popunjavanja'], -8); //get TIME
        $format_datum_popunjavanja = $date_ac_d.".".$date_ac_m.".".$date_ac_y.". ". $date_ac_time;

        $date_pr_y = substr($res['datum_popunjavanja'], 0, 4); //get year
        $date_pr_m = substr($res['datum_popunjavanja'], 5, 2); //get month
        $date_pr_d = substr($res['datum_popunjavanja'], 8, 2); //get day
        $format_datum_proizvodnje = $date_pr_d.".".$date_pr_m.".".$date_pr_y.".";
echo $date_pr_time;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>".$res['linija']."</td>";
        echo "<td>".$res['tim']."</td>";
        echo "<td>".$res['smena']."</td>";
        echo "<td>".$format_datum_proizvodnje."</td>";
        echo "<td>".$format_datum_popunjavanja."</td>";
        echo "<td>".$res['mesec']."</td>";
        echo "<td>".$res['nedelja']."</td>";
        echo "<td>".$res['mesto_detect_def']."</td>";
        echo "<td>".$res['mesto_nastanka_def']."</td>";
        echo "<td>".$res['kod_defekta']."</td>";
        echo "<td>".$res['opis_defekta']."</td>";
        echo "<td>".$res['br_instalacije']."</td>";
        echo "<td>".$res['pozicija_def']."</td>";
        echo "<td>".$res['ID_timLidera']."</td>";
        echo "<td>".$res['ID_operatera']."</td>";
        echo "<td>".$res['rew_skart']."</td>";
        echo "</tr>";
        $i++;
    }
    ?>
  </tbody>
</table>
<?php require "../inc/footer.php"; ?>