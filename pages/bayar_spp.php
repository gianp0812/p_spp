<?php
if ($role == 'siswa') {
?>
    <script>
        location.reload();
        alert("Anda Tidak Berhak Mengakses Halaman Ini");
        window.history.back();
    </script>
<?php
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query_pilih = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nisn='$id'");
    $data = mysqli_fetch_array($query_pilih);
}

?>

<h1 class="h3 mb-3" align="center"><strong>Bayar SPP</strong></h1>

<div class="row">
    <div class="col-12">
        <div class="card flex-fill">
            <div class="card-body">
                <?php
                if (isset($_GET['id'])) {
                } else {
                ?>
                    <button data-bs-toggle="modal" data-bs-target="#datasiswa" class="btn btn-success btn-sm">Pilih Siswa</button>
                <?php
                }
                ?>
                <form method="post" action="control/transaksi.php">
                    <div class="mb-3">
                        <label class="form-label"><strong>NISN</strong></label>
                        <input type="hidden" name="nisn" class="form-control" value="<?= $data['nisn'] ?>">
                        <input type="text" name="bulan" class="form-control" value="<?= date('F') ?>" hidden>
                        <input type="text" name="tahun" class="form-control" value="<?= date('Y') ?>" hidden>
                        <input type="text" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" hidden>
                        <?php
                        if (isset($_GET['id'])) {
                        ?>
                            <input type="text" name="oldnisn" class="form-control" value="<?= $data['nisn'] ?>" disabled>
                        <?php
                        } else {
                        ?>
                            <input type="text" name="" class="form-control" value="Silahkan Pilih Siswa Terlebih Dahulu" disabled>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>NIS</strong></label>
                        <?php
                        if (isset($_GET['id'])) {
                        ?>
                            <input type="text" name="nis" class="form-control" value="<?= $data['nis'] ?>" disabled>

                        <?php
                        } else {
                        ?>
                            <input type="text" name="" class="form-control" value="Silahkan Pilih Siswa Terlebih Dahulu" disabled>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Nama Siswa</strong></label>
                        <?php
                        if (isset($_GET['id'])) {
                        ?>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" disabled>
                        <?php
                        } else {
                        ?>
                            <input type="text" name="" class="form-control" value="Silahkan Pilih Siswa Terlebih Dahulu" disabled>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3">
                        <label class="form-label"><strong>Kelas</strong></label>
                        <?php
                        if (isset($_GET['id'])) {
                        ?>
                            <input type="text" name="kelas" class="form-control" value="<?= $data['nama_kelas'] . ' - ' . $data['kompetensi_dasar'] ?>" disabled>
                        <?php
                        } else {
                        ?>
                            <input type="text" name="" class="form-control" value="Silahkan Pilih Siswa Terlebih Dahulu" disabled>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="mb-3" <?= (isset($_GET['id']) ? '' : 'hidden') ?>>
                        <label class="form-label"><strong>SPP</strong></label>
                        <select name="spp" class="form-select" required>
                            <option value="" hidden>-Pilih SPP-</option>
                            <?php
                            if (isset($_GET['id'])) {
                                $nisn = $data['nisn'];

                                $spp0 = mysqli_query($koneksi, "SELECT * FROM spp");

                                while ($spp1 = mysqli_fetch_array($spp0)) {
                                    $id_spp = $spp1['id_spp'];

                                    $cek = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_bayar FROM pembayaran WHERE nisn='$nisn' AND id_spp='$id_spp'");
                                    $cek1 = mysqli_fetch_array($cek);

                                    $total = $spp1['nominal'] - $cek1['total_bayar'];
                                    if ($total != 0) {
                                        $hasil = "Kurang : Rp " . number_format($total, 2, ',', '.');
                                    } else {
                                        $hasil = "Lunas";
                                    }
                            ?>
                                    <option value="<?= $spp1['id_spp'] ?>" <?= ($total != 0 ? '' : 'disabled') ?>>
                                        <?= $spp1['tahun'] . ' - ' . "Rp " . number_format($spp1['nominal'], 2, ',', '.') . " - " . $hasil ?>
                                    </option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3" <?= (isset($_GET['id']) ? '' : 'hidden') ?>>
                        <label class="form-label"><strong>Jumlah Bayar</strong></label>
                        <input type="number" name="nominal" class="form-control" required>
                    </div>

                    <div class="mb-3" style="float: right;">
                        <a href="?page=bayar_spp" class="btn btn-danger">Reset</a>

                        <button type="submit" class="btn btn-primary" <?= (isset($_GET['id']) ? '' : 'hidden') ?>>Bayar</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Siswa -->
<div class="modal fade" id="datasiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <div class="text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Siswa</h1>
                        <button type="button" class="btn-close" style="float: right; margin-right: -20px; margin-top: -30px;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="table">
                <table class="table table-bordered table-hover cell-border" id="siswa">
                    <thead class=" text-primary">
                        <th>NISN</th>
                        <th>NIS</th>
                        <th>Nama</th>
                        <th>Kelas</th>
                        <th>Action</th>
                    </thead>

                    <tbody>
                        <?php
                        $query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas");

                        while ($data_siswa = mysqli_fetch_array($query_siswa)) {
                        ?>
                            <tr>
                                <td><?= $data_siswa['nisn'] ?></td>
                                <td><?= $data_siswa['nis'] ?></td>
                                <td><?= $data_siswa['nama'] ?></td>
                                <td><?= $data_siswa['nama_kelas'] . " - " . $data_siswa['kompetensi_dasar'] ?></td>
                                <td><a href="?page=bayar_spp&id=<?= $data_siswa['nisn'] ?>" class="btn btn-success btn sm">Pilih</a></td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
<script>
    let table = new DataTable('#siswa');
</script>