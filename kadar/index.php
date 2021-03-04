<?php
// Početak sesije
	session_start();

// Provera forme i putanje ka opcijama
	if (isset($_POST["prijava"],$_POST["izbortima"])) {
		$link="prijava.php?tim_filter=".$_POST["izbortima"];
		header("Location: $link");
		exit;
	}
	
// Provera forme i putanje ka opcijama
	if (isset($_POST["pregled"],$_POST["izbortima"])) {
		$link="pregled_prisustva.php?tim_filter=".$_POST["izbortima"];
		header("Location: $link");
		exit;
	}

	
	
// define variables and set to empty values
if (isset($_SESSION['userform'])) {
}
else {
$_SESSION['userform']="";
$pass=$_SESSION['userform'];
}
		$datum_unosa = date ("Y-m-d");
	$pass=$_SESSION['userform'];
	$lozinka= "admin";
	$page="index.php";
	if (isset($_POST['unlock_btn'])) {
		// Podaci iz forme
		
	    $pass = test_input($_POST["unlock_pass"]);
	    $_SESSION['userform'] = $pass;

		if ($pass!==$lozinka) {
			$pass="";
			echo '<div class="alert alert-danger">Pogrešna lozinka! Pokušajte ponovo.</div';
		}
		}
		
		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	if (isset($_POST['odjava'])) {
		// remove all session variables
		session_unset();
		// destroy the session
		session_destroy();
		//izabrani tim sa nastavkom .php koristi kao link
		header("Location: $page");
		exit;
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>KADAR</title>
	<link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">		

</head>
<body  class="body-p body-color container">

  <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">

<?php if ($pass==$lozinka){ 
echo  '
	
	<form method="POST">
		<input type="submit" name="odjava" class="btn btn-light shadow-sm text-left mr-2 mb-2" value="Odjavi se">
	</form>
';} 
else { 
echo'

	<form class="input-group shadow-sm mb-2 mr-2" method="post">
	

		<input type="password" class="form-control border-light" name="unlock_pass" placeholder="Lozinka">

		<div class="input-group-append">
			<button class="btn btn-light" type="submit" name="unlock_btn">
				<img src="asset/icon/unlock.svg" class="img-fluid" alt="prijavi se"></button>
		</div>
	</form>	
'; } ?>
	<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#pregled-dana">
		Pregled dana</a>
  </div>


	<h4 class="text-dark text-left mt-3">Aplikacija za evidenciju prisustva,
		<span class="font-weight-bold text-danger">
			KADAR
		</span>
	</h4>

<!-- Glavni sadrzaj-->
	<hr class="bg-secondary">
	<div class="row">
	
			<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">
			<div class="rounded text-dark shadow-sm bg-light border border-info p-2 mb-4">
			<img src="asset/icon/info-circle.svg" class="float-right" width="24" alt="promeni tim">
			<p>
			Ova aplikacija je namenjena za evidenciju prisustva operatera na liniji i njihovih aktivnih pozicija.<br><br>
			Da biste započeli upotrebu, izaberite željeni tim u ispod dostupnoj selekciji, i kliknite na "Prijava operatera"</p>
			</div>
        <form method="post">
		<small class="text-secondary">Izaberite tim pre prijave operatera</small>
				<select class="form-control border-light shadow-sm mr-2 mb-2" name="izbortima" >
				
					<option value="" selected="selected" disabled="">Izaberite tim</option>
						<?php
							//povlaci vrednosti iz tabele timovi
							include 'db_connection.php';
							
							$query = "SELECT tim FROM mf_timovi";
							$query_run = mysqli_query($conn, $query);
							
							while ($row = mysqli_fetch_array($query_run)) {
							  echo "<option value='".$row['tim']."'>".$row['tim']."</option>";
							}
							
							$conn->close();
							?>
					</select>
									
				<div class="form-group">
				<input type="submit" name="prijava" value="Prijava operatera" class="btn btn-light shadow-sm text-left mr-2 mb-2">
				<input type="submit" name="pregled" value="Pregled prisustva" class="btn btn-light shadow-sm text-left mr-2 mb-2">
				</div>

				  </form>
				</div>
	
		<div class="col-xl-8 col-lg-7 col-md-6 mb-3">
		
		
<?php if ($pass==$lozinka){ echo '	
		  		<a href="baza_zaposleni.php" class="btn btn-light shadow-sm text-left mr-2 mb-2">Baza zaposlenih</a>
		  		<a href="baza_prijavljeni.php?date='. $datum_unosa.'" class="btn btn-light shadow-sm text-left mr-2 mb-2">Baza prisustva</a>
				<a href="pregled_timova.php" class="btn btn-light shadow-sm text-left mr-2 mb-2">Pregled timova</a>
				<a href="me_stanice.php" class="btn btn-warning shadow-sm text-left mr-2 mb-2">Radne stanice</a>
';
}?>				
				
		</div>	
	

</div>

	<div class="modal fade" id="pregled-dana" tabindex="-1" role="dialog" aria-labelledby="pregled-dana" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content bg-light">
				
				<!--naslov-->
				<div class="modal-header">
					<h5 class="modal-title" id="pregled-dana">Pregled dana</h5>
					<button type="button" class="btn btn-link text-danger" data-dismiss="modal" aria-label="Close"> Zatvori</button>
				</div>
				
				<!--sadrzaj-->
				<div class="modal-body">

						<table class="table table-hover table-sm table-borderless text-center p-2">
							<thead>
								<tr>
									<th>Smena</th>
									<th>Tim</th>
									<th>Prisutno DH</th>
									<th>Prisutno IH</th>
								</tr>
							</thead>

							<tbody>
								<?php
									include 'db_connection.php'; 

									//izvlaci unikatne vrednosti iz kolone tim, za izabrani datum, i broji unikatne vrednosti iz kolone id za taj tim
									foreach($conn->query("SELECT  smena,
									tim,
									count(distinct (case when mf_prisustvo.struktura = 'DH' then id_zaposlenog end)) as dh,
									count(distinct (case when mf_prisustvo.struktura = 'IH' then id_zaposlenog end)) as ih FROM mf_prisustvo WHERE datum_unosa = '$datum_unosa' GROUP BY tim ORDER BY smena") as $row) {
								?>
								<tr>
									<td> <?php echo $row['smena']; ?> </td>
									<td><a href="pregled_prisustva.php?tim_filter=<?php echo $row['tim']; ?>" target="_blank"> <?php echo $row['tim']; ?> </td>
									<td> <?php echo $row['dh']; ?> </td>
									<td> <?php echo $row['ih'];} ?> </td>
								</tr>
							</tbody>
						</table>
					
				</div>
			</div>
		</div>
	</div>


<script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
<script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

</body>
</html>