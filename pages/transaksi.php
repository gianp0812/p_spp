<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title text-center">Riwayat Transaksi</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover cell-border" id="transaksi">
              <thead class=" text-primary text-center">
                <th>NO</th>
                <th>Nisn</th>
                <th>Nama Siswa</th>
                <th>Nama Petugas</th>
                <th>Tanggal Transaksi</th>
                <th>Nominal Pembayaran</th>
                <th>SPP Tahun</th>
                <th class="text-right">Action</th>
              </thead>

              <tbody class="text-center">
                <?php
                $no = 1;
                if ($role == 'siswa') {
                  $id_role = $_SESSION['user']['nisn'];
                  $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER join siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas WHERE pembayaran.nisn='$id_role' ORDER BY id_pembayaran DESC");
                } else {
                  $query = mysqli_query($koneksi, "SELECT * FROM pembayaran INNER JOIN petugas ON pembayaran.id_petugas=petugas.id_petugas INNER join siswa ON pembayaran.nisn=siswa.nisn INNER JOIN spp ON pembayaran.id_spp=spp.id_spp INNER JOIN kelas ON siswa.id_kelas=kelas.id_kelas ORDER BY id_pembayaran DESC");
                }
                while ($data = mysqli_fetch_array($query)) {
                ?>
                  <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $data['nisn'] ?></td>
                    <td><?= $data['nama'] ?></td>
                    <td><?= $data['nama_petugas'] ?></td>
                    <td><?= $data['tgl_bayar'] ?></td>
                    <td><?= "Rp " . number_format($data['jumlah_bayar'], 2, ',', '.') ?></td>
                    <td><?= $data['tahun'] ?></td>
                    <td class="text-right">
                      <button data-bs-toggle="modal" data-bs-target="#detail<?= $data['id_pembayaran'] ?>" class="btn btn-info btn-sm">Detail</button>
                    </td>
                  </tr>

                  <!-- Modal Tambah -->
                  <div class="modal fade" id="detail<?= $data['id_pembayaran'] ?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <div class="col-12">
                            <div class="text-center">
                              <h1 class="modal-title fs-5" id="staticBackdropLabel">Detail Transaksi</h1>
                              <button type="button" class="btn-close" style="float: right; margin-right: -20px; margin-top: -30px;" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                          </div>
                        </div>
                        <form action="">
                          <div class="modal-body">
                            <div class="mb-3">
                              <label class="form-label">NISN</label>
                              <div>
                                <input type="number" name="nisn" class="form-control mb-3" value="<?= $data['nisn'] ?>" disabled>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">NIS</label>
                                <div>
                                  <input type="number" name="nis" class="form-control mb-3" value="<?= $data['nis'] ?>" disabled>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Nama</label>
                                <div>
                                  <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama'] ?>" disabled>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <div>
                                  <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama_kelas'] . " - " . $data['kompetensi_dasar'] ?>" disabled>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Petugas</label>
                                <div>
                                  <input type="text" name="nama" class="form-control mb-3" value="<?= $data['nama_petugas'] ?>" disabled>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">SPP</label>
                                <div>
                                  <input type="text" name="no_telp" class="form-control mb-3" value="<?= $data['tahun'] . " - " . "Rp " . number_format($data['nominal'], 2, ',', '.') ?>" disabled>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Tanggal Bayar</label>
                                <div>
                                  <input type="text" name="nama" class="form-control mb-3" value="<?= date("l, d - F - Y", strtotime($data['tgl_bayar'])) ?>" disabled>
                                </div>
                              </div>
                              <div class="mb-3">
                                <label class="form-label">Jumlah Bayar</label>
                                <div>
                                  <input type="text" name="nama" class="form-control mb-3" value="<?= "Rp " . number_format($data['jumlah_bayar'], 2, ',', '.') ?>" disabled>
                                </div>
                              </div>
                              <div class="modal-footer">
                                <div class="col-12">
                                  <div class="text-center">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                  </div>
                                </div>
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
  let table = new DataTable('#transaksi');
</script>