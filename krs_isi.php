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
                        <th>Nama Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Aksi</th>
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
                        <td> <?php echo $no; ?> </td>
                        <td> <?php echo $dt['kode_matkul'] ?> </td>
                        <td> <?php echo $dt['matkul'] ?> </td>
                        <td> <?php echo $dt['sks'] ?> </td>
                        <td><a title="Hapus" class="btn btn-outline-danger" href="?page=krs_hapus&&nim=<?php echo $data['nim']; ?>&kode_matkul=<?php echo $dt['kode_matkul']; ?>"
                                onclick="return confirm('Yakin menghapus data ini?')"><i class="fa-solid fa-trash"
                                    style="color: #df1616;"></i></a></td>
                    </tr>
                    <?php $no++;
                    } ?>
                </tbody>
                <tr>
                    <th colspan="3">JUMLAH SKS</th>
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
                        
                    </th>
                </tr>
            </table>
            <div style="display: flex; justify-content: flex-end; margin-top: 10px;">
    <?php
    $maksimal_sks = 24;  // Jumlah SKS maksimal yang diperbolehkan
    if ($jumlah['total'] < $maksimal_sks) {
        // Tampilkan formulir input mata kuliah
        echo '<a href="?page=tambahmk&&nim=' . $data['nim'] .'" class="btn btn-warning" style="margin-right: 10px;">Tambah</a>';
    } else {
        // Tampilkan pesan jika jumlah SKS sudah mencapai batas maksimal
        echo '<p class="text-danger">Anda sudah mencapai batas maksimal SKS yang dapat diambil (24 SKS).</p>';
    }
    ?>

    <a href="cetak.php" class="btn btn-warning"><i class="fas fa-print"></i> Print</a>
</div>

        </table>
    </div>
</div>