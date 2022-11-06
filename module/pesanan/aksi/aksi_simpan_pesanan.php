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

// Tanggal
    $tglambil = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tanggalambil'])));
    $tglkembali = date('Y-m-d', strtotime(str_replace('/', '-', $_POST['tanggalkembali'])));

// Order/Pesanan
    $sessionid = session_id();
    $statusorderan = "Belum Kembali";
    $queryp = mysqli_query($koneksi, "SELECT * FROM tbl_order_detail ORDER BY id_order_detail DESC LIMIT 1");
    $hasilp = mysqli_fetch_array($queryp);
    error_reporting(E_ALL ^ E_NOTICE);
    $lastidp = $hasilp['id_order_detail'];

    if ($lastidp == "") {
        $idp = "O0001";
    } else {
        $idp = substr($lastidp, -4);
        $idp = intval($idp);
        $idp = ($idp + 1);
        $idp = "O" . str_pad($idp, 4, '0', STR_PAD_LEFT);
    }
// Dari Cart

// Per Produk
    $grandtotal = $_POST['grandtotal'];
    $qtytotal = $_POST['qtytotal'];
// Si Pembuat Orderan
    $iduser = $_POST['penanggungjawab'];

    $queryorderdetail = mysqli_query($koneksi, "INSERT INTO tbl_order_detail VALUES ('$idp','$sessionid','$idpelanggan','$qtytotal','$grandtotal','$tglambil','$tglkembali','$statusorderan','$iduser')");
    $queryproduk = mysqli_query($koneksi, "SELECT p.`id_produk` AS idproduk, p.`stok` AS stok, o.jumlah AS jumlah FROM tbl_produk p, tbl_order o WHERE p.id_produk = o.id_produk");
    $perproduk = mysqli_fetch_array($queryproduk);
    // Opeartor
    $idproduk = $perproduk['idproduk'];
    $stokakhir = $perproduk['stok'] - $perproduk['jumlah'];

    $queryupdatestok = mysqli_query($koneksi, "UPDATE tbl_produk SET stok = '$stokakhir' WHERE id_produk = '$idproduk'");
    // $queryclearcart = mysqli_query($koneksi, "DELETE FROM tbl_order WHERE id_session = '$sessionid'");
    session_regenerate_id();

    if ($queryorderdetail && $queryupdatestok) {
        echo "<script> alert('Data pesanan Berhasil Masuk'); window.location = '$admin_url'+'?module=listpesanan';</script>";
    } else {
        echo "<script> alert('Data pesanan Gagal Dimasukkan'); die; window.location = '$admin_url'+'?module=tambahpesanan&idcart='+'$idcart';</script>";

    }
}
