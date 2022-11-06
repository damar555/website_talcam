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

    $sessionid = session_id();
    $idproduk = trim($_GET['idproduk']);

    $kuericart = mysqli_query($koneksi, "SELECT id FROM tbl_order WHERE id_produk = '$idproduk' AND id_session = '$sessionid'");
    $result = mysqli_num_rows($kuericart);
    if ($result) {
        mysqli_query($koneksi, "DELETE FROM tbl_order WHERE id_produk = '$idproduk' AND id_session = '$sessionid'");
    }
    header("Location: $admin_url./?module=tambahpesanan");
}
