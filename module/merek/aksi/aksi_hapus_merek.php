<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {

    include "../../../assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
    include "../../../assets/lib/config.php";
    include "../../../assets/lib/koneksi.php";

    $idmerek = $_GET['idmerek'];
    $queryHapus = mysqli_query($koneksi, "DELETE FROM tbl_merek WHERE id_merek='$idmerek'");

    if ($queryHapus) {
        echo "<script> alert('Data merek Berhasil Dihapus'); window.location = '$admin_url'+'?module=listmerek';</script>";

    } else {
        echo "<script> alert('Data merek Gagal Dihapus'); window.location = '$admin_url'+'?module=listmerek';</script>";
    }
}
