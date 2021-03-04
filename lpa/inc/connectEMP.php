<?php 

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'ankete';

$connEMP = mysqli_connect($serverName, $username, $password, $dbName);

if ($connEMP == FALSE) {
    echo "Neuspešno povezivanje";
}



?>