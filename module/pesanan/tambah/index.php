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

    $queryc = mysqli_query($koneksi, "SELECT * FROM tbl_cart_item ORDER BY id_cart DESC LIMIT 1");
    $hasilc = mysqli_fetch_array($queryc);
    $lastidc = $hasilc['id_cart'];

    if ($lastidc == "") {
        $idc = "F0001";
    } else if ($_GET['idcart'] == $lastidc) {
        $idc = $lastidc;
    } else {
        $idc = substr($lastidc, -4);
        $idc = intval($idc);
        $idc = ($idc + 1);
        $idc = "F" . str_pad($idc, 4, '0', STR_PAD_LEFT);
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
                                    <li class="breadcrumb-item active">Tambah Pesanan
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Form wizard with number tabs section start -->
                <section id="number-tabs">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Input Produk</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form id="formprodukpesanan" method="post">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group produk">
                                                    <label for="idprodukpesanan">Produk</label>
                                                    <select name="idproduk" id="idprodukpesanan" class="custom-select form-control" style="width: 100%">
                                                        <option></option>
<?php
$kueriproduk = mysqli_query($koneksi, "SELECT * FROM tbl_produk");
    while ($produk = mysqli_fetch_array($kueriproduk)) {
        ?>
                                                        <option data-harga="<?=$produk['harga'];?>" value="<?=$produk['id_produk'];?>"><?=$produk['nama'];?></option>
<?php
}
    ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="hargasewa">Harga Sewa</label>
                                                    <input type="text" name="hargasewa" class="form-control hargasewa" id="hargasewa" value="" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="jumlah">Jumlah</label>
                                                    <input type="text" name="jumlah" class="form-control" id="jumlah">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group float-right">
                                                    <button type="submit" name="submit" class="btn btn-success">Tambah</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Form Identitas Pelanggan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form action="module/pesanan/aksi/aksi_simpan_pesanan.php?idcart=<?=$idc;?>" method="POST">
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

                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="tanggalambil">Tanggal Ambil</label>
                                                            <input type="text" name="tanggalambil" id="tanggalambil" class="form-control pickadate-firstday">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="tanggalkembali">Tanggal Kembali</label>
                                                            <input type="text" name="tanggalkembali" id="tanggalkembali" class="form-control pickadate-firstday">
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="my-2">
                                                <h4 class="card-title">Barang Belanjaan</h4>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12 table-responsive">
                                                        <table class="table table-hover">
                                                            <thead class="thead-dark">
                                                                <tr class="text-center">
                                                                    <th>NO</th>
                                                                    <th>ID Produk</th>
                                                                    <th>Nama Produk</th>
                                                                    <th>Jumlah</th>
                                                                    <th>Subtotal</th>
                                                                    <th width="80">Aksi</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
$kuericartitem = mysqli_query($koneksi, "SELECT p.`id_produk` AS idproduk, p.`nama` AS nama, ci.`kuantitas` AS kuantittas,ci.`subtotal` AS subtotal FROM `tbl_cart_item` ci, `tbl_produk`p WHERE ci.`id_produk` = p.`id_produk` AND ci.`id_cart` = '$idc'");
    $i = 1;
    while ($cartitem = mysqli_fetch_array($kuericartitem)) {
        ?>
                                                                <tr>
                                                                    <th class="text-center"><?=$i;?></th>
                                                                    <th class="text-center"><?=$cartitem['idproduk'];?></th>
                                                                    <th><?=$cartitem['nama'];?></th>
                                                                    <th class="text-center"><?=$cartitem['kuantittas'];?></th>
                                                                    <th class="text-right">Rp. <?=number_format($cartitem['subtotal']);?>,-</th>
                                                                    <th class="text-center">
                                                                        <a href="module/cart/aksi/delcart.php?idproduk=<?=$cartitem['idproduk'];?>&idcart=<?=$idc;?>" class="btn btn-icon btn-danger"><i class="feather icon-trash-2"></i></a>
                                                                    </th>
                                                                </tr>
                                                                <?php
$i++;
    }
    ?>
                                                            </tbody>
                                                            <tfoot>
                                                                <tr class="text-center">
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th></th>
                                                                    <th>Total Harga:</th>
                                                                    <?php
$grand = mysqli_query($koneksi, "SELECT SUM(subtotal) AS total FROM `tbl_cart_item` WHERE id_cart = '$idc'");
    $g = mysqli_fetch_array($grand);
    ?>
                                                                    <th><p class="float-right">Rp. <?=number_format($g['total']);?>,-</p></th>
                                                                    <th></th>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <button type="submit" class="btn btn-primary"><i class="feather icon-save"></i>&nbsp;&nbsp; Simpan</button>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="iduser" value="<?=$res['id_user'];?>">
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Form wizard with number tabs section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
<?php }?>