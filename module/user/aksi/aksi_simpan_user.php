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
    $iduser = trim($_POST['iduser']);
    $username = trim(($_POST['username']));
    $nama = trim($_POST['nama']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $level = trim($_POST['level']);
    $tgllahir = date('Y-m-d', strtotime($_POST['tgl_lahir']));
    $nohp = trim($_POST['nohp']);
    $jk = trim($_POST['jk']);
    $alamat = trim($_POST['alamat']);
    $twitter = trim($_POST['twitter']);
    $facebook = trim($_POST['facebook']);
    $instagram = trim($_POST['instagram']);
    $gaji = $_POST['gaji'];
    $currentDateTime = date('Y-m-d H:i:s', strtotime(time()));

//set path folder tempat menyimpan gambarnya
    $path = "../../user/upload/" . $nama_file;

    if ($username == "") {
        echo "<script>alert('Username tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($nama == "") {
        echo "<script>alert('Nama tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($email == "") {
        echo "<script>alert('Email tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($password == "") {
        echo "<script>alert('Password tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($level == "") {
        echo "<script>alert('Level tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($tgllahir == "") {
        echo "<script>alert('Tanggal lahir tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($nohp == "") {
        echo "<script>alert('Nomor HP tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($jk == "") {
        echo "<script>alert('Jenis kelamin tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } elseif ($alamat == "") {
        echo "<script>alert('Alamat tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
    } else {

        if ($nama_file != "") {
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'jfif');
            $x = explode('.', $nama_file);
            $ekstensi = strtolower(end($x));
            $angka_acak = rand(1, 99999);
            $nama_file_baru = time() . "_{$nama_file}";

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                if ($ukuran_file <= 2000000) {
                    move_uploaded_file($tmp_file, "../../user/upload/" . $nama_file_baru);

                    $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_user
                    (id_user,username,password,nama,level,email,gambar,tgl_lahir,no_hp,jenis_kelamin,alamat,facebook,twitter,instagram,gaji)
                    VALUES ('$iduser','$username','$password','$nama','$level','$email','$nama_file_baru','$tgllahir','$nohp','$jk','$alamat','$facebook','$twitter','$instagram','$gaji')");
                    if (!$querySimpan) {
                        die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
                    } else {
                        echo "<script>alert('Data user berhasil ditambahkan'); window.location='$admin_url'+'?module=listuser';</script>";
                    }

                } else {
                    echo "<script>alert('Data Gambar user Gagal Dimasukkan Karena Ukuran Melebihi 1 MB');window.location = '$admin_url'+
            '?module=tambahuser';</script>";
                }

            } else {
                echo "<script>alert('Ekstensi gambar yang diperbolehkan hanya png, jpg, jpeg, dan jfif.');window.location='$admin_url'+
        '?module=tambahuser';</script>";
            }
        } else {
            echo "<script>alert('Gambar user tidak boleh kosong!'); window.location='$admin_url'+'?module=tambahuser';</script>";
            $querySimpan = mysqli_query($koneksi, "INSERT INTO tbl_user
            (id_user,username,password,nama,level,email,gambar,tgl_lahir,no_hp,jenis_kelamin,alamat,facebook,twitter,instagram,gaji)
            VALUES ('$iduser','$username','$password','$nama','$level','$email','$nama_file_baru','$tgllahir','$nohp','$jk','$alamat','$facebook','$twitter','$instagram','$gaji')");
            if (!$querySimpan) {
                die("Query gagal dijalankan: " . mysqli_errno($koneksi) . " - " . mysqli_error($koneksi));
            } else {
                echo "<script>alert('Data user berhasil ditambahkan'); window.location='$admin_url'+'?module=listuser';</script>";
            }
        }
    }
}
