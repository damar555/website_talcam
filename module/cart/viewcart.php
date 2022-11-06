<?php
$sessionid = session_id();
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
                            <h2 class="content-header-title float-left mb-0">Checkout</h2>
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="#">eCommerce</a>
                                    </li>
                                    <li class="breadcrumb-item active">Checkout
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-header-right text-md-right col-md-3 col-12 d-md-block d-none">
                    <div class="form-group breadcrum-right">
                        <div class="dropdown">
                            <button class="btn-icon btn btn-primary btn-round btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="feather icon-settings"></i></button>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="#">Chat</a><a class="dropdown-item" href="#">Email</a><a class="dropdown-item" href="#">Calendar</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <form class="icons-tab-steps checkout-tab-steps wizard-circle" action="module/pesanan/aksi/aksi_simpan_pesanan.php" method="POST">
                    <!-- Checkout Place order starts -->
                    <h6><i class="step-icon step feather icon-shopping-cart"></i>Cart</h6>
                    <fieldset class="checkout-step-1 px-0">
                        <section id="place-order" class="list-view product-checkout">
                            <div class="checkout-items">
<?php
$kuericart = mysqli_query($koneksi, "SELECT p.`nama` AS namaproduk, p.`gambar` AS gambar, p.`stok` as stok, o.`jumlah` AS jumlah, o.`id_produk` as idproduk, o.`harga` AS harga, m.nama AS namamerek FROM `tbl_produk` p,`tbl_order` o,`tbl_merek` m WHERE o.`id_session` = '$sessionid' AND p.`id_produk` = o.`id_produk` AND p.`id_merek` = m.`id_merek`");
$i = 1;
$total = 0;
while ($cartitem = mysqli_fetch_array($kuericart)) {
    $subtotal = $cartitem['harga'] * $cartitem['jumlah'];

    ?>
<!-- <form action="module/cart/aksi/updatecart.php?idproduk=<?=$cartitem['idproduk'];?>" method="post"> -->
                                <div class="card ecommerce-card">
                                    <div class="card-content">
                                        <div class="item-img text-center">
                                            <a>
                                                <img src="module/produk/upload/<?=$cartitem['gambar'];?>" alt="img-placeholder">
                                            </a>
                                        </div>
                                        <input type="hidden" class="pid" name="pid" value="<?=$cartitem['idproduk'];?>">
                                        <div class="card-body">
                                            <div class="item-name">
                                                <a><?=$cartitem['namaproduk'];?></a>
                                                <span></span>
                                                <p class="item-company">By <span class="company-name"><?=$cartitem['namamerek'];?></span></p>
                                                <p class="stock-status-in">In Stock</p>
                                            </div>
                                            <div class="item-quantity">
                                                <p class="quantity-title">Jumlah</p>
                                                <div class="input-group quantity-counter-wrapper">
                                                    <input type="number" name="qty" class="quantity-counter" value="<?=$cartitem['jumlah'];?>" min="1" max="<?=$cartitem['stok'];?>">
                                                </div>
                                            </div>
                                            <p class="delivery-date">Harga:</p>
                                            <p class="offers">Rp. <?=number_format($cartitem['harga']);?>,- <i class="text-secondary ml-25">/ qty</i></p>
                                        </div>
                                        <div class="item-options text-center">
                                            <div class="item-wrapper">
                                                <div class="item-rating">
                                                    <div class="badge badge-primary badge-md">
                                                        &nbsp;<?=$cartitem['stok'];?> Stok <i class="feather icon-star ml-25"></i>
                                                    </div>
                                                </div>
                                                <div class="item-cost">
                                                    <h6 class="item-price">
                                                        Rp. <?=number_format($subtotal)?>
                                                    </h6>
                                                    <p class="shipping">
                                                        <i class="feather icon-shopping-cart"></i> Free Shipping
                                                    </p>
                                                </div>
                                            </div>
                                            <a href="module/cart/aksi/delcart.php?idproduk=<?=$cartitem['idproduk'];?>">
                                            <div class="wishlist">
                                                <i class="feather icon-x align-middle"></i> Remove
                                            </div></a>
                                            <a href="">
                                            <div>
                                                    <button type="button" class="btn cart btn-block"><i class="fa fa-floppy-o mr-25"></i>&nbsp;&nbsp;Update</button>
                                            </div></a>
                                        </div>
                                    </div>
                                </div>
<?php $total += $subtotal;
    $i++;}?>
                            </div>
                            <div class="checkout-options">
                                <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="price-details">
                                                <p>Detail Pembayaran</p>
                                            </div>
                                            <hr>
                                            <input type="hidden" name="grandtotal" value="<?=$total;?>">
                                            <input type="hidden" name="qtytotal" value="<?=$ttl;?>">
                                            <input type="hidden" name="penanggungjawab" value="<?=$iduser;?>">
                                            <div class="detail">
                                                <div class="detail-title detail-total">Total</div>
                                                <div class="detail-amt total-amt">Rp. <?=number_format($total);?></div>
                                            </div>
                                            <div class="btn btn-primary btn-block place-order">SELANJUTNYA</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>
                    <!-- Checkout Place order Ends -->

                    <!-- Checkout Customer Address Starts -->
<?php
$kueripelanggan = mysqli_query($koneksi, "SELECT * FROM tbl_pelanggan ORDER BY id_pelanggan DESC LIMIT 1");
$rowpelanggan = mysqli_fetch_array($kueripelanggan);
?>
                    <h6><i class="step-icon step feather icon-home"></i>Detail Pelanggan</h6>
                    <fieldset class="checkout-step-2 px-0">
                        <section id="checkout-address" class="list-view product-checkout">
                            <div class="card">
                                <div class="card-header flex-column align-items-start">
                                    <h4 class="card-title">Detail Pelanggan</h4>
                                    <p class="text-muted mt-25">Data di bawah diambil dari Data Pelanggan yang terakhir kali diinputkan</p>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label for="checkout-idpelanggan">ID Pelanggan:</label>
                                                    <input type="text" value="<?=$rowpelanggan['id_pelanggan'];?>" id="checkout-idpelanggan" class="form-control required" name="idpelanggan" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="checkout-nama">Nama Lengkap:</label>
                                                    <input type="text" value="<?=$rowpelanggan['nama'];?>" id="checkout-nama" class="form-control required" name="nama" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="checkout-nohp">Nomor HP:</label>
                                                    <input type="number" value="<?=$rowpelanggan['nohp'];?>" id="checkout-nohp" class="form-control required" name="nohp" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="checkout-alamat">Alamat:</label>
                                                    <input type="text" value="<?=$rowpelanggan['alamat'];?>" id="checkout-alamat" class="form-control required" name="alamat" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="checkout-jaminan">Jaminan:</label>
                                                    <input type="text" value="<?=$rowpelanggan['jaminan'];?>" id="checkout-jaminan" class="form-control required" name="jaminan" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="tanggalambil">Tanggal Ambil</label>
                                                    <input type="date" name="tanggalambil" id="tanggalambil" class="form-control" value="<?=date('Y-m-d');?>" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label for="tanggalkembali">Tanggal Kembali</label>
                                                    <input type="date" name="tanggalkembali" id="tanggalkembali" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="customer-card">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Konfirmasi Detail Pelanggan</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body actions">
                                            <p class="mb-0">Apakah sudah benar ?</p>
                                            <hr>
                                            <div class="btn btn-primary btn-block delivery-address">YA, SUDAH BENAR</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>

                    <!-- Checkout Customer Address Ends -->

                    <!-- Checkout Payment Starts -->
                    <h6><i class="step-icon step feather icon-credit-card"></i>Payment</h6>
                    <fieldset class="checkout-step-3 px-0">
                        <section id="checkout-payment" class="list-view product-checkout">
                            <div class="payment-type">
                                <div class="card">
                                    <div class="card-header flex-column align-items-start">
                                        <h4 class="card-title">Payment options</h4>
                                        <p class="text-muted mt-25">Be sure to click on correct payment option</p>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between flex-wrap">
                                                <div class="vs-radio-con vs-radio-primary">
                                                    <input type="radio" name="vueradio" checked="" value="false">
                                                    <span class="vs-radio">
                                                        <span class="vs-radio--border"></span>
                                                        <span class="vs-radio--circle"></span>
                                                    </span>
                                                    <img src="app-assets/images/pages/eCommerce/bank.png" alt="img-placeholder" height="40">
                                                    <span>US Unlocked Debit Card 12XX XXXX XXXX 0000
                                                    </span>
                                                </div>
                                                <div class="card-holder-name mt-75">
                                                    John Doe
                                                </div>
                                                <div class="card-expiration-date mt-75">
                                                    11/2020
                                                </div>
                                            </div>
                                            <div class="customer-cvv mt-1">
                                                <div class="form-inline">
                                                    <label class="mb-50" for="card-holder-cvv">Enter CVV:</label>
                                                    <input type="number" class="form-control ml-75 mb-50 input-cvv" id="card-holder-cvv">
                                                    <div class="btn btn-primary btn-cvv ml-50 mb-50">Continue</div>
                                                </div>
                                            </div>
                                            <hr class="my-2">
                                            <ul class="other-payment-options list-unstyled">
                                                <li>
                                                    <div class="vs-radio-con vs-radio-primary py-25">
                                                        <input type="radio" name="vueradio" value="false">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span>
                                                            Credit / Debit / ATM Card
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="vs-radio-con vs-radio-primary py-25">
                                                        <input type="radio" name="vueradio" value="false">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span>
                                                            Net Banking
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="vs-radio-con vs-radio-primary py-25">
                                                        <input type="radio" name="vueradio" value="false">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span>
                                                            EMI (Easy Installment)
                                                        </span>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="vs-radio-con vs-radio-primary py-25">
                                                        <input type="radio" name="vueradio" value="false">
                                                        <span class="vs-radio">
                                                            <span class="vs-radio--border"></span>
                                                            <span class="vs-radio--circle"></span>
                                                        </span>
                                                        <span>
                                                            Cash On Delivery
                                                        </span>
                                                    </div>
                                                </li>
                                            </ul>
                                            <hr>
                                            <div class="gift-card">
                                                <p><i class="feather icon-plus-square mr-25 font-medium-5"></i>
                                                    Add Gift Card
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="amount-payable checkout-options">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Ringkasan Belanja</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="detail">
                                                <div class="details-title">
                                                    Total Barang (<?=$ttl;?> barang):
                                                </div>
                                            </div>
<?php
$kuericartfinish = mysqli_query($koneksi, "SELECT p.`nama` AS namaproduk, p.`gambar` AS gambar, p.`stok` as stok, o.`jumlah` AS jumlah, o.`id_produk` as idproduk, o.`harga` AS harga, m.nama AS namamerek FROM `tbl_produk` p,`tbl_order` o,`tbl_merek` m WHERE o.`id_session` = '$sessionid' AND p.`id_produk` = o.`id_produk`");
while ($cartfinish = mysqli_fetch_array($kuericartfinish)) {

    $subtotal = $cartfinish['harga'] * $cartfinish['jumlah'];
    ?>
                                            <div class="detail">
                                                <div class="details-title">
                                                    <?=$cartfinish['namaproduk'];?> x <?=$cartfinish['jumlah'];?>
                                                </div>
                                                <div class="detail-amt">
                                                    <strong>Rp. <?=number_format($subtotal);?></strong>
                                                </div>
                                            </div>
<?php
}
?>
                                            <hr>
                                            <div class="detail">
                                                <div class="detail-title detail-total">
                                                    Total Tagihan
                                                </div>
                                                <div class="detail-amt total-amt">Rp. <?=number_format($total);?></div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-block">Checkout</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </fieldset>

                    <!-- Checkout Payment Starts -->
</form>
                </div>

            </div>
        </div>
    </div>
    <!-- END: Content-->
