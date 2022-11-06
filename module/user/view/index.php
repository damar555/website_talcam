<?php
if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {
    include "assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
    $iduser = $_GET['iduser'];
    $kueriviewuser = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE id_user = '$iduser'");
    $qvu = mysqli_fetch_array($kueriviewuser);
    ?>
<!-- BEGIN: Content-->
<div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- page users view start -->
                <section class="page-users-view">
                    <div class="row">
                        <!-- account start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Account</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="users-view-image">
                                            <img src="module/user/upload/<?=$qvu['gambar'];?>" class="users-avatar-shadow w-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                                        </div>
                                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                                            <table>
                                                <tr>
                                                    <td class="font-weight-bold">Username</td>
                                                    <td><?=$qvu['username'];?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Nama</td>
                                                    <td><?=$qvu['nama'];?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Email</td>
                                                    <td><?=$qvu['email'];?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12 col-md-12 col-lg-5">
                                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                                <tr>
                                                    <td class="font-weight-bold">Status</td>
                                                    <td>Aktif</td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Role</td>
                                                    <td><?=$qvu['level'];?></td>
                                                </tr>
                                                <tr>
                                                    <td class="font-weight-bold">Alamat</td>
                                                    <td><?=$qvu['alamat'];?></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="col-12">
                                            <a href="?module=edituser&iduser=<?=$qvu['id_user'];?>" class="btn btn-primary mr-1"><i class="feather icon-edit-1"></i> Edit</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- account end -->
                        <!-- information start -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Informasi</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Tanggal Lahir </td>
                                            <td><?=date('D, d M Y', strtotime($qvu['tgl_lahir']));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Nomor HP</td>
                                            <td><?=$qvu['no_hp'];?></td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Jenis Kelamin</td>
                                            <td><?=($qvu['jenis_kelamin'] == 'L' ? 'Laki - Laki' : 'Perempuan')?></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- information start -->
                        <!-- social links end -->
                        <div class="col-md-6 col-12 ">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-2">Social Links</div>
                                </div>
                                <div class="card-body">
                                    <table>
                                        <tr>
                                            <td class="font-weight-bold">Twitter</td>
                                            <td><?=$qvu['twitter'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Facebook</td>
                                            <td><?=$qvu['facebook'];?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="font-weight-bold">Instagram</td>
                                            <td><?=$qvu['instagram'];?>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- social links end -->
                        <!-- permissions start -->
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header border-bottom mx-2 px-0">
                                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Permission
                                    </h6>
                                </div>
                                <div class="card-body px-75">
                                    <div class="table-responsive users-view-permission">
                                        <table class="table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th>Module</th>
                                                    <th>Read</th>
                                                    <th>Write</th>
                                                    <th>Create</th>
                                                    <th>Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Merek</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox2"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox3" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox3"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox4" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox4"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Kategori</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox5" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox5"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox6" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox6"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox7" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox7"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox8" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox8"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Produk</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox9" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox9"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox10" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox10"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox11" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox11"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox12" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox12"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pesanan</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox13" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox13"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox14" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox14"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox15" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox15"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox16" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox16"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Pelanggan</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox17" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox17"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox18" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox18"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox19" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox19"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox20" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox20"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php if ($qvu['level'] == "Administrator") {?>
                                                    <tr>
                                                    <td>User/Karyawan</td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox17" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox17"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox18" class="custom-control-input" disabled checked>
                                                            <label class="custom-control-label" for="users-checkbox18"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox19" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox19"></label>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox20" class="custom-control-input" disabled checked><label class="custom-control-label" for="users-checkbox20"></label>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <?php } else {}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- permissions end -->
                    </div>
                </section>
                <!-- page users view end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php }?>