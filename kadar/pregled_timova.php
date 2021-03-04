<?php
// Početak sesije
session_start();
// Konekcija na bazu
include 'db_connection.php';
// Provera logovanja i restartovanje sesije
$user_id = $_SESSION['userform'];
$page    = "index.php";

if ($user_id == "") {
	session_unset();
	// destroy the session
	session_destroy();
	//izabrani tim sa nastavkom .php koristi kao link
	header("Location: $page");
	exit;
}

//kreiranje novog tima
if (isset($_POST['tim_create'])) {
	$id_new = '$_POST[id_new]';
	if ($id_new == "") {
		$id_new = NULL;
	}
	$sql = "INSERT INTO `mf_timovi`(`id_lidera`, `id_linije`, `tim`) VALUES ('$id_new','$_POST[line_new]','$_POST[tim_new]')";
	
	if ($conn->query($sql) === TRUE) {
		echo '<div class="alert alert-success">Tim uspešno kreiran!</div';
	} else {
		echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
	}
}

//azuriranje broja ljudi po projektu
if (isset($_POST['ppl_projekat'])) {
	
	$sql = "UPDATE `mf_timovi` SET `ppl_target`='$_POST[broj_target]' WHERE id_linije = '$_POST[projekat_target]'";
	
	if ($conn->query($sql) === TRUE) {
		echo '<div class="alert alert-success">HC target uspešno promenjen!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
	}
}
//brisanje tima iz baze
if (isset($_POST['obrisi_tim'])) {
	$sql = "DELETE FROM `mf_timovi`
		WHERE tim = '$_POST[tim_za_brisanje]'";
	
	if ($conn->query($sql) === TRUE) {
		echo '<div class="alert alert-success">Tim uspešno obrisan!</div>';
	} else {
		echo '<div class="alert alert-danger">Error: ' . $sql . '<br>' . $conn->error . '</div>';
	}
}

// Provera odobrenja alatima
$stock_count = 1;
$disabled    = $stock_count > 0 ? "disabled='disabled'" : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Pregled Timova</title>
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
	Pregled timova i targeta po timu</h4>
	<hr class="bg-secondary">
	<div class="row">

<!--levi segment sa instrukcijama i opcijama-->
		<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">
			<div class="rounded text-dark shadow-sm bg-light border border-info p-2 mb-4">
			<img src="asset/icon/info-circle.svg" class="float-right" width="24" alt="">
			<p>
			U desnom segmentu stranice prikazani su timovi, grupisani po projektu, sa svojim HC targetima. Klikom na iste, otvara vam se mogućnost individualne promene HC targeta.<br>Alternativno, u ispod dostupnim opcijam možete promeniti target na nivou celog projekta.</p>
			</div>

			<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#add-team">
			Novi tim</a>
			<a class="btn btn-light shadow-sm text-left mr-2 mb-2 disabled" href="" data-toggle="modal" data-target="#add-line" >
			Novi projekat</a>
			<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#ppl_projekat">
			Promena targeta po projektu</a>
			<a class="btn btn-danger shadow-sm text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#modal_obrisi_tim">
			Obriši tim</a>
		</div>


<!--Desni segment sa projektima-->
		<div class="col-xl-8 col-lg-7 col-md-6 mb-3">
			<div class="card-columns">

			<?php
			$query="SELECT DISTINCT mf_timovi.id_linije FROM mf_timovi ORDER BY mf_timovi.id_linije";
			$rs_result = mysqli_query($conn, $query);

			while($row = mysqli_fetch_array($rs_result)) {
			$proces = $row["id_linije"];
			echo '  
			<div class="card text-center bg-light  shadow-sm">
			<h5 class="text-left ml-3 mt-3">'.$proces.'</h5>
			<div class="dropdown-divider"></div>

			'
			;
			$query_pos="
			SELECT
			*
			FROM
			mf_timovi
			WHERE id_linije = '$proces'
			ORDER BY tim";
			$query_res = mysqli_query($conn,$query_pos);
			echo '
			<table class="table table-sm table-hover table-borderless">
			<thead >
			<tr>
			</tr>
			</thead>';
			if ($result = $conn->query($query_pos)) {
			while ($row = $query_res->fetch_assoc()) {

			$field1name = $row["tim"];
			$field2name = $row["ppl_target"];
			echo '<tr>';

			echo '<td class="text-left pl-3">'.$field1name.'</td>';
			echo '<td class="text-right pr-3"><a href="op_del.php?pagelink='.$_SERVER["PHP_SELF"].'&id='.$field1name.'&change=linehc_target" name="edt" >HC '.$field2name.'</a></td>';
							
			}
			$result->free();
			}
			echo "</table>
			</div>";
			}
			?>
			</div>
		</div>
	</div>
<!------------------------------------------------------------------------->

<!-- modal promena po projektu-->
	<div class="modal" id="ppl_projekat" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content p-3 bg-light">
		<h5 class="mb-3">
		Promena broja operatera po projektu</h5>

		<form class="" method="post" >
			<p>
			Izaberite projekat i unesite HC target. Klikom na "Promeni", HC target će se promeniti svim timovima koji pripadaju izabranom projektu.</p>
			
			<select class="custom-select form-control shadow-sm mb-3" name="projekat_target" required>
				<option value="" selected="selected" disabled="">Izaberite projekat</option>
				<?php
				$query = "SELECT DISTINCT id_linije FROM me_stanice";
				$query_run = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($query_run))
				{
				echo "<option value='" . $row['id_linije'] . "'>" . $row['id_linije'] . "</option>";
				}
				$query_run->free();
				?>
			</select>
			
			<input type="text" class="form-control mb-3 shadow-sm" name="broj_target" autocomplete="off" value="" placeholder="Unesite novi broj operatera (HC target)" required="">
			
			<button type="button" class="btn btn-secondary   mr-3" data-dismiss="modal">Otkaži</button>
			<input type="submit" class="btn btn-primary  " name="ppl_projekat" value="Promeni">
		</form>
	</div>
	</div>
	</div>

<!-- modal kreiranje novog tima-->
	<div class="modal" id="add-team" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content p-3 bg-light">
		<h5 class="mb-3">
		Kreiranje novog tima</h5>

		<form class="" method="post" >
			<p>
			U ponuđena polja uneti naziv novog tima i izabrati kojem projektu pripada.</p>
			
			<select class="custom-select form-control mb-3 shadow-sm" name="line_new" required>
				<option value="" selected="selected" disabled="">Izaberite projekat</option>
				<?php
				$query = "SELECT DISTINCT id_linije FROM me_stanice";
				$query_run = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($query_run))
				{
				echo "<option value='" . $row['id_linije'] . "'>" . $row['id_linije'] . "</option>";
				}
				$query_run->free();
				?>
			</select>
			
			<input type="text" class="form-control mb-3 shadow-sm" name="tim_new" autocomplete="off" value="" placeholder="Unesite naziv novog tima" required>
			
			<button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Otkaži</button>
			<input type="submit" class="btn btn-primary  " name="tim_create" value="Kreiraj tim">
		</form>
	</div>
	</div>
	</div>

<!-- modal brisanje projekta-->

<!-- modal kreiranje novog tima-->
	<div class="modal" id="modal_obrisi_tim" tabindex="-1" role="dialog">
	<div class="modal-dialog">
	<div class="modal-content p-3 bg-light">
		<h5 class="mb-3">
		Brisanje tima iz baze</h5>

		<form class="" method="post" >
			<p>
			U ponuđena polja uneti naziv novog tima i izabrati kojem projektu pripada.U ponuđena polja uneti naziv novog tima i izabrati kojem projektu pripada.</p>
			
			<select class="custom-select form-control mb-3 shadow-sm" name="tim_za_brisanje" required>
				<option value="" selected="selected" disabled="">Izaberite tim</option>
				<?php
				$query = "SELECT DISTINCT tim FROM mf_timovi";
				$query_run = mysqli_query($conn, $query);
				while ($row = mysqli_fetch_array($query_run))
				{
				echo "<option value='" . $row['tim'] . "'>" . $row['tim'] . "</option>";
				}
				$query_run->free();
				?>
			</select>
			
			<button type="button" class="btn btn-secondary mr-3" data-dismiss="modal">Otkaži</button>
			<input type="submit" class="btn btn-danger  " name="obrisi_tim" value="Obriši tim">
		</form>
	</div>
	</div>
	</div>

<script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
<script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

</body>
</html>