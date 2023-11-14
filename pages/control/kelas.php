<?php
include '../koneksi.php';

if (isset($_POST['tambahkelas'])) {
    $nama = $_POST['nama_kelas'];
    $komp = $_POST['kompetensi'];

    $cek = mysqli_query($koneksi, "SELECT * FROM kelas WHERE nama_kelas='$nama' AND kompetensi_dasar='$komp'");

    if (mysqli_num_rows($cek) == 0) {
        $query = mysqli_query($koneksi, "INSERT INTO kelas (nama_kelas, kompetensi_dasar) VALUES ('$nama','$komp')");

        if ($query) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Ditambah';
            header('location:../?page=kelas');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'Kelas Sudah Ada';
        header('location:../?page=kelas');
    }
}

if (isset($_POST['editkelas'])) {
    $id = $_POST['id_kelas'];
    $nama = $_POST['nama_kelas'];
    $komp = $_POST['kompetensi'];

    $cek = mysqli_query($koneksi, "SELECT * FROM kelas WHERE id_kelas!='$id' AND nama_kelas='$nama' AND kompetensi_dasar='$komp'");

    if (mysqli_num_rows($cek) == 0) {
        $query1 = mysqli_query($koneksi, "UPDATE kelas SET nama_kelas='$nama', kompetensi_dasar='$komp' WHERE id_kelas='$id'");

        if ($query1) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Diubah';
            header('location:../?page=kelas');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'Kelas Sudah Ada';
        header('location:../?page=kelas');
    }
}
if (isset($_POST['hapuskelas'])) {
    $id = $_POST['id_kelas'];

    $query2 = mysqli_query($koneksi, "DELETE FROM kelas WHERE id_kelas='$id'");

    if ($query2) {
        $_SESSION['status'] = 'success';
        $_SESSION['title'] = 'BERHASIL';
        $_SESSION['text'] = 'Data Berhasil Dihapus';
        header('location:../?page=kelas');
    }
}
