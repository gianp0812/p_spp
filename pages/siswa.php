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
?>

<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-center">Siswa</h4>
        </div>
        <?php
        if ($_SESSION['user']['level'] == 'admin') {
        ?>
          <div class="ml-3 mb-3">
            <button data-bs-toggle="modal" data-bs-target="#tambahsiswa" class="btn btn-success btn-sm mr-3">+ Tambah Siswa</button>
            <form method="post">
              <input type="text" name="cari" placeholder="Cari Nama Siswa..." value="<?= (!empty($_POST['cari']) ? $_POST['cari'] : '') ?>">
              <button type="submit" class="btn btn-info btn-sm"><i class="nc-icon nc-zoom-split"></i></button>
              <a href="?page=siswa" class="btn btn-danger btn-sm"><i class="nc-icon nc-simple-remove"></i></a>
            </form>
          </div>
        <?php
        }
        ?>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover cell-border" id="siswa">
              <thead class="text-primary text-center">
                <th>NO</th>
                <th>NISN</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>SPP</th>
                <th <?= ($_SESSION['user']['level'] != 'admin' ? 'hidden' : '')  ?>>Action</th>
              </thead>

              <tbody class="text-center">
                <?php
                $no = 1;
                if (isset($_POST['cari'])) {
                  $cari_nama = $_POST['cari'];
                  $query = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE nama LIKE '%$cari_nama%'");
                } else {
                  $query = mysqli_query($koneksi, "SELECT * FROM siswa INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas");
                }
                while ($data = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nisn'] ?></td>
                    <td><?= $data['nis'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['nama_kelas'] . ' - ' . $data['kompetensi_dasar'] ?></td>
                    <td><?= $data['alamat'] ?></td>
                    <td><?= $data['no_telp'] ?></td>
                    <td>
                      <a href="?page=bayar_spp&id=<?= $data['nisn'] ?>" class="btn btn-success btn-sm">Bayar</a>
                      <a href="?page=detail_bayar&id=<?= $data['nisn'] ?>" class="btn btn-success btn-sm"><i class="nc-icon nc-align-left-2"></i> Riwayat</a>
                    </td>
                    <td class="text-right" <?= ($_SESSION['user']['level'] != 'admin' ? 'hidden' : '')  ?>>
                      <button data-bs-toggle="modal" data-bs-target="#editsiswa<?= $data['nisn'] ?>" class="btn btn-warning btn-sm mr-1"><i class="nc-icon nc-settings"></i></button>
                      <button data-bs-toggle="modal" data-bs-target="#hapussiswa<?= $data['nisn'] ?>" class="btn btn-danger btn-sm"><i class="nc-icon nc-box"></i></button>
                    </td>
                  </tr>


                  <!-- Modal Edit -->
                  <div class="modal fade" id="editsiswa<?= $data['nisn'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Siswa</h1>
                              <button type="button" class="btn-close" style="float: right; margin-right: -20px; margin-top: -30px;" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          </div>
                        </div>
                        <form action="control/siswa.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="id" value="<?= $data['nisn'] ?>">
                              <input type="hidden" name="id2" value="<?= $data['nis'] ?>">
                              <label class="form-label">NISN</label>
                              <div>
                                <input type="number" name="nisn" class="form-control mb-3" value="<?= $data['nisn'] ?>" required>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <div>
                                  <input type="number" name="nis" class="form-control mb-3" value="<?= $data['nis'] ?>" required>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <div>
                                  <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama'] ?>" required>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <div>
                                  <select name="kelas" class="form-select" required>

                                    <?php
                                    $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");

                                    while ($da_kelas = mysqli_fetch_array($kelas)) {

                                    ?>

                                      <option value="<?= $da_kelas['id_kelas'] ?>" <?php if ($data['id_kelas'] == $da_kelas['id_kelas']) {
                                                                                      echo 'selected';
                                                                                    } ?>>
                                        <?= $da_kelas['nama_kelas'] . " - " . $da_kelas['kompetensi_dasar'] ?>
                                      </option>

                                    <?php
                                    }
                                    ?>
                                  </select>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Alamat</label>
                                <div>
                                  <textarea name="alamat" rows="5" cols="59" required><?= $data['alamat'] ?></textarea>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">No Telp</label>
                                <div>
                                  <input type="number" name="no_telp" class="form-control mb-3" value="<?= $data['no_telp'] ?>" required>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Password</label>
                                <div>
                                  <input type="password" name="password" class="form-control mb-3">
                                </div>
                              </div>
                              <div class="modal-footer">
                                <div class="col-12">
                                  <div class="text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="editsiswa">Simpan</button>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                      </form>
                    </div>
                  </div>






                  <!-- Modal Hapus -->
                  <div class="modal fade" id="hapussiswa<?php echo $data['nisn'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Kelas</h1>
                              <button type="button" class="btn-close" style="float: right; margin-right: -20px; margin-top: -30px;" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          </div>
                        </div>
                        <form action="control/siswa.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="nisn" value="<?php echo $data['nisn'] ?>">
                              <div class="text-center">
                                <span>Yakin Hapus Data ?</span><br>
                                <span class="text-danger">Nama Siswa - <span><?php echo $data['nama'] ?></span></span>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <div class="col-12">
                              <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="hapussiswa">Hapus</button>
                              </div>
                            </div>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

                <?php
                }
                ?>
              </tbody>

            </table>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer class="footer footer-black  footer-white mb-">
  <hr>
</footer>

<script>
  let table = new DataTable('#siswa');
</script>



<!-- Modal Tambah -->
<div class="modal fade" id="tambahsiswa" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-12">
          <div class="text-center">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Siswa</h1>
            <button type="button" class="btn-close" style="float: right; margin-right: -20px; margin-top: -30px;" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        </div>
      </div>
      <form action="control/siswa.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">NISN</label>
            <div>
              <input type="number" name="nisn" class="form-control mb-3" required>
            </div>
            <div class="mb-3">
              <label class="form-label">NIS</label>
              <div>
                <input type="number" name="nis" class="form-control mb-3" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Nama</label>
              <div>
                <input type="text" name="nama" class="form-control mb-3" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Kelas</label>
              <div>
                <select name="kelas" class="form-select" required>
                  <option value="" hidden>-Pilih Kelas-</option>

                  <?php
                  $kelas = mysqli_query($koneksi, "SELECT * FROM kelas");

                  while ($da_kelas = mysqli_fetch_array($kelas)) {

                  ?>

                    <option value="<?= $da_kelas['id_kelas'] ?>">
                      <?= $da_kelas['nama_kelas'] . " - " . $da_kelas['kompetensi_dasar'] ?>
                    </option>

                  <?php
                  }
                  ?>
                </select>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Alamat</label>
              <div>
                <textarea name="alamat" rows="5" cols="59" required></textarea>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">No Telp</label>
              <div>
                <input type="number" name="no_telp" class="form-control mb-3" required>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <div>
                <input type="password" name="password" class="form-control mb-3" required>
              </div>
            </div>
            <div class="modal-footer">
              <div class="col-12">
                <div class="text-center">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary" name="tambahsiswa">Simpan</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>