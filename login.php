<?php
session_start();
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/login.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
</head>

<body>
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h2 class="card-title text-center">L O G I N</h2>
            </div>
            <div class="card-text">
                <?php
						if (isset($_POST['login'])) {
							$email = $_POST['email'];
							$password = md5($_POST['password']);
							$sql = "select * from user where email='$email' and password='$password'";
							$query = mysqli_query($koneksi, $sql);
							$data = mysqli_fetch_array($query);
							$row = mysqli_num_rows($query);
							if ($row > 0) {
								$_SESSION['email'] = $data['email'];
								$_SESSION['level'] = $data['level'];
								$_SESSION['nama_lengkap'] = $data['nama_lengkap'];
								header("location:beranda.php");
							} else {
								echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  Email atau password Anda salah, ulangi kembali!
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
  </button></div>";
							}
						}
						?>
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="login" class="btn btn-primary">Login <i
                                class="fas fa-sign-out-alt"></i></button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>