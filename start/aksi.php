<?php
include "lib/koneksi.php";

if (isset($_POST['action'])) {
    $sql = "SELECT * FROM tbl_produk WHERE stok > 0";

    if (isset($_POST['merek'])) {
        $merek = "'" . implode("','", $_POST['merek']) . "'";
        $sql .= " AND id_merek IN (" . $merek . ")";
    }
    if (isset($_POST['kategori'])) {
        $kategori = "'" . implode(",", $_POST['kategori']) . "'";
        $sql .= " AND id_kategori IN (" . $kategori . ")";
    }

    $hasil = mysqli_query($koneksi, $sql);
    $output = '';

    if (mysqli_num_rows($hasil) > 0) {
        while ($row = mysqli_fetch_array($hasil)) {
            $output .= '<div class="col-md-4 mb-2">
                        <div class="card-deck">
                            <div class="card border-secondary">
                                <div class="text-center">
                                <img src="../module/produk/upload/' . $row['gambar'] . '" alt="" style="width: 160px; height: auto;" class="card-img-top">
                                </div>
                                <div class="card-body">
                                <h6 class="text-light bg-primary text-center rounded p-1">' . $row['nama'] . '</h6>
                                    <h6 class="card-title text-danger">Harga : Rp. ' . number_format($row['harga']) . '</h6>
                                    <br>
                                    <pre style="font-family: Segoe UI, Tahoma, Geneva, Verdana, sans-serif; font-size: medium;">Deskripsi    : ' . $row['deskripsi'] . '<br>Stok           : ' . $row['stok'] . '</pre>
                                </div>
                            </div>
                        </div>
                    </div>';
        }
    } else {
        $output = "<h3>Tidak ada hasil</h3>";
    }
    echo $output;
}
