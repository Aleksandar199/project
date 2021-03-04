<?php 
require_once "../inc/connectEMP.php"; 
require_once "../inc/connect.php"; 
error_reporting(0);
session_start();

if(empty($_SESSION['status'])){
  header("Location: ../../lpa");
}

//GET USER
$sql = "SELECT * FROM ankete.employee_db WHERE ID_CARD='". $_SESSION['net_id']."'";
$query = mysqli_query($connEMP, $sql);

while($row = mysqli_fetch_assoc($query)) {
  $ime = $row['Name'];
  $prezime = $row['Surname'];
  $pass = $row['pass'];
}

/* 1 upisivanje komentara u bazu */
$k1 = $_POST['k1'];
$u1 = $_POST['u1'];
$k2 = $_POST['k2'];
$u2 = $_POST['u2'];
$k3 = $_POST['k3'];
$u3 = $_POST['u3'];
$k4 = $_POST['k4'];
$u4 = $_POST['u4'];
/* 2 */
$k5 = $_POST['k5'];
$u5 = $_POST['u5'];
$k6 = $_POST['k6'];
$u6 = $_POST['u6'];
$k7 = $_POST['k7'];
$u7 = $_POST['u7'];
/* 3 */
$k8 = $_POST['k8'];
$u8 = $_POST['u8'];
$k9 = $_POST['k9'];
$u9 = $_POST['u9'];
$k10 = $_POST['k10'];
$u10 = $_POST['u10'];
$k11 = $_POST['k11'];
$u11 = $_POST['u11'];
/* 4 */
$k12 = $_POST['k12'];
$u12 = $_POST['u12'];
$k13 = $_POST['k13'];
$u13 = $_POST['u13'];
$k14 = $_POST['k14'];
$u14 = $_POST['u14'];
$k15 = $_POST['k15'];
$u15 = $_POST['u15'];
$k16 = $_POST['k16'];
$u16 = $_POST['u16'];
$k17 = $_POST['k17'];
$u17 = $_POST['u17'];
$k18 = $_POST['k18'];
$u18 = $_POST['u18'];
$k19 = $_POST['k19'];
$u19 = $_POST['u19'];
$k20 = $_POST['k20'];
$u20 = $_POST['u20'];
$k21 = $_POST['k21'];
$u21 = $_POST['u21'];
/* 5 */
$k22 = $_POST['k22'];
$u22 = $_POST['u22'];
$k23 = $_POST['k23'];
$u23 = $_POST['u23'];
$k24 = $_POST['k24'];
$u24 = $_POST['u24'];
$k25 = $_POST['k25'];
$u25 = $_POST['u25'];
$k26 = $_POST['k26'];
$u26 = $_POST['u26'];
$k27 = $_POST['k27'];
$u27 = $_POST['u27'];
$k28 = $_POST['k28'];
$u28 = $_POST['u28'];
$k29 = $_POST['k29'];
$u29 = $_POST['u29'];
$k30 = $_POST['k30'];
$u30 = $_POST['u30'];
/* 6 */
$k31 = $_POST['k31'];
$u31 = $_POST['u31'];
$k32 = $_POST['k32'];
$u32 = $_POST['u32'];
$k33 = $_POST['k33'];
$u33 = $_POST['u33'];
/* 7 */
$k34 = $_POST['k34'];
$u34 = $_POST['u34'];
$k35 = $_POST['k35'];
$u35 = $_POST['u35'];
$k36 = $_POST['k36'];
$u36 = $_POST['u36'];
$k37 = $_POST['k37'];
$u37 = $_POST['u37'];
$k38 = $_POST['k38'];
$u38 = $_POST['u38'];
/* 8 */
$k39 = $_POST['k39'];
$u39 = $_POST['u39'];
$k40 = $_POST['k40'];
$u40 = $_POST['u40'];
$k41 = $_POST['k41'];
$u41 = $_POST['u41'];
/* 9 */
$k42 = $_POST['k42'];
$u42 = $_POST['u42'];
$k43 = $_POST['k43'];
$u43 = $_POST['u43'];


/* Ne moze da se predje na drugo pitanje ako neko pre toga nije popunjeno */ 
$p1 = $_POST['p1']; 
$p2 = $_POST['p2']; 
$p3 = $_POST['p3'];  
$p4 = $_POST['p4']; 
$p5 = $_POST['p5']; 
$p6 = $_POST['p6']; 
$p7 = $_POST['p7']; 
$p8 = $_POST['p8']; 
$p9 = $_POST['p9']; 
$p10 = $_POST['p10']; 
$p11 = $_POST['p11']; 
$p12 = $_POST['p12']; 
$p13 = $_POST['p13']; 
$p14 = $_POST['p14']; 
// $p155 = $_POST['p155'];
$p15 = $_POST['p15']; 
$p16 = $_POST['p16']; 
$p17 = $_POST['p17']; 
$p18 = $_POST['p18']; 
$p19 = $_POST['p19']; 
$p20 = $_POST['p20']; 
$p21 = $_POST['p21']; 
$p22 = $_POST['p22']; 
$p23 = $_POST['p23'];
$p24 = $_POST['p24'];
$p25 = $_POST['p25'];
$p26 = $_POST['p26'];
$p27 = $_POST['p27'];
$p28 = $_POST['p28'];
$p29 = $_POST['p29'];
$p30 = $_POST['p30'];
$p31 = $_POST['p31'];
$p32 = $_POST['p32'];
$p33 = $_POST['p33'];
$p34 = $_POST['p34'];
$p35 = $_POST['p35'];
$p36 = $_POST['p36'];
$p37 = $_POST['p37'];
$p38 = $_POST['p38'];
$p39 = $_POST['p39'];
// $p40 = $_POST['p40'];
// $p41 = $_POST['p41'];
// $p42 = $_POST['p42'];
// $p43 = $_POST['p43'];


if(isset($_POST['subBtn'])){ 

  $lokacija = $_GET['LOC'];
  $nivo = $_GET['NIV'];
  $audit = $_GET['AU'];
  
if($p1=="" OR $p2=="" OR $p3=="" OR $p4=="" OR $p5=="" OR $p6=="" OR $p7=="" OR $p8=="" OR $p9=="" OR $p10==""OR $p11=="" OR $p12=="" OR
  $p13=="" OR $p14=="" OR $p15=="" OR $p16=="" OR $p17=="" OR $p18=="" OR $p19=="" OR $p20=="" OR $p21=="" OR $p22==""OR $p23==""OR $p24=="" OR
  $p25==""OR $p26==""OR $p27==""OR $p28==""OR $p29==""OR $p30==""OR $p31==""OR $p32==""OR $p33==""OR $p34==""OR $p35==""OR $p36==""OR $p37==""OR
  $p38==""OR $p39==""){

  $msg = "Ne možete da pošaljete anketu, niste selektovali/popunili sva polja!";

}
else{
  $sql2 = "INSERT INTO ankete.anketa_1 (`net_id`, `lokacija`,`nivo`, `audit`, 
  `1.1k`, `1.1r`, `1.2k`, `1.2r`, `1.3k`, `1.3r`, `1.4k`, `1.4r`,
  `2.1k`, `2.1r`, `2.2k`, `2.2r`, `2.3k`, `2.3r`,
  `3.1k`, `3.1r`, `3.2k`, `3.2r`, `3.3k`, `3.3r`, `3.4k`, `3.4r`,
  `4.1k`, `4.1r`, `4.2k`, `4.2r`, `4.3k`, `4.3r`, `4.4k`, `4.4r`,`4.5k`, `4.5r`, `4.6k`, `4.6r`, `4.7k`, `4.7r`, `4.8k`, `4.8r`,`4.9k`, `4.9r`,`4.10k`, `4.10r`,
  `5.1k`, `5.1r`, `5.2k`, `5.2r`, `5.3k`, `5.3r`, `5.4k`, `5.4r`,`5.5k`, `5.5r`, `5.6k`, `5.6r`, `5.7k`, `5.7r`, `5.8k`, `5.8r`,`5.9k`, `5.9r`,
  `6.1k`, `6.1r`, `6.2k`, `6.2r`, `6.3k`, `6.3r`,
  `7.1k`, `7.1r`, `7.2k`, `7.2r`, `7.3k`, `7.3r`, `7.4k`, `7.4r`,`7.5k`, `7.5r`,
  `8.1k`, `8.1r`, `8.2k`, `8.2r`, `8.3k`, `8.3r`,
  `9.1k`, `9.1r`, `9.2k`, `9.2r`)
  VALUES (".$_SESSION['net_id'].", '$lokacija', '$nivo', '$audit',
   '$k1', '$u1', '$k2', '$u2', '$k3', '$u3', '$k4', '$u4',
   '$k5', '$u5', '$k6', '$u6', '$k7', '$u7',
   '$k8', '$u8', '$k9', '$u9', '$k10', '$u10', '$k11', '$u11',
   '$k12', '$u12', '$k13', '$u13', '$k14', '$u14', '$k15', '$u15','$k16', '$u16', '$k17', '$u17', '$k18', '$u18', '$k19', '$u19','$k20', '$u20', '$k21', '$u21',
   '$k22', '$u22', '$k23', '$u23','$k24', '$u24', '$k25', '$u25','$k26', '$u26', '$k27', '$u27','$k28', '$u28', '$k29', '$u29','$k30', '$u30',
   '$k31', '$u31','$k32', '$u32','$k33', '$u33',
   '$k34', '$u34','$k35', '$u35','$k36', '$u36','$k37', '$u37','$k38', '$u38',
   '$k39', '$u39','$k40', '$u40','$k41', '$u41',
   '$k42', '$u42','$k43', '$u43')";
  $result = mysqli_query($conn, $sql2);
  
  // popup prozor za obavestenje
  $_SESSION['status'] = 0;
  echo 
  "<script>
  alert('Uspesno ste popunili anketu!');
  location = '/lpa';
  </script>";

  // if($_POST['p1'] == "NE"){
  //   $sql1 = "UPDATE ankete.anketa_1
  //   SET (`1.1k` = '$k1', `1.1r` = '$u1')
  //   -- WHERE id_ankete=''";        //net_id=''";
  //   $result1 = mysqli_query($conn, $sql1);
  // }  
  // else {
  //   echo "nesto";
  // }

}
 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LPA Cutting + LP</title>
</head>
<body>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<h3 style="text-align:center">ZONSKA REVIZIJA PROCESA ("LAYERED PROCESS AUDIT CHECKLIST") <p style="color:DodgerBlue;">Sečenje + priprema</p></h3>
<div><h3 class="text-success text-center">Korisnik: <?php echo $ime." ".$prezime  ?></h3></div>

<form action="http://10.239.172.30/lpa/layer/first_page.php?NIV=<?php echo $_GET['NIV']; ?>&LOC=<?php echo $_GET['LOC']; ?>&AU=<?php echo $_GET['AU']; ?>" method="POST">
<table class="table">


<thead>
    <tr class="text-light bg-secondary">
        
      <th></th>
      <th><h4 style="text-align:left">Procesni element</h4></th>
      <!-- Tekst obavestenja preskocenom pitanju -->
      <h4 class="text-danger"><?php echo $msg; ?></h4>
<td></td>
<td></td>
<td></td>
<td></td>
    </tr>
  </thead>


  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">1</th>
      <th scope="col">SPQVC postavka targeta, praćenje i kontinualno unapređenje</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
      <th scope="col">Korektivne mere/Komentari</th>
      <th>Rešavanje neusaglašenosti</th>
    </tr>
  </thead>


  <tbody>
    <tr>
      <th scope="row">1.1</th>
      <td>Da li su SPQVC izlozeni targeti, prate i stakleni zid se odrzava i cisti?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p1" id="inlineRadio1" value="DA" onclick="displayHidden('inlineRadio1', 'inlineRadio2', 'exampleFormControlTextarea1', 'inputState1')"/> <!-- checked -->
          <label class="form-check-label" for="inlineRadio1">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p1" id="inlineRadio2" value="NE" onclick="displayHidden('inlineRadio1', 'inlineRadio2', 'exampleFormControlTextarea1', 'inputState1')"/>
          <label class="form-check-label" for="inlineRadio2"require>NE</label>
        </div>
      </td>

<td><div class="form-group">
      <label for="exampleFormControlTextarea1"></label>
      <textarea class="form-control" id="exampleFormControlTextarea1" name="k1" rows="1" placeholder="Komentar" style=" display: none;"></textarea>
    </div>
</td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState1" name="u1" class="form-select" style= "display:none;" onclick="displayHidden('inlineRadio1', 'inlineRadio2', 'exampleFormControlTextarea1', 'inputState1')" >
      <option selected></option>
      <option>Petar Petrovic</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>




    <tr>
      <th scope="row">1.2</th>
      <td>Da li se praćenje po satu i eskalacioni proces izvršavaju po mašini i stanici pripreme?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p2" id="inlineRadio3" value="DA" onclick="displayHidden('inlineRadio3', 'inlineRadio4', 'exampleFormControlTextarea2', 'inputState2')"/>
          <label class="form-check-label" for="inlineRadio3">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p2" id="inlineRadio4" value="NE" onclick="displayHidden('inlineRadio3', 'inlineRadio4', 'exampleFormControlTextarea2', 'inputState2')"/>
          <label class="form-check-label" for="inlineRadio4">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea2" name="k2" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState2" name="u2" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio3', 'inlineRadio4', 'exampleFormControlTextarea2', 'inputState2')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

    <tr>
      <th scope="row">1.3</th>
      <td>Da li se zastoji sečenja i pripreme efektnivno prate i kontrolišu da bi se osiguralo postizanje smenskih targeta?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p3" id="inlineRadio5" value="DA" onclick="displayHidden('inlineRadio5', 'inlineRadio6', 'exampleFormControlTextarea3', 'inputState3')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p3" id="inlineRadio6" value="NE" onclick="displayHidden('inlineRadio5', 'inlineRadio6', 'exampleFormControlTextarea3', 'inputState3')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea3" name="k3" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState3" name="u3" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio5', 'inlineRadio6', 'exampleFormControlTextarea3', 'inputState3')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


    <tr>
      <th scope="row">1.4</th>
      <td>Da li je plan za rešavanje problema i kontinualno unapređenje uspostavljen da konstanto prati targete?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p4" id="inlineRadio7" value="DA" onclick="displayHidden('inlineRadio7', 'inlineRadio8', 'exampleFormControlTextarea4', 'inputState4')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p4" id="inlineRadio8" value="NE" onclick="displayHidden('inlineRadio7', 'inlineRadio8', 'exampleFormControlTextarea4', 'inputState4')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea4" name="k4" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState4" name= "u4" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio7', 'inlineRadio8', 'exampleFormControlTextarea4', 'inputState4')">
      <option selected></option>
      <option value="Petar">Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

    <thead>
    <tr class="text-white bg-dark">
      <th scope="col">2</th>
      <th scope="col">Uslovi bezbednosti i okoline</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">2.1</th>
      <td>Da li operateri koriste zahtevanu bezbednostnu opremu?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p5" id="inlineRadio9" value="DA" onclick="displayHidden('inlineRadio9', 'inlineRadio10', 'exampleFormControlTextarea5', 'inputState5')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p5" id="inlineRadio10" value="NE" onclick="displayHidden('inlineRadio9', 'inlineRadio10', 'exampleFormControlTextarea5', 'inputState5')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea5" name="k5" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState5" name="u5" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio9', 'inlineRadio10', 'exampleFormControlTextarea5', 'inputState5')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>
<tr>
      <th scope="row">2.2</th>
      <td>Ne postoji rizik za integritet operatera: dimenzije prostora; radno mesto i oprema; zaštita opreme; 5S?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p6" id="inlineRadio11" value="DA" onclick="displayHidden('inlineRadio11', 'inlineRadio12', 'exampleFormControlTextarea6', 'inputState6')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p6" id="inlineRadio12" value="NE" onclick="displayHidden('inlineRadio11', 'inlineRadio12', 'exampleFormControlTextarea6', 'inputState6')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea6" name="k6" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState6" name="u6" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio11', 'inlineRadio12', 'exampleFormControlTextarea6', 'inputState6')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>
<tr>
      <th scope="row">2.3</th>
      <td>Da li je osvetljenost radnog mesta adekvatno?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p7" id="inlineRadio13" value="DA" onclick="displayHidden('inlineRadio13', 'inlineRadio14', 'exampleFormControlTextarea7', 'inputState7')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p7" id="inlineRadio14" value="NE" onclick="displayHidden('inlineRadio13', 'inlineRadio14', 'exampleFormControlTextarea7', 'inputState7')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea7" name="k7" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState7" name="u7" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio13', 'inlineRadio14', 'exampleFormControlTextarea7', 'inputState7')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


<!--  3  -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">3</th>
      <th scope="col">Trening resursi</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">3.1</th>
      <td>Da li su operateri trenirani i sertifikovani? Da li je matrica fleksibilnosti ažurirana i dostupna?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p8" id="inlineRadio15" value="DA" onclick="displayHidden('inlineRadio15', 'inlineRadio16', 'exampleFormControlTextarea8', 'inputState8')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p8" id="inlineRadio16" value="NE" onclick="displayHidden('inlineRadio15', 'inlineRadio16', 'exampleFormControlTextarea8', 'inputState8')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea8" name="k8" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState8" name="u8" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio15', 'inlineRadio16', 'exampleFormControlTextarea8', 'inputState8')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">3.2</th>
      <td>Da li je broj operatera i pomoćnih operatera usaglašen sa potrebama prema nedeljnoj studiji kapaciteta?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p9" id="inlineRadio17" value="DA" onclick="displayHidden('inlineRadio17', 'inlineRadio18', 'exampleFormControlTextarea9', 'inputState9')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p9" id="inlineRadio18" value="NE" onclick="displayHidden('inlineRadio17', 'inlineRadio18', 'exampleFormControlTextarea9', 'inputState9')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea9" name="k9" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState9" name="u9" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio17', 'inlineRadio18', 'exampleFormControlTextarea9', 'inputState9')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>
  <tr>
      <th scope="row">3.3</th>
      <td>Da li je dnevni performans novih operatera evaluisan da bi se oslobodila trening sertifikacija?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p10" id="inlineRadio19" value="DA" onclick="displayHidden('inlineRadio19', 'inlineRadio20', 'exampleFormControlTextarea10', 'inputState10')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p10" id="inlineRadio20" value="NE" onclick="displayHidden('inlineRadio19', 'inlineRadio20', 'exampleFormControlTextarea10', 'inputState10')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea10" name="k10" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState10" name="u10" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio19', 'inlineRadio20', 'exampleFormControlTextarea10', 'inputState10')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">3.4</th>
      <td>Da li je organizacija proizvodnje uspostavljena da bi efektivno osigurala nadgledanje operatera i procesa?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p11" id="inlineRadio21" value="DA" onclick="displayHidden('inlineRadio21', 'inlineRadio22', 'exampleFormControlTextarea11', 'inputState11')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p11" id="inlineRadio22" value="NE" onclick="displayHidden('inlineRadio21', 'inlineRadio22', 'exampleFormControlTextarea11', 'inputState11')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea11" name="k11" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState11" name="u11" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio21', 'inlineRadio22', 'exampleFormControlTextarea11', 'inputState11')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>




  <!--  4   -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">4</th>
      <th scope="col">Organizacija radnog mesta i poštovanje materijala</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">4.1</th>
      <td>Da li zonski prostor sečenja/pripreme organizovan, sa koridorima definisanim da podrže konekcije sa rafom za kablove, die centrom i pagodama?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p12" id="inlineRadio23" value="DA" onclick="displayHidden('inlineRadio23', 'inlineRadio24', 'exampleFormControlTextarea12', 'inputState12')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p12" id="inlineRadio24" value="NE" onclick="displayHidden('inlineRadio23', 'inlineRadio24', 'exampleFormControlTextarea12', 'inputState12')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea12" name="k12" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState12" name="u12" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio23', 'inlineRadio24', 'exampleFormControlTextarea12', 'inputState12')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">4.2</th>
      <td>Da li su pagode sa gotovim provodnicima locirane ispred tačke njihove proizvodnje (mačina/ LP stanica)? ("Pull system" definicija - materijal ispred tačke proizvodnje)</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p13" id="inlineRadio25" value="DA" onclick="displayHidden('inlineRadio25', 'inlineRadio26', 'exampleFormControlTextarea13', 'inputState13')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p13" id="inlineRadio26" value="NE" onclick="displayHidden('inlineRadio25', 'inlineRadio26', 'exampleFormControlTextarea13', 'inputState13')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea13" name="k13" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState13" name="u13" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio25', 'inlineRadio26', 'exampleFormControlTextarea13', 'inputState13')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">4.3</th>
      <td>Da li se sva oprema i zona održavana, uređuje i čisti? (mašine, oprema za konekciju, pagode, alati, itd.)</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p14" id="inlineRadio27" value="DA" onclick="displayHidden('inlineRadio27', 'inlineRadio28', 'exampleFormControlTextarea14', 'inputState14')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p14" id="inlineRadio28" value="NE" onclick="displayHidden('inlineRadio27', 'inlineRadio28', 'exampleFormControlTextarea14', 'inputState14')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea14" name="k14" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState14" name="u14" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio27', 'inlineRadio28', 'exampleFormControlTextarea14', 'inputState14')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">4.4</th> <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!  -->
      <td>Da li su sve identifikacije u pagodi sa kodom provodnika, tačkom narudžbine / kapacitet lokacije postavljene i održavane? Za BTO metod, da li je prostor za čekanje organizovan identifikovan sa dostavnim rutama?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p15" id="inlineRadio29" value="DA" onclick="displayHidden('inlineRadio29', 'inlineRadio30', 'exampleFormControlTextarea15', 'inputState15')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p15" id="inlineRadio30" value="NE" onclick="displayHidden('inlineRadio29', 'inlineRadio30', 'exampleFormControlTextarea15', 'inputState15')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea15" name="k15" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState15" name="u15" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio29', 'inlineRadio30', 'exampleFormControlTextarea15', 'inputState15')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">4.5</th>
      <td>Da li se nedeljna revizija sečenja i ažuriranja izvršavaju i pagode + KB ažurira prema kupčevim potrebama, količina po danu i tačka narudžbe?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p0" id="inlineRadio31" value="DA" onclick="displayHidden('inlineRadio31', 'inlineRadio32', 'exampleFormControlTextarea16', 'inputState16')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p0" id="inlineRadio32" value="NE" onclick="displayHidden('inlineRadio31', 'inlineRadio32', 'exampleFormControlTextarea16', 'inputState16')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea16" name="k16" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState16" name="u16" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio31', 'inlineRadio32', 'exampleFormControlTextarea16', 'inputState16')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">4.6</th>
      <td>Da li se "FIFO", kapacitet pozicije, tačka narudžbine i roj snopova u pagodi poštuje?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p16" id="inlineRadio33" value="DA" onclick="displayHidden('inlineRadio33', 'inlineRadio34', 'exampleFormControlTextarea17', 'inputState17')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p16" id="inlineRadio34" value="NE" onclick="displayHidden('inlineRadio33', 'inlineRadio34', 'exampleFormControlTextarea17', 'inputState17')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea17" name="k17" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState17" name="u17" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio33', 'inlineRadio34', 'exampleFormControlTextarea17', 'inputState17')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">4.7</th>
      <td>Da li su dimenzije pagoda i pristupačnost pošteno definisana da podrže dostavne rute?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p17" id="inlineRadio35" value="DA" onclick="displayHidden('inlineRadio35', 'inlineRadio36', 'exampleFormControlTextarea18', 'inputState18')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p17" id="inlineRadio36" value="NE" onclick="displayHidden('inlineRadio35', 'inlineRadio36', 'exampleFormControlTextarea18', 'inputState18')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea18" name="k18" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState18" name="u18" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio35', 'inlineRadio36', 'exampleFormControlTextarea18', 'inputState18')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>
  <tr>
      <th scope="row">4.8</th>
      <td>Da li se terminali pakuju i dostavljaju u Die centar ispravno (koturi u definisanoj poziciji, glave terminala orijentisane na gore, krajevi kotura fiksirani) ? </td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p18" id="inlineRadio37" value="DA" onclick="displayHidden('inlineRadio37', 'inlineRadio38', 'exampleFormControlTextarea19', 'inputState19')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p18" id="inlineRadio38" value="NE" onclick="displayHidden('inlineRadio37', 'inlineRadio38', 'exampleFormControlTextarea19', 'inputState19')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea19" name="k19" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState19" name="u19" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio37', 'inlineRadio38', 'exampleFormControlTextarea19', 'inputState19')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>
  <tr>
      <th scope="row">4.9</th>
      <td>Da li postoji dupla podrška za koture terminala pored presa na mašni? Ako tehnički nije izvodljivo, da li postoji alternativno rešenje?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p19" id="inlineRadio39" value="DA" onclick="displayHidden('inlineRadio39', 'inlineRadio40', 'exampleFormControlTextarea20', 'inputState20')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p19" id="inlineRadio40" value="NE" onclick="displayHidden('inlineRadio39', 'inlineRadio40', 'exampleFormControlTextarea20', 'inputState20')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea20" name="k20" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState20" name="u20" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio39', 'inlineRadio40', 'exampleFormControlTextarea20', 'inputState20')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">4.10</th>
      <td>Da li se spremnik za žice ili raf održava, čisti i sadrži keramičke prstenove bez rizika da se žica ošteti?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p20" id="inlineRadio41" value="DA" onclick="displayHidden('inlineRadio41', 'inlineRadio42', 'exampleFormControlTextarea21', 'inputState21')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p20" id="inlineRadio42" value="NE" onclick="displayHidden('inlineRadio41', 'inlineRadio42', 'exampleFormControlTextarea21', 'inputState21')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea21" name="k21" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState21" name="u21" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio41', 'inlineRadio42', 'exampleFormControlTextarea21', 'inputState21')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>



  <!--  5   -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">5</th>
      <th scope="col">Egzekucija, metod i vizuelne pomoći</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">5.1</th>
      <td>Da li sve mašine i stanice pripreme počinju sa radom u smensko "SOP" vreme? (proveriti prvi sat za zastoj)</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p21" id="inlineRadio43" value="DA" onclick="displayHidden('inlineRadio43', 'inlineRadio44', 'exampleFormControlTextarea22', 'inputState22')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p21" id="inlineRadio44" value="NE" onclick="displayHidden('inlineRadio43', 'inlineRadio44', 'exampleFormControlTextarea22', 'inputState22')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea22" name="k22" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState22" name="u22" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio43', 'inlineRadio44', 'exampleFormControlTextarea22', 'inputState22')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">5.2</th>
      <td>Da li se frekvencija prikupljanja Kanbanova poštuje? BTO- da li se narudžbe puštaju u različito vreme?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p22" id="inlineRadio45" value="DA" onclick="displayHidden('inlineRadio45', 'inlineRadio46', 'exampleFormControlTextarea23', 'inputState23')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p22" id="inlineRadio46" value="NE" onclick="displayHidden('inlineRadio45', 'inlineRadio46', 'exampleFormControlTextarea23', 'inputState23')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea23" name="k23" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState23" name="u23" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio45', 'inlineRadio46', 'exampleFormControlTextarea23', 'inputState23')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">5.3</th>
      <td>Da li se sekvenca proizvodnje poštuje. Kanbani prema satu podešavanja tj. Sekvenca podešavanja za "e-cutting / BTO" ?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p23" id="inlineRadio47" value="DA" onclick="displayHidden('inlineRadio47', 'inlineRadio48', 'exampleFormControlTextarea24', 'inputState24')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p23" id="inlineRadio48" value="NE" onclick="displayHidden('inlineRadio47', 'inlineRadio48', 'exampleFormControlTextarea24', 'inputState24')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea24" name="k24" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState24" name="u24" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio47', 'inlineRadio48', 'exampleFormControlTextarea24', 'inputState24')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">5.4</th>
      <td>Da li mašine rade prateći mašini određene narudžbe ili bez narudžbi u kašnjenju? (proveriti crveni Kanban / BTO sekvencu / kompletiranje narudžbe) ?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p24" id="inlineRadio49" value="DA" onclick="displayHidden('inlineRadio49', 'inlineRadio50', 'exampleFormControlTextarea25', 'inputState25')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p24" id="inlineRadio50" value="NE" onclick="displayHidden('inlineRadio49', 'inlineRadio50', 'exampleFormControlTextarea25', 'inputState25')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea25" name="k25" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState25" name="u25" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio49', 'inlineRadio50', 'exampleFormControlTextarea25', 'inputState25')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">5.5</th>
      <td>Da li se žice, terminali, gumice, alati, aplikatori naručuju unapred i spremni su na mašini za naredno podešavanje?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p25" id="inlineRadio51" value="DA" onclick="displayHidden('inlineRadio51', 'inlineRadio52', 'exampleFormControlTextarea26', 'inputState26')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p25" id="inlineRadio52" value="NE" onclick="displayHidden('inlineRadio51', 'inlineRadio52', 'exampleFormControlTextarea26', 'inputState26')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea26" name="k26" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState26" name="u26" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio51', 'inlineRadio52', 'exampleFormControlTextarea26', 'inputState26')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">5.6</th>
      <td>Da li su vizelne pomoći i radne instrukcije ("SOS / WCT") vidljive i održavane?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p26" id="inlineRadio53" value="DA" onclick="displayHidden('inlineRadio53', 'inlineRadio54', 'exampleFormControlTextarea27', 'inputState27')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p26" id="inlineRadio54" value="NE" onclick="displayHidden('inlineRadio53', 'inlineRadio54', 'exampleFormControlTextarea27', 'inputState27')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea27" name="k27" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState27" name="u27" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio52', 'inlineRadio53', 'exampleFormControlTextarea27', 'inputState27')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">5.7</th>
      <td>Da li se podešavanje izvršava prateći "SOS" korake i vreme prema "WCT"? (proveriti broj izvršenih podešavanja u odnosu na vreme utrošeno za isto)</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p27" id="inlineRadio55" value="DA" onclick="displayHidden('inlineRadio55', 'inlineRadio56', 'exampleFormControlTextarea28', 'inputState28')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p27" id="inlineRadio56" value="NE" onclick="displayHidden('inlineRadio55', 'inlineRadio56', 'exampleFormControlTextarea28', 'inputState28')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea28" name="k28" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState28" name="u28" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio54', 'inlineRadio55', 'exampleFormControlTextarea28', 'inputState28')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">5.8</th>
      <td>Da li su parametri i brzina mašine u skladu sa definicijom sa Kanbana / narudžbenice?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p28" id="inlineRadio57" value="DA" onclick="displayHidden('inlineRadio57', 'inlineRadio58', 'exampleFormControlTextarea29', 'inputState29')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p28" id="inlineRadio58" value="NE" onclick="displayHidden('inlineRadio57', 'inlineRadio58', 'exampleFormControlTextarea29', 'inputState29')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea29" name="k29" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState29" name="u29" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio56', 'inlineRadio57', 'exampleFormControlTextarea29', 'inputState29')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">5.9</th>
      <td>Da li smenovođe / vođe timova posmatraju i nadgledaju egzekuciju operacija, i reaguju da isprave devijacije na vreme?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p29" id="inlineRadio59" value="DA" onclick="displayHidden('inlineRadio59', 'inlineRadio60', 'exampleFormControlTextarea30', 'inputState30')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p29" id="inlineRadio60" value="NE" onclick="displayHidden('inlineRadio59', 'inlineRadio60', 'exampleFormControlTextarea30', 'inputState30')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea30" name="k30" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState30" name="u30" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio59', 'inlineRadio60', 'exampleFormControlTextarea30', 'inputState30')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>





  <!--  6   -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">6</th>
      <th scope="col">Samopouzdanje, kapije kvaliteta i kontrolni planovi</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">6.1</th>
      <td>Da li se instrukcija za promenu (podešavanje) prati i potrebni uzorci se čuvaju, na drugom mestu, obeleženi?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p30" id="inlineRadio61" value="DA" onclick="displayHidden('inlineRadio61', 'inlineRadio62', 'exampleFormControlTextarea31', 'inputState31')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p30" id="inlineRadio62" value="NE" onclick="displayHidden('inlineRadio61', 'inlineRadio62', 'exampleFormControlTextarea31', 'inputState31')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea31" name="k31" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState31" name="u31" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio61', 'inlineRadio62', 'exampleFormControlTextarea31', 'inputState31')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">6.2</th>
      <td>Da li operateri prate kontrolne planove: kontrolišu predmete; kontrolišu metod; mere uzorak; frekvencija i reakcioni plan implementirani u slučaju devijacije?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p31" id="inlineRadio63" value="DA" onclick="displayHidden('inlineRadio63', 'inlineRadio64', 'exampleFormControlTextarea32', 'inputState32')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p31" id="inlineRadio64" value="NE" onclick="displayHidden('inlineRadio63', 'inlineRadio64', 'exampleFormControlTextarea32', 'inputState32')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea32" name="k32" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState32" name="u32" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio63', 'inlineRadio64', 'exampleFormControlTextarea32', 'inputState32')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">6.3</th>
      <td>Da li su parametri mašine zapamćeni i zaključani za operatera?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p32" id="inlineRadio65" value="DA" onclick="displayHidden('inlineRadio65', 'inlineRadio66', 'exampleFormControlTextarea33', 'inputState33')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p32" id="inlineRadio66" value="NE" onclick="displayHidden('inlineRadio65', 'inlineRadio66', 'exampleFormControlTextarea33', 'inputState33')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea33" name="k33" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState33" name="u33" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio65', 'inlineRadio66', 'exampleFormControlTextarea33', 'inputState33')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>



  <!--  7   -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">7</th>
      <th scope="col">Die centar, oprema i održavanje</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">7.1</th>
      <td>Da li je die centar održavan, čišćen i organizovan po definiciji?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p33" id="inlineRadio67" value="DA" onclick="displayHidden('inlineRadio67', 'inlineRadio68', 'exampleFormControlTextarea34', 'inputState34')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p33" id="inlineRadio68" value="NE" onclick="displayHidden('inlineRadio67', 'inlineRadio68', 'exampleFormControlTextarea34', 'inputState34')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea34" name="k34" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState34" name="u34" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio67', 'inlineRadio68', 'exampleFormControlTextarea34', 'inputState34')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">7.2</th>
      <td>Da li izdata oprema, radi ispravno i održavanje se izvršava (proveriti status preventivnog održavanja i prvog nivoa održavanja npr. Alat je očišćen i nauljen)?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p34" id="inlineRadio69" value="DA" onclick="displayHidden('inlineRadio69', 'inlineRadio70', 'exampleFormControlTextarea35', 'inputState35')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p34" id="inlineRadio70" value="NE" onclick="displayHidden('inlineRadio69', 'inlineRadio70', 'exampleFormControlTextarea35', 'inputState35')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea35" name="k35" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState35" name="u35" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio69', 'inlineRadio70', 'exampleFormControlTextarea35', 'inputState35')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">7.3</th>
      <td>Da li se alati pripremaju sa pred-podešavanjem kao što je definisano?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p35" id="inlineRadio71" value="DA" onclick="displayHidden('inlineRadio71', 'inlineRadio72', 'exampleFormControlTextarea36', 'inputState36')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p35" id="inlineRadio72" value="NE" onclick="displayHidden('inlineRadio71', 'inlineRadio72', 'exampleFormControlTextarea36', 'inputState36')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea36" name="k36" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState36" name="u36" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio71', 'inlineRadio72', 'exampleFormControlTextarea36', 'inputState36')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">7.4</th>
      <td>Da li su alati i aplikatori spremni i dostavljaju se na mašine / stanice pripreme? (proveriti zastoje)</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p36" id="inlineRadio73" value="DA" onclick="displayHidden('inlineRadio73', 'inlineRadio74', 'exampleFormControlTextarea37', 'inputState37')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p36" id="inlineRadio74" value="NE" onclick="displayHidden('inlineRadio73', 'inlineRadio74', 'exampleFormControlTextarea37', 'inputState37')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea37" name="k37" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState37" name="u37" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio73', 'inlineRadio74', 'exampleFormControlTextarea37', 'inputState37')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">7.5</th>
      <td>Da li je oprema za merenje kalibrisana i održavana (mikrometri, dinamometri)</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p37" id="inlineRadio75" value="DA" onclick="displayHidden('inlineRadio75', 'inlineRadio76', 'exampleFormControlTextarea38', 'inputState38')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p37" id="inlineRadio76" value="NE" onclick="displayHidden('inlineRadio75', 'inlineRadio76', 'exampleFormControlTextarea38', 'inputState38')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea38" name="k38" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState38" name="u38" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio75', 'inlineRadio76', 'exampleFormControlTextarea38', 'inputState38')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>





  <!--  8   -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">8</th>
      <th scope="col">Segregacija materijala, "kontejment" i dorada</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">8.1</th>
      <td>Da li se otpad odvaja na mašini po definiciji?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p38" id="inlineRadio77" value="DA" onclick="displayHidden('inlineRadio77', 'inlineRadio78', 'exampleFormControlTextarea39', 'inputState39')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p38" id="inlineRadio78" value="NE" onclick="displayHidden('inlineRadio77', 'inlineRadio78', 'exampleFormControlTextarea39', 'inputState39')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea39" name="k39" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState39" name="u39" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio77', 'inlineRadio78', 'exampleFormControlTextarea39', 'inputState39')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  <tr>
      <th scope="row">8.2</th>
      <td>Da li se uzorci sa podešavanja odvajaju na definisano mesto do završetka smene?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p39" id="inlineRadio79" value="DA" onclick="displayHidden('inlineRadio79', 'inlineRadio80', 'exampleFormControlTextarea40', 'inputState40')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p39" id="inlineRadio80" value="NE" onclick="displayHidden('inlineRadio79', 'inlineRadio80', 'exampleFormControlTextarea40', 'inputState40')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea40" name="k40" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState40" name="u40" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio79', 'inlineRadio80', 'exampleFormControlTextarea40', 'inputState40')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>

  <tr>
      <th scope="row">8.3</th>
      <td>Da li se sumnjivi materijal odvaja na specifično mesto i korektno obeležava?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p40" id="inlineRadio81" value="DA" onclick="displayHidden('inlineRadio81', 'inlineRadio82', 'exampleFormControlTextarea41', 'inputState41')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p40" id="inlineRadio82" value="NE" onclick="displayHidden('inlineRadio81', 'inlineRadio82', 'exampleFormControlTextarea41', 'inputState41')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea41" name="k41" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState41" name="u41" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio81', 'inlineRadio82', 'exampleFormControlTextarea41', 'inputState41')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>



  <!--  9   -->
  <thead>
    <tr class="text-white bg-dark">
      <th scope="col">9</th>
      <th scope="col">Komunikacija sa zaposlenima</th>
      <th scope="col" style="color:green;">DA</th>
      <th scope="col" style="color:red;">NE</th>
<td></td>
<td></td>
    </tr>
  </thead>

  <tr>
      <th scope="row">9.1</th>
      <td>Da li su zaposleni svesni targeta, rezultata i poslednjih kupčevih zamerki?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p41" id="inlineRadio83" value="DA" onclick="displayHidden('inlineRadio83', 'inlineRadio84', 'exampleFormControlTextarea42', 'inputState42')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p41" id="inlineRadio84" value="NE" onclick="displayHidden('inlineRadio83', 'inlineRadio84', 'exampleFormControlTextarea42', 'inputState42')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea42" name="k42" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState42" name="u42" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio83', 'inlineRadio84', 'exampleFormControlTextarea42', 'inputState42')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


<tr>
    <th scope="row">9.2</th>
      <td>Da li su adresirane sugestije operatera na unapređenje SPQVC rezultata?</td>
      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p42" id="inlineRadio85" value="DA" onclick="displayHidden('inlineRadio85', 'inlineRadio86', 'exampleFormControlTextarea43', 'inputState43')"/>
          <label class="form-check-label" for="inlineRadio5">DA</label>
        </div>
      </td>

      <td>
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="radio" name="p42" id="inlineRadio86" value="NE" onclick="displayHidden('inlineRadio85', 'inlineRadio86', 'exampleFormControlTextarea43', 'inputState43')"/>
          <label class="form-check-label" for="inlineRadio6">NE</label>
        </div>
      </td>

<td><div class="form-group">
    <label for="exampleFormControlTextarea1"></label>
    <textarea class="form-control" id="exampleFormControlTextarea43" name="k43" rows="1" placeholder="Komentar"  style= "display:none;"></textarea>
  </div></td>

<td> <div class="col-md-10">
    <label for="inputState" class="form-label"></label>
    <select id="inputState43" name="u43" class="form-select"  style= "display:none;" onclick="displayHidden('inlineRadio85', 'inlineRadio86', 'exampleFormControlTextarea43', 'inputState43')">
      <option selected></option>
      <option>Petar</option>
      <option>Pavle</option>
      <option>Marko</option>
    </select>
  </div>
</td>


  </tbody>
</table>
<div class="d-grid gap-2 col-6 mx-auto">
  <input type="submit" name="subBtn" class="btn btn-primary" value="Potvrdi"><br><br>
</form>
</div>  
</body>
</html>


<script>
function displayHidden($id1 ="", $id2 ="", $idT ="", $idU="") {

  var text = document.getElementById($idT);
  var text2 = document.getElementById($idU);
  if(document.getElementById($id1).checked) {
    text.style.display = "none";
    text2.style.display = "none";

  }else if(document.getElementById($id2).checked) {
    text.style.display = "block";
    text2.style.display = "block";
  }
}
</script>
