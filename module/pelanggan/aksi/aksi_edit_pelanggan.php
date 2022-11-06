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

    if ($nama == "") {
        echo "<script> alert('Nama tidak boleh kosong!'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
    } elseif ($nohp == "") {
        echo "<script> alert('Nomor HP tidak boleh kosong!'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
    } elseif ($alamat == "") {
        echo "<script> alert('Alamat tidak boleh kosong!'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
    } elseif ($jk == "") {
        echo "<script> alert('Jenis Kelamin tidak boleh kosong!'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
    } elseif ($pekerjaan == "") {
        echo "<script> alert('Pekerjaan tidak boleh kosong!'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
    } elseif ($jaminan == "") {
        echo "<script> alert('Jaminan tidak boleh kosong!'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
    } else {
        $queryPelanggan = mysqli_query($koneksi, "UPDATE tbl_pelanggan
                                                    SET
                                                        nama = '$nama',
                                                        jenis_kelamin = '$jk',
                                                        pekerjaan = '$pekerjaan',
                                                        alamat = '$alamat',
                                                        nohp = '$nohp',
                                                        jaminan = '$jaminan'
                                                        WHERE id_pelanggan = '$idpelanggan'
                                                    ");

        if ($queryPelanggan) {
            echo "<script> alert('Data pelanggan Berhasil Diubah'); window.location = '$admin_url'+'?module=listpelanggan';</script>";
        } else {
            echo "<script> alert('Data pelanggan Gagal Diubah'); window.location = '$admin_url'+'?module=editpelanggan&idpelanggan='+'$idpelanggan';</script>";
        }
    }
}
