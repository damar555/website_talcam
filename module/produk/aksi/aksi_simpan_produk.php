<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {

    include "../../../assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
//load file koneksi.php
    include "../../../assets/lib/config.php";
    include "../../../assets/lib/koneksi.php";

//ambil data yang dikirim dari form
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

//data selain gambar
    $idproduk = $_POST['idproduk'];
    $idKategori = $_POST['idkategori'];
    $idMerek = $_POST['idmerek'];
    $namaProduk = trim($_POST['nama']);
    $deskripsi = trim($_POST['deskripsi']);
    $harga = trim($_POST['harga']);
    $hargaProduk = str_replace('.', '', $harga);
    $stok = $_POST['stok'];

//set path folder tempat menyimpan gambarnya
    $path = "../../produk/upload/" . $nama_file;

    if ($idKategori == "") {
        echo "<script>alert('Kategori produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
    } elseif ($idMerek == "") {
        echo "<script>alert('Merek produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
    } elseif ($namaProduk == "") {
        echo "<script>alert('Nama produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
    } elseif ($deskripsi == "") {
        echo "<script>alert('Deskripsi produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
    } elseif ($stok == "") {
        echo "<script>alert('Stok produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
    } elseif ($hargaProduk == 0 || $hargaProduk == "") {
        echo "<script>alert('Harga produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
    } else {

        if ($nama_file != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'jfif');
            $x = explode('.', $nama_file);
            $ekstensi = strtolower(end($x));
            $angka_acak = rand(1, 99999);
            $nama_file_baru = time() . "_{$nama_file}";

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran_file <= 2000000) {
                    move_uploaded_file($tmp_file, "../../produk/upload/" . $nama_file_baru);

                    $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_produk VALUES ('$idproduk','$namaProduk','$idKategori','$idMerek','$harga','$nama_file_baru','$deskripsi','$stok')");
                    if (!$querySimpan) {
                        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    } else {
                        echo "<script>alert('Data produk berhasil ditambahkan'); window.location='$admin_url'+'?module=listproduk';</script>";
                    }

                } else {
                    echo "<script>alert('Data Gambar Produk Gagal Dimasukkan Karena Ukuran Melebihi 1 MB');window.location = '$admin_url'+
            '?module=tambahproduk';</script>";
                }

            } else {
                echo "<script>alert('Ekstensi gambar yang diperbolehkan hanya png, jpg, jpeg, dan jfif.');window.location='$admin_url'+
        '?module=tambahproduk';</script>";
            }
        } else {
            echo "<script>alert('Gambar produk tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahproduk';</script>";
            $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_produk VALUES ('$idproduk','$namaProduk','$idKategori','$idMerek','$harga','$nama_file_baru','$deskripsi','$stok')");
            if (!$querySimpan) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data produk berhasil ditambahkan'); window.location='$admin_url'+'?module=listproduk';</script>";
            }
        }
    }
}
