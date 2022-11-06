<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "talcam";


$koneksi = mysqli_connect($server,$username,$password,$database);

if(mysqli_connect_errno()){
    echo "Failed to connect to MySQLi: " . mysqli_connect_error();
    exit();
}

?>