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
    $idpelanggan = $_GET['idpelanggan'];
    $queryp = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan WHERE id_pelanggan = '$idpelanggan'");
    $hasilp = mysqli_fetch_array($queryp);
    error_reporting(E_ALL ^ E_NOTICE);
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
                            <h2 class="content-header-title float-left mb-0">Edit Pelanggan</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Manajemen User</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pelanggan</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Edit Pelanggan</a>
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
                                    <h4 class="card-title">Form Edit Pelanggan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="module/pelanggan/aksi/aksi_edit_pelanggan.php" method="POST">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="idpelanggan">ID Pelanggan </label>
                                                            <input type="text" class="form-control" id="idpelanggan" name="idpelanggan" value="<?=$idpelanggan;?>" readonly style="color: #7367F0;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="nama">Nama </label>
                                                            <input type="text" class="form-control" id="nama" name="nama" value="<?=$hasilp['nama'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="jk">Jenis Kelamin</label>
                                                            <select name="jk" id="jk" class="custom-select form-control">
                                                                <option></option>
                                                                <option value="L" <?=($hasilp['jenis_kelamin'] == 'L' ? 'selected' : '');?>>Laki - Laki</option>
                                                                <option value="P" <?=($hasilp['jenis_kelamin'] == 'P' ? 'selected' : '');?>>Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="nohp">No. HP</label>
                                                            <input type="text" class="form-control" id="nohp" name="nohp" value="<?=$hasilp['nohp'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="pekerjaanpesanan">Pekerjaan</label>
                                                            <select name="pekerjaan" id="pekerjaanpesanan" class="custom-select form-control">
                                                                <option></option>
                                                                <option value="Bekerja" <?=($hasilp['pekerjaan'] == 'Bekerja' ? 'selected' : '');?>>Bekerja</option>
                                                                <option value="Kuliah" <?=($hasilp['pekerjaan'] == 'Kuliah' ? 'selected' : '');?>>Kuliah</option>
                                                                <option value="Sekolah" <?=($hasilp['pekerjaan'] == 'Sekolah' ? 'selected' : '');?>>Sekolah</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat" value="<?=$hasilp['alamat'];?>">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="jaminanpesanan">Jaminan</label>
                                                            <select name="jaminan" id="jaminanpesanan" class="custom-select form-control">
                                                                <option></option>
                                                                <option value="KTP" <?=($hasilp['jaminan'] == 'KTP' ? 'selected' : '');?>>KTP - Kartu Tanda Penduduk</option>
                                                                <option value="KTM" <?=($hasilp['jaminan'] == 'KTM' ? 'selected' : '');?>>KTM - Kartu Tanda Mahasiswa</option>
                                                                <option value="SIM" <?=($hasilp['jaminan'] == 'SIM' ? 'selected' : '');?>>SIM - Surat Izin Mengemudi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary float-right"><i class="feather icon-save mr-25"></i>Simpan</button>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
<?php }?>