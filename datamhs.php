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
                        DATA MAHASISWA
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Data Mahasiswa</h5>

                        <a class="btn btn-primary" href="tambahmhs.php" role="button">+Tambah</a>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Foto</th>
                                        <th scope="col">NIM</th>
                                        <th scope="col">Nama Mahasiswa</th>
                                        <th scope="col">L/P</th>
                                        <th scope="col">Program Studi</th>
                                        <th scope="col">Semester</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
  include "koneksi.php";
  $sql="select * from tblmahasiswa";
  $query=mysqli_query($koneksi,$sql);
  while($a=mysqli_fetch_array($query)){
  ?>
                                    <tr>
                                        <td><img src="foto/<?php echo $a['foto'];?>" width="70px" class="img-thumbnail"
                                                alt="..."></td>
                                        <td><?php echo $a['nim'];?></td>
                                        <td><?php echo $a['nama_mhs'];?></td>
                                        <td><?php echo $a['jnskel'];?></td>
                                        <td><?php echo $a['prodi'];?></td>
                                        <td><?php echo $a['semester'];?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
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
        <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>