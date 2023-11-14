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
          <h4 class="card-title text-center">SPP</h4>
        </div>
        <div class="ml-3 mb-3">
          <button data-bs-toggle="modal" data-bs-target="#tambahspp" class="btn btn-success btn-sm mr-1">+ Tambah SPP</button>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover cell-border" id="spp">
              <thead class="text-primary text-center">
                <th>NO</th>
                <th>Tahun</th>
                <th>Nominal</th>
                <th class="text-right">Action</th>
              </thead>

              <tbody class="text-center">
                <?php
                $no = 1;
                $query = mysqli_query($koneksi, "SELECT * FROM spp");
                while ($data = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['tahun'] ?></td>
                    <td><?= "Rp " . number_format($data['nominal'], 0, ',', '.') . ",00" ?></td>
                    <td class="text-right">
                      <button data-bs-toggle="modal" data-bs-target="#editspp<?= $data['id_spp'] ?>" class="btn btn-warning btn-sm mr-1"><i class="nc-icon nc-settings"></i></button>
                      <button data-bs-toggle="modal" data-bs-target="#hapusspp<?= $data['id_spp'] ?>" class="btn btn-danger btn-sm"><i class="nc-icon nc-box"></i></button>
                    </td>
                  </tr>


                  <!-- Modal Edit -->
                  <div class="modal fade" id="editspp<?= $data['id_spp'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit SPP</h1>
                            </div>
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="control/spp.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="id_spp" value="<?= $data['id_spp'] ?>">
                              <input type="hidden" name="tahun_old" value="<?= $data['tahun'] ?>">
                              <h6>Tahun</h6>
                              <div>
                                <input type="text" name="tahun" class="form-control mb-3" value="<?= $data['tahun'] ?>" required>
                              </div>
                              <div class="mb-3">
                                <h6>Nominal</h6>
                                <div>
                                  <input type="number" name="nominal" min="1000000" class="form-control mb-3" value="<?= $data['nominal'] ?>" required>
                                </div>
                                <div class="modal-footer">
                                  <div class="col-12">
                                    <div class="text-center">
                                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-primary" name="editspp">Simpan</button>
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
                  <div class="modal fade" id="hapusspp<?php echo $data['id_spp'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Hapus SPP</h1>
                            </div>
                          </div>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="control/spp.php" method="post">
                          <div class="modal-body">
                            <div class="mb-3">
                              <input type="hidden" name="id_spp" value="<?php echo $data['id_spp'] ?>">
                              <div class="text-center">
                                <span>Yakin Hapus Data ?</span><br>
                                <span class="text-danger"><?php echo $data['tahun'] ?> - <span><?php echo $data['nominal'] ?></span></span>
                              </div>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <div class="col-12">
                              <div class="text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="hapusspp">Hapus</button>
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
  let table = new DataTable('#spp');
</script>

<!-- Modal Tambah -->
<div class="modal fade" id="tambahspp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <div class="col-12">
          <div class="text-center">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah SPP</h1>
          </div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="control/spp.php" method="post">
        <div class="modal-body">
          <div class="mb-3">
            <label class="form-label">Tahun</label>
            <div>
              <input type="number" min="2000" max="2099" name="tahun" class="form-control mb-3" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Nominal</label>
              <div>
                <input type="number" name="nominal" min="1000000" class="form-control mb-3" required>
              </div>
              <div class="modal-footer">
                <div class="col-12">
                  <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambahspp">Simpan</button>
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