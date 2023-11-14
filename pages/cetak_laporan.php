<script>
    function myFunction() {
        window.print();
    }
</script>

<style>
    @media print {
        .button {
            display: none;
        }
    }
</style>

<?php
include 'koneksi.php';
if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "petugas" || !empty($_SESSION['user'] && isset($_SESSION['user']['nisn']))) {
?>
    <script>
        location.reload();
        alert("Anda Tidak Berhak Mengakses Halaman Ini");
        window.history.back();
    </script>
<?php
}
?>

<center>
    <input style="margin-bottom: 20px; margin-right: 10px; padding:5px;" value="Print Document" type="button" onclick="myFunction()" class="button"></input>
</center>

<?php
if (isset($_GET['tampil']) && $_GET['tampil'] == 'siswa') {
    $tgl_awal = $_GET['tgl_awal'];
    $tgl_akhir = $_GET['tgl_akhir'];
    $spp = $_GET['spp'];
    $nisn = $_GET['nisn'];

?>
    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th colspan="9">Cetak Laporan Riwayat Transaksi</th>
        </tr>
        <tr>
            <th>Nomor</th>
            <th>Id Transaksi</th>
            <th>Tanggal Transaksi</th>
            <th>Nama Siswa</th>
            <th>NISN - NIS</th>
            <th>Kelas</th>
            <th>Nama Petugas</th>
            <th>SPP</th>
            <th>Jumlah Bayar</th>
        </tr>
        <tbody>
            <?php
            $no = 1;

            if ($tgl_awal != "" && $tgl_akhir != "" && $spp != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' AND tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "" && $tgl_akhir != "" && $spp != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' AND tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "" && $tgl_akhir != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "" && $spp != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' AND tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_akhir != "" && $spp != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' AND tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "" && $tgl_akhir != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE tgl_bayar BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "" && $spp != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' AND tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_akhir != "" && $spp != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' AND tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_akhir != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($spp != "" && $nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' AND pembayaran.id_spp='$spp' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_awal != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE tgl_bayar>='$tgl_awal' ORDER BY id_pembayaran DESC");
            } elseif ($tgl_akhir != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE tgl_bayar<='$tgl_akhir' ORDER BY id_pembayaran DESC");
            } elseif ($spp != "") {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN  petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.id_spp='$spp' ORDER BY id_pembayaran DESC");
            } elseif ($nisn != "") {

                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$nisn' ORDER BY id_pembayaran DESC");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas ORDER BY id_pembayaran DESC");
            }

            while ($data = mysqli_fetch_array($query)) {

            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $data['id_pembayaran']; ?></td>
                    <td><?= date('d-m-Y', strtotime($data['tgl_bayar'])); ?></td>
                    <td><?= $data['nama']; ?></td>
                    <td><?= $data['nisn'] . " - " . $data['nis'] ?></td>
                    <td><?= $data['nama_kelas'] . " = " . $data['kompetensi_dasar'] ?></td>
                    <td><?= $data['nama_petugas'] ?></td>
                    <td><?= $data['tahun'] . " - " . "Rp " . number_format($data['nominal'], 0, ',', '.') . ",00" ?></td>
                    <td><?= "Rp " . number_format($data['jumlah_bayar'], 0, ',', '.') . ",00" ?></td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
<?php
} elseif (isset($_GET['tampil']) && $_GET['tampil'] == 'kelas') {
    $id = $_GET['id'];
    $spp = $_GET['spp'];

    $query_kelas = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas='$id'");
    $data_kelas = mysqli_fetch_array($query_kelas);

?>

    <table border="1" width="100%" cellpadding="5" cellspacing="0">
        <tr>
            <th colspan="9">Cetak Laporan Pembayaran SPP Kelas <?= $data_kelas['nama_kelas'] . " - " . $data_kelas['kompetensi_dasar'] ?></th>
        </tr>
        <tr>
            <th>No</th>
            <th>NISN</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>SPP</th>
            <th>Pembayaran</th>
        </tr>
        <tbody>
            <?php
            $no = 1;

            $query = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_kelas='$id'");
            $query_transaksi = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp WHERE pembayaran.id_spp='$spp' AND siswa.id_kelas='$id' ORDER BY nama");
            $query_spp = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp='$spp'");

            while ($data = mysqli_fetch_array($query)) {
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
            ?>
        </tbody>
    </table>
<?php
}
?>