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
    $harga = trim($_GET['harga']);

    $kuericart = mysqli_query($koneksi, "SELECT id_produk FROM tbl_order WHERE id_produk = '$idproduk' AND id_session = '$sessionid'");
    $result = mysqli_num_rows($kuericart);
    if ($result == 0) {
        mysqli_query($koneksi, "INSERT INTO tbl_order (status_order,id_produk,jumlah,harga,id_session) VALUES ('P','$idproduk',1,'$harga','$sessionid')");
    } else {
        mysqli_query($koneksi, "UPDATE tbl_order SET jumlah = jumlah+1 WHERE id_session = '$sessionid' AND id_produk = '$idproduk'");
    }
    header("Location: $admin_url./?module=tambahpesanan");
}
