<div class="card">
    <div class="card-header text-bg-warning">
        SELAMAT DATANG
    </div>
    
    <div class="card-body">

        <h5 class="card-title text-center">KARTU RENCANA STUDI</h5>
        
        <table class="table table-hover">


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
                    <td rowspan="7"><img src="foto/<?php echo $data['foto']; ?>" width="150px" class="img-thumbnail"
                            alt="..."></td>
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
            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
                    <a href="khs_cetak.php" class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
            </div>

        </table>
    </div>
</div>