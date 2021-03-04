<?php
// Početak sesije
  session_start();
// Konekcija na bazu
  include 'db_connection.php';
// Varijable
  $page="index.php";
// Provera logovanja i restartovanje sesije
  $user_id = $_SESSION['userform'];

  if ($user_id == "") {
    session_unset();
    // destroy the session
    session_destroy();
    //izabrani tim sa nastavkom .php koristi kao link
    header("Location: $page");
    exit;
  }
// Prikaz korisnickog imena navbaru
  $query_user = "SELECT * FROM `hr_zaposleni` WHERE `id_zaposlenog` LIKE '$user_id'";
  $query_user_1 = mysqli_query($conn, $query_user);
  
  //definisanje rezultata kverija u stringove
  while ($row = mysqli_fetch_array($query_user_1)) {
  $ime = $row['2'];
  $prezime = $row['3'];
  }
// Odjavljivanje korisnika
  if (isset($_POST['odjava'])) {
    // remove all session variables
    session_unset();
    // destroy the session
    session_destroy();
    //izabrani tim sa nastavkom .php koristi kao link
    header("Location: $page");
    exit;
  }
// Filtriranje po ID broju
  if (isset($_POST['pretraga'])) {
    header('Location:'.$_SERVER['PHP_SELF']."?operater=".$_POST['id']);
    exit;
  }
// Restart filtera
  if (isset($_POST['filter'])) {
    header('Location:'.$_SERVER['PHP_SELF']);
    exit();
  }
//upis promena u bazu
  if(isset($_POST['promena'])){
    $sql = "INSERT INTO `hr_zaposleni`(`id_zaposlenog`,`rfid_tag` , `ime`,`prezime`,`kategorija`)
    VALUES ('$_POST[id_operatera]','$_POST[rf_tag]','$_POST[ime_operatera]','$_POST[prezime_operatera]','$_POST[struktura_operatera]')";

    if ($conn->query($sql) === TRUE) {
      header('Location:zaposleni.php?operater='.$_POST[id_operatera]);
      exit;
    }
    else {
      echo 
      '<div class="body-p">
      <div class="alert-danger">';

      echo "Error: " . $sql . "<br>" . $conn->error;
      echo '</div>
      </div>';
    }
  }

// Provera odobrenja alatima
    $stock_count = 1; 
    $disabled = $stock_count > 0 ? "disabled='disabled'" : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Baza zaposleni</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="style.css">
    
  </style>
</head>
<body class="body-p body-color container" >
	<!-- Navigacija -->
	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
		<a class="btn btn-light shadow-sm text-left mr-2 mb-3" href="index.php">
		Početna stranica</a>
	</div>
	
	<!--naslov-->
	<h4 class="text-dark text-left mt-3">
	Baza zaposlenih</h4>
	<hr class="bg-secondary">
	<div class="row">


<!--levi segment sa instrukcijama i opcijama-->
		<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">
			<div class="rounded text-dark shadow-sm bg-light border border-info p-2 mb-4">
			<img src="asset/icon/info-circle.svg" class="float-right" width="24" alt="">
			<p>
			Zadržavanjem miša preko <span class="text-info">info</span> polja, prikazaće vam se dodatne informacije o zaposlenom.</p>
			</div>

			                    <form method="POST" class="input-group shadow-sm mb-2 mr-2">
           <input class="form-control border-light" id="operater" type="text"  name="id" placeholder="ID broj operatera" autocomplete="off">
            <div class="input-group-append">
              <button class="btn btn-light" type="submit" name="pretraga">Pretraži</button>
            </div>
			
			
			<?php if (isset($_GET['operater'])){
				echo'
			<div class="input-group-append">
			<button class="btn btn-secondary shadow-sm text-left" type="submit" name="filter">Poništi pretragu</button>
				</div>
				';
			}?>
			   </form>
                        <button type="button" class="btn btn-success shadow-sm text-left mr-2 mb-2" name="filter" data-toggle="modal" data-target="#exampleModal">Nov Unos</button>
		
		
		
		</div>

		
		
		
<!--Desni segment sa projektima-->
		<div class="col-xl-8 col-lg-7 col-md-6 mb-3">




  <?php
  include 'db_connection.php';
  $results_per_page = 500;

  $sql = "SELECT COUNT(id_zaposlenog) AS total FROM hr_zaposleni";
  $result = $conn->query($sql);
  $row = $result->fetch_assoc();
  $total_pages = ceil($row["total"] / $results_per_page); // calculate total pages with results

  //tabelarni prikaz promenjiv
  if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
  $start_from = ($page-1) * $results_per_page;

if (isset($_GET['operater'])) {
  $operater = $_GET['operater'];
    $sql = "SELECT * FROM hr_zaposleni WHERE id_zaposlenog LIKE '$operater' ORDER BY id_zaposlenog"; 
    //ASC LIMIT $start_from, ".$results_per_page
  $rs_result = $conn->query($sql);
}


else 
  $sql = "SELECT * FROM hr_zaposleni ORDER BY ime, prezime  "; // ASC LIMIT $start_from, ".$results_per_page;
  $rs_result = $conn->query($sql);

	if (mysqli_num_rows($rs_result)==0) {
	echo '
				<div class="card bg-danger p-2  text-light">
				<p>Traženi operater nije prisutan u bazi.
				<br>Proverite ispravnost ID broja.</p>
			</div>
	';}
	else

  echo '
  <div class="card bg-light shadow-sm pt-2">
  <table class="table table-sm table-hover table-borderless text-center">
  <thead>
  <tr class="">
    <th>ID</th>
    <th>RFID Tag</th>
    <th>Ime</th>
    <th>Prezime</th>
    <th colspan="2">...</th>
  </tr>
  </thead>';

  while($row = $rs_result->fetch_assoc()) {
  echo '
            <tr>
            <td>'.$row["id_zaposlenog"].'</td>
            <td>'.$row["rfid_tag"].'</td>
            <td>'.$row["ime"].'</td>
            <td>'.$row["prezime"].'</td>
			
			<td><a class="text-info"  data-bs-toggle="tooltip" data-bs-placement="top" data-bs-container="body"
			title="
pozicija: '.$row["pozicija"].'
kategorija: '.$row["kategorija"].'
radna_pozicija: '.$row["radna_pozicija"].'
bazni_tim: '.$row["bazni_tim"].'
					">Info</a></td>
					
            <td><a href="op_del.php?pagelink='.$_SERVER["PHP_SELF"].'&id='.$row["id_zaposlenog"].'&change=edituser" name="edt" >Izmeni</a></td>
            </tr>'
            ;
  };

  echo "</table>";

  /*    echo '<nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">';
  for ($i=1; $i<=$total_pages; $i++) {  // print links for all pages

              echo "<li class='page-item'> <a  class='page-link' href='zaposleni.php?page=".$i."'";
              if ($i==$page)  echo "class='page-link' ";
              echo ">".$i."</a></li> "; 

  }; 
              echo "  </ul>
  </nav>";
  */
  ?>

</div>
</div>
</div>

<!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Unos novog operatera</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" >
        <div class="modal-body">


            <div class="form-group row">
              <label for="id_operatera" class="col-lg-2 col-form-label">*ID: </label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="id_operatera" autocomplete="off" value="">
            </div>
          </div>
                      <div class="form-group row">
              <label for="rf_tag" class="col-lg-2 col-form-label">*RFID TAG: </label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="rf_tag" autocomplete="off" value="">
            </div>  
          </div>
            <div class="form-group row">
              <label for="ime-operatera" class="col-lg-2 col-form-label">*Ime:</label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="ime_operatera" autocomplete="off" value="" >
            </div>
          </div>
            <div class="form-group row">
              <label for="tp" class="col-lg-2 col-form-label">*Prezime:</label>
              <div class="col-lg-10">
              <input type="text" class="form-control"class="form-control" name="prezime_operatera" autocomplete="off" value="" >
            </div>
          </div>
            <div class="form-group row">
              <label for="pozicija_operatera" class="col-lg-2 col-form-label">*Struktura:</label>
              <div class="col-lg-10">
              <select class="custom-select form-control mb-3" name="struktura_operatera" >
              <option value="DH" selected="selected" >DH</option>
              <option value="IH" >IH</option>

            </select>
            </div>
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
          <input type="submit" class="btn btn-primary" name="promena" value="Unesi Operatera">
        
        </div>
      </form>
      </div>
    </div>
  </div>

<script>
var exampleEl = document.getElementById('example')
var popover = new bootstrap.Popover(exampleEl, options)
</script>
<script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
<script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>

</body>

</html>