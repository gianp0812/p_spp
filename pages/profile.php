<?php
if ($role == 'siswa') {
    if (isset($_POST['no_telp'])) {
        $nisn = $_SESSION['user']['nisn'];
        $notelp = $_POST['no_telp'];
        $alamat = $_POST['alamat'];
        $password = md5($_POST['password']);

        if ($_POST['password'] == "") {
            $query = mysqli_query($koneksi, "UPDATE siswa SET alamat='$alamat', no_telp='$notelp' WHERE nisn='$nisn'");
            $session = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
        } else {
            $query = mysqli_query($koneksi, "UPDATE siswa SET alamat='$alamat', no_telp='$notelp', password='$password' WHERE nisn='$nisn'");
            $session = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nisn='$nisn'");
        }
        if ($query) {
            $_SESSION['user'] = mysqli_fetch_array($session);
            echo '<script>alert("Berhasil Mengupdate Data");location.href="?page=profile";</script>';
        }
    }
} else {
    if (isset($_POST['username'])) {
        $id_petugas = $_SESSION['user']['id_petugas'];
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        if ($_POST['password'] == "") {
            $query = mysqli_query($koneksi, "UPDATE petugas SET username='$username' WHERE id_petugas='$id_petugas'");
            $session = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
        } else {
            $query = mysqli_query($koneksi, "UPDATE petugas SET username='$username', password='$password' WHERE id_petugas='$id_petugas'");
            $session = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$id_petugas'");
        }
        if ($query) {
            $_SESSION['user'] = mysqli_fetch_array($session);
            echo '<script>alert("Berhasil Mengupdate Data");location.href="?page=profile";</script>';
        }
    }
}




?>

<div class="text-center">
    <h3>Profile <?= ($role == 'siswa' ? "Siswa" : "User") ?></h3>
</div>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card stacked-form">
                    <div class="card-header ">
                        <h4 class="card-title">Profil</h4>
                    </div>
                    <div class="card-body ">
                        <?php
                        if ($role == 'siswa') {
                            $id = $_SESSION['user']['nisn'];
                            $querydata = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nisn='$id'");
                        } elseif ($role) {
                            $id = $_SESSION['user']['id_petugas'];
                            $querydata = mysqli_query($koneksi, "SELECT * FROM petugas WHERE id_petugas='$id'");
                        }

                        $data = mysqli_fetch_array($querydata);

                        if ($role == 'siswa') {

                        ?>
                            <form method="post">
                                <div class="form-group">
                                    <label>Nisn</label>
                                    <input type="text" class="form-control" value=" <?= $data['nisn'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>NIS</label>
                                    <input type="text" class="form-control" value=" <?= $data['nis'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" class="form-control" value=" <?= $data['nama'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Kelas</label>
                                    <input type="text" class="form-control" value=" <?= $data['nama_kelas'] . " - " . $data['kompetensi_dasar'] ?>" disabled>
                                </div>
                            </form>
                        <?php
                        } else {
                        ?>
                            <form method="post">
                                <div class="form-group">
                                    <label>Nama Petugas</label>
                                    <input type="text" class="form-control" value=" <?= $data['nama_petugas'] ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Level</label>
                                    <input type="text" class="form-control" value=" <?= $data['level'] ?>" disabled>
                                </div>
                            </form>

                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card stacked-form">
                    <div class="card-header ">
                        <h4 class="card-title">Edit Profil</h4>
                    </div>
                    <div class="card-body ">
                        <form method="post">
                            <?php
                            if ($role == 'siswa') {
                            ?>
                                <div class="form-group">
                                    <label>No Telp</label>
                                    <input type="number" class="form-control" name="no_telp" value="<?= $data['no_telp'] ?>" required>
                                </div>
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <div>
                                        <textarea name="alamat" id="" cols="69" rows="10" required><?= $data['alamat'] ?></textarea>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" value="<?= $data['username'] ?>" required>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" value="">
                            </div>
                    </div>
                    <div class="card-footer ">
                        <div class="col-md-9">
                            <button type="submit" class="btn btn-fill btn-info mr-3">Edit</button>
                            <button type="reset" class="btn btn-fill btn-danger">Reset</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>