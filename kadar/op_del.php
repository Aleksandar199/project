<?php
include 'db_connection.php';
$pagelink=$_GET['pagelink'];

//upis promena u bazu
if(isset($_POST['promena'])){

		
		$sql = "DELETE FROM `mf_prisustvo`
		WHERE id_unosa = '$str'";

		if ($conn->query($sql) === TRUE) {
		header('Location:prijavljeni.php?date='.$datum_unosa);
		exit;
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Promena Unosa</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
   <link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container body-color">
		<div class="row d-flex justify-content-center">
			<div class="col-sm-7 col-xl-6">
		<div class="card-body">
<!-- Obavestenje -->
	<?php
	if (isset($_GET['info'])) {
		echo '<div class="d-flex justify-content-between">';
		echo "<h3>Uspešna akcija</h3>";
		echo '<a class="btn btn-success"  href="'.$pagelink.'">OK</a></div>';
		exit();
	}
	?>


<!-- Brisanje zaposlenog iz baze -->
	<?php
		if ($_GET['change']=="linehc_target") {
			$id=$_GET['id'];
	?>
		<h4>Promena HC targeta tima: <span class="text-danger"><?php echo $id?></span></h4>
		<hr>
					<form class="" method="post" >
				
				<input type="text" class="form-control mb-3 " name="broj_target" autocomplete="off" value="" placeholder="Unesite novi broj operatera" required="">
				
				<a class="btn btn-secondary" href="<?php echo $pagelink?>" >Otkaži</a>
				<input type="submit" class="btn btn-primary  " name="ppl_tim" value="Promeni">
			</form>
		
	
	<?php
	if (isset($_POST['ppl_tim'])) {
		$sql = "UPDATE mf_timovi SET ppl_target = '$_POST[broj_target]' WHERE tim = '$id'";

		if ($conn->query($sql) === TRUE) {
		header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
		exit;
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
		};
	?>




<!-- Brisanje zaposlenog iz baze -->
	<?php
		if ($_GET['change']=="deleteuser") {
			$id_zaposlenog=$_GET['id'];
			$sql = "SELECT * FROM hr_zaposleni WHERE id_zaposlenog LIKE '$id_zaposlenog'";
			$res = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($res)) {
				$id_zaposlenog=$row['id_zaposlenog'];
				$ime=$row['ime'];
				$prezime=$row['prezime'];
				$kategorija=$row['kategorija'];
				$pozicija=$row['pozicija'];
			};
	?>
		<h4>Brisanje zaposlenog iz baze</h4>
		<hr>
		<div class="row justify-content-center">

			<div class="col-6 text-right">
				<p>ID Operatera:</p>
			</div>
			<div class="col-6">
				<?php echo "$id_zaposlenog";?>
			</div>

			<div class="col-6 text-right">
				<p>Ime:</p>
			</div>
			<div class="col-6">
				<?php echo "$ime";?>
			</div>

			<div class="col-6 text-right">
				<p>Prezime:</p>
			</div>
			<div class="col-6">
				<?php echo "$prezime";?>
			</div>

			<div class="col-6 text-right">
				<p>Pozicija:</p>
			</div>
			<div class="col-6">
				<?php echo "$pozicija";?>
			</div>

			<div class="col-6 text-right">
				<p>Kategorija:</p>
			</div>
			<div class="col-6">
				<?php echo "$kategorija";?>
			</div>

			<div class="col-12 text-center">
			<a class="btn btn-secondary mb-2" href="<?php echo $pagelink?>" >Otkaži</a>
			<form method="POST">
				<input type="hidden" name="id_zaposlenog" value="$id_zaposlenog">
				<input type="submit" name="obrisi_zaposlenog" class="btn btn-danger" value="Obriši Zaposlenog">
			</form>
		</div>
		</div>
	<?php
	if (isset($_POST['obrisi_zaposlenog'])) {
		$sql = "DELETE FROM `hr_zaposleni`
		WHERE id_zaposlenog = '$id_zaposlenog'";

		if ($conn->query($sql) === TRUE) {
		header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
		exit;
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
		};
	?>

<!-- Brisanje unosa iz prijavljenih operatera -->

	<?php
		if ($_GET['change']=="deleteinput") {
			$id_unosa=$_GET['id'];
			$sql = "SELECT * FROM mf_prisustvo WHERE id_unosa LIKE '$id_unosa'";
			$res = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($res)) {
				$id_unosa=$row['id_unosa'];
				$id_zaposlenog=$row['id_zaposlenog'];
				$ime=$row['ime'];
				$prezime=$row['prezime'];
				$tim=$row['tim'];
				$radna_pozicija=$row['pozicija'];
			};
	?>
		<h4>Brisanje prijavljenog operatera iz prisustva</h4>
		<hr>
		<div class="row justify-content-center">

			<div class="col-6 text-right">
				<p>ID Unosa:</p>
			</div>
			<div class="col-6">
				<?php echo "$id_unosa";?>
			</div>

			<div class="col-6 text-right">
				<p>ID Operatera:</p>
			</div>
			<div class="col-6">
				<?php echo "$id_zaposlenog";?>
			</div>

			<div class="col-6 text-right">
				<p>Ime:</p>
			</div>
			<div class="col-6">
				<?php echo "$ime";?>
			</div>

			<div class="col-6 text-right">
				<p>Prezime:</p>
			</div>
			<div class="col-6">
				<?php echo "$prezime";?>
			</div>

			<div class="col-6 text-right">
				<p>Tim:</p>
			</div>
			<div class="col-6">
				<?php echo "$tim";?>
			</div>

			<div class="col-6 text-right">
				<p>Radna Pozicija:</p>
			</div>
			<div class="col-6">
				<?php echo "$radna_pozicija";?>
			</div>

			<div class="col-12 text-center">
			<a class="btn btn-secondary mb-2" href="<?php echo $pagelink?>" >Otkaži</a>
			<form method="POST">
				<input type="hidden" name="id_zaposlenog" value="$id_zaposlenog">
				<input type="submit" name="obrisi_prijavljenog" class="btn btn-danger" value="Obriši Unos">
			</form>
		</div>
		</div>
	<?php
	if (isset($_POST['obrisi_prijavljenog'])) {
		$sql = "DELETE FROM `mf_prisustvo`
		WHERE id_unosa = '$id_unosa'";

		if ($conn->query($sql) === TRUE) {
		header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
		exit;
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
		};
	?>

<!-- Brisanje tima iz baze -->
	<?php
	if ($_GET['change']=="deletelider") {
	$id_tim=$_GET['id'];
	$sql = "SELECT * FROM mf_timovi LEFT JOIN hr_zaposleni ON mf_timovi.id_lidera = hr_zaposleni.id_zaposlenog WHERE mf_timovi.tim LIKE '$id_tim'";
	$res = mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_array($res)) {
	$id_zaposlenog=$row['id_zaposlenog'];
	$ime=$row['ime'];
	$prezime=$row['prezime'];
	$tim=$row['tim'];
	};
	echo '
	<h4>Brisanje vođe/tima iz baze</h4>
	<hr>
	<p class="bg-white border shadow-sm p-2 text-danger">Pre odabira opcije proverite podatke!</p>
	<table class="table table-sm border bg-white shadow-sm">
	<tr>
	<th>Tim</th>
	<th>Id Linije</th>
	<th>Vođa Tima</th>
	</tr>

	<tr>
	<td>'.$tim.'</td>
	<td>'.$ime.'</td>
	<td>'.$prezime.'</td>

	</tr></table>'
	;

	?>


	<hr>
	<form method="POST">
		<a class="btn btn-secondary m-1 rounded-0 shadow-sm" href="<?php echo $pagelink?>" >Otkaži</a>
		<input type="submit" name="obrisi_zaposlenog" class="btn btn-danger m-1 rounded-0 shadow-sm" value="Obriši Vođu">
		<input type="submit" name="obrisi_tim" class="btn btn-danger m-1 rounded-0 shadow-sm" value="Obriši Tim">
	</form>
	</div>
				<?php
					if (isset($_POST['obrisi_zaposlenog'])) {
					$sql = "
					UPDATE `mf_timovi` SET `id_lidera` = NULL WHERE `mf_timovi`.`tim` = '$tim'
					";

					if ($conn->query($sql) === TRUE) {
					header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
					exit;
					}
					else {
					echo "Error: " . $sql . "<br>" . $conn->error;
					}
					}
					if (isset($_POST['obrisi_tim'])) {
					$sql = "
					DELETE FROM `mf_timovi` WHERE `mf_timovi`.`tim` = '$tim'
					";

					if ($conn->query($sql) === TRUE) {
					header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
					exit;
					}
					else {
					echo "Error: " . $sql . "<br>" . $conn->error;
					}
					}
					};
				?>

<!-- Brisanje profila korisnika -->

	<?php
		if ($_GET['change']=="deleteprofil") {
			$id_unosa=$_GET['id'];
			$sql = "SELECT * FROM root_korisnici WHERE id_zaposlenog LIKE '$id_unosa'";
			$res = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($res)) {
				$id_zaposlenog=$row['id_zaposlenog'];
				$lozinka=$row['lozinka'];
			};
	?>
		<h4>Brisanje prijavljenog operatera iz prisustva</h4>
		<hr>
		<div class="row justify-content-center">

			<div class="col-6 text-right">
				<p>ID Unosa:</p>
			</div>
			<div class="col-6">
				<?php echo "$id_unosa";?>
			</div>

			<div class="col-6 text-right">
				<p>Lozinka:</p>
			</div>
			<div class="col-6">
				<?php echo "$lozinka";?>
			</div>

			<div class="col-12 text-center">
			<a class="btn btn-secondary mb-2" href="<?php echo $pagelink?>" >Otkaži</a>
			<form method="POST">
				<input type="hidden" name="id_zaposlenog" value="$id_zaposlenog">
				<input type="submit" name="obrisi_prijavljenog" class="btn btn-danger" value="Obriši Unos">
			</form>
		</div>
		</div>
	<?php
	if (isset($_POST['obrisi_prijavljenog'])) {
		$sql = "DELETE FROM `root_korisnici`
		WHERE id_zaposlenog = '$id_unosa'";

		if ($conn->query($sql) === TRUE) {
		header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
		exit;
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}
		};
	?>

<!-- Promena podataka zaposlenog -->
	<?php
		if ($_GET['change']=="edituser") {
			$id_zaposlenog=$_GET['id'];
			$sql = "SELECT * FROM hr_zaposleni WHERE id_zaposlenog LIKE '$id_zaposlenog'";
			$res = mysqli_query($conn, $sql);
			while ($row = mysqli_fetch_array($res)) {
				$id_zaposlenog=$row['id_zaposlenog'];
				$rfid_tag=$row['rfid_tag'];
				$ime=$row['ime'];
				$prezime=$row['prezime'];
				$kategorija=$row['kategorija'];
				
				$baza=$row['bazni_tim'];
			};
	?>
		<?php
	if (isset($_POST['promeni_zaposlenog'])) {
		$sql = "
		UPDATE `hr_zaposleni` SET  `rfid_tag` = '$_POST[rf_tag]', `prezime` = '$_POST[prezime_operatera]', `kategorija` = '$_POST[struktura_operatera]' , `bazni_tim` = '$_POST[baza]' WHERE `id_zaposlenog` = '$id_zaposlenog'";

		if ($conn->query($sql) === TRUE) {
		header('Location:'.$_SERVER["PHP_SELF"]."?info=delsuccess&pagelink=".$pagelink);
		exit;
		}
		else {
		echo "Error: " . $sql . "<br>" . $conn->error;
		}
	};
	?>
		<h4>Promena podataka zaposlenog</h4>
		<hr>
        <form method="post" >
        <div class="modal-body">


            <div class="form-group row">
              <label for="id_operatera" class="col-lg-2 col-form-label">*ID: </label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="id_operatera" autocomplete="off" value="<?php echo $id_zaposlenog?>" disabled="disabled">
            </div>
          </div>
                      <div class="form-group row">
              <label for="rf_tag" class="col-lg-2 col-form-label">*RFID TAG: </label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="rf_tag" autocomplete="off" value="<?php echo $rfid_tag?>">
            </div>  
          </div>
            <div class="form-group row">
              <label for="ime-operatera" class="col-lg-2 col-form-label">*Ime:</label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="ime_operatera" autocomplete="off" value="<?php echo $ime?>" disabled="disabled">
            </div>
          </div>
            <div class="form-group row">
              <label for="tp" class="col-lg-2 col-form-label">*Prezime:</label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="prezime_operatera" autocomplete="off" value="<?php echo $prezime?>" >
            </div>
          </div>
            <div class="form-group row">
              <label for="pozicija_operatera" class="col-lg-2 col-form-label">*Struktura:</label>
              <div class="col-lg-10">
              <select class="custom-select form-control mb-3" name="struktura_operatera" >
              	<option value="<?php echo $kategorija?>"><?php echo $kategorija?></option>
              	<option disabled="disabled">----------</option>
              <option value="DH" >DH</option>
              <option value="IH" >IH</option>
              <option value="IS">IS</option>

            </select>
            </div>
          </div>
		              <div class="form-group row">
              <label for="pozicija_operatera" class="col-lg-2 col-form-label">*Bazni Tim:</label>
              <div class="col-lg-10">
              <select class="custom-select form-control mb-3" name="baza" >
              	<option value="<?php echo $baza?>"><?php echo $baza?></option>
              	<option disabled="disabled">----------</option>
			<?php
			//povlaci vrednosti iz tabele timovi
			$query = "SELECT DISTINCT bazni_tim FROM hr_zaposleni ORDER BY bazni_tim ASC";
			$query_run = mysqli_query($conn, $query);
			while ($row = mysqli_fetch_array($query_run)) {
			  echo "
			<option value='".$row['bazni_tim']."'>".$row['bazni_tim']."</option>";	
			}
				$query_run->free();
			?>
            </select>
            </div>
          </div>
		  

        </div>
        <div class="modal-footer">
          <a class="btn btn-secondary mb-2" href="<?php echo $pagelink?>" >Otkaži</a>
          <input type="submit" class="btn btn-primary" name="promeni_zaposlenog" value="Promeni Podatke">
        
        </div>
      </form>
		</div>
		</div>
		<?php }; ?>

</div>
</div>
</div>
</body>
</html>