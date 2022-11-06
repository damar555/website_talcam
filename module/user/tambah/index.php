<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {
    include "assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
    include "assets/lib/koneksi.php";

    $queryu = mysqli_query($koneksi, "SELECT * FROM tbl_user ORDER BY id_user DESC LIMIT 1");
    $hasilu = mysqli_fetch_array($queryu);
    error_reporting(E_ALL ^ E_NOTICE);
    $lastidu = $hasilu['id_user'];

    if ($lastidu == "") {
        $idu = "U0001";
    } else {
        $idu = substr($lastidu, -4);
        $idu = intval($idu);
        $idu = ($idu + 1);
        $idu = "U" . str_pad($idu, 4, '0', STR_PAD_LEFT);
    }
    ?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-left mb-0">Tambah Karyawan/User</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Manajemen User</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Karyawan/User</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Tambah Karyawan/User</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-3" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="feather icon-user mr-25"></i><span class="d-none d-sm-block">Account</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i class="feather icon-info mr-25"></i><span class="d-none d-sm-block">Information</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="social-tab" data-toggle="tab" href="#social" aria-controls="social" role="tab" aria-selected="false">
                                            <i class="feather icon-share-2 mr-25"></i><span class="d-none d-sm-block">Social</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit account form start -->
                                        <form action="module/user/aksi/aksi_simpan_user.php" method="POST" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>ID User</label>
                                                            <input type="text" name="iduser" class="form-control" value="<?=$idu;?>" readonly style="color: #7367F0;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Username</label>
                                                            <input type="text" name="username" class="form-control" placeholder="Username" required data-validation-required-message="Tolong isi kolom ini!">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Nama</label>
                                                            <input type="text" name="nama" class="form-control" placeholder="Nama" required data-validation-required-message="Tolong isi kolom ini!">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>E-mail</label>
                                                            <input type="email" name="email" class="form-control" placeholder="Email" required data-validation-required-message="Tolong isi kolom ini!">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">

                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Password</label>
                                                            <input type="text" name="password" class="form-control" placeholder="Password" required data-validation-required-message="Tolong isi kolom ini!">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Role</label>
                                                        <select class="form-control select2" name="level" id="leveluser">
                                                            <option></option>
                                                            <option value="Administrator">Admin</option>
                                                            <option value="Karyawan">Karyawan</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Gambar Karyawan</label>
                                                        <div class="custom-file">
                                                            <input type="file" name="gambar" id="gambar" class="form-control custom-file-input">
                                                            <label class="custom-file-label" for="gambar">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
                                        <!-- users edit Info form start -->
                                            <div class="row mt-1">
                                                <div class="col-12 col-sm-6">
                                                    <h5 class="mb-1"><i class="feather icon-user mr-25"></i>Personal Information</h5>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <div class="controls">
                                                                    <label>Tanggal Lahir</label>
                                                                    <input type="date" name="tgl_lahir" class="form-control" required placeholder="Tanggal Lahir" data-validation-required-message="Tolong isi kolom ini!">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>No. HP</label>
                                                            <input type="text" name="nohp" maxlength="15" class="form-control" placeholder="Nomor Handphone" data-validation-required-message="Tolong isi kolom ini!">
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label>Jenis Kelamin</label>
                                                        <ul class="list-unstyled mb-0">
                                                            <li class="d-inline-block mr-2">
                                                                <fieldset>
                                                                    <div class="vs-radio-con">
                                                                        <input type="radio" name="jk" value="L">
                                                                        <span class="vs-radio">
                                                                            <span class="vs-radio--border"></span>
                                                                            <span class="vs-radio--circle"></span>
                                                                        </span>
                                                                        Laki - Laki
                                                                    </div>
                                                                </fieldset>
                                                            </li>
                                                            <li class="d-inline-block mr-2">
                                                                <fieldset>
                                                                    <div class="vs-radio-con">
                                                                        <input type="radio" name="jk" value="P">
                                                                        <span class="vs-radio">
                                                                            <span class="vs-radio--border"></span>
                                                                            <span class="vs-radio--circle"></span>
                                                                        </span>
                                                                        Perempuan
                                                                    </div>
                                                                </fieldset>
                                                            </li>

                                                        </ul>
                                                    </div>

                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <h5 class="mb-1 mt-2 mt-sm-0"><i class="feather icon-map-pin mr-25"></i>Address</h5>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="alamat">Alamat</label>
                                                            <textarea id="alamat" class="form-control char-textarea" name="alamat" rows="5" placeholder="Alamat" required data-validation-required-message="This Address field is required"></textarea>
                                                            <small class="counter-value float-right"><span class="char-count">0</span></small>
                                                        </div>
                                                    </div>
                                                    <h5 class="mb-1 mt-2 mt-sm-0"><i class="fa fa-money mr-25"></i>Gaji</h5>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label for="gaji">Gaji</label>
                                                            <input type="number" name="gaji" id="gaji" placeholder="Gaji" class="form-control" required data-validation-required-message="Tolong isi kolom ini!">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- users edit Info form ends -->
                                    </div>
                                    <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                                        <!-- users edit socail form start -->
                                            <div class="row">
                                                <div class="col-12">

                                                    <fieldset>
                                                        <label>Twitter</label>
                                                        <div class="input-group mb-75">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text feather icon-twitter" id="basic-addon3"></span>
                                                            </div>
                                                            <input type="text" name="twitter" class="form-control" value="-" placeholder="https://www.twitter.com/" aria-describedby="basic-addon3">
                                                        </div>

                                                        <label>Facebook</label>
                                                        <div class="input-group mb-75">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text feather icon-facebook" id="basic-addon4"></span>
                                                            </div>
                                                            <input type="text" name="facebook" class="form-control" value="-" placeholder="https://www.facebook.com/" aria-describedby="basic-addon4">
                                                        </div>
                                                        <label>Instagram</label>
                                                        <div class="input-group mb-75">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text feather icon-instagram" id="basic-addon5"></span>
                                                            </div>
                                                            <input type="text" name="instagram" class="form-control" value="-" placeholder="https://www.instagram.com/" aria-describedby="basic-addon5">
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Save
                                                        Changes</button>
                                                    <button type="reset" class="btn btn-outline-warning">Reset</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit socail form ends -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
                                                        <?php }?>