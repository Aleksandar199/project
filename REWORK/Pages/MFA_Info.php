<?php require "../scripts/script_MFA_Info.php"; ?>

<?php require "../inc/header_p.php"; ?>
<br>
<div class="container-fluid">
   <!-- STATISTIKA CELIJE -->
<div class="row">
	<div class="col-md col-lg col-sm">
        <table class="table table-striped table-sm table-dark">
          <thead>
            <tr>
              <th scope="col" colspan="3" class="text-white text-center">STATISTIKA ĆELIJE - TOP 5 GREŠAKA</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row" class='text-center text-info'>#</th>
              <th  scope="col" class="text-info text-center">Kod defekta</th>
              <th class="text-info text-center">Broj grešaka</th>
            </tr>
            <?php 
        	    $i = 1; 
                while($res = mysqli_fetch_array($result2)) {         
                    echo "<tr class='text-center'><th scope='row'>" .$i++. "</th>";
                    echo '<td>'.$res['DefectCode'].'</td>';
                    echo '<td>'.$res['Broj'].'</td></tr>';         
                }
                ?>
          </tbody>
        </table>
    </div>
		<!-- STATISTIKA LOGOVANOG KORISNIKA -->	
	<div class="col-md col-lg col-sm">
        <table class="table table-striped table-sm table-dark">
          <thead>
            <tr>
        	  <th scope="col" colspan="4" class="text-white text-center">STATISTIKA KORISNIKA:
              <span class="text-warning"><?php echo  $ime." ". $prezime; ?></span>	
         	</th>
            </tr>
          </thead>
          <tbody>
            <tr  class="text-info text-center">
              <th scope="row">#</th>
              <th>Kod defekta</th>
        	  <th>Opis defekata</th>
        	  <th>Broj grešaka</th>
            </tr>
            <?php 
        		$i = 1;
                while($res = mysqli_fetch_array($result3)){ 
        		  echo '<tr class="text-center">';
        		  echo '<td>' .$i++. '</td>';
                  echo '<td>'.$res['DefectCode'].'</td>';
        		  echo '<td>'.$res['DefectCode'].'</td>';
                 echo '<td>'.$res['Broj'].'</td></tr>';
                }
              ?>
           </tbody>
	     </table>
	  </div>
    </div>

    <b><h5 class="text-danger"><button class="btn btn-sm btn-info float-left btn_ref" onclick='window.location.reload();'><b><span class="fa fa-refresh"></span> Osveži tabelu</b></button><center>>> LISTA NEPOTVRĐENIH GREŠAKA <<</center></h5></b>
      <!-- PRIKAZ TABELE GRESAKA -->
      <table class="table table-sm table-striped table-dark">
        	<tbody>
                <tr class="text-center greske-tabela">
                 <td class="text-white">#</td>
      		       <td>ID OP.</td>
      		       <td>MESTO</td>
      		       <td>TIP</td>
      		       <td>BROJ INST.</td>
      		       <td>DATUM PROIZ.</td>
      		       <td>SMENA</td>
      		       <td>TIM</td>
      		       <td>KOD DEF.</td>
      		       <td>KONEKTOR</td>
      		       <td>AKCIJA</td>
      		    </tr>
                <?php 
                $i = 1;
                while($res = mysqli_fetch_array($result4)) 
      		    {       
                echo '<tr class="text-center text-danger greske-tabela">';
                echo '<td class="text-white">'.$i++.'</td>';	
                echo '<td>'.$res['IDOperater'].'</td>';
      		    	echo '<td>'.$res['Post'].'</td>';
      		    	echo '<td>'.$res['FTQ_REQ_Status'].'</td>';
      		    	echo '<td>'.$res['HarnessNumber'].'</td>';
      		    	echo '<td>'.$res['DateProduction'].'</td>';
      		    	echo '<td>'.$res['Shift'].'</td>';			
      		    	echo '<td>'.$res['Team'].'</td>';			
      		    	echo '<td>'.$res['DefectCode'].'</td>';
      		    	echo '<td>'.$res['DefectPos1'].'</td>';
                echo '<td><a class="btn btn-sm btn-danger" style="padding: 3px 40px" href="MFA_potvrda?ID_FR='.$res['ID_FR'].'"><b>Potvrda</a></td></tr>'; 
      		    }
                ?>
            </tbody>
      </table>
</div>


<?php require "../inc/footer.php"; ?>