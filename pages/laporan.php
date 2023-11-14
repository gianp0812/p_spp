<?php
if ($role == 'siswa' || $role == 'petugas') {
?>
    <script>
        location.reload();
        alert("Anda Tidak Berhak Mengakses Halaman Ini");
        window.history.back();
    </script>
<?php
}
?>

<h1 class="h3 mb-3" align="center"><strong>Laporan Transaksi</strong></h1>
<div class="row">
    <div class="col-12">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">
                                        <center>Laporan Riwayat Pembayaran SPP</center>
                                    </h5>
                                    <br>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="corner-up-left"></i>
                                    </div>
                                </div>
                            </div>
                            <form method="post">
                                <input type="hidden" name="tampil" value="siswa">
                                Tanggal Awal :
                                <input type="date" name="tgl_awal" class="form-control" value="<?php echo (!empty($_POST['tgl_awal']) ? $_POST['tgl_awal'] : '') ?>">
                                <br>
                                Tanggal Akhir :
                                <input type="date" name="tgl_akhir" class="form-control" value="<?php echo (!empty($_POST['tgl_akhir']) ? $_POST['tgl_akhir'] : '') ?>">
                                <br>
                                SPP :
                                <select name="spp" class="form-select">
                                    <option value="" hidden>Semua SPP</option>
                                    <?php
                                    $query_4 = mysqli_query($koneksi, "SELECT * FROM spp ORDER BY tahun");
                                    while ($data_4 = mysqli_fetch_array($query_4)) {
                                    ?>
                                        <option value="<?php echo $data_4['id_spp']; ?>" <?php echo (!empty($_POST['spp']) && $_POST['spp'] == $data_4['id_spp'] ? 'selected' : '') ?>>
                                            <?= $data_4['tahun'] . " - " . "Rp " . number_format($data_4['nominal'], 0, ',', '.') . ",00" ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                Siswa :
                                <?php
                                if (isset($_GET['nisn'])) {
                                    $id = $_GET['nisn'];
                                    $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$id'");
                                    $data = mysqli_fetch_array($query);
                                ?>
                                    <input type="text" name="" class="form-control" value="<?= $data['nis'] . " - " . $data['nama'] ?>" disabled>
                                    <input type="text" name="siswa" value="<?= $data['nisn'] ?>" hidden>
                                <?php
                                } else {
                                ?>
                                    <input type="text" name="" class="form-control" value="Semua Siswa" disabled>
                                    <input type="text" name="siswa" value="" hidden>
                                <?php
                                }
                                ?>
                                <div align="center">
                                    <button type="submit" class="btn btn-primary btn-sm btn-rounded mt-3">Tampilkan</button>
                                </div>
                            </form>
                            <div align="center">
                                <button data-bs-toggle="modal" data-bs-target="#datasiswa" class="btn btn-success btn-sm">Pilih Siswa</button>
                                <button onclick="location.href='?page=laporan'" class="btn btn-danger btn-rounded btn-sm">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col mt-0">
                                    <h5 class="card-title">
                                        <center>Laporan Pembayaran SPP per Kelas</center>
                                    </h5>
                                    <br>
                                </div>
                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="corner-up-left"></i>
                                    </div>
                                </div>
                            </div>
                            <form method="post">
                                <input type="hidden" name="tampil" value="kelas">
                                SPP :
                                <select name="spp1" class="form-select" required>
                                    <option value="" hidden>Pilih SPP</option>
                                    <?php
                                    $query_0 = mysqli_query($koneksi, "SELECT * FROM spp ORDER BY tahun");
                                    while ($data_0 = mysqli_fetch_array($query_0)) {
                                    ?>
                                        <option value="<?php echo $data_0['id_spp']; ?>" <?php echo (!empty($_POST['spp1']) && $_POST['spp1'] == $data_0['id_spp'] ? 'selected' : '') ?>>
                                            <?= $data_0['tahun'] . " - " . "Rp " . number_format($data_0['nominal'], 0, ',', '.') . ",00" ?>
                                        </option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <br>
                                Kelas :
                                <?php
                                if (isset($_GET['id_kelas'])) {
                                    $id_kelas = $_GET['id_kelas'];

                                    $query_kelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id_kelas'");
                                    $data_kelas1 = mysqli_fetch_array($query_kelas);
                                ?>
                                    <input type="text" name="" class="form-control" value="<?= $data_kelas1['nama_kelas'] . " - " . $data_kelas1['kompetensi_dasar'] ?>" disabled>
                                    <input type="text" name="id_kelas" value="<?= $id_kelas ?>" hidden>
                                <?php
                                } else {
                                ?>
                                    <input type="text" name="" class="form-control" value="Silahkan Pilih Kelas" disabled>
                                <?php
                                }
                                ?>
                                <br><br><br><br><br><br><br>
                                <?php
                                if (isset($_GET['id_kelas'])) {
                                ?>
                                    <div align="center">
                                        <button type="submit" class="btn btn-primary btn-sm btn-rounded mt-3">Tampilkan</button>
                                    </div>
                                <?php
                                }
                                ?>

                            </form>
                            <div align="center">
                                <button data-bs-toggle="modal" data-bs-target="#datakelas" class="btn btn-success btn-sm">Pilih Kelas</button>
                                <button onclick="location.href='?page=laporan'" class="btn btn-danger btn-rounded btn-sm">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Riwayat Transaksi-->
                <?php if (isset($_POST['tampil']) && $_POST['tampil'] == 'siswa') {
                ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card-header">
                                    <div align="center">
                                        <h3>Laporan Pembayaran SPP</h3>
                                    </div>
                                    <?php
                                    if (isset($_POST['tampil']) && $_POST['tampil'] == 'siswa') {
                                        $tgl_awal = $_POST['tgl_awal'];
                                        $tgl_akhir = $_POST['tgl_akhir'];
                                        $spp = $_POST['spp'];

                                        if (isset($_GET['nisn'])) {
                                            $nisn_id = $_GET['nisn'];
                                        } else {
                                            $nisn_id = "";
                                        }

                                    ?>
                                        <a href="cetak_laporan.php?tgl_awal=<?= $tgl_awal ?>&tgl_akhir=<?= $tgl_akhir ?>&spp=<?= $spp ?>&nisn=<?= $nisn_id ?>&tampil=siswa" target="_blank" class="btn btn-primary btn-sm rounded"><i data-feather="printer"></i> Print</a>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <table class="table table-bordered table-striped table-hover cell-border" id="surat_masuk">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>Kelas</th>
                                            <th>SPP</th>
                                            <th>Jumlah Bayar</th>
                                            <th>Tanggal Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (isset($_POST['tampil']) && $_POST['tampil'] == 'siswa') {

                                            if ($tgl_awal != "" && $tgl_akhir != "" && $spp != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' AND tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "" && $tgl_akhir != "" && $spp != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' AND tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "" && $tgl_akhir != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "" && $spp != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' AND tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_akhir != "" && $spp != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' AND tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "" && $tgl_akhir != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "" && $spp != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' AND tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_akhir != "" && $spp != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' AND tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_akhir != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($spp != "" && isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_awal != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
                                            } elseif ($tgl_akhir != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
                                            } elseif ($spp != "") {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' ORDER BY id_pembayaran DESC");
                                            } elseif (isset($_GET['nisn'])) {
                                                $nisn = $_GET['nisn'];
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' ORDER BY id_pembayaran DESC");
                                            } else {
                                                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas ORDER BY id_pembayaran DESC");
                                            }

                                            while ($data = mysqli_fetch_array($query)) {

                                        ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $data['nis']; ?></td>
                                                    <td><?php echo $data['nama']; ?></td>
                                                    <td><?= $data['nama_kelas'] . " - " . $data['kompetensi_dasar'] ?></td>
                                                    <td><?= $data['tahun'] . " - " . "Rp " . number_format($data['nominal'], 0, ',', '.') . ",00" ?></td>
                                                    <td><?= "Rp " . number_format($data['jumlah_bayar'], 0, ',', '.') . ",00" ?></td>
                                                    <td><?php echo date('d-m-Y', strtotime($data['tgl_bayar'])); ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
                <!-- Kelas -->
                <?php if (isset($_POST['tampil']) && $_POST['tampil'] == 'kelas') {
                    $id = $_POST['id_kelas'];
                    $spp = $_POST['spp1'];

                    $kelas1 = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id'");
                    $array1 = mysqli_fetch_array($kelas1);
                ?>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="card-header">
                                    <div align="center">
                                        <h3>Laporan Pembayaran SPP Kelas <?= $array1['nama_kelas'] . " - " . $array1['kompetensi_dasar'] ?></h3>
                                    </div>
                                    <a href="cetak_laporan.php?id=<?= $id_kelas ?>&spp=<?= $spp ?>&tampil=kelas" target="_blank" class="btn btn-primary btn-sm rounded"><i data-feather="printer"></i> Print</a>
                                </div>
                                <table class="table table-bordered table-striped table-hover cell-border" id="surat_masuk">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>NISN</th>
                                            <th>NIS</th>
                                            <th>Nama</th>
                                            <th>SPP</th>
                                            <th>Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        if (isset($_POST['tampil']) && $_POST['tampil'] == 'kelas') {

                                            $query_kelas1 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id_kelas'");
                                            $query_transaksi = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp WHERE pembayaran.id_spp='$spp' AND siswa.id_kelas='$id' ORDER BY nama");
                                            $query_spp = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp='$spp'");

                                            while ($data = mysqli_fetch_array($query_kelas1)) {
                                                $data_transaksi = mysqli_fetch_array($query_transaksi);
                                                $nisn = $data['nisn'];

                                                $data_spp = mysqli_fetch_array($query_spp);


                                                if (!empty($data_transaksi['id_spp'])) {
                                                    $id_spp = $data_transaksi['id_spp'];
                                                    $cek = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_bayar FROM pembayaran WHERE nisn='$nisn' AND id_spp='$id_spp'");

                                                    $cek1 = mysqli_fetch_array($cek);
                                                    $cek2 = mysqli_num_rows($cek);
                                                    $total = $data_transaksi['nominal'] - $cek1['total_bayar'];
                                                    if ($total != 0) {
                                                        $hasil = "Kurang : Rp " . number_format($total, 2, ',', '.');
                                                    } else {
                                                        $hasil = "Lunas";
                                                    }
                                                } else {
                                                    $hasil = "(Belum Ada Riwayat Pembayaran)";
                                                }
                                        ?>
                                                <tr>
                                                    <td><?php echo $no++; ?></td>
                                                    <td><?php echo $data['nisn']; ?></td>
                                                    <td><?php echo $data['nis']; ?></td>
                                                    <td><?php echo $data['nama']; ?></td>
                                                    <td>
                                                        <?php
                                                        if (!empty($data_transaksi['id_spp'])) {
                                                            echo $data_transaksi['tahun'] . " - " . "Rp " . number_format($data_transaksi['nominal'], 0, ',', '.') . ",00";
                                                        } else {
                                                            echo $data_spp['tahun'] . " - " . "Rp " . number_format($data_spp['nominal'], 0, ',', '.') . ",00";
                                                        }

                                                        ?>
                                                    </td>
                                                    <td><?php echo $hasil ?></td>
                                                </tr>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal Pilih Kelas Done -->
<div class="modal fade" id="datakelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="col-12">
                    <div class="text-center">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Pilih Kelas</h1>
                        <button type="button" class="btn-close" style="float: right; margin-right: -20px; margin-top: -30px;" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
            </div>
            <div class="table">
                <table class="table table-bordered table-hover cell-border">
                    <thead class=" text-primary">
                        <th>No</th>
                        <th>Nama Kelas</th>
                        <th>Kompetensi</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        $pilih_kelas = mysqli_query($koneksi, "SELECT * FROM kelas");
                        $no = 1;

                        while ($data_kelas = mysqli_fetch_array($pilih_kelas)) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data_kelas['nama_kelas'] ?></td>
                                <td><?= $data_kelas['kompetensi_dasar'] ?></td>
                                <td><a href="?page=laporan&id_kelas=<?= $data_kelas['id_kelas'] ?>" class="btn btn-success btn-sm">Pilih</a></td>
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
                <table class="table table-bordered table-hover cell-border">
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
                                <td><a href="?page=laporan&nisn=<?= $data_siswa['nisn'] ?>" class="btn btn-success btn sm">Pilih</a></td>
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
    let table = new DataTable('table');
</script>