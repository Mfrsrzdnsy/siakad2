<?php
session_start();
if (isset($_SESSION['email']) && isset($_SESSION['level'])) {
    include "koneksi.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cetak KRS</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .card {
            border: 1px solid #ccc;
            border-radius: 10px;
            padding: 20px;
            margin-top: 20px;
            margin-bottom: 30px;
        }

        .card-title {
            margin-top: 20px;
        }

        .img-thumbnail {
            max-width: 150px;
        }

        .text-center {
            text-align: center;
        }

        .table {
            margin: 20px;
        }

        .card-bottom {
            margin-top: 20px;
            border: 0;
        }
    </style>
</head>

<body onload="javascript:window.print()">
    <div class="container-fluid">
        <div class="card">
            <h5 class="card-title text-center"><b>KARTU RENCANA STUDI (KRS)</b></h5>

            <!-- Informasi Mahasiswa -->
            <table class="table table-borderless">
                <tbody>
                    <?php
                    include 'koneksi.php';
                    if ($_SESSION['level'] == 'mahasiswa') {
                        $sqltampil = mysqli_query($koneksi, "SELECT * FROM tblmahasiswa WHERE email='$_SESSION[email]'");
                        $data = mysqli_fetch_assoc($sqltampil);
                    ?>
                        <tr>
                            <td>Nama Lengkap</td>
                            <td>: <?php echo $data['nama_mhs']; ?></td>
                            <td rowspan="6">
                                <img src="foto/<?php echo $data['foto']; ?>" width="150px" class="img-thumbnail" alt="...">
                            </td>
                        </tr>
                        <tr>
                            <td>Nomor Induk Mahasiswa</td>
                            <td>: <?php echo $data['nim']; ?></td>
                        </tr>
                        <tr>
                            <td>Prodi</td>
                            <td>: <?php echo $data['prodi']; ?></td>
                        </tr>
                        <tr>
                            <td>Semester</td>
                            <td>: <?php echo $data['semester']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Tabel KRS -->
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>Kode</th>
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sqlkrs = "SELECT * FROM tblmahasiswa, tblmatkul, khs WHERE tblmahasiswa.nim = khs.nim AND tblmatkul.kode_matkul = khs.kode_matkul
                    AND khs.nim = '$data[nim]' AND khs.semester = '$data[semester]' ORDER BY tblmatkul.kode_matkul ASC";
                    $qkrs = mysqli_query($koneksi, $sqlkrs);

                    if (!$qkrs) {
                        die("Query error: " . mysqli_error($koneksi));
                    }

                    $no = 1;
                    while ($dt = mysqli_fetch_array($qkrs)) {
                    ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td><?php echo $dt['kode_matkul'] ?></td>
                            <td><?php echo $dt['matkul'] ?></td>
                            <td><?php echo $dt['sks'] ?></td>
                            <td></td>
                        </tr>
                    <?php $no++;
                    } ?>
                </tbody>

                <!-- Jumlah SKS -->
                <tr>
                    <th colspan="3">JUMLAH</th>
                    <th colspan="2">
                        <?php
                        $sqlsks = "SELECT sum(sks) AS total FROM tblmatkul, khs WHERE tblmatkul.kode_matkul = khs.kode_matkul
                            AND khs.nim='$data[nim]' AND khs.semester = '$data[semester]'";
                        $qsks = mysqli_query($koneksi, $sqlsks);
                        $jumlah = mysqli_fetch_array($qsks);
                        echo $jumlah['total'] . " SKS";
                        ?>
                    </th>
                </tr>
            </table>

            <!-- Tanggal dan Tanda Tangan -->
            <div class="card-bottom">
    <table class="text-center" style="width: 100%;">
        <tr>
            <td class="dosen" style="width: 50%;">
                <h6 style="margin-bottom: 80px;">Dosen Wali</h6>
                <span><u><b>( Dr. Muhammad Multazam, S.Kom., M.Kom )</b></u></span><br>
                <b>NIDN. 12345678910</b>
            </td>
            <td class="mahasiswa" style="width: 50%;">
                <h6>Mataram, <?php echo date('d F Y') ?></h6>
                <h6 style="margin-bottom: 80px;">Mahasiswa yang bersangkutan,</h6>
                <span><u><b><?php echo $data['nama_mhs']; ?></b></u></span><br>
                <span><b>NPM. <?php echo $data['nim']; ?></b></span>
            </td>
        </tr>
    </table>
</div>


        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/all.min.js"></script>
</body>

</html>

<?php
}
?>
