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

    $idpesanan = $_GET['idpesanan'];

    $querydelete = mysqli_query($koneksi, "DELETE FROM tbl_order_detail WHERE id_order_detail = '$idpesanan'");
    if ($querydelete) {
        echo "<script> alert('Data pesanan Berhasil Dihapus'); window.location = '$admin_url'+'?module=listpesanan';</script>";
    } else {
        echo "<script> alert('Data pesanan Gagal Dihapus'); window.location = '$admin_url'+'?module=listpesanan';</script>";
    }
}
