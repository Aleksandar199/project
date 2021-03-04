<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
	</head>
	<body>

<?php
	include 'db_connection.php';


	$output = '';
	if(isset($_POST["export"])){
		if (isset($_GET['filter'])) {
		$naziv = "prisutnost_".$_GET["date_from"].$_GET['date_to'].".xls";
		$datum_od = $_GET['date_from'];
		$datum_do = $_GET['date_to'];

		$query = "SELECT * FROM mf_prisustvo WHERE datum_unosa BETWEEN '$datum_od' AND '$datum_do' ORDER BY datum_unosa, tim, id_zaposlenog ASC";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0) {

			$output .= '
			<table class="table" bordered="1">
				<tr>
					  <td> <font face="Arial">id</font> </td>
					  <td> <font face="Arial">ime</font> </td>
					  <td> <font face="Arial">prezime</font> </td>
					  <td> <font face="Arial">smena</font> </td>
					  <td> <font face="Arial">tim</font> </td>
					  <td> <font face="Arial">datum_unosa</font> </td>
					  <td> <font face="Arial">vreme_unosa</font> </td>
					  <td> <font face="Arial">vreme_transfera</font> </td>
					  <td> <font face="Arial">transfer</font> </td>
					  <td> <font face="Arial">pozicija</font> </td>
					  <td> <font face="Arial">kategorija</font> </td>
				</tr>';

			while($row = mysqli_fetch_array($result)) {
				$output .= '
				<tr>
					<td>'.$row["id_zaposlenog"].'</td>
					<td>'.$row["ime"].'</td>
					<td>'.$row["prezime"].'</td>
					<td>'.$row["smena"].'</td>
					<td>'.$row["tim"].'</td>
					<td>'.$row["datum_unosa"].'</td>
					<td>'.$row["vreme_unosa"].'</td>
					<td>'.$row["vreme_transfera"].'</td>
					<td>'.$row["transfer"].'</td>
					<td>'.$row["pozicija"].'</td>
					<td>'.$row["struktura"].'</td>
				</tr>';
			}
		  $output .= '</table>';
		  header('Content-Type: application/xls;');
		  header("Content-Disposition: attachment; filename=$naziv");
		  echo $output;
		}
		else {
			echo "Nema rezultata, vratite se nazad";

		}

		}
		else {
				$naziv = "prisutnost_".$_GET["date"].".xls";
				$datum_unosa = $_GET['date'];
		
				$query = "SELECT * FROM mf_prisustvo WHERE datum_unosa LIKE '$datum_unosa' ORDER BY id_zaposlenog ASC";
				$result = mysqli_query($conn, $query);
				if(mysqli_num_rows($result) > 0) {
		
					$output .= '
					<table class="table" bordered="1">
						<tr>
							  <td> <font face="Arial">id</font> </td>
							  <td> <font face="Arial">ime</font> </td>
							  <td> <font face="Arial">prezime</font> </td>
							  <td> <font face="Arial">smena</font> </td>
							  <td> <font face="Arial">tim</font> </td>
							  <td> <font face="Arial">datum_unosa</font> </td>
							  <td> <font face="Arial">vreme_unosa</font> </td>
							  <td> <font face="Arial">vreme_transfera</font> </td>
							  <td> <font face="Arial">transfer</font> </td>
							  <td> <font face="Arial">pozicija</font> </td>
							  <td> <font face="Arial">kategorija</font> </td>
						</tr>';
		
					while($row = mysqli_fetch_array($result)) {
						$output .= '
						<tr>
							<td>'.$row["id_zaposlenog"].'</td>
							<td>'.$row["ime"].'</td>
							<td>'.$row["prezime"].'</td>
							<td>'.$row["smena"].'</td>
							<td>'.$row["tim"].'</td>
							<td>'.$row["datum_unosa"].'</td>
							<td>'.$row["vreme_unosa"].'</td>
							<td>'.$row["vreme_transfera"].'</td>
							<td>'.$row["transfer"].'</td>
							<td>'.$row["pozicija"].'</td>
							<td>'.$row["struktura"].'</td>
						</tr>';
					}
				  $output .= '</table>';
				  header('Content-Type: application/xls;');
				  header("Content-Disposition: attachment; filename=$naziv");
				  echo $output;
				}
				else {
					echo "Nema rezultata, vratite se nazad";
		
				}
			}
	}



	if(isset($_POST["export_stanice"])){

		$query = "SELECT * FROM me_stanice";
		$result = mysqli_query($conn, $query);
		if(mysqli_num_rows($result) > 0) {

			$output .= '
			<table class="table" bordered="1">
				<tr>
					  <td> <font face="Arial">id_unosa</font> </td>
					  <td> <font face="Arial">id_linije</font> </td>
					  <td> <font face="Arial">radni_proces</font> </td>
					  <td> <font face="Arial">redni_broj</font> </td>
					  <td> <font face="Arial">radna_pozicija</font> </td>
					  <td> <font face="Arial">broj_operatera</font> </td>
				</tr>';

			while($row = mysqli_fetch_array($result)) {
				$output .= '
				<tr>
					<td>'.$row["id_unosa"].'</td>
					<td>'.$row["id_linije"].'</td>
					<td>'.$row["radni_proces"].'</td>
					<td>'.$row["redni_broj"].'</td>
					<td>'.$row["radna_pozicija"].'</td>
					<td>'.$row["broj_operatera"].'</td>
				</tr>';
			}
		  $output .= '</table>';
		  header('Content-Type: application/xls;');
		  header("Content-Disposition: attachment; filename=me_stanice_export.xls");
		  echo $output;
		}
		else {
			echo "Nema rezultata, vratite se nazad";

		}
	}
?>
</body>
</html>