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
                            <h2 class="content-header-title float-left mb-0">List Produk</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Apps</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Produk</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">List Produk</a>
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
                                    <h4 class="card-title">List Produk</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="40">NO</th>
                                                        <th>ID Produk</th>
                                                        <th>Kategori</th>
                                                        <th>Merek</th>
                                                        <th>Nama Produk</th>
                                                        <th>Harga Sewa</th>
                                                        <th>Stok</th>
                                                        <th>Gambar Produk</th>
                                                        <th width="170">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
$kueriproduk = mysqli_query($koneksi, "SELECT p.id_produk AS idproduk, p.nama AS namaproduk, p.harga AS hargaproduk, p.stok as stok, p.gambar AS gambarproduk, p.deskripsi AS deskripsiproduk, k.nama AS namakategori, m.nama AS namamerek FROM `tbl_produk` p,`tbl_kategori` k,`tbl_merek` m WHERE p.id_kategori = k.id_kategori AND p.id_merek = m.id_merek");
    $i = 1;
    while ($row = mysqli_fetch_array($kueriproduk)) {
        ?>
                                                    <tr class="text-center">
                                                        <td><?=$i;?></td>
                                                        <td><?=$row['idproduk'];?></td>
                                                        <td><?=$row['namakategori'];?></td>
                                                        <td><?=$row['namamerek'];?></td>
                                                        <td><?=$row['namaproduk'];?></td>
                                                        <td>Rp. <?=$row['hargaproduk'];?>,-</td>
                                                        <td><?=$row['stok'];?></td>
                                                        <td><img src="module/produk/upload/<?=$row['gambarproduk'];?>" style="max-width: 90px; width: 100%; height: auto;"></td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="?module=editproduk&idproduk=<?=$row['idproduk'];?>" class="btn btn-warning"><i class="feather icon-edit"></i></a>
                                                                <a href="module/produk/aksi/aksi_hapus_produk.php?idproduk=<?=$row['idproduk'];?>" class="btn btn-danger"><i class="feather icon-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
$i++;
    }
    ?>
                                                </tbody>
                                                <tfoot>
                                                    <tr class="text-center">
                                                        <th width="40">NO</th>
                                                        <th>ID Produk</th>
                                                        <th>Kategori</th>
                                                        <th>Merek</th>
                                                        <th>Nama Produk</th>
                                                        <th>Harga Sewa</th>
                                                        <th>Stok</th>
                                                        <th>Gambar Produk</th>
                                                        <th width="170">Aksi</th>
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