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
            <h5 class="card-title text-center"><b>KARTU HASIL STUDI (KHS)</b></h5>

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
                        <th>Mata Kuliah</th>
                        <th>NM</th>
                        <th>AM</th>
                        <th>K</th>
                        <th>AM x K</th>
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
                $totalAMxK = 0;
                while ($dt = mysqli_fetch_array($qkrs)) {
                
                    ?>
                    <tr>
                        <td> <?php echo $no; ?> </td>
                        <td> <?php echo $dt['kode_matkul'] ?> </td>
                        <td> <?php echo $dt['matkul'] ?> </td>
                        <td> <?php echo $dt['nilai'] ?></td>
                        <td> <?php  
                                if ($dt['nilai'] === 'A') {
                                    echo "4";
                                }elseif ($dt['nilai'] === 'B') {
                                    echo "3";
                                }elseif ($dt['nilai'] === 'C') {
                                    echo "2";
                                }elseif ($dt['nilai'] === 'D') {
                                    echo "1";
                                }else {
                                    echo "0";
                                }
                                ?>
                    
                        </td>
                        <td> <?php echo $dt['sks'] ?> </td>
                        <td>
                        <?php
                            $am = 0;
                            if ($dt['nilai'] === 'A') {
                                $am = 4;
                            } elseif ($dt['nilai'] === 'B') {
                                $am = 3;
                            } elseif ($dt['nilai'] === 'C') {
                                $am = 2;
                            } elseif ($dt['nilai'] === 'D') {
                                $am = 1;
                    }

                    $k = $dt['sks'];
                    $amxk = $am * $k;
                    echo $amxk;

                    $totalAMxK += $amxk;
                ?>
                        </td>
                    </tr>
                    <?php $no++;
                    } ?>
                </tbody>
                <tr>
                    <th colspan="5">JUMLAH SKS</th>
                    <th>
                        <?php
                        $sqlsks = "SELECT sum(sks) AS total FROM tblmatkul, khs WHERE tblmatkul.kode_matkul = khs.kode_matkul
                            AND khs.nim='$data[nim]' AND khs.semester = '$data[semester]'";
                        $qsks = mysqli_query($koneksi, $sqlsks);
                        $jumlah = mysqli_fetch_array($qsks);
                        echo $jumlah['total'];
                        ?>
                    </th>
                    <th>
                    <?php echo $totalAMxK;?>
                    </th>
                </tr>
            </table>
            <div>
                <span>Index Prestasi Semester Ini = <?php
        // Memastikan tidak terjadi pembagian dengan nol
        if ($jumlah['total'] != 0) {
            $ip = $totalAMxK / $jumlah['total'];
            echo number_format($ip, 2); // Menampilkan IP dengan 2 angka di belakang koma
        } else {
            echo "N/A"; // Menampilkan N/A jika total SKS adalah 0 untuk menghindari pembagian dengan nol
        }
        ?></span>
            </div>

            <!-- Tanggal dan Tanda Tangan -->
            <div class="card-bottom">
    <table class="" style="width: 100%;">
        <tr>
            <td class="dosen" style="width: 50%;">
            <h5><b><i>Keterangan :</i></b></h5>
            <span><i>NM = Nilai Mutu</i></span><br>
            <span><i>AM = Angka Mutu</i></span><br>
            <span><i>IP = Index Prestasi</i></span>
            </td>
            <td class="rektor" style="width: 50%;">
                <h6>Mataram, <?php echo date('d F Y') ?></h6>
                <h6 >Universitas Teknologi Mataram</h6>
                <h6 style="margin-bottom: 80px;">Rektor</h6>
                <span><u><b> Ir.H.Lalu Darmawan Bakti, M.Sc., M.Kom </b></u></span><br>
                <span><b>NIK. 001.03.99</b></span>
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
