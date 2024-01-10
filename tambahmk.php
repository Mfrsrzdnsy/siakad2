<div class="card">
    <div class="card-header text-bg-warning">
        Tambah Mata Kuliah ke KRS
    </div>

    <?php
    $a = mysqli_query($koneksi, "SELECT * FROM tblmahasiswa WHERE nim='$_GET[nim]'");
    $b = mysqli_fetch_array($a);
    ?>

    <div class="card-body">
        <h5 class="card-title text-center">
            Tambah Mata Kuliah <br> Kartu Rencana Studi <br>
        </h5>

        <table class="table table-bordered">
            <thead>
                <th scope="col">Kode</th>
                <th scope="col">nama Mata Kuliah</th>
                <th scope="col">SKS</th>
                <th scope="col">Semester</th>
                <th scope="col">Aksi</th>
            </thead>

            <tbody>
                <?php
                $ksr= "SELECT * FROM tblmatkul";
                $qkrs = mysqli_query($koneksi, $ksr);
                while($dt = mysqli_fetch_array($qkrs)){

                 ?>
                    <tr>
                        <td scope="row"><?php echo $dt['kode_matkul'] ?></td>
                        <td><?php echo $dt['matkul'] ?></td>
                        <td><?php echo $dt['sks'] ?></td>
                        <td><?php echo $dt['semester'] ?></td>
                        <td>
                   <?php
                   $j = "SELECT * FROM khs WHERE nim='$_GET[nim]' AND kode_matkul='$dt[kode_matkul]'";
                    $k = mysqli_query($koneksi, $j);
                    $row = mysqli_num_rows($k);
                    if ($row > 0) {
                       echo "<i class='fa fa-check'></i>";
                    } else {
                        echo "<a href='inputkrs.php?kode_matkul=$dt[kode_matkul]&&nim=$b[nim]&&semester=$b[semester]' style='text-decoration: none;' >Pilih</a>";
                    }
                    ?>
                   </td>
                    </tr>
            <?php } ?>
            </tbody>
        </table>
        <a href="?page=krs_isi" class="btn btn-warning">SELESAI</a>
    </div>
</div>