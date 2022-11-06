<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {
    include "assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
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
                            <h2 class="content-header-title float-left mb-0">List Karyawan</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Manajemen User</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Karyawan</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">List Karyawan</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">List Karyawan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration table-hover">
                                                <thead class="thead-dark text-center">
                                                    <tr>
                                                        <th>No</th>
                                                        <th>ID Karyawan</th>
                                                        <th>Nama Karyawan</th>
                                                        <th>Umur (tahun)</th>
                                                        <th>Tanggal Bergabung</th>
                                                        <th>Gaji</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
<?php
$kuerikaryawan = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE level = 'Karyawan'");
    $i = 1;
    while ($karyawan = mysqli_fetch_array($kuerikaryawan)) {
        $tglkargab = date('Y', strtotime($karyawan['tgl_lahir']));
        $today = date('Y');
        $umur = abs($today) - abs($tglkargab);
        ?>
                                                    <tr>
                                                        <td class="text-center"><?=$i;?></td>
                                                        <td class="text-center"><?=$karyawan['id_user'];?></td>
                                                        <td><?=$karyawan['nama'];?></td>
                                                        <td class="text-center"><?=$umur;?></td>
                                                        <td class="text-center"><?=date('d F Y', strtotime($karyawan['tgl_gabung']));?></td>
                                                        <td class="text-right">Rp. <?=number_format($karyawan['gaji']);?> ,-</td>
                                                        <td class="text-center">
                                                            <a href="?module=viewuser&iduser=<?=$karyawan['id_user'];?>" class="btn btn-icon bg-gradient-info" title="Detail"><i class="feather icon-info"></i></a>
                                                            <a href="?module=edituser&iduser=<?=$karyawan['id_user'];?>" class="btn btn-icon bg-gradient-warning" title="Edit"><i class="feather icon-edit"></i></a>
                                                            <a href="module/user/aksi/aksi_hapus_user.php?iduser=<?=$karyawan['id_user'];?>" class="btn btn-icon bg-gradient-danger" title="Hapus"><i class="feather icon-trash-2"></i></a>
                                                        </td>
                                                    </tr>
<?php
$i++;
    }
    ?>
                                                </tbody>
                                                <tfoot class="text-center">
                                                    <tr>
                                                    <th>No</th>
                                                        <th>ID Karyawan</th>
                                                        <th>Nama Karyawan</th>
                                                        <th>Umur (tahun)</th>
                                                        <th>Tanggal Bergabung</th>
                                                        <th>Gaji</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php }?>