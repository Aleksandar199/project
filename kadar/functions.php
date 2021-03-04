<?php
include 'db_connection.php';

 if(isset($_POST["Import"])){
 		if (isset($_POST["izborlinije"])) {
 			$lineid=$_POST["izborlinije"];
 		}
 		else {
		$lineid="";
	}

		$sql="DELETE FROM me_stanice WHERE id_linije LIKE '$lineid' ";
		if ($conn->query($sql) === FALSE) {

		echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$filename=$_FILES["file"]["tmp_name"];		


		 if($_FILES["file"]["size"] > 0)
		 {
		  	$file = fopen($filename, "r");
	        while (($getData = fgetcsv($file, 10000, ",")) !== FALSE)
	         {


	           $sql = "INSERT into me_stanice (id_linije,radni_proces,redni_broj,radna_pozicija,broj_operatera) 
                   values ('".$getData[0]."','".$getData[1]."','".$getData[2]."','".$getData[3]."','".$getData[4]."')";
                   $result = mysqli_query($conn, $sql);
				if(!isset($result))
				{
					echo '<a href="me_stanice.php">nazad</a>';		
				}
				else {
					  echo '<a href="me_stanice.php">nazad</a>';
				}
	         }
			
	         fclose($file);	
		 }
		 else{echo '<a href="me_stanice.php">nazad</a>';}
	}
 ?>