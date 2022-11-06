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

    $idproduk = $_GET['idproduk'];
    $queryEdit = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE id_produk='$idproduk'");

    $row = mysqli_fetch_array($queryEdit);
    $sk = $row['id_kategori'];
    $sm = $row['id_merek'];

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
                            <h2 class="content-header-title float-left mb-0">Edit Produk</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Apps</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produk</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Edit Produk</a>
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
                                    <h4 class="card-title">Edit Produk</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="module/produk/aksi/aksi_edit_produk.php" method="POST" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>ID Produk</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="idproduk" class="form-control" name="idproduk" placeholder="ID Produk" style="color: #7367F0;" value="<?=$row['id_produk'];?>" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Kategori</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select id="kategori" name="idkategori" class="select2-border form-control" data-border-color="primary" data-border-variation="darken-2" data-text-color="primary">
                                                                    <option></option>
                                                                    <?php
include "assets/lib/koneksi.php";
    $kuerikategori = mysqli_query($koneksi, "SELECT * FROM tbl_kategori");
    while ($rowkategori = mysqli_fetch_array($kuerikategori)) {
        ?>
                                                                    <option value="<?=$rowkategori['id_kategori'];?>" <?=($sk == $rowkategori['id_kategori'] ? 'selected' : '');?>><?=$rowkategori['nama'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Merek</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <select id="merek" name="idmerek" class="select2-border form-control" data-border-color="primary" data-border-variation="darken-2" data-text-color="primary">
                                                                    <option></option>
                                                                    <?php
include "assets/lib/koneksi.php";
    $kuerimerek = mysqli_query($koneksi, "SELECT * FROM tbl_merek");
    while ($rowmerek = mysqli_fetch_array($kuerimerek)) {
        ?>
                                                                    <option value="<?=$rowmerek['id_merek'];?>" <?=($sm == $rowmerek['id_merek'] ? 'selected' : '');?>><?=$rowmerek['nama'];?></option>
                                                                    <?php }?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Nama Produk</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" id="nama" class="form-control" name="nama" placeholder="Nama Produk" value="<?=$row['nama'];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Harga Produk</span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" id="harga" class="form-control" name="harga" placeholder="Harga Produk" value="<?=$row['harga'];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Stok Produk</span>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <input type="text" id="stok" class="form-control" name="stok" placeholder="Stok Produk" value="<?=$row['stok'];?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Gambar Produk</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <div class="custom-file">
                                                                    <input type="hidden" name="gambarlama" value="<?=$row['gambar'];?>">
                                                                    <input type="file" id="gambar" class="form-control custom-file-input" name="gambar">
                                                                    <label class="custom-file-label" for="gambar"><?=$row['gambar'];?></label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>Deskripsi Produk</span>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <textarea id="deskripsi" class="form-control char-textarea" name="deskripsi" rows="3" placeholder="Deskripsi Produk"><?=$row['deskripsi'];?></textarea>
                                                                <small class="counter-value float-right"><span class="char-count">0</span></small>
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