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
          <h4 class="card-title text-center">Kelas</h4>
        </div>
        <div class="ml-3 mb-3">
          <button data-bs-toggle="modal" data-bs-target="#tambahkelas" class="btn btn-success btn-sm">+ Tambah Kelas</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover cell-border" id="kelas">
              <thead class=" text-primary text-center">
                <th>NO</th>
                <th>Nama Kelas</th>
                <th>Kompetensi Dasar</th>
                <th class="text-right">Action</th>
              </thead>

              <tbody class="text-center">
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM kelas");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nama_kelas'] ?></td>
                    <td><?= $data['kompetensi_dasar'] ?></td>
                    <td class="text-right">
                      <button data-bs-toggle="modal" data-bs-target="#editkelas<?= $data['id_kelas'] ?>" class="btn btn-warning btn-sm mr-1"><i class="nc-icon nc-settings"></i></button>
                      <button data-bs-toggle="modal" data-bs-target="#hapuskelas<?= $data['id_kelas'] ?>" class="btn btn-danger btn-sm"><i class="nc-icon nc-box"></i></button>
                    </td>
                  </tr>


                  <!-- Modal Edit -->
                  <div class="modal fade" id="editkelas<?= $data['id_kelas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kelas</h1>
                            </div>
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="control/kelas.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="id_kelas" value="<?= $data['id_kelas'] ?>">
                              <h6>Nama Kelas</h6>
                              <div>
                                <input type="text" name="nama_kelas" class="form-control mb-3" value="<?= $data['nama_kelas'] ?>" required>
                              </div>
                              <div class="mb-3">
                                <h6>Kompetensi Dasar</h6>
                                <div>
                                  <input type="text" name="kompetensi" class="form-control mb-3" value="<?= $data['kompetensi_dasar'] ?>" required>
                                </div>
                                <div class="modal-footer">
                                  <div class="col-12">
                                    <div class="text-center">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" name="editkelas">Simpan</button>
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
                  <div class="modal fade" id="hapuskelas<?php echo $data['id_kelas'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus Kelas</h1>
                            </div>
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="control/kelas.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="id_kelas" value="<?php echo $data['id_kelas'] ?>">
                              <div class="text-center">
                                <span>Yakin Hapus Data ?</span><br>
                                <span class="text-danger"><?php echo $data['nama_kelas'] ?> - <span><?php echo $data['kompetensi_dasar'] ?></span></span>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <div class="col-12">
                              <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="hapuskelas">Hapus</button>
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
  let table = new DataTable('#kelas');
</script>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahkelas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-12">
          <div class="text-center">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Kelas</h1>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="control/kelas.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Nama Kelas</label>
            <div>
              <input type="text" name="nama_kelas" class="form-control mb-3" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Kompetensi Dasar</label>
              <div>
                <input type="text" name="kompetensi" class="form-control mb-3" required>
              </div>
              <div class="modal-footer">
                <div class="col-12">
                  <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambahkelas">Simpan</button>
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