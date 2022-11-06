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
                            <h2 class="content-header-title float-left mb-0">List Pesanan</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#">Apps</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">Pesanan</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#">List Pesanan</a>
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
                                    <h4 class="card-title">List Pesanan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                            <table class="table zero-configuration">
                                                <thead>
                                                    <tr class="text-center">
                                                        <th width="40">NO</th>
                                                        <th>ID Pesanan</th>
                                                        <th>Nama Penyewa</th>
                                                        <th>Total Barang</th>
                                                        <th>Total Harga</th>
                                                        <th width="50">Order Status</th>
                                                        <th width="170">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
$kueripesanan = mysqli_query($koneksi, "SELECT od.id_order_detail AS idpesanan, SUM(o.jumlah) AS qtytotal ,od.grandtotal AS totalharga, pl.nama as namapelanggan, od.status AS statusorder  FROM tbl_order o, tbl_order_detail od, tbl_pelanggan pl WHERE o.id_session = od.id_session AND pl.id_pelanggan = od.id_pelanggan GROUP BY od.id_order_detail");
    $i = 1;
    while ($row = mysqli_fetch_array($kueripesanan)) {
        ?>
                                                    <tr class="text-center">
                                                        <td><?=$i;?></td>
                                                        <td><?=$row['idpesanan'];?></td>
                                                        <td><?=$row['namapelanggan'];?></td>
                                                        <td><?=$row['qtytotal'];?></td>
                                                        <td>Rp. <?=number_format($row['totalharga']);?></td>
                                                        <form action="module/pesanan/aksi/aksi_update_pesanan.php?idpesanan=<?=$row['idpesanan'];?>" method="post">
                                                        <td>
                                                            <select name="statusorder" class="form-control select2">
                                                                <option value="Sudah Kembali" <?=($row['statusorder'] == 'Sudah Kembali' ? 'selected' : '');?> >Sudah Kembali</option>
                                                                <option value="Belum Kembali" <?=($row['statusorder'] == 'Belum Kembali' ? 'selected' : '');?> >Belum Kembali</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="submit" class="btn bg-gradient-info"><i class="feather icon-save mr-25"></i>Update</button></form>
                                                                <a href="module/pesanan/aksi/aksi_hapus_pesanan.php?idpesanan=<?=$row['idpesanan'];?>" class="btn bg-gradient-danger"><i class="feather icon-trash-2 mr-25"></i>Hapus</a>
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
                                                        <th>ID Pesanan</th>
                                                        <th>Nama Penyewa</th>
                                                        <th>Total Barang</th>
                                                        <th>Total Harga</th>
                                                        <th>Order Status</th>
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