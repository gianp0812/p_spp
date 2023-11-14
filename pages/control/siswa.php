<?php
include '../koneksi.php';

if (isset($_POST['tambahsiswa'])) {
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $password = md5($_POST['password']);

    $cek1 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
    $cek_nisn = mysqli_num_rows($cek1);
    $cek2 = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$nis'");
    $cek_nis = mysqli_num_rows($cek2);

    if ($cek_nisn >= 1 || $cek_nis >= 1) {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'NISN/NIS Sudah Ada';
        header('location:../?page=siswa');
    } else {
        $query = mysqli_query($koneksi, "INSERT INTO siswa (nisn, nis, nama, id_kelas, alamat, no_telp, password) VALUES ('$nisn','$nis','$nama','$kelas','$alamat','$no_telp','$password')");

        if ($query) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Ditambah';
            header('location:../?page=siswa');
        }
    }
}

if (isset($_POST['editsiswa'])) {
    $nisn_old = $_POST['id'];
    $nis_old = $_POST['id2'];
    $nisn = $_POST['nisn'];
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $kelas = $_POST['kelas'];
    $alamat = $_POST['alamat'];
    $no_telp = $_POST['no_telp'];
    $password = md5($_POST['password']);

    $cek_nisn = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn!='$nisn_old' AND nisn='$nisn'");
    $cek_nis = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis!='$nis_old' AND nis='$nis'");
    $cek1 = mysqli_num_rows($cek_nisn);
    $cek2 = mysqli_num_rows($cek_nis);

    if ($cek1 == 0 && $cek2 == 0) {
        if ($_POST['password'] == "") {
            $query = mysqli_query($koneksi, "UPDATE siswa SET nisn='$nisn',nis='$nis',nama='$nama',id_kelas='$kelas', alamat='$alamat' WHERE nisn='$nisn_old'");
        } else {
            $query = mysqli_query($koneksi, "UPDATE siswa SET nisn='$nisn',nis='$nis',nama='$nama',id_kelas='$kelas', alamat='$alamat', no_telp='$no_telp', password='$password' WHERE nisn='$nisn_old'");
        }
        if ($query) {
            $_SESSION['status'] = 'success';
            $_SESSION['title'] = 'BERHASIL';
            $_SESSION['text'] = 'Data Berhasil Diubah';
            header('location:../?page=siswa');
        }
    } elseif ($cek1 != 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'NISN Sudah Ada';
        header('location:../?page=siswa');
    } elseif ($cek2 != 0) {
        $_SESSION['status'] = 'error';
        $_SESSION['title'] = 'KESALAHAN';
        $_SESSION['text'] = 'NIS Sudah Ada';
        header('location:../?page=siswa');
    }
}


if (isset($_POST['hapussiswa'])) {
    $id = $_POST['nisn'];

    $query2 = mysqli_query($koneksi, "DELETE FROM siswa WHERE nisn='$id'");

    if ($query2) {
        $_SESSION['status'] = 'success';
        $_SESSION['title'] = 'BERHASIL';
        $_SESSION['text'] = 'Data Berhasil Dihapus';
        header('location:../?page=siswa');
    }
}
