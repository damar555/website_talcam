<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {

    echo "<center>Untuk mengakses modul, Anda harus login <br>";
    echo "<a href=../..><b>LOGIN</b></a></center>";
} else {
    include "../../../assets/lib/config.php";
    include "../../../assets/lib/koneksi.php";

    $idkategori = $_GET['idkategori'];
    $queryHapus = mysqli_query($koneksi, "DELETE FROM tbl_kategori WHERE id_kategori='$idkategori'");

    if ($queryHapus) {
        echo "<script> alert('Data kategori Berhasil Dihapus'); window.location = '$admin_url'+'?module=listkategori';</script>";

    } else {
        echo "<script> alert('Data kategori Gagal Dihapus'); window.location = '$admin_url'+'?module=listkategori';</script>";
    }
}
