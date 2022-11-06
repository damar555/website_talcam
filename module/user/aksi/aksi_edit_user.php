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
    $tgllahir = date('Y-m-d', strtotime($_POST['tgl_lahir']));
    $nohp = trim($_POST['nohp']);
    $jk = trim($_POST['jk']);
    $gaji = $_POST['gaji'];
    $level = trim($_POST['level']);
    $alamat = trim($_POST['alamat']);
    $twitter = trim($_POST['twitter']);
    $facebook = trim($_POST['facebook']);
    $instagram = trim($_POST['instagram']);
    $currentDateTime = date('Y-m-d H:i:s', strtotime(time()));
    $gambarLama = $_POST['gambarlama'];

    if ($username == "") {
        echo "<script>alert('Username tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($nama == "") {
        echo "<script>alert('Nama tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($email == "") {
        echo "<script>alert('Email tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($password == "") {
        echo "<script>alert('Password tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($tgllahir == "") {
        echo "<script>alert('Tanggal lahir tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($nohp == "") {
        echo "<script>alert('Nomor HP tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($jk == "") {
        echo "<script>alert('Jenis kelamin tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } elseif ($alamat == "") {
        echo "<script>alert('Alamat tidak boleh kosong!'); window.location='$admin_url'+'?module=edituser'+'$iduser';</script>";
    } else {

        if ($_FILES['gambar']['error'] === 4) {
            $nama_file = $gambarLama;
            $queryEdit = mysqli_query($koneksi, "UPDATE tbl_user SET
                                username = '$username',
                                password = '$password',
                                nama = '$nama',
                                alamat = '$alamat',
                                tgl_lahir = '$tgllahir',
                                gambar = '$nama_file',
                                no_hp = '$nohp',
                                email = '$email',
                                jenis_kelamin = '$jk',
                                level = '$level',
                                gaji = '$gaji',
                                facebook = '$facebook',
                                twitter = '$twitter',
                                instagram = '$instagram'
                                WHERE id_user='$iduser'");
            if ($queryEdit) {
                echo "<script> alert('Data user Berhasil Diubah'); window.location = '$admin_url'+'?module=viewuser&iduser='+'$iduser';</script>";

            } else {
                echo "<script> alert('Data user Gagal Diubah'); window.location = '$admin_url'+'?module=edituser&iduser='+'$iduser';</script>";
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
                        move_uploaded_file($tmp_file, "../../user/upload/" . $nama_file_baru);

                    } else {
                        echo "<script>alert('Data Gambar user Gagal Dimasukkan Karena Ukuran Melebihi 1 MB');window.location = '$admin_url'+
            '?module=edituser&iduser='+'$iduser';</script>";
                    }

                } else {
                    echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='$admin_url'+
        '?module=edituser&iduser='+'$iduser';</script>";
                }
            } else {
            }

            $queryEdit = mysqli_query($koneksi, "UPDATE tbl_user SET
                                username = '$username',
                                password = '$password',
                                nama = '$nama',
                                alamat = '$alamat',
                                tgl_lahir = '$tgllahir',
                                gambar = '$nama_file_baru',
                                no_hp = '$nohp',
                                email = '$email',
                                jenis_kelamin = '$jk',
                                level = '$level',
                                gaji = '$gaji',
                                facebook = '$facebook',
                                twitter = '$twitter',
                                instagram = '$instagram'
                                WHERE id_user='$iduser'");
            $img = $gambarLama;
            unlink("../../user/upload/" . $img);
            if ($queryEdit) {
                echo "<script> alert('Data user Berhasil Diubah'); window.location = '$admin_url'+'?module=viewuser&iduser='+'$iduser';</script>";

            } else {
                echo "<script> alert('Data user Gagal Diubah'); window.location = '$admin_url'+'?module=edituser&iduser='+'$iduser';</script>";
            }
        }
    }
}
