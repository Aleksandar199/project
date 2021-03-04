<?php 

$serverName = 'localhost';
$username = 'root';
$password = '';
$dbName = 'ankete';

$conn = mysqli_connect($serverName, $username, $password, $dbName);

if ($conn == FALSE) {
    echo "Neuspešno povezivanje";
}


?>