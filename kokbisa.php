<?php
session_start();
if (isset($_SESSION['email']) and isset($_SESSION['level'])) {
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Halaman Beranda</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-warning" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand text-dark" href="#">Siakad</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav text-dark">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" aria-current="page" href="#"><i
                                    class="fas fa-home"></i> Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-dark" href="#">Visi Misi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active text-dark" href="#">About Us</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav text-dark ms-auto">
                        <li class="nav-item" style="padding-right: 20px;">
                            <span class="navbar-text text-dark">
                                <?php echo $_SESSION['nama_lengkap']; ?>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-dark text-white" href="logout.php"><i class="fas fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br>
        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="list-group">
                    <a href="beranda.php" class="list-group-item list-group-item-action active" aria-current="true">
                        MENU UTAMA
                    </a>
                    <?php
                        if ($_SESSION['level'] == "admin") { ?>
                    <a href="?page=user" class="list-group-item list-group-item-action"><i
                            class="far fa-address-card"></i>
                        Update Profil</a>
                    <a href="?page=mahasiswa" class="list-group-item list-group-item-action"><i
                            class="fas fa-server"></i> Data Mahasiswa</a>
                    <a href="?page=dosen" class="list-group-item list-group-item-action"><i class="fas fa-server"></i>
                        Data Dosen</a>
                    <a href="?page=matkul" class="list-group-item list-group-item-action"> <i class="fas fa-server"></i>
                        Data Mata Kuliah</a>
                    <a href="#" class="list-group-item list-group-item-action"><i class="fas fa-server"></i> Data
                        Program Studi</a>
                    <?php } elseif ($_SESSION['level'] == "dosen") { ?>
                    <a href="?page=dosen" class="list-group-item list-group-item-action">Update Profil</a>
                    <a href="#" class="list-group-item list-group-item-action">Lihat KRS</a>
                    <a href="#" class="list-group-item list-group-item-action">Input Nilai</a>
                    <a href="#" class="list-group-item list-group-item-action">Jadwal Mengajar</a>
                    <?php } elseif ($_SESSION['level'] == "mahasiswa") { ?>
                    <a href="?page=mahasiswa" class="list-group-item list-group-item-action">Update Profil</a>
                    <a href="#" class="list-group-item list-group-item-action">Isi KRS</a>
                    <a href="#" class="list-group-item list-group-item-action">Lihat KHS</a>
                    <a href="#" class="list-group-item list-group-item-action">Jadwal Kuliah</a>
                    <?php } ?>
                </div>
            </div>
            <div class="col-md-9 mb-3" style="margin-bottom: 20px;">
                <?php include "konten.php"; ?>
            </div>
        </div>
        <div class=" row">
            <div class="card">
                <div class="card-body bg-dark-subtle">
                    <center>Copyright &copy;2023 by Muhammad Firas</center>
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>
<?php
} else {
    echo "<h3><font color='red'>Anda tidak berhak mengakses halaman ini!
	 Silahkan login <a href='index.php'>disini</a>";
}
?>