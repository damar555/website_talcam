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

    $idkategori = trim($_POST['idkategori']);
    $namakategori = trim($_POST['nama']);

    if ($namakategori == "") {
        echo "<script> alert('Nama kategori tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahkategori';</script>";
    } else {
        $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_kategori (id_kategori,nama) VALUES('$idkategori','$namakategori')");

        if ($querySimpan) {
            echo "<script> alert('Data kategori Berhasil Masuk'); window.location = '$admin_url'+'?module=listkategori';</script>";
        } else {
            echo "<script> alert('Data kategori Gagal Dimasukkan'); window.location = '$admin_url'+'?module=tambahkategori';</script>";
        }
    }
}
