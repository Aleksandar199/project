<?php
include 'db_connection.php';
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>system</title>

	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
	<link rel="stylesheet" href="style.css">		
</head>

<body>

<form method="post">
<input type="text" placeholder="kod" name="kod" autocomplete="off">
<button type="submit" name="pretraga">enter</button>
</form>


<br>
<?php
	//odsutni iz baznog tima
	If (isset ($_POST['pretraga'])){
	
	$kod = $_POST['kod'];
	$query = $conn->query("SELECT *	FROM adresni_sistem	WHERE	kod_provodnika = '$kod'	");	

	// Tabela svih prijavljenih operatera


	while ($row = $query->fetch_assoc()) {
	$field1name = $row["kod_provodnika"];
	$field2name = $row["linija"];
	$field3name = $row["celija"];
	$field4name = $row["raf"];
	$field5name = $row["lokacija"];
	
	echo $field1name;
	echo $field2name ;
	echo $field4name ;
	echo $field5name ;

		}
	$query->free();
	; }
	?>
							</tbody>
						</table>


<script src="bootstrap/js/jquery-3.5.1.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>