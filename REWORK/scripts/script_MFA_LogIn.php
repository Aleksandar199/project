<?php 
  error_reporting(0);
  require_once "scripts/db_conn_logs.php";
  require_once "scripts/db_conn_rework.php";
  
  $RF_TAG = $_POST['RF_TAG'];
  $cell = $_GET['CELL'];
  $mfa = $_GET['BR'];
  $STATUS = 1;

if(isset($_POST['RF_TAG'])){
// VREME UNOSA PODATAKA U BAZU
		  $LOGIN = date('Y-m-d H:i:s');	
		  
		  //Proracun smene na osnovu SOP etikete
		  $TempLogin = date('H:i:s');
		  if($TempLogin >= "06:00:00" && $TempLogin <= "13:59:00") $SHIFT = "1";
		  if($TempLogin >= "14:00:00" && $TempLogin <= "21:59:00") $SHIFT = "2"; 
		  if(($TempLogin >= "22:00:00" && $TempLogin <= "23:59:00") OR ($TempLogin >= "00:00:00" && $TempLogin <= "05:59:00")) $SHIFT = "3";
		
		  // BROJANJE NEDELJE	
		  $WEEK=0;
		  $ddate = date('Y-m-d');	
		  $duedt = explode("-", $ddate);
		  $date2  = mkTime(0, 0, 0, $duedt[1], $duedt[2], $duedt[0]);
		  $WEEK = (int)date('W', $date2);
		  
		  // MESEC -> TEXT	
		  $month_name="";
		  $months = array (1 => "JANUAR", 2 => "FEBRUAR", 3 => "MART", 4 => "APRIL", 5 => "MAJ", 6 => "JUN", 7 => "JUL", 8 => "AVGUST", 9 => "SEPTEMBAR", 10 => "OKTOBAR", 11 => "NOVEMBAR", 12 => "DECEMBAR");
		  $parts = explode('-',$ddate);
		  $month = $parts[1];
		  $month_name = $months[(int)$month];
		  
		  // POVEZIVANJE KODA sa ID KARTICE SA KORISNIKOM
			 
		  $query  = "SELECT * FROM rework.employee WHERE RF_TAG='$RF_TAG'";
          $result = mysqli_query($conn_rew, $query);
          $row = mysqli_fetch_array($result);
          
		  if(mysqli_num_rows($result) == 0) {
            $msg = "KORISNIK NE POSTOJI U BAZI!\nMolimo Vas pokušajte ponovo.\nAko se greška ponovi prijavite grešku tim lideru.";
			
		  } 	
		  else {
		     $ID_CARD = $row[0];
		     $SURNAME = $row[2];
		     $NAME = $row[3];
   
		      
		     // Prvo se izloguju svi korisnici koji su ostali sa statusom 1
		     $order="UPDATE logs.mfa$mfa SET `STATUS`='0' WHERE `ID_LOG`>1 AND `POST`='$cell'";
             $result2= mysqli_query($conn_logs, $order);
			 
			 if($res =  mysqli_fetch_array($result2)) {
				$msg = "Neuspešan unos podataka, pokušajte ponovo.";
			  }
			  else{
				   //UPIS U BAZU	
				   $order2="	
				   INSERT INTO logs.mfa$mfa (RF_TAG, LOGIN, POST, SHIFT, STATUS, WEEK, MONTH, ID_CARD, SURNAME, NAME) VALUES 
				   ('$RF_TAG', '$LOGIN', '$cell', '$SHIFT', '$STATUS', '$WEEK', '$month_name', '$ID_CARD', '$SURNAME', '$NAME')
				   ";
				   $result3 = mysqli_query($conn_logs, $order2);
				   
				   if($res =  mysqli_fetch_array($result3)) {
					  $msg = "Neuspešan unos podataka, pokušajte ponovo..";
				   }
				   else{
					setcookie("logged_in", "1", time() + (3600 * 9));
					setcookie("cell", $cell, time() + (3600 * 9));
					setcookie("mfa", $mfa, time() + (3600 * 9));
			
					header("Location: http://".$_SERVER['HTTP_HOST']."/REWORK/Pages/MFA_Info?BR=$mfa&CELL=$cell" );
				   }
			  }
		}
	}
	
//URL VALIDATION
	$xml = simplexml_load_file("mfa.xml") or die("Error: Cannot create object :(");
    
	foreach($xml->mfa[0]->mfa300 as $m){
		$cell_mfa300 = $m->celija;
		//if cell exist, set true
		if($cell_mfa300 == $cell){
			$url_valid = true;
		}
	}
	foreach($xml->mfa[1]->mfa310 as $m){
		$cell_mfa310 = $m->celija;
		if($cell_mfa300 == $cell){
			$url_valid = true;
		}
	}
	foreach($xml->mfa[2]->mfa320 as $m){
		$cell_mfa320 = $m->celija;
		if($cell_mfa300 == $cell){
			$url_valid = true;
		}

		//manual validation
		if($cell == "AMGC0102" OR $cell == "AMGC03"){
			$url_valid = true;
		}
	}
?>