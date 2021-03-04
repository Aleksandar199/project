<?php
	include 'db_connection.php';
 	$id = $_POST['rowid']; 
	$tim_filter= $_POST['timid'];
	$datum_unosa = date ("Y-m-d");
// Naslov
	echo '
		<h4 class="mb-3">Prijavljeni operateri na radnoj poziciji: <span class="font-weight-bold text-danger">'.$id.'</span></h4>
		<div class="dropdown-divider"></div>';

	if ($id == "NOK") {		
		//tabela sa podacima prijavljenih
		$query = "
          SELECT
                     mf_prisustvo.id_unosa,
                     mf_prisustvo.id_zaposlenog,
                     mf_prisustvo.ime,
                     mf_prisustvo.prezime,
                     mf_prisustvo.transfer,
                     mf_prisustvo.pozicija
                  FROM
                    mf_prisustvo
                  LEFT JOIN
                    (me_stanice
                  INNER JOIN
                    mf_timovi ON me_stanice.id_linije = mf_timovi.id_linije AND mf_timovi.tim LIKE '$tim_filter') 
                  ON
                    (mf_prisustvo.pozicija = me_stanice.radna_pozicija )
                  WHERE mf_prisustvo.datum_unosa = '$datum_unosa' AND mf_prisustvo.tim = '$tim_filter' AND me_stanice.radna_pozicija IS NULL";
		$query_res = mysqli_query($conn, $query);
		if (mysqli_num_rows($query_res)==0) {
		echo '    <!-- Error Alert -->
					<div class="alert alert-danger alert-dismissible fade show text-center">
					Izabrana radna pozicija nema prijavljenih operatera!</a>
					</div>';
		}
		else {
		echo '<table style="text-align: center" class="table table-borderless table-hover">
		<thead >
		<tr>
		<th>ID</th>
		<th>Ime</th>
		<th>Prezime</th>
		<th>Transfer</th>
		<th>Pozicija</th>
		<th>Akcija</th>
		</tr>
		</thead>';


		if ($result = $conn->query($query)) {
		while ($row = $result->fetch_assoc()) {
		$field0name = $row["id_unosa"];
		$field1name = $row["id_zaposlenog"];
		$field2name = $row["ime"];
		$field3name = $row["prezime"];
		$field9name = $row["transfer"];
		$field10name = $row["pozicija"];

		echo '<tr>
		<td>'.$field1name.'</td>
		<td>'.$field2name.'</td>
		<td>'.$field3name.'</td>
		<td>'.$field9name.'</td>
		<td>'.$field10name.'</td>
      	<td><a href="pos_edit.php?team_filter='.$tim_filter.'&input_id='.$field0name.'"><b>Promeni</a></td>
      	</tr>';
		}
		$result->free();
		}
		echo "</table>";
	}
			
		}


else{






		//tabela sa podacima prijavljenih
		$query = "SELECT * FROM mf_prisustvo WHERE tim ='$tim_filter' AND pozicija = '$id' AND datum_unosa LIKE '$datum_unosa' ORDER BY pozicija ASC";
		$query_res = mysqli_query($conn, $query);
		if (mysqli_num_rows($query_res)==0) {
		echo '    <!-- Error Alert -->
					<div class="alert alert-danger alert-dismissible fade show text-center">
					Izabrana radna pozicija nema preijavljenih operatera!</a>
					</div>';
		}
		else {
		echo '<table style="text-align: center" class="table table-borderless table-hover">
		<thead >
		<tr>
		<th>ID</th>
		<th>Ime</th>
		<th>Prezime</th>
		<th>Transfer</th>
		<th>Akcija</th>
		</tr>
		</thead>';


		if ($result = $conn->query($query)) {
		while ($row = $result->fetch_assoc()) {
		$field0name = $row["id_unosa"];
		$field1name = $row["id_zaposlenog"];
		$field2name = $row["ime"];
		$field3name = $row["prezime"];
		$field9name = $row["transfer"];

		echo '<tr>
		<td>'.$field1name.'</td>
		<td>'.$field2name.'</td>
		<td>'.$field3name.'</td>
		<td>'.$field9name.'</td>
      	<td><a href="pos_edit.php?team_filter='.$tim_filter.'&input_id='.$field0name.'"><b>Promeni</a></td>
      	</tr>';
		}
		$result->free();
		}
		echo "</table>";
	}
}
?>