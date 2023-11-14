<?php
include '../koneksi.php';

if (isset($_POST['tambahspp'])) {
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];

    $cek = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun='$tahun'");
    $data_cek = mysqli_num_rows($cek);

    if ($data_cek == 0) {
        $query = mysqli_query($koneksi, "INSERT INTO spp (tahun, nominal) VALUES ('$tahun','$nominal')");

        if ($query) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Ditambah';
            header('location:../?page=spp');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'Kesalahan';
        $_SESSION['text'] = 'SPP Tahun ' . $tahun . ' Sudah Ada';
        header('location:../?page=spp');
    }
}

if (isset($_POST['editspp'])) {
    $id = $_POST['id_spp'];
    $tahun_old = $_POST['tahun_old'];
    $tahun = $_POST['tahun'];
    $nominal = $_POST['nominal'];

    $query_cek = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun!='$tahun_old' AND tahun='$tahun'");
    $tahun_cek = mysqli_num_rows($query_cek);

    if ($tahun_cek == 0) {
        $query1 = mysqli_query($koneksi, "UPDATE spp SET tahun='$tahun', nominal='$nominal' WHERE id_spp='$id'");

        if ($query1) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Diubah';
            header('location:../?page=spp');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'SPP Tahun ' . $tahun . ' Sudah Ada';
        header('location:../?page=spp');
    }
}
if (isset($_POST['hapusspp'])) {
    $id = $_POST['id_spp'];

    $query2 = mysqli_query($koneksi, "DELETE FROM spp WHERE id_spp='$id'");

    if ($query2) {
        $_SESSION['status'] = 'success';
        $_SESSION['title'] = 'BERHASIL';
        $_SESSION['text'] = 'Data Berhasil Dihapus';
        header('location:../?page=spp');
    }
}
