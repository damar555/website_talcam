<?php
session_start();
if (!isset($_SESSION['namauser']) && !isset($_SESSION['passuser'])) {
    include "assets/lib/config.php";
    header("Location: $admin_url./pages/login/");
    exit;
} else {
    include "assets/lib/koneksi.php";
    include "assets/lib/config.php";
    $sessionid = session_id();
    // Halaman Set Active
    $p = $_GET['module'];
    $username = $_SESSION['namauser'];
    $password = $_SESSION['passuser'];
    $query = mysqli_query($koneksi, "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'");
    $res = mysqli_fetch_array($query);
    $nama = $res['nama'];
    $iduser = $res['id_user'];
    $leveluser = $res['level'];

    // Item Cart
    $kuericarts = mysqli_query($koneksi, "SELECT SUM(jumlah) as jml FROM `tbl_order` WHERE `id_session` = '$sessionid'");
    $rc = mysqli_fetch_array($kuericarts);
    $ttl = 0;
    $ttl += $rc['jml'];
    ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard | TalCam</title>
    <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,500,600" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/nouislider.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/ui/prism.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/ag-grid/ag-grid.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/ag-grid/ag-theme-material.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/file-uploaders/dropzone.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/animate/animate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/sweetalert2.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css">
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/extensions/toastr.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/validation/form-validation.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-ecommerce-shop.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/wizard.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/card-analytics.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/noui-slider.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/app-user.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/aggrid.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/file-uploaders/dropzone.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/data-list-view.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/extensions/toastr.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns ecommerce-application navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu floating-nav navbar-light navbar-shadow">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon feather icon-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <!-- li.nav-item.mobile-menu.d-xl-none.mr-auto-->
                            <!--   a.nav-link.nav-menu-main.menu-toggle.hidden-xs(href='#')-->
                            <!--     i.ficon.feather.icon-menu-->
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-todo.html" data-toggle="tooltip" data-placement="top" title="Todo"><i class="ficon feather icon-check-square"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-chat.html" data-toggle="tooltip" data-placement="top" title="Chat"><i class="ficon feather icon-message-square"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-email.html" data-toggle="tooltip" data-placement="top" title="Email"><i class="ficon feather icon-mail"></i></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="app-calender.html" data-toggle="tooltip" data-placement="top" title="Calendar"><i class="ficon feather icon-calendar"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link bookmark-star"><i class="ficon feather icon-star warning"></i></a>
                                <div class="bookmark-input search-input">
                                    <div class="bookmark-input-icon"><i class="feather icon-search primary"></i></div>
                                    <input class="form-control input" type="text" placeholder="Explore Vuexy..." tabindex="0" data-search="template-list">
                                    <ul class="search-list search-list-bookmark"></ul>
                                </div>
                                <!-- select.bookmark-select-->
                                <!--   option Chat-->
                                <!--   option email-->
                                <!--   option todo-->
                                <!--   option Calendar-->
                            </li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon feather icon-maximize"></i></a></li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-shopping-cart"></i><span class="badge badge-pill badge-primary badge-up cart-item-count"><?=$ttl;?></span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-cart dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <h3 class="white"><span class="cart-item-count"><?=$ttl;?></span><span class="mx-50">Barang</span></h3><span class="notification-title">Di Keranjang Anda</span>
                                    </div>
                                </li>
                                <li class="scrollable-container media-list">
<?php
$kuericarts = mysqli_query($koneksi, "SELECT p.`nama` AS namaproduk, p.`gambar` AS gambar, p.`deskripsi` AS deskripsi, o.`id_produk` AS idproduk, o.`jumlah` AS jumlah, o.`harga` AS harga, m.`nama` AS namamerek FROM `tbl_produk` p,`tbl_order` o,`tbl_merek` m WHERE o.`id_session` = 'b543uoc5iovv0c4edt0ni6nj2g' AND p.`id_produk` = o.`id_produk` AND p.`id_merek` = m.`id_merek`");
    while ($cartitems = mysqli_fetch_array($kuericarts)) {
        ?>
                                    <a class="cart-item">
                                        <div class="media">
                                            <div class="media-left d-flex justify-content-center align-items-center"><img src="module/produk/upload/<?=$cartitems['gambar'];?>" width="75" alt="Cart Item"></div>
                                            <div class="media-body"><span class="item-title text-truncate text-bold-500 d-block mb-50"><?=$cartitems['namaproduk']?></span><span class="item-desc font-small-2 text-truncate d-block"> <?=$cartitems['deskripsi'];?>.</span>
                                                <div class="d-flex justify-content-between align-items-center mt-1"><span class="align-middle d-block"><?=$cartitems['jumlah'];?> x Rp. <?=number_format($cartitems['harga']);?></span><a href="module/cart/aksi/delcart.php?idproduk=<?=$cartitems['idproduk'];?>"><i class="remove-cart-item feather icon-x danger font-medium-1"></i></a></div>
                                            </div>
                                        </div>
                                    </a>
<?php }?>
                                </li>
                                <?php
if ($ttl == 0) {} else {
        ?>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center text-primary" href="?module=listcart"><i class="feather icon-shopping-cart align-middle"></i><span class="align-middle text-bold-600">Checkout</span></a></li>
                                <?php }?>
                                <li class="empty-cart d-none p-2">Your Cart Is Empty.</li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon feather icon-bell"></i><span class="badge badge-pill badge-primary badge-up">5</span></a>
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header m-0 p-2">
                                        <h3 class="white">5 New</h3><span class="notification-title">App Notifications</span>
                                    </div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left"><i class="feather icon-plus-square font-medium-5 primary"></i></div>
                                            <div class="media-body">
                                                <h6 class="primary media-heading">You have new order!</h6><small class="notification-text"> Are your going to meet me tonight?</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">9 hours ago</time></small>
                                        </div>
                                    </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left"><i class="feather icon-download-cloud font-medium-5 success"></i></div>
                                            <div class="media-body">
                                                <h6 class="success media-heading red darken-1">99% Server load</h6><small class="notification-text">You got new order of goods.</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">5 hour ago</time></small>
                                        </div>
                                    </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left"><i class="feather icon-alert-triangle font-medium-5 danger"></i></div>
                                            <div class="media-body">
                                                <h6 class="danger media-heading yellow darken-3">Warning notifixation</h6><small class="notification-text">Server have 99% CPU usage.</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Today</time></small>
                                        </div>
                                    </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left"><i class="feather icon-check-circle font-medium-5 info"></i></div>
                                            <div class="media-body">
                                                <h6 class="info media-heading">Complete the task</h6><small class="notification-text">Cake sesame snaps cupcake</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last week</time></small>
                                        </div>
                                    </a><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <div class="media d-flex align-items-start">
                                            <div class="media-left"><i class="feather icon-file font-medium-5 warning"></i></div>
                                            <div class="media-body">
                                                <h6 class="warning media-heading">Generate monthly report</h6><small class="notification-text">Chocolate cake oat cake tiramisu marzipan</small>
                                            </div><small>
                                                <time class="media-meta" datetime="2015-06-11T18:29:20+08:00">Last month</time></small>
                                        </div>
                                    </a></li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-1 text-center" href="javascript:void(0)">View all notifications</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name text-bold-600"><?=$nama;?></span><span class="user-status">Available</span></div><span><img class="round" src="module/user/upload/<?=$res['gambar'];?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right"><a class="dropdown-item" href="?module=viewuser&iduser=<?=$res['id_user'];?>"><i class="feather icon-user"></i> Lihat Profile</a><a class="dropdown-item" href="app-email.html"><i class="feather icon-mail"></i> My Inbox</a><a class="dropdown-item" href="app-todo.html"><i class="feather icon-check-square"></i> Task</a><a class="dropdown-item" href="app-chat.html"><i class="feather icon-message-square"></i> Chats</a>
                                <div class="dropdown-divider"></div><a class="dropdown-item" id="confirm-text1"><i class="feather icon-power"></i> Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <ul class="main-search-list-defaultlist d-none">
        <li class="d-flex align-items-center"><a class="pb-25" href="#">
                <h6 class="text-primary mb-0">Files</h6>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="app-assets/images/icons/xls.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Two new item submitted</p><small class="text-muted">Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;17kb</small>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="app-assets/images/icons/jpg.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">52 JPG file Generated</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;11kb</small>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="app-assets/images/icons/pdf.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">25 PDF File Uploaded</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;150kb</small>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100" href="#">
                <div class="d-flex">
                    <div class="mr-50"><img src="app-assets/images/icons/doc.png" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna_Strong.doc</p><small class="text-muted">Web Designer</small>
                    </div>
                </div><small class="search-data-size mr-50 text-muted">&apos;256kb</small>
            </a></li>
        <li class="d-flex align-items-center"><a class="pb-25" href="#">
                <h6 class="text-primary mb-0">Members</h6>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-8.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">John Doe</p><small class="text-muted">UI designer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-1.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Michal Clark</p><small class="text-muted">FontEnd Developer</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-14.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Milena Gibson</p><small class="text-muted">Digital Marketing Manager</small>
                    </div>
                </div>
            </a></li>
        <li class="auto-suggestion d-flex align-items-center cursor-pointer"><a class="d-flex align-items-center justify-content-between py-50 w-100" href="#">
                <div class="d-flex align-items-center">
                    <div class="avatar mr-50"><img src="app-assets/images/portrait/small/avatar-s-6.jpg" alt="png" height="32"></div>
                    <div class="search-data">
                        <p class="search-data-title mb-0">Anna Strong</p><small class="text-muted">Web Designer</small>
                    </div>
                </div>
            </a></li>
    </ul>
    <ul class="main-search-list-defaultlist-other-list d-none">
        <li class="auto-suggestion d-flex align-items-center justify-content-between cursor-pointer"><a class="d-flex align-items-center justify-content-between w-100 py-50">
                <div class="d-flex justify-content-start"><span class="mr-75 feather icon-alert-circle"></span><span>No results found.</span></div>
            </a></li>
    </ul>
    <!-- END: Header-->


    <!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="html/ltr/vertical-menu-template-semi-dark/index.html">
                        <div class="brand-logo"></div>
                        <h2 class="brand-text mb-0">TalCam</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pr-0" data-toggle="collapse"><i class="feather icon-x d-block d-xl-none font-medium-4 primary toggle-icon"></i><i class="toggle-icon feather icon-disc font-medium-4 d-none d-xl-block collapse-toggle-icon primary" data-ticon="icon-disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class=" nav-item <?=($p == 'home' ? 'active' : '');?>"><a href="?module=home"><i class="feather icon-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span></a>
                </li>
                <li class=" navigation-header"><span>Apps</span>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-copy"></i><span class="menu-title" data-i18n="Kategori">Kategori</span></a>
                    <ul class="menu-content">
<?php
$listkategoriquery = mysqli_query($koneksi, "SELECT COUNT(id_kategori) as jmlkategori FROM tbl_kategori");
    $jmlkategori = mysqli_fetch_array($listkategoriquery);
    ?>
                        <li class="<?=($p == 'listkategori' ? 'active' : '');?>"><a href="?module=listkategori"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="List Kategori">List Kategori</span><span class="badge badge badge-pill badge-success float-right mr-2"><?=$jmlkategori['jmlkategori'];?></span></a></li>
                        <li class="<?=($p == 'tambahkategori' ? 'active' : '');?>"><a href="?module=tambahkategori"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Tambah Kategori">Tambah Kategori</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-tag"></i><span class="menu-title" data-i18n="Merek">Merek</span></a>
                    <ul class="menu-content">
                    <?php
$listmerekquery = mysqli_query($koneksi, "SELECT COUNT(id_merek) as jmlmerek FROM tbl_merek");
    $jmlmerek = mysqli_fetch_array($listmerekquery);
    ?>
                        <li class="<?=($p == 'listmerek' ? 'active' : '');?>"><a href="?module=listmerek"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="List Merek">List Merek</span><span class="badge badge badge-pill badge-success float-right mr-2"><?=$jmlmerek['jmlmerek'];?></span></a></li>
                        <li class="<?=($p == 'tambahmerek' ? 'active' : '');?>"><a href="?module=tambahmerek"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Tambah Merek">Tambah Merek</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-grid"></i><span class="menu-title" data-i18n="Produk">Produk</span></a>
                    <ul class="menu-content">
                    <?php
$listprodukquery = mysqli_query($koneksi, "SELECT COUNT(id_produk) as jmlproduk FROM tbl_produk");
    $jmlproduk = mysqli_fetch_array($listprodukquery);
    ?>
                        <li class="<?=($p == 'listproduk' ? 'active' : '');?>"><a href="?module=listproduk"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="List Produk">List Produk</span><span class="badge badge badge-pill badge-success float-right mr-2"><?=$jmlproduk['jmlproduk'];?></span></a></li>
                        <li class="<?=($p == 'tambahproduk' ? 'active' : '');?>"><a href="?module=tambahproduk"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Tambah Produk">Tambah Produk</span></a></li>
                    </ul>
                </li>
                <li class=" nav-item"><a href="#"><i class="feather icon-credit-card"></i><span class="menu-title" data-i18n="Pesanan">Pesanan</span></a>
                    <ul class="menu-content">
                    <?php
$listorderdetailquery = mysqli_query($koneksi, "SELECT COUNT(id_order_detail) as jmlorderdetail FROM tbl_order_detail");
    $jmlorderdetail = mysqli_fetch_array($listorderdetailquery);
    ?>
                        <li class="<?=($p == 'listpesanan' ? 'active' : '');?>"><a href="?module=listpesanan"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="List Pesanan">List Pesanan</span><span class="badge badge badge-pill badge-success float-right mr-2"><?=$jmlorderdetail['jmlorderdetail'];?></span></a></li>
                        <li class="<?=($p == 'tambahpesanan' ? 'active' : '');?>"><a href="?module=tambahpesanan"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Tambah Pesanan">Tambah Pesanan</span></a></li>
                    </ul>
                </li>

                <li class=" navigation-header"><span>Manajemen User</span>
                </li>
                <?php
if ($leveluser == "Administrator") {
        ?>
                <li class=" nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Karyawan">Karyawan</span></a>
                    <ul class="menu-content">
                    <?php
$listuserquery = mysqli_query($koneksi, "SELECT COUNT(id_user) as jmluser FROM tbl_user WHERE level='Karyawan'");
        $jmluser = mysqli_fetch_array($listuserquery);
        ?>
                        <li class="<?=($p == 'listuser' ? 'active' : '');?>"><a href="?module=listuser"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="List Karyawan">List Karyawan</span><span class="badge badge badge-pill badge-success float-right mr-2"><?=$jmluser['jmluser'];?></span></a></li>
                        <li class="<?=($p == 'tambahuser' ? 'active' : '');?>"><a href="?module=tambahuser"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="Tambah Karyawan">Tambah Karyawan</span></a></li>
                    </ul>
                </li>
    <?php } else {}?>
                <li class=" nav-item"><a href="#"><i class="feather icon-users"></i><span class="menu-title" data-i18n="Karyawan">Pelanggan</span></a>
                    <ul class="menu-content">
                    <?php
$listpelangganquery = mysqli_query($koneksi, "SELECT COUNT(id_pelanggan) as jmlpelanggan FROM tbl_pelanggan");
    $jmlpelanggan = mysqli_fetch_array($listpelangganquery);
    ?>
                        <li class="<?=($p == 'listpelanggan' ? 'active' : '');?>"><a href="?module=listpelanggan"><i class="feather icon-circle"></i><span class="menu-title" data-i18n="List Karyawan">List Pelanggan</span><span class="badge badge badge-pill badge-success float-right mr-1"><?=$jmlpelanggan['jmlpelanggan'];?></span></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
    <!-- END: Main Menu-->

    <!-- Begin Content Module -->
<?php
if ($_GET['module'] == 'home') {
        include "module/home/index.php";
    }
// Kategori
    elseif ($_GET['module'] == 'listkategori') {
        include "module/kategori/index.php";
    } elseif ($_GET['module'] == 'tambahkategori') {
        include "module/kategori/tambah/index.php";
    } elseif ($_GET['module'] == 'editkategori') {
        include "module/kategori/edit/index.php";
    }
// Merek
    elseif ($_GET['module'] == 'listmerek') {
        include "module/merek/index.php";
    } elseif ($_GET['module'] == 'tambahmerek') {
        include "module/merek/tambah/index.php";
    } elseif ($_GET['module'] == 'editmerek') {
        include "module/merek/edit/index.php";
    }
// ProdukSewa
    elseif ($_GET['module'] == 'listproduk') {
        include "module/produk/index.php";
    } elseif ($_GET['module'] == 'tambahproduk') {
        include "module/produk/tambah/index.php";
    } elseif ($_GET['module'] == 'editproduk') {
        include "module/produk/edit/index.php";
    }
// user
    elseif ($_GET['module'] == 'listuser') {
        include "module/user/index.php";
    } elseif ($_GET['module'] == 'tambahuser') {
        include "module/user/tambah/index.php";
    } elseif ($_GET['module'] == 'edituser') {
        include "module/user/edit/index.php";
    } elseif ($_GET['module'] == 'viewuser') {
        include "module/user/view/index.php";
    }
// pemesanan
    elseif ($_GET['module'] == 'listpesanan') {
        include "module/pesanan/index.php";
    } elseif ($_GET['module'] == 'listcart') {
        include "module/cart/viewcart.php";
    } elseif ($_GET['module'] == 'tambahpesanan') {
        include "module/cart/index.php";
    }
// pelanggan
    elseif ($_GET['module'] == 'listpelanggan') {
        include "module/pelanggan/index.php";
    } elseif ($_GET['module'] == 'tambahpelanggan') {
        include "module/pelanggan/tambah/index.php";
    } elseif ($_GET['module'] == 'editpelanggan') {
        include "module/pelanggan/edit/index.php";
    } elseif ($_GET['module'] == 'logout') {
        echo '<script>window.location.replace("logout.php")</script>';
        // echo "<script> alert('Modul belum ada!'); window.location = 'adminweb.php?module=home';</script>";
    } else {
        include "module/home/index.php";
    }
    ?>
    <!-- End Content Module -->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-light">
        <p class="clearfix blue-grey lighten-2 mb-0"><span class="float-md-left d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2020<a class="text-bold-800 grey darken-2" href="https://1.envato.market/pixinvent_portfolio" target="_blank">Pixinvent,</a>All rights Reserved</span><span class="float-md-right d-none d-md-block">Hand-crafted & Made with<i class="feather icon-heart pink"></i></span>
            <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="feather icon-arrow-up"></i></button>
        </p>
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="app-assets/vendors/js/tables/ag-grid/ag-grid-community.min.noStyle.js"></script>
    <script src="app-assets/vendors/js/ui/prism.min.js"></script>
    <script src="app-assets/vendors/js/extensions/wNumb.js"></script>
    <script src="app-assets/vendors/js/extensions/nouislider.min.js"></script>
    <script src="app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.bootstrap4.min.js"></script>
    <script src="app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/dataTables.select.min.js"></script>
    <script src="app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="app-assets/vendors/js/extensions/sweetalert2.all.min.js"></script>
    <script src="app-assets/vendors/js/extensions/polyfill.min.js"></script>
    <script src="app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/picker.time.js"></script>
    <script src="app-assets/vendors/js/pickers/pickadate/legacy.js"></script>
    <script src="app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js"></script>
    <script src="app-assets/vendors/js/extensions/toastr.min.js"></script>
    <script src="app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/components.js"></script>
    <script src="app-assets/js/scripts/customizer.js"></script>
    <script src="app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="app-assets/js/scripts/pages/app-ecommerce-shop.js"></script>
    <script src="app-assets/js/scripts/datatables/datatable.js"></script>
    <script src="app-assets/js/scripts/pages/app-user.js"></script>
    <script src="app-assets/js/scripts/navs/navs.js"></script>
    <script src="app-assets/js/scripts/ui/data-list-view.js"></script>
    <script src="app-assets/js/scripts/forms/select/form-select2.js"></script>
    <script src="app-assets/js/scripts/extensions/sweet-alerts.js"></script>
    <!-- <script src="app-assets/js/scripts/forms/wizard-steps.js"></script> -->
    <script src="app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <script src="app-assets/js/scripts/forms/number-input.js"></script>
    <script src="app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>

    <!-- END: Page JS-->

    <!-- BEGIN Custom JS -->
    <script>
    $('#confirm-text1').on('click', function () {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Anda akan logout setelah ini!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Saya yakin!',
            confirmButtonClass: 'btn btn-primary',
            cancelButtonClass: 'btn btn-danger ml-1',
            buttonsStyling: false,
            }).then(function (result) {
                if (result.value) {
                    Swal.fire(
                        {
                            type: "success",
                            title: 'Berhasil Logout!',
                            text: 'Anda telah logout.',
                            confirmButtonClass: 'btn btn-success'
                        }
                        ).then(function() {
                        // Redirect the user
                        window.location.href = "pages/logout/aksi/logout.php";
                        });
                        }
                        })
                        });
    </script>

    <script>
        $('#kategori').select2({
            placeholder: "-- Pilih Kategori --"
            });
        $('#merek').select2({
            placeholder: "-- Pilih Merek --"
            });
        $('#jk').select2({
            placeholder: "-- Pilih Jenis Kelamin --"
            });
        $('#pekerjaanpesanan').select2({
            placeholder: "-- Pilih Pekerjaan --"
            });
        $('#idprodukpesanan').select2({
            placeholder: "-- Pilih Produk --"
            });
        $('#jaminanpesanan').select2({
            placeholder: "-- Pilih Jaminan --"
            });
        $('#leveluser').select2({
            placeholder: "-- Pilih Level --"
            });
    </script>

    <script>
        $("#idprodukpesanan").change(function(){
            update();
        });

        function update() {
            $("#hargasewa").val($('#idprodukpesanan').data('harga'));
        }
    </script>

    <script>
        $('.produk').on('change', function() {
            $('.hargasewa')
            .val(
                $(this).find(':selected').data('harga')
                );
            });
    </script>
    <!-- <script>
    $("#idprodukpesanan").change(function() {
  var action = $(this).val();
  $("#formprodukpesanan").attr("action", "module/cart/aksi/cart.php?idcart=<?=$idc;?>&idproduk=" + action);
});
</script> -->

<script>
    $(document).ready(function () {
    $(".quantity-counter" ).on('change',function() {
        var max = parseInt($(this).attr('max'));
        var min = parseInt($(this).attr('min'));
        if ($(this).val() > max)
        {
            $(this).val(max);
            var $el = $(this).closest('.item-quantity');
            $el.find("button").addClass("disabled-max-min");
        }
        else if ($(this).val() < min)
        {
            $(this).val(min);
        }
        });
    });


</script>
<script>
    $(document).ready(function(){
        $(".quantity-counter").on('change', function(){
            var $el = $(this).closest('.ecommerce-card');
            var pid = $el.find(".pid").val();
            var qty = $el.find(".quantity-counter").val();
            location.reload(true);
            $.ajax({
                url: 'module/cart/aksi/updatecart.php',
                method: 'post',
                cache: false,
                data: {pid:pid,qty:qty},
                success: function(response){

                    console.log(response);
                }
            });
        });
    });
</script>

    <!-- END Custom JS -->
</body>
<!-- END: Body-->

</html>
<?php }?>