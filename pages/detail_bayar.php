<?php
$nisn = $_GET['id'];

$query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nisn='$nisn'");
$data_siswa = mysqli_fetch_array($query_siswa);

?>

<h4 align="center">
    Detail Pembayaran SPP
    <br>
    <strong> <?= $data_siswa['nama'] . "<br>" . $data_siswa['nama_kelas'] . " - " . $data_siswa['kompetensi_dasar'] ?> </strong>
</h4>
<div class="content">
    <div class="row">

        <?php

        $query = mysqli_query($koneksi, "SELECT * FROM spp ORDER BY tahun");

        while ($data = mysqli_fetch_array($query)) {
            $id = $data['id_spp'];
            $nominal = $data['nominal'];

            $query_transaksi = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_bayar FROM pembayaran WHERE id_spp='$id' AND nisn='$nisn'");
            $data_transaksi = mysqli_fetch_array($query_transaksi);

            $total = $nominal - $data_transaksi['total_bayar'];

            if ($total == 0) {
                $hasil = "LUNAS";
            } elseif ($total == $nominal) {
                $hasil = "Belum Membayar";
            } else {
                $hasil = "Kurang <br> Rp " . number_format($total, 0, ',', '.') . ",00";
            }

        ?>

            <div class="col-lg-12 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-body ">
                        <div class="row">
                            <div class="col-5 col-md-4">
                                <div class="text-center icon-warning" style=" font-size: 36px;">
                                    <i class="nc-icon nc-money-coins text-<?php if ($total == 0) {echo 'success'; } elseif ($total == $nominal) { echo 'secondary'; } else {echo 'warning'; } ?>"><br><?= $hasil ?></i>
                                </div>
                            </div>
                            <div class="col-7 col-md-8">
                                <div class="numbers">
                                    <p class="card-category"><strong>SPP Tahun <?= $data['tahun'] ?></strong></p>
                                    <p class="card-title">
                                        Nominal
                                        <br>
                                        <?= "Rp " . number_format($data['nominal'], 0, ',', '.') . ",00"  ?>
                                    <p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer ">
                        <hr>
                        <div class="stats">
                            <i></i>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>
<footer>
</footer>