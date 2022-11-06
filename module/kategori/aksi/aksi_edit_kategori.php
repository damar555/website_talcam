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

    $idkategori = $_POST['idkategori'];
    $namakategori = trim($_POST['nama']);
    if ($namakategori == "") {
        echo "<script> alert('Nama kategori tidak boleh kosong!'); window.location = '$admin_url'+'?module=editkategori&idkategori='+'$idkategori';</script>";
    } else {
        $querySimpan = mysqli_query($koneksi, "UPDATE tbl_kategori SET nama = '$namakategori' WHERE id_kategori = '$idkategori'");

        if ($querySimpan) {
            echo "<script> alert('Data kategori Berhasil diubah'); window.location = '$admin_url'+'?module=listkategori';</script>";
        } else {
            echo "<script> alert('Data kategori Gagal diubah'); window.location = '$admin_url'+'?module=editkategori&idkategori='+'$idkategori';</script>";
        }
    }
}
