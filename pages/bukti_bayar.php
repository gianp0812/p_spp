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
if (!empty($_SESSION['user']['nisn'])) {
?>
    <script>
        location.reload();
        alert("Anda Tidak Berhak Mengakses Halaman Ini");
        window.history.back();
    </script>
<?php
}

include 'koneksi.php';

$query1 = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN siswa ON pembayaran.nisn=siswa.nisn INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER JOIN spp ON pembayaran.id_spp=spp.id_spp ORDER BY id_pembayaran DESC");
$data1 = mysqli_fetch_array($query1);

$id = $data1['id_pembayaran'];
$id_spp = $data1['id_spp'];
$nisn = $data1['nisn'];

$query = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_bayar FROM pembayaran WHERE nisn='$nisn' AND id_pembayaran!='$id' AND id_spp='$id_spp' ORDER BY id_pembayaran DESC");
$cek = mysqli_num_rows($query);

$data = mysqli_fetch_array($query);




?>
<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class='print' style="border: 1px solid #a1a1a1; width: 300px; background: white; padding: 10px; margin: 0 auto; text-align: center;">

                <div class="invoice-title" align="center">

                    <h1>Pembayaran SPP</h1>
                </div>

                <div class="invoice-title">
                    <div align="left">Tanggal Transaski <b><?= date("d - m - Y", strtotime($data1['tgl_bayar'])) ?></b></div>
                    <br>
                    <div align="right">No. Transaksi <b><?= $data1['id_pembayaran'] ?></b></div>
                </div>
                </br>

                <div class="invoice-title" align="left">
                    SPP Tahun &nbsp; &nbsp;<b> <?= $data1['tahun'] ?></b><br>
                    Nominal &nbsp; &nbsp;<b><?= "Rp " . number_format($data1['nominal'], 0, ',', '.') . ",00" ?></b>
                </div>
                <br>
                <hr>




                <div>
                    <div>
                        <table class="table table-condensed">
                            <tr>
                                <td class="text-right">Diterima Dari : </td>
                                <td class="text-center"><b><?= $data1['nama'] ?></b></td>
                            </tr>
                        </table>
                        <hr>

                        <table class="table table-condensed">
                            <tr>
                                <td class="text-center">Jumlah Bayar :</td>
                                <td></td>
                                <td class="text-center">
                                    <b><?php
                                        if ($cek = 0) {
                                            echo "Rp " . number_format($data1['jumlah_bayar'], 0, ',', '.') . ",00";
                                        } else {
                                            echo "Rp " . number_format($data1['jumlah_bayar'] + $data['total_bayar'], 0, ',', '.') . ",00";
                                        }
                                        ?></b>
                                </td>
                            </tr>
                        </table>
                        <hr>
                        <table class="table table-condensed" align="center">
                            <thead>
                                <?php
                                if ($cek = 0) {
                                    $jumlah = $data1['jumlah_bayar'];
                                } else {
                                    $jumlah = $data1['jumlah_bayar'] + $data['total_bayar'];
                                }
                                $kurang = $data1['nominal'] - $jumlah;

                                if ($kurang != "0") {
                                ?>
                                    <tr>
                                        <td class="text-center"></td>
                                        <td class="text-center">Kurang :</td>
                                        <td class="text-right"><b><?= "Rp " . number_format($kurang, 0, ',', '.') . ",00" ?></b></td>
                                    </tr>

                                <?php
                                } else {
                                ?>
                                    <th class="text-right"><b><strong>LUNAS</strong></b></th>
                                <?php
                                }
                                ?>
                            </thead>

                        </table>
                        <hr>
                    </div>
                </div>
                <br>
                <br>
                <br>
                <div align="right">
                    &nbsp;&nbsp;<b></b>
                </div>
                <div align="right">
                    &nbsp;&nbsp; <b></b>
                </div>
                <div align="right">
                    Petugas : &nbsp;&nbsp; <b><?= $data1['nama_petugas'] ?></b>
                </div>
            </div>
            <div>
                <div align="center" style="margin-top: 40px;">
                    <input style="padding:5px;" value="Print Document" type="button" onclick="myFunction()" class="button"></input>
                    <br>
                    <br>
                    <a href="index.php?page=bayar_spp" class="button">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
if (isset($_SESSION['status'])) {
?>
    <script>
        Swal.fire({
            icon: "<?php echo $_SESSION['status'] ?>",
            title: "<?php echo $_SESSION['title'] ?>",
            text: "<?php echo $_SESSION['text'] ?>",
        })
    </script>
<?php
    unset($_SESSION['status']);
}
?>