<?php
include 'koneksi.php';

if (isset($_POST['username'])) {
	$username = $_POST['username'];
	$password = md5($_POST['password']);

	$siswa = mysqli_query($koneksi, "SELECT * FROM siswa WHERE nis='$username' AND password='$password'");
	$petugas = mysqli_query($koneksi, "SELECT * FROM petugas WHERE username='$username' AND password='$password'");

	if (mysqli_num_rows($siswa) > 0) {
		$_SESSION['user'] = mysqli_fetch_array($siswa);
		echo '<script>alert("Login Berhasil");location.href="index.php";</script>';
	} elseif (mysqli_num_rows($petugas) > 0) {
		$_SESSION['user'] = mysqli_fetch_array($petugas);
		echo '<script>alert("Login Berhasil");location.href="index.php";</script>';
	} else {
		echo '<script>alert("Username/Password Salah");location.href="login.php";</script>';
	}
}

if (!empty($_SESSION['user'])) {
	header('location: index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" href="../assets/img/favicon.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Pembayaran SPP | Dashboard</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<!--     Fonts and icons     -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
	<title> PEMBAYARAN SPP | LOGIN</title>
	<!-- CSS Files -->
	<link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
	<link href="../assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body>
	<main class="d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row vh-100">
				<div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Selamat Datang</h1>
							<p class="lead">
								Silahkan login
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-3">
									<form method="post">
										<div>
											<label class="form-label">
												<h6>Username/NIS:</h6>
											</label>
										</div>

										<div class="input-group no-border">
											<input class="form-control form-control-lg" type="text" name="username" placeholder="Masukkan Username/NISN" required />
										</div>
										<div>
											<label class="form-label">
												<h6>Password :</h6>
											</label>
										</div>
										<div class="input-group no-border">
											<input class="form-control form-control-lg" type="password" name="password" placeholder="Masukkan password" required />
										</div>
										<div class="d-grid gap-2 mt-3" align="center">
											<button class="btn btn-lg btn-primary">Masuk</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</main>

	<script src="js/app.js"></script>

</body>

</html>