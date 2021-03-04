<?php 
$conn_rew = mysqli_connect("localhost","root","","rework");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  exit();
}

?>