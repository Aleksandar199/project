<?php

if(empty($_SESSION['status'])){
    header("Location: ../../lpa");
  }
  
?>

<?php 
session_start();

session_unset();
session_destroy();
header("Location: ../../lpa");
?>

