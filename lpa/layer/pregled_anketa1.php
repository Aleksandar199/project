<!DOCTYPE html>
<?php
//including the database connection file
include_once("../inc/connect.php");
 
//fetching data in descending order (lastest entry first)
//$result = mysql_query("SELECT * FROM users ORDER BY id DESC"); // mysql_query is deprecated
$result = mysqli_query($mysqli, "SELECT * FROM ankete.aneketa_1 ORDER BY id_ankete DESC LIMIT 500"); // using mysqli_query instead
?>

<html lang="en">
<head>
    <meta charset="utf-8" />
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0" />-->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
	<!-- BOOTSTRAP STYLES-->
    <link href="/public/css/bootstrap/bootstrap.css" rel="stylesheet" />
	<link rel="stylesheet" href="/public/css/bootstrap/bootstrap.min.css">
     <!-- FONTAWESOME STYLES-->
    <link href="/public/css/bootstrap/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="/public/css/bootstrap/custom.css" rel="stylesheet" />
     <!-- GOOGLE FONTS-->
	 <!--    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> -->
	<link href='/public/fonts/css?family=Open+Sans' rel='stylesheet' type='text/css' />
	 
	<title>SUB ROB FTQ: PREGLED UNOSA</title>

</head>

<body style="margin:0;padding-left:20px; background-color:#bbd6ab;">
<table style="height: 70px; margin-left: auto; margin-right: auto;" border="0"; width="auto">
<tbody>
<tr>
<td style="width: 350px; text-align: left; vertical-align:middle;"><h2 style="text-align: left;"><img title="" src="/public/img/aptiv_logo.jpg" alt="APTIV" width="300" height="60" style="border:1.5px solid black"/></h2></td>
<td style="width: 550px; text-align: center; vertical-align: middle;"><h3 style="text-align: center;"><b>FTQ SUB ROB</p>PREGLED POSLEDNJIH 500 UNOSA</td>
<td style="width: 550px; text-align: right; vertical-align: middle;"><h2 style="text-align: right;"><img title="" style="float: right; margin-right: 40px;" src="/public/img/JLR_logo.png" alt="APTIV" width="200" height="50" style="border:0px solid gray" /></h2></td>
</tr>
</tbody>
</table>
<hr>

    <table width='95%' border=1 bgcolor='white'>
        <tr bgcolor='#CCCCCC' align="center">
		<td>id_ankete</td>
		<td>net_id</td>
		<td>LOKACIJA</td>
		<td>NIVO</td>
		<td>AUDIT</td>
		<td>DATUM</td>
		<td>1.1k</td>
		<td>1.1r</td>
		<td>1.2k</td>
		<td>1.2r</td>
		<td>1.3k</td>
		<td>1.3r</td>
		<td>MESTO</td>
		<td>POZ 1</td>
		<td>LAC 1</td>
		<td>POZ 2</td>
		<td>LAC 2</td>
		</tr>
        <?php 
        //while($res = mysql_fetch_array($result)) { // mysql_fetch_array is deprecated, we need to use mysqli_fetch_array 
        while($res = mysqli_fetch_array($result)) {         
            echo "<tr>";
            echo '<td style='.'"'.'text-align:center'.';">'.$res['id_ankete'].'</td>';
            echo '<td style='.'"'.'text-align:center'.';">'.$res['Line'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['LocationFill'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DrivenSide'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['Team'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['Shift'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DateProduction'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['SOPTime'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['FTQ_IN_time'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['HarnessNumber'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['InstType'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DefectCode'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DefectDetectionPos'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DefectPos1'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DefectLac1a'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DefectPos2'].'</td>';
			echo '<td style='.'"'.'text-align:center'.';">'.$res['DefectLac2'].'</td>';

            
        }
        ?>
    </table>

</tbody>



 
	   
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="/public/js/jquery-3.3.1.min.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="/public/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="/public/js/jquery.metisMenu.js"></script>
      <!-- CUSTOM SCRIPTS -->
	<script src="/public/js/custom.js"></script>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>    
	
</body>
</html>

