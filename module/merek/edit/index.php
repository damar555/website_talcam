<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {

    include "assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
    include "assets/lib/config.php";
    include "assets/lib/koneksi.php";

    $idmerek = $_GET['idmerek'];
    $queryEdit = mysqli_query($koneksi, "SELECT * FROM tbl_merek WHERE id_merek='$idmerek'");

    $row = mysqli_fetch_array($queryEdit);

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
                            <h2 class="content-header-title float-left mb-0">Edit Merek</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Apps</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Merek</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Edit Merek</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="col-md-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Merek</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="module/merek/aksi/aksi_edit_merek.php" method="POST">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>ID Merek</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="idmerek" class="form-control" name="idmerek" placeholder="ID Merek" style="color: #7367F0;" value="<?=$row['id_merek'];?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Nama Merek</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Merek" value="<?=$row['nama'];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-8 offset-md-4">
                                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Submit</button>
                                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1">Reset</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic Horizontal form layout section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php }?>