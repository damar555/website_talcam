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

    $idpelanggan = $_GET['idpelanggan'];
    $queryHapus = mysqli_query($koneksi, "DELETE FROM tbl_pelanggan WHERE id_pelanggan='$idpelanggan'");

    if ($queryHapus) {
        echo "<script> alert('Data pelanggan Berhasil Dihapus'); window.location = '$admin_url'+'?module=listpelanggan';</script>";

    } else {
        echo "<script> alert('Data pelanggan Gagal Dihapus'); window.location = '$admin_url'+'?module=listpelanggan';</script>";
    }
}
