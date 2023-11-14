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

<!-- End Navbar -->
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-center">Petugas</h4>
        </div>
        <div class="ml-3 mb-3">
          <button data-bs-toggle="modal" data-bs-target="#tambahpetugas" class="btn btn-success btn-sm">+ Tambah Petugas</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover cell-border" id="petugas">
              <thead class=" text-primary text-center">
                <th>NO</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Level</th>
                <th class="text-right">Action</th>
              </thead>

              <tbody class="text-center">
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM petugas");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama_petugas'] ?></td>
                    <td><?= $data['username'] ?></td>
                    <td><?= ucwords($data['level']) ?></td>
                    <td class="text-right">
                      <button data-bs-toggle="modal" data-bs-target="#editpetugas<?= $data['id_petugas'] ?>" class="btn btn-warning btn-sm mr-1"><i class="nc-icon nc-settings"></i></button>
                      <button data-bs-toggle="modal" data-bs-target="#hapuspetugas<?= $data['id_petugas'] ?>" class="btn btn-danger btn-sm"><i class="nc-icon nc-box"></i></button>
                    </td>
                  </tr>

                  <!-- Modal Edit -->
                  <div class="modal fade" id="editpetugas<?= $data['id_petugas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit Petugas</h1>
                            </div>
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="control/petugas.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="id_petugas" value="<?= $data['id_petugas'] ?>">
                              <input type="hidden" name="user_old" value="<?= $data['username'] ?>">
                              <h6>Nama Petugas</h6>
                              <div>
                                <input type="text" name="nama_petugas" class="form-control mb-3" value="<?= $data['nama_petugas'] ?>" required>
                              </div>
                            </div>
                            <div class="mb-3">
                              <h6>Username</h6>
                              <div>
                                <input type="text" name="username" class="form-control mb-3" value="<?= $data['username'] ?>" required>
                              </div>
                              <div class="mb-3">
                                <h6>Password</h6>
                                <div>
                                  <input type="password" name="password" class="form-control mb-3">
                                </div>
                              </div>
                              <div class="mb-3">
                                <h6>Level</h6>
                                <div>
                                  <select name="level" class="form-select mb-3">
                                    <option value="admin" <?= ($data['level'] == 'admin ' ? 'selected' : '') ?>>Admin</option>
                                    <option value="petugas" <?= ($data['level'] == 'petugas' ? 'selected' : '') ?>>Petugas</option>
                                  </select>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer">
                              <div class="col-12">
                                <div class="text-center">
                                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary" name="editpetugas">Simpan</button>
                                </div>
                              </div>
                            </div>
                          </div>
                      </div>
                    </div>
                    </form>
                  </div>
          </div>
        </div>



        <!-- Modal Hapus -->
        <div class="modal fade" id="hapuspetugas<?php echo $data['id_petugas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="col-12">
                  <div class="text-center">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Petugas</h1>
                  </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="control/petugas.php" method="post">
                <div class="modal-body">
                  <div class="mb-3">
                    <input type="hidden" name="id_petugas" value="<?php echo $data['id_petugas'] ?>">
                    <div class="text-center">
                      <span>Yakin Hapus Data ?</span><br>
                      <span class="text-danger">Nama Petugas - <span><?php echo $data['nama_petugas'] ?></span></span>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <div class="col-12">
                    <div class="text-center">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-primary" name="hapuspetugas">Hapus</button>
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
<footer class="footer footer-black  footer-white ">
  <hr>
</footer>

<script>
  let table = new DataTable('#petugas');
</script>


<!-- Modal Tambah -->
<div class="modal fade" id="tambahpetugas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-12">
          <div class="text-center">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Petugas</h1>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="control/petugas.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Petugas</label>
            <div>
              <input type="text" name="nama_petugas" class="form-control mb-3" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Username</label>
              <div>
                <input type="text" name="username" class="form-control mb-3" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Password</label>
                <div>
                  <input type="password" name="password" class="form-control mb-3" required>
                </div>
                <div class="mb-3">
                  <label class="form-label">Level</label>
                  <div>
                    <select name="level" class="form-select mb-3" required>
                      <option hidden value="">-Pilih Level Akses-</option>
                      <option>admin</option>
                      <option>petugas</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <div class="col-12">
                  <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambahpetugas">Simpan</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>