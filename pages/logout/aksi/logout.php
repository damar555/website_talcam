<?php
//logout
include "../../../assets/lib/config.php";
session_start();
session_destroy();
// arahkan ke halaman login.php
header("location: $admin_url./pages/login/");
?>