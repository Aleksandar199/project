<?php 
session_start();
error_reporting(0);
require_once "../scripts/db_conn_rework.php";
require_once "../scripts/db_conn_ftqfca.php";

//Ako nije ulogovan, vraca ga na LogIn.
if(empty($_SESSION['log_in']))
{
    header("Location: ../index");
    exit;
}

error_reporting(0);
require "../scripts/db_conn_rework.php";
require "../scripts/db_conn_ftqfca.php";

$linija = $_GET['line'];

//radne stanice 
$radne_stanice = "SELECT * FROM linije WHERE naziv='$linija'";
$result_rs = mysqli_query($conn_fca, $radne_stanice);

$r_s = "SELECT * FROM linije WHERE naziv='$linija'";
$result_rs2 = mysqli_query($conn_fca, $r_s);

//defekti1
$defk = "SELECT kod_def FROM defekti_1";
$result_defk = mysqli_query($conn_fca, $defk);

$defo = "SELECT opis_def FROM defekti_1";
$result_defo = mysqli_query($conn_fca, $defo);

//pozicije defekta
$poz_def_konektori = "SELECT * FROM pozicije_def_komponente WHERE linija='$linija' AND naziv_komponente='konektori'";
$poz_def_zice = "SELECT * FROM pozicije_def_komponente WHERE linija='$linija' AND naziv_komponente='zice'"; 
$poz_def_TiF = "SELECT * FROM pozicije_def_komponente WHERE linija='$linija' AND naziv_komponente='terminali_ferule'"; 
$poz_def_ostalo = "SELECT * FROM pozicije_def_komponente WHERE linija='$linija' AND naziv_komponente='ostalo'"; 

$result_pozDef_K = mysqli_query($conn_fca, $poz_def_konektori);
$result_pozDef_Z = mysqli_query($conn_fca, $poz_def_zice);
$result_pozDef_TiF = mysqli_query($conn_fca, $poz_def_TiF);
$result_pozDef_O = mysqli_query($conn_fca, $poz_def_ostalo);

//input data
$tim = $_POST['tim'];
$smena = $_POST['smena'];
$datum_pr = $_POST['datum_pr'];
$mesto_detect_def = $_POST['mesto_det_def'];
$kod_def = $_POST['kod_def'];
$mesto_nast_def = $_POST['mesto_nast_def'];
$opis_def = $_POST['opis_def'];
$br_instalacije = $_POST['br_instalacije'];
$poz_def_1 = $_POST['poz_def_1'];
$poz_def_rucno = $_POST['poz_def'];
$timLider_id = $_POST['timLider_id'];
$rew_skar = $_POST['rew_skar'];

//WEEK AND DATE PATTERNS ***********************
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



if(isset($_POST['btn_submit'])){

  if(empty($tim)){
    $msg = "Niste odabrali tim!";
  }
  else if(empty($smena)){
    $msg = "Niste odabrali smenu!";
  }
  else if($timLider_id == ""){
    $msg = "Niste uneli ID tim lidera!";
  }
  else if(!is_numeric($timLider_id)){
    $msg = "ID tim lidera mogu biti samo brojevi!";
  }
  else{
    if($poz_def_1 == "---"){
      $poz_def_1 = $poz_def_rucno;
    }

    $sql = "INSERT INTO ftq_fca.unos (mesec, nedelja, tim, smena, datum_proizvodnje, linija, mesto_detect_def, kod_defekta, mesto_nastanka_def, opis_defekta, br_instalacije, ID_operatera, ID_timLidera, pozicija_def, rew_skart)
    VALUES ('$month_name', '$WEEK', '$tim', '$smena', '$datum_pr', '$linija', '$mesto_detect_def', '$kod_def', '$mesto_nast_def', '$opis_def', '$br_instalacije', '".$_SESSION['user_ID_CARD']."', '$timLider_id ', '$poz_def_1', '$rew_skar');";
    $result = mysqli_query($conn_fca, $sql);

    if($result > 0){
        $msg ="Uspesno ste uneli podatke!";
        echo "
        <script>alert('Uspešno ste uneli podatke!');
        window.location='/FTQFCA/Pages/ftq_fca';
        </script>
        ";
    }
    else{
        $msg ="Neuspesan unos, ukoliko se greska ponovi, prijavite tim lideru!";
    }
  }
    
}

?>

<?php require "../inc/header_l.php"; ?>

<div class="container">
    <h2 class="text-center text-primary">FTQ - FCA - <span class="text-white">Linija: <?php echo $linija; ?></span></h2>
    
    <a href="ftq_fca" class="btn btn-primary btn-md"><- Nazad</a>

    <div class="card container bg-light text-primary card1 border-primary">
    <h2 class="text-danger"><?php echo $msg; ?></h2>
       <form method="POST" action="<?php $_SERVER['PHP_SELF']."?line=$linija"; ?>" onsubmit="return confirm('Da li želite da prosledite ove podatke u bazu?');">
           <div class="container text-center container2">

                    <label>Selektujte Tim:</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light border-primary text-primary">
                              <input type="radio" name="tim" id="option1"  value="1" autocomplete="off" required> Tim 1
                            </label>
                            <label class="btn btn-light border-primary text-primary">
                              <input type="radio" name="tim" id="option2"  value="2" autocomplete="off" required> Tim 2
                            </label>
                    </div>
                   <br><br>
                    <label>Selektujte Smenu:</label>
                    <div class="btn-group btn-group-toggle" data-toggle="buttons">
                            <label class="btn btn-light border-primary text-primary">
                              <input type="radio" name="smena" id="option1"  value="1" autocomplete="off" required> prva (1)
                            </label>
                            <label class="btn btn-light border-primary text-primary">
                              <input type="radio" name="smena" id="option2"  value="2" autocomplete="off" required> druga (2)
                            </label>
                            <label class="btn btn-light border-primary text-primary">
                              <input type="radio" name="smena" id="option3"  value="3" autocomplete="off" required> treća (3)
                            </label>
                    </div><br><br>
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Datum proizvodnje: </label>
                        </div>
                        <input type="date" class="form-control" name="datum_pr" autocomplete="off" id="inputGroupSelect01" value ="<?php echo date('Y-m-d') ?>" id="date" required>
                    </div>
                    
                     <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Mesto detektovanja defekta: </label>
                        </div>

                        <select class="custom-select" name="mesto_det_def" required>
                        <?php
                            while($res = mysqli_fetch_assoc($result_rs)){
                                echo "<option value='".$res['radne_stanice']."'>".$res['radne_stanice']."</option>";
                            }
                        
                        ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Mesto nastanka defekta: </label>
                        </div>
                        <select class="custom-select" name="mesto_nast_def" required>
                        <?php 
                            while($res = mysqli_fetch_assoc($result_rs2)){
                                echo "<option value='".$res['radne_stanice']."'>".$res['radne_stanice']."</option>";
                            }
                         ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Kod defekta: </label>
                        </div>
                        <select class="custom-select" name="kod_def">
                        <?php
                            while($resD = mysqli_fetch_assoc($result_defk)){
                                echo "<option value='".$resD['kod_def']."'>".$resD['kod_def']."</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Opis defekta: </label>
                        </div>
                        <select class="custom-select" id="inputGroupSelect01" name="opis_def" required>
                        <?php
                            while($resD_o = mysqli_fetch_assoc($result_defo)){
                                echo "<option value='".$resD_o['opis_def']."'>".$resD_o['opis_def']."</option>";
                            }
                        ?>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Broj instalacije: </label>
                        </div>
                         <input type="text" name="br_instalacije" class="form-control" placeholder="Unesite broj instalacije.." autocomplete="off" required>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend"> 
                          <label class="input-group-text" for="inputGroupSelect01">Pozicija defekta: </label>
                        </div>
                        <div id="poz_def_1">
                            <select class="custom-select" id="inputGroupSelect01" name="poz_def_1" required>
                                <option value="---" selected>---</option>
                                <optgroup label="Konektori: ">
                                    <?php
                                        while($resPD_K = mysqli_fetch_assoc($result_pozDef_K)){
                                            echo "<option value='".$resPD_K['pozicija_def']."'>".$resPD_K['pozicija_def']."</option>";
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="Žice: ">
                                    <?php
                                        while($resPD_Z = mysqli_fetch_assoc($result_pozDef_Z)){
                                            echo "<option value='".$resPD_Z['pozicija_def']."'>".$resPD_Z['pozicija_def']."</option>";
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="Terminali i ferule: ">
                                    <?php
                                        while($resPD_TiF = mysqli_fetch_assoc($result_pozDef_TiF)){
                                            echo "<option value='".$resPD_TiF['pozicija_def']."'>".$resPD_TiF['pozicija_def']."</option>";
                                        }
                                    ?>
                                </optgroup>
                                <optgroup label="Ostalo: ">
                                    <?php
                                        while($resPD_O = mysqli_fetch_assoc($result_pozDef_O)){
                                            echo "<option value='".$resPD_O['pozicija_def']."'>".$resPD_O['pozicija_def']."</option>";
                                        }
                                    ?>
                                </optgroup>
                            </select>
                          </div>
                        <!-- rucni unos -->
                        <input type="text" name="poz_def" class="form-control" placeholder=" Unesite ručno.." id="poz_def" autocomplete="off" style="display:none">
                         &nbsp;<label><small>Ručni unos </small></label>&nbsp;<input type="checkbox" class="checkbox-input" name="poz_def_check" id="checked_validation" onclick="myFunction()"> &nbsp;
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Tim Lider: </label>
                        </div>
                        <select class="custom-select" name="timLider_id" required>
                          <option value="1">Tim Lider 1</option>
                          <option value="2">Tim Lider 2</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <label class="input-group-text" for="inputGroupSelect01">Rework-Skart: </label>
                        </div>
                        <select class="custom-select" name="rew_skar" required>
                          <option value="1">---</option>
                          <option value="Rework">Rework</option>
                          <option value="Skart">Skart</option>
                        </select>
                    </div>
                 </div>
                
                 <br>
                 <center>
                     <input type="submit" value="Unos Podataka" name="btn_submit" class="btn btn-success btn-md btn_ftq">&nbsp;&nbsp;
                     <input type="reset" value="Poništi" name="btn_reset" class="btn btn-secondary btn-md btn_ftq">
                </center>
           </div>
       </form>
    </div>
</div>

<?php require "../inc/footer.php"; ?>

<script>

    function myFunction() {
  // Get the checkbox
  var checkBox = document.getElementById("checked_validation");
  // Get the output text
  var unos1 = document.getElementById("poz_def_1");
  var unos2 = document.getElementById("poz_def");
  // If the checkbox is checked, display the output text
  if (checkBox.checked == true){
    unos1.style.display = "none";
    document.getElementsByName('poz_def_1')[0].value = "---";
    unos2.style.display = "block";
  } else if (checkBox.checked == false) {
    unos1.style.display = "block";
    unos2.style.display = "none";
  }
}
    </script>
