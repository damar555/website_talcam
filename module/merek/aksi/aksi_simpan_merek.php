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

    $idmerek = trim($_POST['idmerek']);
    $namamerek = trim($_POST['nama']);

    if ($namamerek == "") {
        echo "<script> alert('Nama merek tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahmerek';</script>";
    } else {
        $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_merek (id_merek,nama) VALUES('$idmerek','$namamerek')");

        if ($querySimpan) {
            echo "<script> alert('Data merek Berhasil Masuk'); window.location = '$admin_url'+'?module=listmerek';</script>";
        } else {
            echo "<script> alert('Data merek Gagal Dimasukkan'); window.location = '$admin_url'+'?module=tambahmerek';</script>";
        }
    }
}
