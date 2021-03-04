<?php 
	include 'db_connection.php'; 

	// Varijable

	$tim_filter = $_GET['tim_filter'];
	$basetim_filterDH = 'DH '.$tim_filter;
	$basetim_filterIH = 'IH '.$tim_filter;


	$datum_unosa = date ("Y-m-d");

	//DH prijavljeni operateri
	$query = "SELECT * FROM mf_prisustvo JOIN hr_zaposleni ON mf_prisustvo.id_zaposlenog=hr_zaposleni.id_zaposlenog  WHERE mf_prisustvo.tim = '$tim_filter' AND mf_prisustvo.datum_unosa = '$datum_unosa' AND mf_prisustvo.struktura = 'DH' ORDER BY mf_prisustvo.id_zaposlenog ASC";
	$dh_prisutni = mysqli_query($conn, $query);
	
	//IH prijavljeni operateri
	$query = "SELECT * FROM mf_prisustvo JOIN hr_zaposleni ON mf_prisustvo.id_zaposlenog=hr_zaposleni.id_zaposlenog  WHERE mf_prisustvo.tim = '$tim_filter' AND mf_prisustvo.datum_unosa = '$datum_unosa' AND mf_prisustvo.struktura = 'IH' ORDER BY mf_prisustvo.id_zaposlenog ASC";
	$ih_prisutni = mysqli_query($conn, $query);
	
	//HC target po timu
	$query = "select ppl_target from mf_timovi where tim = '$tim_filter'";
	$result3 = mysqli_query($conn, $query);
	
	//svi prijavljeni kojima se preklapa bazni tim (ih, dh)
	$query = "SELECT * FROM mf_prisustvo JOIN hr_zaposleni ON mf_prisustvo.id_zaposlenog = hr_zaposleni.id_zaposlenog WHERE mf_prisustvo.tim = '$tim_filter' AND mf_prisustvo.datum_unosa = '$datum_unosa'  AND (hr_zaposleni.bazni_tim = '$basetim_filterDH' OR hr_zaposleni.bazni_tim = '$basetim_filterIH')"  ;
	$bazni_prisutni = mysqli_query($conn, $query);

	//svi prijavljeni kojima se ne preklapa bazni tim (ih, dh)
	$query = "SELECT * FROM mf_prisustvo JOIN hr_zaposleni ON mf_prisustvo.id_zaposlenog = hr_zaposleni.id_zaposlenog WHERE mf_prisustvo.tim = '$tim_filter' AND mf_prisustvo.datum_unosa = '$datum_unosa'  AND hr_zaposleni.bazni_tim <> '$basetim_filterDH' AND hr_zaposleni.bazni_tim <> '$basetim_filterIH'";
	$transfer_prisutni = mysqli_query($conn, $query);	

	//odsutni iz baznog tima
	$query = "
	SELECT * FROM hr_zaposleni WHERE (hr_zaposleni.bazni_tim = '$basetim_filterDH' OR hr_zaposleni.bazni_tim = '$basetim_filterIH') AND id_zaposlenog NOT IN (
	SELECT mf_prisustvo.id_zaposlenog FROM mf_prisustvo JOIN hr_zaposleni ON mf_prisustvo.id_zaposlenog = hr_zaposleni.id_zaposlenog WHERE mf_prisustvo.tim = '$tim_filter' AND mf_prisustvo.datum_unosa = '$datum_unosa'  AND (hr_zaposleni.bazni_tim = '$basetim_filterDH' OR hr_zaposleni.bazni_tim = '$basetim_filterIH')
	)";
	$bazni_odsutni = mysqli_query($conn, $query);	
	
	$row1 = mysqli_num_rows($dh_prisutni);
	$row2 = mysqli_num_rows($ih_prisutni);
	$row3 = mysqli_fetch_array($result3);
	$row4 = mysqli_num_rows($bazni_prisutni);
	$row5 = mysqli_num_rows($transfer_prisutni);
	$row6 = mysqli_num_rows($bazni_odsutni);
						
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="1200;url=index_plus.php">
  <title>Pregled Prisustva</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">

  <script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    
</head>
<!-- Naslov-->  
<body class="body-p body-color container">

  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
	<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="index.php" >
		Početna stranica</a>
	<a class="btn btn-light shadow-sm text-left mr-2 mb-2" href="" data-toggle="modal" data-target="#pregled-dana">
		Pregled dana</a>
	<a class="btn btn-light shadow-sm text-left mr-4 mb-2" href="prijava.php?tim_filter=<?php echo $tim_filter?>" >
		Prijava prisustva</a>

		<form class="input-group shadow-sm mb-2" method="post">
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
			  $link="pregled_prisustva.php?tim_filter=".$_POST["izbortima"];
			  header("Location: $link");
			  exit;
			}
			?>
		  </select>
		  <div class="input-group-append">
			<button class="btn btn-light" type="submit" name="promena">
			  <img src="asset/icon/arrow-down-up.svg" class="img-fluid" alt="promeni tim">
			  </button>
			</div>
		</form>	

  </div>

	<h4 class="text-dark text-left mt-3">Pregled prisustva, tim: 
		<span class="font-weight-bold text-danger">
			<?php echo $tim_filter;
			?>
		</span>
	</h4>


<!-- Glavni sadrzaj-->
	<hr class="bg-secondary">
	<div class="row">
		

		<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">

			<div class="btn btn-light btn-block shadow-sm text-dark mb-2 position-relative">
				<div class="">Direktnih (DH) prisutno <img src="asset/icon/box-arrow-in-up-right.svg" class="float-right" alt="Prijavi"> </div> 
				<div class="card-body text-center h3">
				
					<a href="" class="text-dark stretched-link" data-toggle="modal" data-target="#dh_prisutni_modal">
					<?php
						echo ''.$row1.' / '.$row3['ppl_target'].'';
					?>
					</a>

				</div>

			</div>

			<div class="btn btn-light btn-block shadow-sm text-dark mb-2 position-relative">
				<div class="">Indirektnih (IH) prisutno <img src="asset/icon/box-arrow-in-up-right.svg" class="float-right" alt="Prijavi"> </div>
				<div class="card-body text-center h3">

					<a href="" class="text-dark stretched-link" data-toggle="modal" data-target="#ih_prisutni_modal">
					<?php
					echo $row2;
					?>
					</a>

				</div>
			</div>
			
			<a class="btn btn-light shadow-sm text-left mb-2" href="" data-toggle="modal" data-target="#bazni_prisutni_modal"><?php
					echo $row4;
					?> iz baznog tima 
				<img src="asset/icon/box-arrow-in-up-right.svg" class="" alt="Prijavi"> 
			</a>
			<a class="btn btn-warning shadow-sm text-left mb-2" href="" data-toggle="modal" data-target="#transfer_prisutni_modal"><?php
					echo $row5;
					?> iz transfera 
				<img src="asset/icon/box-arrow-in-up-right.svg" class="" alt="Prijavi"> 
			</a>
			
		</div>
		
		<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">

			<div class="btn btn-danger btn-block shadow-sm text-light mb-2 position-relative">
				<div class="">Odsutno iz HC </div>
				<div class="card-body text-center h3">

					<?php
						
						echo ($row3['ppl_target']-$row1);

					?>
					
				</div>
			</div>
						<div class="btn btn-danger btn-block shadow-sm text-light mb-2 position-relative">
				<div class="">Odsutno iz baznog tima<img src="asset/icon/box-arrow-in-up-right.svg" class="float-right img-invert" alt="Prijavi"> </div>
				<div class="card-body text-center h3">
				
					<a href="" class="text-light stretched-link" data-toggle="modal" data-target="#bazni_odsutni_modal">

					<?php
						
						echo $row6;

					?>
					</a>
					
				</div>
			</div>
			
		</div>
	</div>

    <!-- Modal-->
	<div class="modal fade" id="myModal" role="dialog">
	  <div class="modal-dialog modal-lg" role="document">
		  <div class="modal-content">
			  <div class="modal-body">
				  <div class="fetched-data"></div>
			  </div>
			  <div class="modal-footer">
				  <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
			  </div>
		  </div>
	  </div>
	</div>

	<div class="modal fade" id="dh_prisutni_modal" tabindex="-1" role="dialog" aria-labelledby="dh_prisutni_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content bg-light">
			
				<!--naslov-->
				<div class="modal-header">
					<h5 class="modal-title">Lista prisutnih DH operatera</h5>
					<button type="button" class="btn btn-link text-danger" data-dismiss="modal" aria-label="Close"> Zatvori</button>
				</div>
				
				<!--sadrzaj-->
				<div class="modal-body">

					<div class="border border-secondary bg-white shadow-sm">
						<table class="table table-sm table-borderless p-2">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">Operater</th>
									<th class="text-center">Pozicija</th>
									<th class="text-center" colspan="2">Bazni Tim</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									// Tabela svih prijavljenih operatera

									if ($dh_prisutni) {
									while ($row = $dh_prisutni->fetch_assoc()) {
									$field0name = $row["id_unosa"];
									$field1name = $row["id_zaposlenog"];
									$field2name = $row["ime"];
									$field3name = $row["prezime"];
									$field4name = $row["pozicija"];
									$field5name = $row["bazni_tim"];
								?>

								<tr>
									<td class="text-center"><?php echo $field1name ?></td>
									<td class="text-center"><?php echo ''.$field2name.' '.$field3name.''?></td>
									<td class="text-center"><?php echo $field4name ?></td>
									<td class="text-center"><?php echo $field5name ?></td>
								</tr>

								<?php
									}
									$dh_prisutni->free();
									}; 
								?>
							</tbody>
						</table>
					</div>
					
				</div>

			</div>
		</div>
	</div>
		  
	<div class="modal fade" id="ih_prisutni_modal" tabindex="-1" role="dialog" aria-labelledby="ih_prisutni_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content bg-light">
			
				<!--naslov-->
				<div class="modal-header">
					<h5 class="modal-title">Lista prisutnih IH operatera</h5>
					<button type="button" class="btn btn-link text-danger" data-dismiss="modal" aria-label="Close"> Zatvori</button>
				</div>
				
				<!--sadrzaj-->
				<div class="modal-body">

					<div class="border border-secondary bg-white shadow-sm">
						<table class="table table-sm table-borderless text-center p-2">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">Operater</th>
									<th class="text-center">Pozicija</th>
									<th class="text-center" colspan="2">Bazni Tim</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									// Tabela svih prijavljenih operatera

									if ($ih_prisutni) {
									while ($row = $ih_prisutni->fetch_assoc()) {
									$field0name = $row["id_unosa"];
									$field1name = $row["id_zaposlenog"];
									$field2name = $row["ime"];
									$field3name = $row["prezime"];
									$field4name = $row["pozicija"];
									$field5name = $row["bazni_tim"];
								?>

								<tr>
									<td class="text-center"><?php echo $field1name ?></td>
									<td class="text-center"><?php echo ''.$field2name.' '.$field3name.''?></td>
									<td class="text-center"><?php echo $field4name ?></td>
									<td class="text-center"><?php echo $field5name ?></td>
								</tr>

								<?php
									}
									$ih_prisutni->free();
									}; 
								?>
							</tbody>
						</table>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>
		  
	<div class="modal fade" id="bazni_prisutni_modal" tabindex="-1" role="dialog" aria-labelledby="bazni_prisutni_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content bg-light">
			
				<!--naslov-->
				<div class="modal-header">
					<h5 class="modal-title">Lista prisutnih operatera iz baznog tima</h5>
					<button type="button" class="btn btn-link text-danger" data-dismiss="modal" aria-label="Close"> Zatvori</button>
				</div>
				
				<!--sadrzaj-->
				<div class="modal-body">

					<div>
						<table class="table table-sm table-borderless text-center p-2">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">Operater</th>
									<th class="text-center">Pozicija</th>
									<th class="text-center" colspan="2">Bazni Tim</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									// Tabela svih prijavljenih operatera

									if ($bazni_prisutni) {
									while ($row = $bazni_prisutni->fetch_assoc()) {
									$field0name = $row["id_unosa"];
									$field1name = $row["id_zaposlenog"];
									$field2name = $row["ime"];
									$field3name = $row["prezime"];
									$field4name = $row["pozicija"];
									$field5name = $row["bazni_tim"];
								?>

								<tr>
									<td class="text-center"><?php echo $field1name ?></td>
									<td class="text-center"><?php echo ''.$field2name.' '.$field3name.''?></td>
									<td class="text-center"><?php echo $field4name ?></td>
									<td class="text-center"><?php echo $field5name ?></td>
								</tr>

								<?php
									}
									$bazni_prisutni->free();
									}; 
								?>
							</tbody>
						</table>
					</div>
					
				</div>
				
			</div>
		</div>
	</div>

	<div class="modal fade" id="transfer_prisutni_modal" tabindex="-1" role="dialog" aria-labelledby="transfer_prisutni_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-lg">
			<div class="modal-content bg-light">
			
				<!--naslov-->
				<div class="modal-header">
					<h5 class="modal-title">Lista prisutnih operatera iz transfera</h5>
					<button type="button" class="btn btn-link text-danger" data-dismiss="modal" aria-label="Close"> Zatvori</button>
				</div>
				
				<!--sadrzaj-->
				<div class="modal-body">

					<div>
						<table class="table table-sm table-borderless p-2">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">Operater</th>
									<th class="text-center">Pozicija</th>
									<th class="text-center" colspan="2">Bazni Tim</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									// Tabela svih prijavljenih operatera

									if ($transfer_prisutni) {
									while ($row = $transfer_prisutni->fetch_assoc()) {
									$field0name = $row["id_unosa"];
									$field1name = $row["id_zaposlenog"];
									$field2name = $row["ime"];
									$field3name = $row["prezime"];
									$field4name = $row["pozicija"];
									$field5name = $row["bazni_tim"];
								?>

								<tr>
									<td class="text-center"><?php echo $field1name ?></td>
									<td class="text-center"><?php echo ''.$field2name.' '.$field3name.''?></td>
									<td class="text-center"><?php echo $field4name ?></td>
									<td class="text-center"><?php echo $field5name ?></td>
								</tr>

								<?php
									}
									$transfer_prisutni->free();
									}; 
								?>
							</tbody>
						</table>
					</div>
					
				</div>

			</div>
		</div>
	</div>

	<div class="modal fade" id="bazni_odsutni_modal" tabindex="-1" role="dialog" aria-labelledby="bazni_odsutni_modal" aria-hidden="true">
		<div class="modal-dialog modal-dialog-scrollable modal-xl">
			<div class="modal-content bg-light">
			
				<!--naslov-->
				<div class="modal-header">
					<h5 class="modal-title">Lista odsutnih operatera iz baznog tima</h5>
					<button type="button" class="btn btn-link text-danger" data-dismiss="modal" aria-label="Close"> Zatvori</button>
				</div>
				
				<!--sadrzaj-->
				<div class="modal-body">

					<div>
						<table class="table table-sm table-borderless p-2">
							<thead>
								<tr>
									<th class="text-center">ID</th>
									<th class="text-center">Operater</th>
									<th class="text-center">Pozicija</th>
									<th class="text-center" colspan="2">Bazni Tim</th>
								</tr>
							</thead>
							
							<tbody>
								<?php 
									// Tabela svih prijavljenih operatera

									if ($bazni_odsutni) {
									while ($row = $bazni_odsutni->fetch_assoc()) {
									$field1name = $row["id_zaposlenog"];
									$field2name = $row["ime"];
									$field3name = $row["prezime"];
									$field4name = $row["pozicija"];
									$field5name = $row["bazni_tim"];
								?>

								<tr>
									<td class="text-center"><?php echo $field1name ?></td>
									<td class="text-center"><?php echo ''.$field2name.' '.$field3name.''?></td>
									<td class="text-center"><?php echo $field4name ?></td>
									<td class="text-center"><?php echo $field5name ?></td>
								</tr>

								<?php
									}
									$bazni_odsutni->free();
									}; 
								?>
							</tbody>
						</table>
					</div>
					
				</div>

			</div>
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


<script type="text/javascript">
	$(document).ready(function(){
	$('#myModal').on('show.bs.modal', function (e) {
	  var timid = $(e.relatedTarget).data('tim');
	  var rowid = $(e.relatedTarget).data('id');

	  $.ajax({
		  type : 'post',
		  url : 'modal_poz.php', //Here you will fetch records 
		  data :  'rowid='+ rowid+'&timid='+ timid, //Pass $id
		  success : function(data){
		  $('.fetched-data').html(data);//Show fetched data from database
		  }
	  });
	});
	});
</script>

</body>
</html>