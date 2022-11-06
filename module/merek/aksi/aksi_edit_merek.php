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

    $idmerek = $_POST['idmerek'];
    $namamerek = trim($_POST['nama']);
    if ($namamerek == "") {
        echo "<script> alert('Nama merek tidak boleh kosong!'); window.location = '$admin_url'+'?module=editmerek&idmerek='+'$idmerek';</script>";
    } else {
        $querySimpan = mysqli_query($koneksi, "UPDATE tbl_merek SET nama = '$namamerek' WHERE id_merek = '$idmerek'");

        if ($querySimpan) {
            echo "<script> alert('Data merek Berhasil diubah'); window.location = '$admin_url'+'?module=listmerek';</script>";
        } else {
            echo "<script> alert('Data merek Gagal diubah'); window.location = '$admin_url'+'?module=editmerek&idmerek='+'$idmerek';</script>";
        }
    }
}
