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
    $idcart = $_GET['idcart'];
    $tglambil = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tanggalambil'])));
    $tglkembali = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tanggalkembali'])));

    $status = "Belum Kembali";

    $ciq = mysqli_query($koneksi, "SELECT SUM(subtotal) AS total FROM tbl_cart_item WHERE id_cart = '$idcart'");
    $ci = mysqli_fetch_array($ciq);
    $grandprice = $ci['total'];

    $iduser = $_POST['iduser'];

    if ($nama == "") {
        echo "<script> alert('Nama tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
    } elseif ($nohp == "") {
        echo "<script> alert('Nomor HP tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
    } elseif ($alamat == "") {
        echo "<script> alert('Alamat tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
    } elseif ($jk == "") {
        echo "<script> alert('Jenis Kelamin tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
    } elseif ($pekerjaan == "") {
        echo "<script> alert('Pekerjaan tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
    } elseif ($jaminan == "") {
        echo "<script> alert('Jaminan tidak boleh kosong!'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
    } else {
        $queryPelanggan = mysqli_query($koneksi, "INSERT INTO tbl_pelanggan VALUES ('$idpelanggan','$nama','$jk','$pekerjaan','$alamat','$nohp','$jaminan')");
        $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_cart (id_cart,id_pelanggan,id_user,tanggalambil,tanggalkembali,grandprice,status) VALUES('$idcart','$idpelanggan','$iduser','$tglambil','$tglkembali',$grandprice,'$status')");

        if ($querySimpan && $queryPelanggan) {
            echo "<script> alert('Data pesanan Berhasil Masuk'); window.location = '$admin_url'+'?module=listpesanan';</script>";
        } else {
            echo "<script> alert('Data pesanan Gagal Dimasukkan'); window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";
        }
    }
}
