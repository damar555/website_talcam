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
    $queryp = mysqli_query($koneksi, "SELECT COUNT(id_pelanggan) as jmlpelanggan FROM tbl_pelanggan");
    $hasilp = mysqli_fetch_array($queryp);

    $queryo = mysqli_query($koneksi, "SELECT COUNT(id_order_detail) as jmlorderdetail FROM tbl_order_detail");
    $hasilo = mysqli_fetch_array($queryo);

    $queryttlsewa = mysqli_query($koneksi, "SELECT SUM(qtytotal) as ttlblmkembali FROM tbl_order_detail WHERE status = 'Belum Kembali'");
    $hasilttl = mysqli_fetch_array($queryttlsewa);

    $tglnow = date('F');
    $querypendapatan = mysqli_query($koneksi, "SELECT SUM(grandtotal) AS totalpendapatan, DATE_FORMAT(tgl_ambil, '%m-%Y') AS bulan FROM tbl_order_detail GROUP BY DATE_FORMAT(tgl_ambil, '%m-%Y')");
    $hasilpendapatan = mysqli_fetch_array($querypendapatan);

    error_reporting(E_ALL ^ E_NOTICE);
    ?>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
<!-- Dashboard Ecommerce Starts -->
<section id="dashboard-ecommerce">
    <div class="row">
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?=$hasilp['jmlpelanggan'];?></h2>
                        <p>Pelanggan</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-users text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?=$hasilo['jmlorderdetail'];?></h2>
                        <p>Total Order</p>
                    </div>
                    <div class="avatar bg-rgba-warning p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-shopping-cart text-warning font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0"><?php if ($hasilttl['ttlblmkembali'] > 0) {print_r($hasilttl['ttlblmkembali']);} else {echo '0';}
    ;?></h2>
                        <p>Barang Belum Kembali</p>
                    </div>
                    <div class="avatar bg-rgba-danger p-50 m-0">
                        <div class="avatar-content">
                            <i class="feather icon-package text-danger font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">Rp. <?=number_format($hasilpendapatan['totalpendapatan']);?></h2>
                        <p>Pendapatan Bulan <?=$tglnow;?></p>
                    </div>
                    <div class="avatar bg-rgba-success p-50 m-0">
                        <div class="avatar-content">
                            <i class="fa fa-money text-success font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Dashboard Ecommerce ends -->
</div>
        </div>
    </div>
    <!-- END: Content-->
<?php }?>