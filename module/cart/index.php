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

    $queryp = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan ORDER BY id_pelanggan DESC LIMIT 1");
    $hasilp = mysqli_fetch_array($queryp);
    error_reporting(E_ALL ^ E_NOTICE);
    $lastidp = $hasilp['id_pelanggan'];

    if ($lastidp == "") {
        $idp = "C0001";
    } else {
        $idp = substr($lastidp, -4);
        $idp = intval($idp);
        $idp = ($idp + 1);
        $idp = "C" . str_pad($idp, 4, '0', STR_PAD_LEFT);
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
                            <h2 class="content-header-title float-left mb-0">Tambah Pesanan</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Apps</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pesanan</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">Tambah Pesanan</a>
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
                                    <h4 class="card-title">Step 1 - List Produk Yang Tersedia</h4>
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
$kueriproduk = mysqli_query($koneksi, "SELECT p.id_produk AS idproduk, p.nama AS namaproduk, p.harga AS hargaproduk, p.stok as stok, p.gambar AS gambarproduk, p.deskripsi AS deskripsiproduk, k.nama AS namakategori, m.nama AS namamerek FROM `tbl_produk` p,`tbl_kategori` k,`tbl_merek` m WHERE p.id_kategori = k.id_kategori AND p.id_merek = m.id_merek AND p.stok > 0");
    $i = 1;
    while ($row = mysqli_fetch_array($kueriproduk)) {
        ?>
                                                    <tr class="text-center">
                                                        <td><?=$i;?></td>
                                                        <td><?=$row['idproduk'];?></td>
                                                        <td><?=$row['namakategori'];?></td>
                                                        <td><?=$row['namamerek'];?></td>
                                                        <td><?=$row['namaproduk'];?></td>
                                                        <td>Rp. <?=number_format($row['hargaproduk']);?>,-</td>
                                                        <td><?=$row['stok'];?></td>
                                                        <td><img src="module/produk/upload/<?=$row['gambarproduk'];?>" style="max-width: 90px; width: 100%; height: auto;"></td>
                                                        <td>

                                                                <a href="module/cart/aksi/cart.php?idproduk=<?=$row['idproduk'];?>&harga=<?=$row['hargaproduk'];?>" class="btn bg-gradient-success"><i class="feather icon-save"></i>&nbsp;&nbsp;Tambah<br>Ke Keranjang</a>

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
                </section>
                <!--/ Zero configuration table -->

                <section>
                <div class="row">
                <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Step 2 - Form Identitas Pelanggan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="module/cart/aksi/pelanggan.php" method="POST">
                                        <input type="hidden" name="idcartitem" value="<?=$idci;?>">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="idpelanggan">ID Pelanggan </label>
                                                            <input type="text" class="form-control" id="idpelanggan" name="idpelanggan" value="<?=$idp;?>" readonly style="color: #7367F0;">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="nama">Nama </label>
                                                            <input type="text" class="form-control" id="nama" name="nama">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="jk">Jenis Kelamin</label>
                                                            <select name="jk" id="jk" class="custom-select form-control">
                                                                <option></option>
                                                                <option value="L">Laki - Laki</option>
                                                                <option value="P">Perempuan</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="nohp">No. HP</label>
                                                            <input type="text" class="form-control" id="nohp" name="nohp">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="pekerjaanpesanan">Pekerjaan</label>
                                                            <select name="pekerjaan" id="pekerjaanpesanan" class="custom-select form-control">
                                                                <option></option>
                                                                <option value="Bekerja">Bekerja</option>
                                                                <option value="Kuliah">Kuliah</option>
                                                                <option value="Sekolah">Sekolah</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="alamat">Alamat</label>
                                                            <input type="text" class="form-control" id="alamat" name="alamat">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="jaminanpesanan">Jaminan</label>
                                                            <select name="jaminan" id="jaminanpesanan" class="custom-select form-control">
                                                                <option></option>
                                                                <option value="KTP">KTP - Kartu Tanda Penduduk</option>
                                                                <option value="KTM">KTM - Kartu Tanda Mahasiswa</option>
                                                                <option value="SIM">SIM - Surat Izin Mengemudi</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </section>

                <section>
                    <div class="row">
                        <div class="col-12">
                        <div class="card">
                        <div class="card-body">
                        <button type="submit" class="btn bg-gradient-primary btn-lg col-12"><i class="feather icon-shopping-cart"></i>&nbsp;&nbsp; Simpan & Checkout</button>
                        </div>
                        </div>
                        </div>
                    </div>
                </section>

</form>
            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php }?>