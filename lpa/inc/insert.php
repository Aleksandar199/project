<?php 
/*
$errors = array();

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $lozinka = $_POST['lozinka'];
    $nivo = $_POST['nivo'];
    $ns1 = $_POST['ns1'];
    $ns2 = $_POST['ns2'];

    require 'connect.php';

    $id= mysqli_real_escape_string($conn, $id);
    $lozinka= mysqli_real_escape_string($conn, $lozinka);
    $nivo= mysqli_real_escape_string($conn, $nivo);
    $ns1= mysqli_real_escape_string($conn, $ns1);
    $ns2 = mysqli_real_escape_string($conn, $ns2);

    $prikaz = "SELECT * FROM lpa WHERE lozinka = '$lozinka' AND id='$id'";
    $rez = mysqli_query($conn, $prikaz);


    if (mysqli_num_rows($rez) == 1) {
        array_push($errors, "Lozinka je zauzeta");
    }

    if (empty($id)) {
        array_push($errors, "Unesite Vaš ID broj!");
    }
    if (empty($lozinka)) {
        array_push($errors, "Upišite lozinku!");
    }
    if (empty($nivo)) {
        array_push($errors, "Upišite nivo!");
    }
    if (empty($ns1)) {
        array_push($errors, "Upišite ns1!");
    }
    if (empty($ns2)) {
        array_push($errors, "Upišite ns2!");
    }

    if (empty($errors)) {
        $upit = "INSERT INTO lpa (id, lozinka, nivo, ns1, ns2) VALUES ('{$id}', '{$lozinka}', '{$nivo}', '{$ns1}', '{$ns2}')";
        mysqli_query($conn, $upit);
        echo "Podaci su uspešno uneti!" ;
        
    }

    if (!empty($errors)) {
        foreach ($errors as $error){
            echo $error . "<br>";
        }
    }
}

*/