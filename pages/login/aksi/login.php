<?php
include "../../../assets/lib/config.php";
include "../../../assets/lib/koneksi.php";
$username = $_POST['username'];
$pass = $_POST['password'];
//
if (!ctype_alnum($username) || !ctype_alnum($pass)) {
    echo "<center>LOGIN GAGAL! <br>
        Username atau Password Anda tidak benar.<br>
        Atau akun Anda sedang diblokir.<br>";
    echo "<a href=$admin_url./login/><b>ULANGI LAGI</b></a></center>";
} else {
    $login = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username' && password='$pass'");
    $ketemu = mysqli_num_rows($login);
    $r = mysqli_fetch_array($login);

    //
    if ($ketemu > 0) {
        session_start();
        $_SESSION['namauser'] = $r['username'];
        $_SESSION['passuser'] = $r['password'];
        header('Location:' . $admin_url . '?module=home');
    } else {
        echo "<center>LOGIN GAGAL! <br>
        Username atau Password Anda tidak benar.<br>
        Atau akun Anda sedang diblokir.<br>";
        echo "<a href=$admin_url./login/><b>ULANGI LAGI</b></a></center>";
    }
}
