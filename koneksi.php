<?php

$host = "localhost";
$user = "root";
$pass = "";
$db   = "sr_outdoor";

$conn = mysqli_connect($host,$user,$pass,$db);

if(!$conn){
    die("Koneksi database gagal");
}

session_start();

?>