<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Siakad</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Akademik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Pembayaran</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="#">Pengumuman</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav><br>
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="index.php" class="list-group-item list-group-item-action active" aria-current="true">
                        MENU UTAMA
                    </a>
                    <a href="datamhs.php" class="list-group-item list-group-item-action">Data Mahasiswa</a>
                    <a href="#" class="list-group-item list-group-item-action">Data Dosen</a>
                    <a href="#" class="list-group-item list-group-item-action">Data Mata Kuliah</a>
                    <a href="#" class="list-group-item list-group-item-action">Data Program Studi</a>
                </div><br>
            </div>
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header text-bg-primary">
                        TAMBAH MAHASISWA
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Tambah Mahasiswa</h5>

                        <?php
include "koneksi.php";
if(isset($_POST['simpan'])){
	$nim=$_POST['nim'];
	$nama_mhs=$_POST['nama_mhs'];
	$prodi=$_POST['prodi'];
	$semester=$_POST['semester'];
	$alamat=$_POST['alamat'];
	$jnskel=$_POST['jnskel'];
	$foto=$_FILES['foto']['name'];
	$tmp=$_FILES['foto']['tmp_name'];
	$a="insert into tblmahasiswa values('$nim','$nama_mhs','$prodi','$semester',
	'$alamat','$jnskel','$foto')";
	$b=mysqli_query($koneksi,$a);
	move_uploaded_file($tmp,"foto/$foto");
	if($b){
		echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>Berhasil!</strong> Data berhasil disimpan.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
	}else{
		echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Berhasil!</strong> Data berhasil disimpan.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
	}
}
?>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nim" class="form-control" id="inputEmail3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                                <div class="col-sm-8">
                                    <input type="text" name="nama_mhs" class="form-control" id="inputPassword3">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Program Studi</label>
                                <div class="col-sm-8">
                                    <select name="prodi" class="form-select" aria-label="Default select example">
                                        <option value="Teknik Informatika">Teknik Informatika</option>
                                        <option value="Sistem Informasi">Sistem Informasi</option>
                                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail3" class="col-sm-4 col-form-label">Semester</label>
                                <div class="col-sm-8">
                                    <select name="semester" class="form-select" aria-label="Default select example">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1"
                                        rows="3"></textarea>
                                </div>
                            </div>
                            <fieldset class="row mb-3">
                                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                                <div class="col-sm-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jnskel" id="gridRadios1"
                                            value="L" checked>
                                        <label class="form-check-label" for="gridRadios1">
                                            Laki-Laki
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="jnskel" id="gridRadios2"
                                            value="P">
                                        <label class="form-check-label" for="gridRadios2">
                                            Perempuan
                                        </label>
                                    </div>

                                </div>
                            </fieldset>
                            <div class="row mb-3">
                                <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Foto</label>
                                <div class="col-sm-8">
                                    <input class="form-control" name="foto" type="file" id="formFile">
                                </div>
                            </div>
                            <input type="submit" class="btn btn-primary" name="simpan" value="SIMPAN">
                            <input type="reset" class="btn btn-warning" name="batal" value="BATAL">
                        </form>
                    </div>
                </div>
            </div>
        </div><br>
        <div class="row">
            <div class="card">
                <div class="card-body">
                    Copyright &copy;2023 by Universitas Teknologi Mataram
                </div>
            </div>
        </div>
    </div>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>

<?php
include "koneksi.php";

if (isset($_POST['simpan'])) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $prodi = $_POST['prodi'];
    $semester = $_POST['semester'];
    $alamat = $_POST['alamat'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];

    $a = "INSERT INTO tbl_mahasiswa (nim, nama, prodi, semester, alamat, jenis_kelamin, foto)
        VALUES ('$nim', '$nama', '$prodi', '$semester', '$alamat', '$jenis_kelamin', '$foto')";

    $b = mysqli_query($koneksi, $a);

    if ($b) {
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Berhasil!</strong> Data berhasil disimpan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>Gagal!</strong> Data gagal disimpan.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
    }

    move_uploaded_file($tmp, "foto/$foto");
}
?>