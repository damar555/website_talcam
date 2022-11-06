<?php
include "lib/koneksi.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TalCam Start Page</title>

    <!-- CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

</head>
<body>
    <h3 class="text-center text-light bg-primary" style="height: 50px;line-height: normal;">Selamat Datang di TalCam's Product</h3>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3">
                <h5>Filter Produk</h5>
                <hr>
                <h6 class="text-primary">Pilih Merek</h6>
                <ul class="list-group">
                    <?php
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_merek ORDER BY nama");
while ($row = mysqli_fetch_assoc($sql)) {
    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input produk_check" id="merek" value="<?=$row['id_merek'];?>"><?=$row['nama'];?>
                            </label>
                        </div>
                    </li>
                        <?php }?>
                </ul>
                <br>
                <h6 class="text-primary">Pilih Kategori</h6>
                <ul class="list-group">
                    <?php
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_kategori ORDER BY nama");
while ($row = mysqli_fetch_assoc($sql)) {
    ?>
                    <li class="list-group-item">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input produk_check" id="kategori" value="<?=$row['id_kategori'];?>"><?=$row['nama'];?>
                            </label>
                        </div>
                    </li>
                        <?php }?>
                </ul>


            </div>

            <div class="col-lg-9">
                <h5 class="text-center" id="textChange">List Produk</h5>
                <hr>
                <div class="text-center">
                    <img src="assets/img/2.gif" alt="" id="loader" style="display:none;">
                </div>
                <div class="row" id="result">
                    <?php
$sql = mysqli_query($koneksi, "SELECT * FROM tbl_produk WHERE stok > 0");
while ($row = mysqli_fetch_assoc($sql)) {
    ?>
                    <div class="col-md-4 mb-2">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <div class="text-center">
                                <img src="../module/produk/upload/<?=$row['gambar'];?>" alt="" style="width: 160px; height: auto;" class="card-img-top">
                                </div>
                                <div class="card-body">
                                <h6 class="text-light bg-primary text-center rounded p-1"><?=$row['nama'];?></h6>
                                    <h6 class="card-title text-danger">Harga : Rp. <?=number_format($row['harga']);?></h6>
                                    <br>
                                    <pre style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: medium;">Deskripsi    : <?=$row['deskripsi'];?><br>Stok           : <?=$row['stok'];?></pre>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
<script>
    $(document).ready(function(){

        $(".produk_check").click(function(){
            $("#loader").show();

            var action = 'data';
            var merek = get_filter_text('merek');
            var kategori = get_filter_text('kategori');

            $.ajax({
                url: 'aksi.php',
                method: 'POST',
                data:{action:action,merek:merek,kategori:kategori},
                success:function(response){
                    $("#result").html(response);
                    $("#loader").hide();
                    $("#textChange").text("List Produk :");
                }
            });
        });

        function get_filter_text(text_id){
            var filterData = [];
            $('#'+text_id+':checked').each(function(){
                filterData.push($(this).val());
            });
            return filterData;
        }
    });
</script>

</html>
