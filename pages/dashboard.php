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
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-globe text-warning"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">SPP Tahun Ini</p>
                <p class="card-title">
                  <?php
                  $thn = date("Y");
                  $query_spp = mysqli_query($koneksi, "SELECT * FROM spp WHERE tahun='$thn'");
                  $data_spp = mysqli_fetch_array($query_spp);

                  echo $data_spp['tahun'] . " - " . "Rp " . number_format($data_spp['nominal'], 0, ',', '.') . ",00";
                  ?>
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-money-coins text-success"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">
                  <?php
                  if ($role == 'siswa') {
                    echo "Total Pembayaran";
                  } else {
                    echo "Total Transaksi Tahun Ini";
                  }
                  ?>
                </p>
                <p class="card-title">
                  <?php
                  if ($role == 'siswa') {
                    $id = $_SESSION['user']['nisn'];

                    $query2 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_bayar FROM pembayaran WHERE nisn='$id'");
                    $cek2 = mysqli_num_rows($query2);
                    $data2 = mysqli_fetch_array($query2);

                    if ($cek2 != 0) {
                      echo "Rp " . number_format($data2['total_bayar'], 0, ',', '.') . ",00";
                    } else {
                      echo "Belum Ada Riwayat Pembayaran";
                    }
                  } else {
                    $tahun = date("Y");
                    $query2 = mysqli_query($koneksi, "SELECT SUM(jumlah_bayar) AS total_bayar FROM pembayaran WHERE tahun_bayar='$tahun'");
                    $data2 = mysqli_fetch_array($query2);

                    echo "Rp " . number_format($data2['total_bayar'], 0, ',', '.') . ",00";
                  }
                  ?>
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer">
          <hr>
          <div class="stats">
            <i></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-badge"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Jumlah Petugas</p>
                <p class="card-title">
                  <?php
                  $query_petugas = mysqli_query($koneksi, "SELECT * FROM petugas");

                  echo mysqli_num_rows($query_petugas);
                  ?>
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i></i>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6">
      <div class="card card-stats">
        <div class="card-body ">
          <div class="row">
            <div class="col-5 col-md-4">
              <div class="icon-big text-center icon-warning">
                <i class="nc-icon nc-single-02"></i>
              </div>
            </div>
            <div class="col-7 col-md-8">
              <div class="numbers">
                <p class="card-category">Jumlah Siswa</p>
                <p class="card-title">
                  <?php
                  $query_siswa = mysqli_query($koneksi, "SELECT * FROM siswa");

                  echo mysqli_num_rows($query_siswa);
                  ?>
                <p>
              </div>
            </div>
          </div>
        </div>
        <div class="card-footer ">
          <hr>
          <div class="stats">
            <i></i>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<footer>
  <hr>
</footer>