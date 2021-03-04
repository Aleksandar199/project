<?php
// Početak sesije
  session_start();
// Konekcija na bazu
  include 'db_connection.php';
// Varijable
  $page="index.php";
  if (isset($_GET['filter'])) {
    $datum_od=$_GET['date_from'];
    $datum_do=$_GET['date_to'];
  }
  else {
    $datum_unosa=$_GET['date'];
  }
// Provera logovanja i restartovanje sesije
  $user_id = $_SESSION['userform'];

  if ($user_id == "") {
    session_unset();
    // destroy the session
    session_destroy();
    //izabrani tim sa nastavkom .php koristi kao link
    header("Location: $page");
    exit;
  }

// Odjavljivanje korisnika
  if (isset($_POST['odjava'])) {
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    //izabrani tim sa nastavkom .php koristi kao link
    header("Location: $page");
    exit;
  }
// Filtriranje po ID broju
  if (isset($_POST['pretraga'])) {
    header('Location:'.$_SERVER['PHP_SELF']."?date=".$_GET['date']."&operater=".$_POST['id']);
    exit;
  }
// Aktiviranje filtera
  if (isset($_POST['filter'])) {
    header('Location:'.$_SERVER['PHP_SELF']."?date=".$_POST['date']);
    exit();
  }
// Aktiviranje filtera raspona
  if (isset($_POST['filter_range'])) {
    header('Location:'.$_SERVER['PHP_SELF']."?filter=range&date_from=".$_POST['date_from']."&date_to=".$_POST['date_to']);
    exit();
  }
// Export
  if (isset($_POST['export'])) {
    $export_page="export.php?date=".$datum_unosa;
    header("Location: $export_page");
    exit();
  }
// Provera odobrenja alatima
    $stock_count = 1; 
    $disabled = $stock_count > 0 ? "disabled='disabled'" : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Baza Prijavljenih</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
</head>
<body class="body-p body-color container">

  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
	<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="index.php" >
		Početna stranica</a>
	<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#pregled-dana">
		Pregled dana</a>

  </div>

	<h4 class="text-dark text-left mt-3">Lista prijavljenih operatera za: <span class='font-weight-bold text-danger'>
          <?php
            if (isset($_GET['filter'])) {
              echo "od ".$datum_od." do ".$datum_do;
            }
            else
              echo $datum_unosa;
          ?>
            
          </span>
	</h4>


<!-- Glavni sadrzaj-->
	<hr class="bg-secondary">
	<div class="row">
		

		<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">
			<div class="rounded text-dark shadow-sm bg-light border border-info p-2 mb-4">
			<img src="asset/icon/info-circle.svg" class="float-right" width="24" alt="">
			<p>
			Format datuma je <span class="text-danger">Godina-mesec-dan</span>!
			<br>
			Kada je filtriran raspon, pretraga po operateru nije moguća.</p>
			</div>	
	
        <form method="POST">
		<div class="input-group shadow-sm mb-2 mr-2">
          <input class="form-control border-light" id="operater" type="text"  name="id" placeholder="Pretraži operatera po ID broju" value="" autocomplete="off">
            <div class="input-group-append">
              <button class="btn btn-light" type="submit" name="pretraga">Pretraži</button>
            </div>
			
		
			<?php if (isset($_GET['operater'])){
				echo'
			<div class="input-group-append">
			<button class="btn btn-secondary shadow-sm text-left" type="submit" name="filter">Poništi pretragu</button>
				</div>
				';
			}?>
			</div>
		   
          <small>:mesec-dan-godina:</small>
		  <div class="input-group shadow-sm mb-2 mr-2">
	  <!--  lista selekcija datuma prisutnih u bazi
				<select class="form-control border-light" name="date">
				<option value="$tim_filter" selected disabled hidden>Izaberi datum</option>
				<?php
				//povlaci vrednosti iz tabele timovi
				$sql = "SELECT DISTINCT datum_unosa FROM mf_prisustvo ORDER BY datum_unosa DESC ";
				$result = mysqli_query($conn, $sql);
				while ($row = mysqli_fetch_array($result)) {
				echo "<option value='".$row['datum_unosa']."'>".$row['datum_unosa']."</option>";
				}
				?>
			  </select> -->
			  <input class="form-control border-light" type="date" name="date" data-date-format="yyyy/mm/dd" value="<?php echo $datum_unosa;?>">
			  <div class="input-group-append">
			  <button type="submit" class="btn btn-light" name="filter">Filtriraj Datum</button>
			  </div>
		  </div>
		  
		  <small>Mora biti od manjeg ka većem!</small>
          <div class="input-group shadow-sm mb-2 mr-2">
		  
		  <!--
          <select class="custom-select custom-select-sm rounded-0 mb-1 bg-light" name="date_from">
            <option selected disabled hidden>Datum od</option>
            <?php
            //povlaci vrednosti iz tabele timovi
            $sql = "SELECT DISTINCT datum_unosa FROM mf_prisustvo ORDER BY datum_unosa DESC ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            echo "<option value='".$row['datum_unosa']."'>".$row['datum_unosa']."</option>";
            }
            ?>
          </select>
          <select class="custom-select custom-select-sm rounded-0 mb-1 bg-light" name="date_to">
            <option selected disabled hidden>Datum do</option>
            <?php
            //povlaci vrednosti iz tabele timovi
            $sql = "SELECT DISTINCT datum_unosa FROM mf_prisustvo ORDER BY datum_unosa DESC ";
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_array($result)) {
            echo "<option value='".$row['datum_unosa']."'>".$row['datum_unosa']."</option>";
            }
            ?>
          </select>
		  -->
		  <input class="form-control border-light" type="date" name="date_from" value="<?php echo $datum_unosa;?>">
		  
		  
		  <input class="form-control border-light" type="date" name="date_to" value="<?php echo $datum_unosa;?>">
		
		  
		  <div class="input-group-append">
          <button type="submit" class="btn btn-light" name="filter_range">Filtriraj Raspon</button> 
	          	  
		  </div>
		  
        </div>

		  
		  
		  
          <button type="submit" class="btn btn-success shadow-sm text-left mr-2 mb-2" name="export" formaction="export.php?
          <?php 
            if (isset($_GET['filter'])) {
              echo "filter=range&date_from=".$datum_od."&date_to=".$datum_do;
            }
            else
              echo "date=".$datum_unosa;
          ?>
          ">Izvedi u Excell</button>
        </form>  
      </div>

		
		
		
<!--Desni segment sa projektima-->
		<div class="col-xl-8 col-lg-7 col-md-6 mb-3">


<!-- Prikaz rezultata -->


  <?php
  include 'db_connection.php';
  $results_per_page = 50;
if (isset($_GET['filter'])) {
  $sql = "SELECT COUNT(id_zaposlenog) AS total FROM mf_prisustvo WHERE datum_unosa BETWEEN '$datum_od' AND '$datum_do'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

}
else {
  $sql = "SELECT COUNT(id_zaposlenog) AS total FROM mf_prisustvo WHERE datum_unosa LIKE '$datum_unosa'";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results
}
  //tabelarni prikaz promenjiv
  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  $start_from = ($page-1) * $results_per_page;

if (isset($_GET['operater'])) {
  $operater = $_GET['operater'];
    $sql = "SELECT * FROM mf_prisustvo WHERE datum_unosa LIKE '$datum_unosa' AND id_zaposlenog LIKE '$operater' ORDER BY tim, id_zaposlenog ASC LIMIT $start_from, ".$results_per_page;
  $rs_result = $conn->query($sql);
}
else if (isset($_GET['filter'])) {
      $sql = "SELECT * FROM mf_prisustvo WHERE datum_unosa BETWEEN '$datum_od' AND '$datum_do' ORDER BY datum_unosa, tim, id_zaposlenog ASC LIMIT $start_from, ".$results_per_page;
  $rs_result = $conn->query($sql);

}

else 
  $sql = "SELECT * FROM mf_prisustvo WHERE datum_unosa LIKE '$datum_unosa' ORDER BY tim, id_zaposlenog ASC LIMIT $start_from, ".$results_per_page;
  $rs_result = $conn->query($sql);



  echo '
  <div class="card bg-light shadow-sm pt-2">
  <table class="table table-sm table-hover table-borderless text-center">
  <thead>
  <tr class="">
    <th>ID</th>
    <th>Ime</th>
    <th>Prezime</th>
    <th>Smena</th>
    <th>Tim</th>
    <th>Transfer</th>
    <th>Pozicija</th>
    <th>Vreme Prijave</th>
    <th>Akcija</th>
  </tr>
  </thead>';

  while($row = $rs_result->fetch_assoc()) {
  echo '
            <tr>
            <td>'.$row["id_zaposlenog"].'</td>
            <td>'.$row["ime"].'</td>
            <td>'.$row["prezime"].'</td>
            <td>'.$row["smena"].'</td>
            <td>'.$row["tim"].'</td>
            <td>'.$row["transfer"].'</td>
            <td>'.$row["pozicija"].'</td>
            <td>'.$row["datum_unosa"].' '.$row["vreme_unosa"].'</td>
            <td><a href="op_del.php?pagelink='.$_SERVER["PHP_SELF"].'?id='.$row["id_unosa"].'&change=deleteinput" name="del" class="text-danger">Obriši</a></td>
            </tr>'
            ;
  };

  echo "</table>";

    echo '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-start">';

if (isset($_GET['filter'])) {
    for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages

              echo "<li class='p-1'> <a  class='' href='prijavljeni.php?filter=range&date_from=".$datum_od."&date_to=".$datum_do."&page=".$i."'";
              if ($i==$page)  echo "class='page-link' ";
              echo ">".$i."</a></li> "; 

  }; 
}
else{
  for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages

              echo "<li class='p-1'> <a  class='' href='prijavljeni.php?date=".$datum_unosa ."&page=".$i."'";
              if ($i==$page)  echo "class='page-link' ";
              echo ">".$i."</a></li> "; 

  }; }
              echo "  </ul>
  </nav>";
?>
</div>
</div>
</div>


<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-light p-3 rounded-0">
        <div class="modal-header mb-2">
          <h5 class="modal-title" id="exampleModalLabel">Total prijavljenih po timovima</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
              <p class="bg-white p-2 rounded-0 border shadow-sm">Klikom na tim otvoriće vam se grafički prikaz prijavljenih pozicija <span class="text-danger">(Primenjivo samo za aktuelni dan)</span> za izabran tim.</p>
                          <?php
                             //kreiranje tabele
                              echo '<table class="table table-sm table-borderless text-center rounded-0 border shadow-sm bg-white">
                              
                              <tr>
                              <th> Smena</th>
                              <th> Tim</th>
                              <th> Prisutno DH</th>
                              <th> Prisutno IH</th>
                              </tr>
                              ';
                             
                             //izvlaci unikatne vrednosti iz kolone tim, za izabrani datum, i broji unikatne vrednosti iz kolone id za taj tim
                              foreach($conn->query("SELECT  smena,
 tim,
  count(distinct (case when mf_prisustvo.struktura = 'DH' then id_zaposlenog end)) as dh,
  count(distinct (case when mf_prisustvo.struktura = 'IH' then id_zaposlenog end)) as ih FROM mf_prisustvo WHERE datum_unosa = '$datum_unosa' GROUP BY tim ORDER BY smena") as $row) {
                                echo "<tr>";
                                echo "<td>" . $row['smena'] . "</td>";
                                echo "<td><a href='prijava.php?tim_filter=".$row['tim']."'  target='_blank'>" . $row['tim'] . "</td>";
                                echo "<td>" . $row['dh'] . "</td>";

                                echo "<td>" . $row['ih'] . "</td>";

                                echo "</tr>";
                                
                             }
                             echo"</table>";
                             ?>

      </div>
    </div>
  </div>

<script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
<script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

</body>

</html>