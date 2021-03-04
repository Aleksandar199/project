<?php
$servername = "localhost";
$username = "root";
$password = "";
$kadar = "kadar";
// -----------------------
$conn = new mysqli($servername, $username, $password, $kadar);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//-------------------------------------------
$conn->query("SET NAMES 'utf8'");
$conn->query("SET CHARACTER SET utf8");
$conn->query("SET SESSION collation_connection = 'utf8_unicode_ci'");
?>
