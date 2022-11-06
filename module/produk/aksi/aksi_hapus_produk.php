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

    $idProduk = $_GET['idproduk'];

    $res = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk='$idProduk'");
    while ($row = mysqli_fetch_array($res)) {
        $img = $row['gambar_produk'];
    }
    unlink("../../produk/upload/" . $img);
    $queryHapus = mysqli_query($koneksi, "DELETE FROM tbl_produk WHERE id_produk='$idProduk'");

    if ($queryHapus) {
        echo "<script> alert('Data Produk Berhasil Dihapus'); window.location = '$admin_url'+'?module=listproduk';</script>";

    } else {
        echo "<script> alert('Data Produk Gagal Dihapus'); window.location = '$admin_url'+'?module=listproduk';</script>";
    }
}
