<?php 
	include 'db_connection.php'; 
	
	// Varijable
	$tim_filter = $_GET['tim_filter'];
	
	$basetim_filterDH = 'DH '.$tim_filter;
	$basetim_filterIH = 'IH '.$tim_filter;

	$datum_unosa = date ("Y-m-d");
	$vreme_unosa = date ("H:i:s");

	// Konvertovanje vremena u smenu
	$SOPTime =  date ("H:i:s");

	if ($SOPTime >= "05:00:00" && $SOPTime <= "12:59:00") $Shift = "1";
	if ($SOPTime >= "13:00:00" && $SOPTime <= "20:59:00") $Shift = "2";
	if (($SOPTime >= "21:00:00" && $SOPTime <= "23:59:00") OR ($SOPTime >= "00:00:00" && $SOPTime <= "04:59:00")) $Shift = "3";

	if ($SOPTime >= "00:00:00" && $SOPTime <= "04:59:00") $datum_unosa = date ("Y-m-d", strtotime( '-1 days' ));
			
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="1200;url=index_plus.php">
  <title>Prijava Prisustva</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">

  <script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    
</head>
<!-- Naslov-->  
<body class="body-p body-color container">

  <div class="btn-toolbar mb-3" role="toolbar" aria-label="Toolbar with button groups">
	<a class="btn btn-light  text-left mr-2 mb-2" href="index_plus.php" >
		Početna stranica</a>
	<a class="btn btn-light  text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#pregled-dana">
		Pregled dana</a>
	<a class="btn btn-light  text-left mr-4 mb-2" href="pregled_prisustva.php?tim_filter=<?php echo $tim_filter?>" >
		Pregled prisustva</a>

	<form class="input-group  mb-2" method="post">
		<select class="form-control border-light" name="izbortima">
			<option value="$tim_filter" selected="selected" disabled="">Promeni Tim</option>
			<?php
			//povlaci vrednosti iz tabele timovi
			$query = "SELECT tim FROM mf_timovi";
			$query_run = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($query_run)) {
			echo "
			<option value='".$row['tim']."'>".$row['tim']."</option>";
			}
			;
			if (isset($_POST["promena"],$_POST["izbortima"])) {
			$link="prijava.php?tim_filter=".$_POST["izbortima"];
			header("Location: $link");
			exit;
			}
			?>
		</select>
		<div class="input-group-append">
			<button class="btn btn-light" type="submit" name="promena">
				<img src="asset/icon/arrow-down-up.svg" class="img-fluid" alt="promeni tim"></button>
		</div>
	</form>	

  </div>

	<h4 class="text-dark text-left mt-3">Prijava prisustva operatera, tim: 
		<span class="font-weight-bold text-danger">
			<?php echo $tim_filter;?>
		</span>
	</h4>


<!-- Glavni sadrzaj-->
	<hr class="bg-secondary">
	<div class="row justify-content-center">
		
		<div class="col-xl-5 col-lg-6 col-md-8">
			<br><br>
			<form class="input-group mb-3"  name="form1" method="post" onsubmit="required()" autocomplete="off">
				<input type="text" class="form-control form-control-lg border-light" placeholder="ID / RFID Broj" id="idoperatera" name="idoperatera" autofocus="">
				<div class="input-group-append">
					<button class="btn btn-lg btn-light" name="prijava" id="prijava" type="submit"> Prijava
					<img src="asset/icon/person-check.svg" class="img-fluid" alt="Prijavi">
					</button>
				</div>
			</form>

			<div class="card bg-light p-2 mb-2 ">
				<h4>Prijavite se očitavanjem kartice na RFID čitaču ili ručnim unosom ID broja.</h4>
			</div>

			<?php 


				// Provera ID-a u bazi nakon submita
				if(isset($_POST['prijava'])){

				$input = "$_POST[idoperatera]";                    // produces "Alien     "
				$input0 = str_pad($input, 10, "0", STR_PAD_LEFT); 
				$input1 =(int)$input;

				$query_ime = "SELECT * FROM hr_zaposleni WHERE id_zaposlenog = '$_POST[idoperatera]' OR rfid_tag='$input0' OR rfid_tag='$input1'";
				$query_ime_run = mysqli_query($conn, $query_ime);

				while ($row = mysqli_fetch_array($query_ime_run)) {
				$ID=$row['0'];
				$IME=$row['2'];
				$PREZIME=$row['3'];
				$POZICIJA=$row['6'];
				$struktura=$row['5'];
				}

				// U slucaju da ne pronadje ID, izbacuje informativnu poruku
				if (mysqli_num_rows($query_ime_run)==0) {
			?>
			
			<div class="card bg-danger p-2  text-light">
				<h2> <strong>Prijava neuspešna! (<?php echo $input;?>)</strong>
				<br><br>Očitajte ponovo ID karticu ili unesite ručno ID broj.</h2>
			</div>
			
			<?php  
				}

				//ako pronadje ID ubacuje ga u listu prijavljenih oepratera
				else{
				$sql1 = "
				INSERT INTO `mf_prisustvo`(`id_zaposlenog`, `ime`, `prezime`, `smena`, `tim`, `datum_unosa`, `vreme_unosa`,`transfer`,`pozicija`,`struktura`)
				VALUES ('$ID',N'$IME',N'$PREZIME','$Shift','$tim_filter','$datum_unosa','$vreme_unosa','N','$POZICIJA','$struktura')
				/*u slucaju duple KEY vrednosti azurira podatak o timu i transferu*/
				ON DUPLICATE KEY UPDATE
				tim = CASE WHEN tim <> VALUES (tim)
				THEN values (tim) ELSE tim END,
				transfer = CASE WHEN tim <> VALUES (tim)
				THEN 'N' ELSE 'Y' END";
				?>

				<div class="card bg-success p-2  text-light">
				<h2><strong><?php echo $ID. ", " .$IME. " " .$PREZIME. " </strong> <br>uspešno prijavljen."?></h2>
				</div>
				<?php
				//restartuje stranicu
				if ($conn->query($sql1) === TRUE){
				}
				else {
				echo "Error: " . $sql1 . "
				<br>" . $conn->error;
				}
				}
				}
			?>
		</div>


    <!-- Modal-->
		  
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


</body>
</html>