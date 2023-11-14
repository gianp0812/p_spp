<?php
include '../koneksi.php';
$petugas = $_SESSION['user']['id_petugas'];

if (isset($_POST['nominal'])) {
    $nisn = $_POST['nisn'];
    $tgl = $_POST['tanggal'];
    $bln = $_POST['bulan'];
    $thn = $_POST['tahun'];
    $spp = $_POST['spp'];
    $nominal = $_POST['nominal'];

    $cek = mysqli_query($koneksi, "SELECT * FROM spp WHERE id_spp='$spp'");
    $cek_spp = mysqli_fetch_array($cek);

    if ($nominal > $cek_spp['nominal']) {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'Jumlah Bayar Melebihi Nominal SPP';
        header('location: ../?page=bayar_spp');
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO pembayaran (id_petugas, nisn, tgl_bayar, bulan_bayar, tahun_bayar, id_spp, jumlah_bayar) VALUES ('$petugas', '$nisn', '$tgl', '$bln', '$thn', '$spp', '$nominal')");

        if ($query) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Ditambah';
            header('location: ../bukti_bayar.php');
        }
    }
}
