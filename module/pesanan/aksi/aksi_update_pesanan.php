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
    $statusorder = $_POST['statusorder'];

    $queryupdate = mysqli_query($koneksi, "UPDATE tbl_order_detail SET status = '$statusorder' WHERE id_order_detail = '$idpesanan'");
    if ($queryupdate) {
        echo "<script> alert('Status pesanan Berhasil Diubah'); window.location = '$admin_url'+'?module=listpesanan';</script>";
    } else {
        echo "<script> alert('Status pesanan Gagal Diubah'); window.location = '$admin_url'+'?module=listpesanan';</script>";
    }
}
