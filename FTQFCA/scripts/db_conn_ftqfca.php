<?php 
$conn_fca = mysqli_connect("localhost","root","","ftq_fca");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>