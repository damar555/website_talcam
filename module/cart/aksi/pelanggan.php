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

// Pelanggan
    $idpelanggan = trim($_POST['idpelanggan']);
    $nama = trim($_POST['nama']);
    $nohp = trim($_POST['nohp']);
    $alamat = trim($_POST['alamat']);
    $jk = trim($_POST['jk']);
    $pekerjaan = trim($_POST['pekerjaan']);
    $jaminan = trim($_POST['jaminan']);

// Tanggal
    $tglambil = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tanggalambil'])));
    $tglkembali = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tanggalkembali'])));

    if ($nama == "") {
        echo "<script> alert('Nama tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
    } elseif ($nohp == "") {
        echo "<script> alert('Nomor HP tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
    } elseif ($alamat == "") {
        echo "<script> alert('Alamat tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
    } elseif ($jk == "") {
        echo "<script> alert('Jenis Kelamin tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
    } elseif ($pekerjaan == "") {
        echo "<script> alert('Pekerjaan tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
    } elseif ($jaminan == "") {
        echo "<script> alert('Jaminan tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
    } else {
        $queryPelanggan = mysqli_query($koneksi, "INSERT INTO tbl_pelanggan VALUES ('$idpelanggan','$nama','$jk','$pekerjaan','$alamat','$nohp','$jaminan')");

        if ($queryPelanggan) {
            echo "<script>window.location = '$admin_url'+'?module=listcart';</script>";
        } else {
            echo "<script> alert('Data pelanggan Gagal Dimasukkan'); window.location = '$admin_url'+'?module=tambahpesanan';</script>";
        }
    }
}
