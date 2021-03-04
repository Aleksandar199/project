<?php require_once "../scripts/script_MFA_potvrda.php"; ?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="900">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="images/ticket.ico" type="image/x-icon" />
        <meta name="author" content="Ivan Funcik">
        <title>MFA | Potvrda</title>
        
         <!--bootstrap-->
         <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
         <link rel="stylesheet" href="../bootstrap-4.6.0-dist/css/bootstrap.min.css">
         <script src="../bootstrap-4.6.0-dist/js/bootstrap.min.js"></script>
        <!--custom CSS-->
        <link rel="stylesheet" href="../CSS/style.css">
    </head>
    <body>
      <div class="container">
      <br><br><br>
      <div class="container text-center">
              <form name="form1" method="post" action="<?php echo $_SERVER['PHP_SELF']."?ID_FR=$ID_FR"; ?>">
              <center><b><h3 class="text-danger">PRIHVATATE ILI ODBIJATE GREŠKU?</h3></b>
        
                <!-- PRIKAZ TABELE #2 -->
                <table class="table table-sm table-dark">
                  <thead>
                  	<tbody>
                        <tr class="bg-dark text-center text-white">
                		<td>ID OP.</td>
                		<td>MESTO</td>
                		<td>TIP</td>
                		<td>BROJ INST.</td>
                		<td>DATUM PROIZ.</td>
                		<td>SMENA</td>
                		<td>TIM</td>
                		<td>KOD DEF.</td>
                		<td>KONEKTOR</td>
                		</tr>
                    <?php 
                        while($res = mysqli_fetch_assoc($result)) 
                		{       
                		       	echo "<tr>";	
                            echo '<td class="text-danger text-center">'.$res['IDOperater'].'</td>';
                		      	echo '<td class="text-danger text-center">'.$res['Post'].'</td>';
                		      	echo '<td class="text-danger text-center">'.$res['FTQ_REQ_Status'].'</td>';
                		      	echo '<td class="text-danger text-center">'.$res['HarnessNumber'].'</td>';
                		      	echo '<td class="text-danger text-center">'.$res['DateProduction'].'</td>';
                		      	echo '<td class="text-danger text-center">'.$res['Shift'].'</td>';			
                		      	echo '<td class="text-danger text-center">'.$res['Team'].'</td>';			
                		      	echo '<td class="text-danger text-center">'.$res['DefectCode'].'</td>';
                            echo '<td class="text-danger text-center">'.$res['DefectPos1'].'</td>';
                            setcookie("ID_FR", $res['ID_FR'], time() + 3600);
                            setcookie("IDOperater", $res['IDOperater'], time() + 3600);
                		}
                        ?>
                    </tbody>
                 </table>

            <h3 class="text-warning">VAŠ ID BROJ: <?php echo  $_COOKIE['IDOperater'];?></h3>
      			<input type="hidden" name="Signature" value="">
      			<input type="hidden" name="ID_FR" value="<?php echo $_GET['ID_FR']; ?>">
            <br>   
         	 	<button type="submit"  name="update" class="btn btn-success"><b>PRIHVATAM GREŠKU</b></button> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      	    <button type="submit" name="update_NO" class="btn btn-warning"><b>ODBIJAM GREŠKU</b></button>
       </form>
 </div>
      </div>


<?php require "../inc/footer.php"; ?>