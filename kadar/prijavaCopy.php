<?php include 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta http-equiv="refresh" content="1200;url=index_plus.php">
  <title>Prijava Prisustva</title>
  <link href="bootstrap-4.5.0-dist/css/bootstrap.min.css" rel="stylesheet" />

  <script src="bootstrap-4.5.0-dist/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap-4.5.0-dist/js/bootstrap.min.js"></script>
    
  <style>
    .body-p {
      margin-top: 20px;
    }    
    .body-color {
      background-color: #E7E7E7E7;
    }
    .navbar {
      min-height: 60px;
      max-height: 60px;
    }

    @media (min-width: 576px) {
      .card-columns {
        column-count: 1;
      }
    }

    @media (min-width: 768px) {
      .card-columns {
        column-count: 1;
      }
    }

    @media (min-width: 992px) {
      .card-columns {
        column-count: 2;
     }
    }

    @media (min-width: 1200px) {
      .card-columns {
        column-count: 3;
      }
    }
  </style>

</head>
<body class="body-color">

<!-- Naslov-->  
  <div class="body-p container-fluid">
    <h4 class="text-dark text-left ml-3">Prijava prisustva operatera i pregled radnih pozicija,
      <br> tim: 
        <span class="font-weight-bold text-danger">
          <?php
          $tim_filter = $_GET['tim_filter'];
          echo $_GET['tim_filter'];
          ?>
        </span> | vođa tima: 
        <span class="font-weight-bold text-danger">
          <?php
            $query_user = "SELECT * FROM `hr_zaposleni` JOIN `mf_timovi` ON hr_zaposleni.id_zaposlenog = mf_timovi.id_lidera WHERE mf_timovi.tim LIKE N'$tim_filter'";
            $query_user_1 = mysqli_query($conn, $query_user);
            if (mysqli_num_rows($query_user_1)==0) {
              echo "...";
            }
            else {
              while ($row = mysqli_fetch_array($query_user_1)) {
              $ime = $row['2'];
              $prezime = $row['3'];
              }
              echo "$prezime".", "."$ime";
            }
            ?>
        </span>
      </h4>
    </div>

<!-- Glavni sadrzaj-->
  <div class="container-fluid">
  <hr class="bg-secondary">
    <div class="row">

    <!-- Segment za prijavu --> 
      
<div class="col-xl-4 col-lg-5 col-md-6 mb-3 ">
  <div class="shadow bg-light" >
	<form class="form-inline justify-content-around p-3 mb-n2 shadow-sm" method="post">
		<a href="index_plus.php" class="rounded-0" >Povratak na početnu</a>
		<div class="input-group">
		  <select class="form-control border-secondary rounded-0" name="izbortima">
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
			  $link="prijava.php?tim_filter=".$_POST["izbortima"];
			  header("Location: $link");
			  exit;
			}
			?>
		  </select>
		  <div class="input-group-append">
			<button class="btn btn-dark rounded-0" type="submit" name="promena">
			  <img src="asset/icon/icons8-left-and-right-arrows-20.png" alt="Prijavi">
			  </button>
			</div>
		</div>
	</form>

			
    <form class="mb-3" name="form1" method="post" onsubmit="required()" autocomplete="off">
		<p class="text-dark p-3 mb-n3">Prijavite se očitavanjem kartice na RFID čitaču ili ručnim unosom ID broja.</p>
		<div class="input-group p-3 mb-n3 shadow-sm">
			<input type="text" class="form-control btn-lg border-secondary rounded-0" placeholder="ID / RFID Broj" id="idoperatera" name="idoperatera" autofocus="">
			<div class="input-group-append">
				<button class="btn btn-dark rounded-0" name="prijava" id="prijava" type="submit">
					<img src="asset/icon/icons8-checked-user-male-24.png" alt="Prijavi">
				</button>
			</div>
		</div>
    </form>
        <div class="p-3">
          <?php 
              // Varijable
                
                $datum_unosa = date ("Y-m-d");
                $vreme_unosa = date ("H:i:s");
                
              // Konvertovanje vremena u smenu
                $SOPTime =  date ("H:i:s");
                
                if ($SOPTime >= "05:00:00" && $SOPTime <= "12:59:00") $Shift = "1";
                if ($SOPTime >= "13:00:00" && $SOPTime <= "20:59:00") $Shift = "2";
                if (($SOPTime >= "21:00:00" && $SOPTime <= "23:59:00") OR ($SOPTime >= "00:00:00" && $SOPTime <= "04:59:00")) $Shift = "3";

                if ($SOPTime >= "00:00:00" && $SOPTime <= "04:59:00") $datum_unosa = date ("Y-m-d", strtotime( '-1 days' ));

              // Provera ID-a u bazi nakon submita
                if(isset($_POST['prijava'])){
                
                $input = "$_POST[idoperatera]";                    // produces "Alien     "
                $input0 = str_pad($input, 10, "0", STR_PAD_LEFT); 
                $input1 =(int)$input;

                $query_ime = "SELECT * FROM hr_zaposleni WHERE id_zaposlenog = '$_POST[idoperatera]' OR rfid_tag='$input0' OR rfid_tag='$input1'";
                $query_ime_run = mysqli_query($conn, $query_ime);
                
                while ($row = mysqli_fetch_array($query_ime_run)) {
                $ID=$row['0'];
                $IME=$row['2'];
                $PREZIME=$row['3'];
                $POZICIJA=$row['6'];
                $struktura=$row['5'];
                }
                
              // U slucaju da ne pronadje ID, izbacuje informativnu poruku
                if (mysqli_num_rows($query_ime_run)==0) {
                  ?>
          <div class="border border-danger bg-light p-2 mb-3 text-danger shadow-sm">
            <strong>Pogrešan ID!</strong> Očitajte ponovo ID karticu ili unesite ručno ID broj.
                  
          </div>
          <?php  
                }

                //ako pronadje ID ubacuje ga u listu prijavljenih oepratera
                else{
                  $sql1 = "
                  INSERT INTO `mf_prisustvo`(`id_zaposlenog`, `ime`, `prezime`, `smena`, `tim`, `datum_unosa`, `vreme_unosa`,`transfer`,`pozicija`,`struktura`)
                  VALUES ('$ID',N'$IME',N'$PREZIME','$Shift','$tim_filter','$datum_unosa','$vreme_unosa','N','$POZICIJA','$struktura')
                  /*u slucaju duple KEY vrednosti azurira podatak o timu i transferu*/
                  ON DUPLICATE KEY UPDATE
                  tim = CASE WHEN tim <> VALUES (tim)
                  THEN values (tim) ELSE tim END,
                  transfer = CASE WHEN tim <> VALUES (tim)
                  THEN 'N' ELSE 'Y' END";

                  //restartuje stranicu
                  if ($conn->query($sql1) === TRUE){
                  }
                  else {
                    echo "Error: " . $sql1 . "
          <br>" . $conn->error;
                  }
                }
                }
              
              // Broj neusaglasenih operatera
                $query = "
                  SELECT
                      mf_prisustvo.ime
                  FROM
                    mf_prisustvo
                  LEFT JOIN
                    (me_stanice
                  INNER JOIN
                    mf_timovi ON me_stanice.id_linije = mf_timovi.id_linije AND mf_timovi.tim LIKE '$tim_filter') 
                  ON
                    (mf_prisustvo.pozicija = me_stanice.radna_pozicija )
                  WHERE mf_prisustvo.datum_unosa = '$datum_unosa' AND mf_prisustvo.tim = '$tim_filter' AND me_stanice.radna_pozicija IS NULL";
                $result = mysqli_query($conn, $query);
                      if ($result) {
                        $row = mysqli_num_rows($result);
                          if ($row) {
                     ?>
            <div class="border border-danger bg-light p-2 mb-3 shadow-sm">
              <b>
                <a class="text-danger" href="#myModal" data-toggle="modal" data-id="NOK" data-tim="<?php echo "$tim_filter";?>">
                  <?php echo "$row"; ?> NOK Pozicija!
                </a>
              </b>
            </div>
            <?php 
                    }
                    mysqli_free_result($result);
                    }


                
              // Tabela svih prijavljenih operatera
                echo '
                
            <div class="border border-secondary shadow-sm">';
                $query = "SELECT * FROM mf_prisustvo WHERE tim = '$tim_filter' AND datum_unosa = '$datum_unosa' AND struktura = 'DH'";
                $result = mysqli_query($conn, $query);
                $query2 = "SELECT * FROM mf_prisustvo WHERE tim = '$tim_filter' AND datum_unosa = '$datum_unosa' AND struktura = 'IH'";
                $result2 = mysqli_query($conn, $query2);
                if ($result){
                  $row = mysqli_num_rows($result);
                  $row2 = mysqli_num_rows($result2);
                    echo '   
                
              <div class="p-2 bg-dark text-light">
                 Prisutno operatera DH: <b> '.$row.' </b>IH:  <b>  '.$row2.'</b>
              </div>
                    ';

                  mysqli_free_result($result);
                }

                $query = "SELECT * FROM mf_prisustvo WHERE tim = '$tim_filter' AND datum_unosa = '$datum_unosa' ORDER BY vreme_transfera DESC";
                
                echo '
                  
              <table class="table table-sm table-borderless p-2">
                <thead>
                  <tr>
                    <th class="text-center"> ID </th>
                    <th class="text-center">Operater</th>
                    <th class="text-center">Pozicija</th>
                    <th class="text-center">Kategorija</th>
                  </tr>
                </thead>
                <tbody>';
                
                if ($result = $conn->query($query)) {
                  while ($row = $result->fetch_assoc()) {
                  $field1name = $row["id_zaposlenog"];
                  $field2name = $row["ime"];
                  $field3name = $row["prezime"];
                  $field4name = $row["pozicija"];
                  $field5name = $row["struktura"];


                  echo '
                      
                  <tr>
                    <td class="text-center">'.$field1name.'</td>
                    <td class="text-center">'.$field2name.' '.$field3name.'</td>
                    <td class="text-center">'.$field4name.'</td>
                    <td class="text-center">'.$field5name.'</td>
                  </tr>';
                  }
                $result->free();
                }
                ;
                echo "
                    
                </tbody>
              </table>
            </div>";
            ?>
          </div>
        </div>
      </div>


  
    <!-- Segment sa pozicijama -->
      <div class="col-xl-8 col-lg-7 col-md-6 mb-3">
        <div class="card-columns">
      <!--kartica 1-->
        <?php
          
          $datum_unosa = date ("Y-m-d");

        // OFFSET = page_num -1 Filtrira naziv procesa
          $query_radni_proces="
            SELECT DISTINCT
              me_stanice.radni_proces
            FROM
              me_stanice
            INNER JOIN
              mf_timovi ON me_stanice.id_linije = mf_timovi.id_linije
            WHERE
              mf_timovi.tim LIKE '$tim_filter'
            ORDER BY
              me_stanice.redni_broj";

  $rs_result = mysqli_query($conn, $query_radni_proces);

  while($row = mysqli_fetch_array($rs_result)) {
    $proces = $row["radni_proces"];
  echo '  
  <div class="card text-center bg-light rounded-0 shadow">
  <h5 class="text-left ml-3 mt-3">'.$proces.'</h5>
            <div class="dropdown-divider"></div>

            '
            ;
              $query_pos="
              SELECT
                me_stanice.radna_pozicija,
                me_stanice.broj_operatera,
                me_stanice.id_linije,
                COUNT(mf_prisustvo.pozicija)
              FROM
                mf_prisustvo
              RIGHT JOIN
                (me_stanice
              INNER JOIN
                mf_timovi ON me_stanice.id_linije = mf_timovi.id_linije AND mf_timovi.tim LIKE '$tim_filter') 
              ON
                (mf_prisustvo.pozicija = me_stanice.radna_pozicija AND mf_prisustvo.datum_unosa = '$datum_unosa'  AND mf_prisustvo.tim = '$tim_filter')
              WHERE 
                me_stanice.radni_proces = '$proces'
              GROUP BY
                me_stanice.radna_pozicija
              ORDER BY
                me_stanice.redni_broj";
$query_res = mysqli_query($conn,$query_pos);
              echo '
              <table style="text-align: center" class="table table-sm table-borderless">
                <thead >
                  <tr>
                    <th>Pozicija</th>
                    <th># def</th>
                    <th># pri</th>
                  </tr>
                </thead>';
              if ($result = $conn->query($query_pos)) {
                while ($row = $query_res->fetch_assoc()) {

                  $field1name = $row["radna_pozicija"];
                  $field2name = $row["broj_operatera"];
                  $field3name = $row["COUNT(mf_prisustvo.pozicija)"];
                  echo '<tr>';

                  if ($field3name < $field2name) {
                    echo '<td class="table-danger">'.$field1name.'</td>';
                    echo '<td class="table-danger">'.$field2name.'</td>';
                    echo '<td class="table-danger"><a href="#myModal" data-toggle="modal" data-id="'.$field1name.'" data-tim="'.$tim_filter.'">'.$field3name.'</a></td>';
                  }
                  else if ($field3name > $field2name) {
                    echo '<td class="table-warning">'.$field1name.'</td>';
                    echo '<td class="table-warning">'.$field2name.'</td>';
                    echo '<td class="table-warning"><a href="#myModal" data-toggle="modal" data-id="'.$field1name.'" data-tim="'.$tim_filter.'">'.$field3name.'</a></td>';
                  }
                  else {
                    echo '<td class="table-success">'.$field1name.'</td>';
                    echo '<td class="table-success">'.$field2name.'</td>';
                    echo '<td class="table-success"><a href="#myModal" data-toggle="modal" data-id="'.$field1name.'" data-tim="'.$tim_filter.'">'.$field3name.'</a></td>';
                  }
                  echo '</tr>';
                }
                $result->free();
              }
              echo "</table>
              </div>";
}
        ?>

      <!--kraj kartice-->

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