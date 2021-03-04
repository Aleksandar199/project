<?php
// Početak sesije
  session_start();
// Konekcija na bazu
  include 'db_connection.php';
// Varijable
  $page="index.php";
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
// Prikaz korisnickog imena navbaru
  $query_user = "SELECT * FROM `hr_zaposleni` WHERE `id_zaposlenog` LIKE '$user_id'";
  $query_user_1 = mysqli_query($conn, $query_user);
  
  //definisanje rezultata kverija u stringove
  while ($row = mysqli_fetch_array($query_user_1)) {
  $ime = $row['2'];
  $prezime = $row['3'];
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


// Provera odobrenja alatima
    $stock_count = 1; 
    $disabled = $stock_count > 0 ? "disabled='disabled'" : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Stanice</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
</head>
<body class="body-p body-color container" >

	<!-- Navigacija -->
	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
		<a class="btn btn-light shadow-sm text-left mr-2 mb-3" href="index.php">
		Početna stranica</a>
	</div>
	
	<!--naslov-->
	<h4 class="text-dark text-left mt-3">
	Pregled radnih stanica po liniji</h4>
	<hr class="bg-secondary">
	<div class="row">
<!--levi segment sa instrukcijama i opcijama-->
		<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">
			<div class="rounded text-dark shadow-sm bg-light border border-info p-2 mb-4">
			<img src="asset/icon/info-circle.svg" class="float-right" width="24" alt="">
			<p>
			Pri ažuriranju prvo izvedite podatke u Excel kako bi imali formu za uvoz.</p>
			</div>

        <button type="button" class="btn btn-light shadow-sm text-left mr-2 mb-2" name="filter" data-toggle="modal" data-target="#exampleModal">Ažuriraj podatke</button>
        <form action="export.php" method="post" name="upload_excel">
          <input type="submit" name="export_stanice" class="btn btn-success shadow-sm text-left mr-2 mb-2" value="Izvedi u Excel"/>    
        </form>
		<hr>
		<div class="sticky-top pt-3">
		            <?php
						$query="SELECT DISTINCT me_stanice.id_linije FROM me_stanice ORDER BY me_stanice.id_linije";
			$rs_result = mysqli_query($conn, $query);

			while($row = mysqli_fetch_array($rs_result)) {
			$proces = $row["id_linije"];

			echo '  
			<a class=" btn btn-light shadow-sm text-left mr-2 mb-2" href="#'.$proces.'">'.$proces.'</a>

			'
			;	}	?>	
			</div>
    </div>
	
	
<!--Desni segment sa projektima-->
		<div class="col-xl-8 col-lg-7 col-md-6 mb-3">

    <!-- Prikaz rezultata -->
            <?php
						$query="SELECT DISTINCT me_stanice.id_linije FROM me_stanice ORDER BY me_stanice.id_linije";
			$rs_result = mysqli_query($conn, $query);

			while($row = mysqli_fetch_array($rs_result)) {
			$proces = $row["id_linije"];

			echo '  
			<div class="card text-center bg-light  shadow-sm" id="'.$proces.'">
			<h5 class="text-left ml-3 mt-3">'.$proces.'</h5>
			<div class="dropdown-divider"></div>

			'
			;
			

			
    $Sql = "SELECT * FROM me_stanice WHERE id_linije = '$proces'";
    $result = mysqli_query($conn, $Sql);  
    if (mysqli_num_rows($result) > 0) {
     echo "<table id='myTable' class='table table-sm table-hover table-borderless'>
             <thead><tr>
                          <th>#</th>
                          <th>Proces</th>
                          <th>Radna Pozicija</th>
                          <th>Broj Operatera</th>
                        </tr></thead><tbody>";
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr>
                   <td>" . $row['redni_broj']."</td>
                   <td>" . $row['radni_proces']."</td>
                   <td>" . $row['radna_pozicija']."</td>
                   <td>" . $row['broj_operatera']."</td></tr>";        
     }
    
     echo "</tbody></table></div>";
     
} else {
     echo "you have no records";
}

			}  ?>
        
	</div>
	</div>

<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content bg-light p-3 rounded-0">
                      <br>
              <p class="bg-white p-2 rounded-0 border shadow-sm">Izabrati liniju koju ažurirate (<span class="text-danger">Svi podaci u bazi će se obrisati za izabranu liniju!</span>), i očitajte fajl sa novim podacima.<br><span class="text-danger">Pre primene potvrdite ispravnost unetih podataka!</span></p>
              <form class="form-horizontal" action="functions.php" method="post" name="upload_excel" enctype="multipart/form-data">
                <select class="custom-select form-control mb-3 rounded-0 shadow-sm" name="izborlinije" onsubmit="required()">
                  <option selected="selected" disabled="">Linija za azuriranje</option>
                  <option>Izaberi sve</option>
                  <?php
                  //povlaci vrednosti iz tabele timovi
                  $query = "SELECT DISTINCT id_linije FROM me_stanice";
                  $query_run = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_array($query_run)) {
                  echo "
                  <option value='".$row['id_linije']."'>".$row['id_linije']."</option>";
                  }
                  ;
                  ?>
                </select>
  <div class="custom-file shadow-sm">
    <input type="file" class="custom-file-input" id="inputGroupFile01" name="file">
    <label class="custom-file-label rounded-0" for="inputGroupFile01">Učitaj fajl sa podacima</label>

</div>
                <hr>
                <button type="button" class="btn btn-secondary rounded-0 shadow-sm" data-dismiss="modal">Otkaži</button>
                <button type="submit" class="btn btn-primary rounded-0 shadow-sm" name="Import" value="Primeni" data-loading-text="Očitava se...">Primeni</button>
              </form>
          </div>

        </div>
      </div>

<script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
<script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

</body>

</html>