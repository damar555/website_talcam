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

    //ambil data yang dikirim dari form
    $nama_file = $_FILES['gambar']['name'];
    $ukuran_file = $_FILES['gambar']['size'];
    $tipe_file = $_FILES['gambar']['type'];
    $tmp_file = $_FILES['gambar']['tmp_name'];

    $idProduk = $_POST['idproduk'];
    $idKategori = $_POST['idkategori'];
    $idMerek = $_POST['idmerek'];
    $namaProduk = trim($_POST['nama']);
    $desksripsiProduk = trim($_POST['deskripsi']);
    $harga = $_POST['harga'];
    $hargaProduk = str_replace('.', '', $harga);
    $stok = $_POST['stok'];
    $gambarLama = $_POST['gambarlama'];

    if ($namaProduk == "") {
        echo "<script>alert('Nama produk tidak boleh kosong!'); window.location='$admin_url'+'?module=editproduk&idproduk='+'$idProduk';</script>";
    } elseif ($desksripsiProduk == "") {
        echo "<script>alert('Deskripsi produk tidak boleh kosong!'); window.location='$admin_url'+'?module=editproduk&idproduk='+'$idProduk';</script>";
    } elseif ($hargaProduk == 0) {
        echo "<script>alert('Harga produk tidak boleh kosong!'); window.location='$admin_url'+'?module=editproduk&idproduk='+'$idProduk';</script>";
    } elseif ($stok == "") {
        echo "<script>alert('Stok produk tidak boleh kosong!'); window.location='$admin_url'+'?module=editproduk&idproduk='+'$idProduk';</script>";
    } else {

        if ($_FILES['gambar']['error'] === 4) {
            $nama_file = $gambarLama;
            $queryEdit = mysqli_query($koneksi, "UPDATE tbl_produk SET
                                id_kategori = '$idKategori',
                                id_merek = '$idMerek',
                                nama = '$namaProduk',
                                deskripsi = '$desksripsiProduk',
                                harga = '$harga',
                                gambar = '$nama_file',
                                stok = '$stok'
                                WHERE id_produk='$idProduk'");
            if ($queryEdit) {
                echo "<script> alert('Data Produk Berhasil Diubah'); window.location = '$admin_url'+'?module=listproduk';</script>";

            } else {
                echo "<script> alert('Data Produk Gagal Diubah'); window.location = '$admin_url'+'?module=editproduk&idproduk='+'$idProduk';</script>";
            }
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

                    } else {
                        echo "<script>alert('Data Gambar Produk Gagal Dimasukkan Karena Ukuran Melebihi 1 MB');window.location = '$admin_url'+
            '?module=editproduk&idproduk='+'$idProduk';</script>";
                    }

                } else {
                    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='$admin_url'+
        '?module=editproduk&idproduk='+'$idProduk';</script>";
                }
            } else {
            }

            $queryEdit = mysqli_query($koneksi, "UPDATE tbl_produk SET
                                id_kategori = '$idKategori',
                                id_merek = '$idMerek',
                                nama = '$namaProduk',
                                deskripsi = '$desksripsiProduk',
                                harga = '$harga',
                                gambar = '$nama_file_baru',
                                stok = '$stok'
                                WHERE id_produk='$idProduk'");
            $img = $gambarLama;
            unlink("../../produk/upload/" . $img);
            if ($queryEdit) {
                echo "<script> alert('Data Produk Berhasil Diubah'); window.location = '$admin_url'+'?module=listproduk';</script>";

            } else {
                echo "<script> alert('DataProduk Gagal Diubah'); window.location = '$admin_url'+'?module=editproduk&idproduk='+'$idProduk';</script>";
            }
        }
    }
}
