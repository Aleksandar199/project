<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Prijava Prisustva</title>
		<link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
		<script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
		<script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
		<?php
			include 'db_connection.php';
			
			$str = $_GET["input_id"];
			$query_ime = "SELECT * FROM mf_prisustvo WHERE id_unosa='$str'";
			$query_ime_run = mysqli_query($conn, $query_ime);
			
			while ($row = mysqli_fetch_array($query_ime_run)) {
			$id=$row['1'];
			$ime=$row['3'];
			$prezime=$row['2'];
			$pozicija=$row['10'];
			$tim=$row['5'];
			}
			;
					$datum_unosa = date ("Y-m-d");
			
					//upis promena u bazu
					if(isset($_POST['promena'])){
			
						$tip_izmene = $_POST['tip_izmene'];
			
						if ($tip_izmene == "1") {
							
							$sql = "INSERT INTO `mf_prisustvo`(`id_zaposlenog`, `datum_unosa`,`pozicija`)
							VALUES ('$id','$datum_unosa','$_POST[pozicija_operatera]')
							ON DUPLICATE KEY UPDATE
							`pozicija` = values (`pozicija`)";
			
							if ($conn->query($sql) === TRUE) {
							header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
							exit;
							}
							else {
							echo "Error: " . $sql . "<br>" . $conn->error;
							}
						}
			
						else{
			
							//upis u listu
							$sql1 = "INSERT INTO `mf_prisustvo`(`id_zaposlenog`, `datum_unosa`,`pozicija`)
							VALUES ('$id','$datum_unosa','$_POST[pozicija_operatera]')
							ON DUPLICATE KEY UPDATE
							`pozicija` = values (`pozicija`)";
			
							if ($conn->query($sql1) === TRUE) {
							}
							else {
							echo "Error: " . $sql1 . "<br>" . $conn->error;
							}
			
							//izmena predefinisanih vrednosti
							$sql2 = "INSERT INTO `hr_zaposleni`(`id_zaposlenog`,`radna_pozicija`)
							VALUES ('$id','$_POST[pozicija_operatera]')
							ON DUPLICATE KEY UPDATE
							`radna_pozicija` = values (`radna_pozicija`)";
			
							if ($conn->query($sql2) === TRUE) {
							header('Location:'.$_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);
							exit;
							}
							else {
							echo "Error: " . $sql2 . "<br>" . $conn->error;
							}
						}
					}
			?>
	</head>
	<body>
		<div class="container p-5">
		<div class="row justify-content-center">
		<div class="col-6">
			<div class="card bg-light p-1">
				<div class="card-body">
					<a href="<?php echo "pregled_prisustva.php?tim_filter=".$_GET["team_filter"]?>" class="btn btn btn-dark" >Povratak na pregled pozicija</a>
					<h4 class="mt-3 mb-3">Promena radne pozicije:</h4>
					<form method="post" >
						<div class="form-group row">
							<label for="id_operatera" class="col-lg-4 col-form-label">ID : </label>
							<div class="col-lg-8">
								<input type="text" class="form-control"class="form-control" name="id_operatera" value="<?php echo $id;?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="ime-operatera" class="col-lg-4 col-form-label">Ime i Prezime :</label>
							<div class="col-lg-8">
								<input type="text" class="form-control"class="form-control" name="ime_operatera" autocomplete="off" value="<?php echo $ime." "; echo $prezime;?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="tp" class="col-lg-4 col-form-label">Trenutna Pozicija :</label>
							<div class="col-lg-8">
								<input type="text" class="form-control"class="form-control" name="tp" autocomplete="off" value="<?php echo $pozicija;?>" disabled>
							</div>
						</div>
						<div class="form-group row">
							<label for="pozicija_operatera" class="col-lg-4 col-form-label">Nova Pozicija :</label>
							<div class="col-lg-8">
								<select class="custom-select form-control mb-3" name="pozicija_operatera" >
									<option value="" selected="selected" disabled="">Izaberi poziciju</option>
									<?php
										//povlaci vrednosti iz tabele timovi
										include 'db_connection.php';
										
										$query = "SELECT radna_pozicija FROM me_stanice INNER JOIN mf_timovi ON me_stanice.id_linije = mf_timovi.id_linije WHERE mf_timovi.tim = '$tim' ORDER BY me_stanice.redni_broj";
										$query_run = mysqli_query($conn, $query);
										
										while ($row = mysqli_fetch_array($query_run)) {
										  echo "<option value='".$row['radna_pozicija']."'>".$row['radna_pozicija']."</option>";
										}
										$conn->close();
										?>
								</select>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
							</div>
							<div class="col-lg-8">
								<label  class="mr-3">			
								<input type="radio" name="tip_izmene" id="privremena" Value="1" autocomplete="off" checked > Privremena Promena
								</label>	
								<label>
								<input type="radio" name="tip_izmene" id="stalna" Value="2" autocomplete="off">Trajna Promena
								</label>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-lg-4">
							</div>
							<div class="col-lg-8">
								<input type="submit" class="btn btn-outline-dark" name="promena" value="Primeni izmenu">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>