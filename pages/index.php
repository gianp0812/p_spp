<?php
include 'koneksi.php';

$today = date("l, d - F - Y");

if (empty($_SESSION['user'])) {
  header('location:login.php');
}

if (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "admin") {
  $role = 'admin';
} elseif (!empty($_SESSION['user']['level']) && $_SESSION['user']['level'] == "petugas") {
  $role = 'petugas';
} else {
  $role = 'siswa';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>Pembayaran SPP |
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'dasboard';
    $cek = preg_replace('/-/', ' ', $page);
    $title = ucwords($cek);
    echo $title;
    ?>
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
  <!-- CSS Files -->
  <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <!-- Data Table -->
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <link href="css/app.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">


</head>

<body class="">
  <div class="wrapper ">
    <div class="sidebar" data-color="white" data-active-color="danger">
      <div class="logo">
        <a href="index.html" class="simple-text logo-mini">
          <div class="logo-image-small">
            <img src="../assets/img/logo-small.png">
          </div>
        </a>
        <a href="index.php" class="simple-text logo-normal">
          Pembayaran SPP
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="<?= ($page == 'bayar_spp' ? 'active' : '') ?>" <?= (!empty($_SESSION['user']['nisn']) ? 'hidden' : '') ?>>
            <a href="?page=bayar_spp" class="btn btn-primary btn-sm btn-rounded">
              <i class="nc-icon nc-credit-card text-white"></i>
              <p class="text-white">Bayar SPP</p>
            </a>
          </li>
          <hr>
          <li class="<?php if (empty($_GET['page']) || $page == 'dashboard') {
                        echo 'active';
                      } ?>" <?= ($role == 'siswa' ? 'hidden' : '') ?>>
            <a href="?page=dashboard">
              <i class="nc-icon nc-laptop"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="<?= ($page == 'transaksi' || $page != 'profile' ? 'active' : '') ?>">
            <a href="?page=transaksi">
              <i class="nc-icon nc-money-coins "></i>
              <p>Riwayat ransaksi</p>
            </a>
          </li>

          <li class="<?php if ($page == 'siswa' || $page == 'detail_bayar') {
                        echo 'active';
                      } ?>" <?= (!empty($_SESSION['user']['nisn']) ? 'hidden' : '') ?>>
            <a href="?page=siswa">
              <i class="nc-icon nc-single-02"></i>
              <p>Daftar Siswa</p>
            </a>
          </li>
          <?php

          if ($role == 'admin') {
          ?>
            <li class="<?php if ($page == 'petugas') {
                          echo 'active';
                        } ?>">
              <a href="?page=petugas">
                <i class="nc-icon nc-badge"></i>
                <p>Daftar Petugas</p>
              </a>
            </li>
            <li class="<?php if ($page == 'kelas') {
                          echo 'active';
                        } ?>">
              <a href="?page=kelas">
                <i class="nc-icon nc-book-bookmark"></i>
                <p>Kelas</p>
              </a>
            </li>
            <li class="<?php if ($page == 'spp') {
                          echo 'active';
                        } ?>">
              <a href="?page=spp">
                <i class="nc-icon nc-bank"></i>
                <p>SPP</p>
              </a>
            </li>
            <li class="<?php if ($page == 'laporan') {
                          echo 'active';
                        } ?>">
              <a href="?page=laporan">
                <i class="nc-icon nc-single-copy-04"></i>
                <p>Laporan</p>
              </a>
            </li>
          <?php
          }
          ?>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <span class="navbar-brand" href="javascript:;"><?= $today; ?></span>
          </div>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
            <ul class="navbar-nav">
              <li class="nav-item btn-rotate dropdown">
                <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="nc-icon nc-circle-10"></i>
                  <p>
                    <span class="d-md-block"><?= (empty($_SESSION['user']['nama_petugas']) ? $_SESSION['user']['nama'] : $_SESSION['user']['nama_petugas']); ?></span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink"><br>
                  <span style="text-align: center; margin-left: 18px;"><strong><?= (empty($_SESSION['user']['nama_petugas']) ? $_SESSION['user']['nama'] : $_SESSION['user']['nama_petugas']); ?></strong></span>
                  <hr>
                  <a class="dropdown-item" href="?page=profile">Profile Details</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
      <main class="content">
        <div class="container-fluid p-0">

          <?php
          if ($role == 'siswa') {
            $page = isset($_GET['page']) ? $_GET['page'] : 'transaksi';
            include $page . '.php';
          } else {
            $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';
            include $page . '.php';
          }

          ?>
      </main>
      <footer>
        <hr>
      </footer>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script><!-- Paper Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
      demo.initChartsPages();
    });
  </script>
  <?php
  if (isset($_SESSION['status'])) {
  ?>
    <script>
      Swal.fire({
        icon: "<?php echo $_SESSION['status'] ?>",
        title: "<?php echo $_SESSION['title'] ?>",
        text: "<?php echo $_SESSION['text'] ?>",
      })
    </script>
  <?php
    unset($_SESSION['status']);
  }
  ?>
</body>

</html>