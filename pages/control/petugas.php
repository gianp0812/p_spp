<?php
include '../koneksi.php';


if (isset($_POST['tambahpetugas'])) {
    $nama = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $user_cek = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username'");
    $data_cek = mysqli_num_rows($user_cek);

    if ($data_cek == 0) {
        $query = mysqli_query($koneksi, "INSERT INTO petugas (nama_petugas, username, password, level) VALUES ('$nama','$username','$password','$level')");

        if ($query) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Ditambah';
            header('location:../?page=petugas');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'Username Sudah Ada';
        header('location:../?page=petugas');
    }
}

if (isset($_POST['editpetugas'])) {
    $id_petugas = $_POST['id_petugas'];
    $user_old = $_POST['user_old'];
    $nama = $_POST['nama_petugas'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $level = $_POST['level'];

    $cek_user = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username!='$user_old' AND username='$username'");
    $cek_data = mysqli_num_rows($cek_user);

    if ($cek_data == 0) {
        if ($_POST['password'] == '') {
            $query1 = mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama', username='$username', level='$level' WHERE id_petugas='$id_petugas'");
        } else {
            $query1 = mysqli_query($koneksi, "UPDATE petugas SET nama_petugas='$nama', username='$username', level='$level', password='$password' WHERE id_petugas='$id_petugas'");
        }

        if ($query1) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Diubah';
            header('location:../?page=petugas');
        }
    } else {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'Username Sudah Ada';
        header('location:../?page=petugas');
    }
}

if (isset($_POST['hapuspetugas'])) {
    $id_petugas = $_POST['id_petugas'];

    $query_del = mysqli_query($koneksi, "DELETE FROM petugas WHERE id_petugas='$id_petugas'");

    if ($query_del) {
        $_SESSION['status'] = 'success';
        $_SESSION['title'] = 'BERHASIL';
        $_SESSION['text'] = 'Data Berhasil Dihapus';
        header('location:../?page=petugas');
    }
}
