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

    $iduser = $_GET['iduser'];

    $res = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user='$iduser'");
    while ($row = mysqli_fetch_array($res)) {
        $img = $row['gambar'];
    }
    unlink("../../user/upload/" . $img);
    $queryHapus = mysqli_query($koneksi, "DELETE FROM tbl_user WHERE id_user='$iduser'");

    if ($queryHapus) {
        echo "<script> alert('Data user Berhasil Dihapus'); window.location = '$admin_url'+'?module=listuser';</script>";

    } else {
        echo "<script> alert('Data user Gagal Dihapus'); window.location = '$admin_url'+'?module=listuser';</script>";
    }
}
