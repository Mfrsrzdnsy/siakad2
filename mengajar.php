<?php if ($_SESSION['level'] == "admin") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA MENGAJAR
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <?php if ($_SESSION['level'] == "admin") { ?>
            <a class="btn btn-warning ml-auto" href="?page=mengajar_tambah" role="button">Tambah <i
                    class="fas fa-user-plus"></i></a>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                    <th scope="col">No</th>
                        <th scope="col">Nama Dosen</th>
                        <th scope="col">Mata Kuliah</th>
                        <th scope="col">Semester</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $sqlmengajar = "SELECT * FROM tbldosen, tblmatkul, mengajar WHERE tbldosen.nidn = mengajar.nidn AND tblmatkul.kode_matkul = mengajar.kode_matkul";
                $qmengajar = mysqli_query($koneksi, $sqlmengajar);
                
                if (!$qmengajar) {
                    die("Query error: " . mysqli_error($koneksi));
                }
                
                $no = 1;
                while ($dt = mysqli_fetch_array($qmengajar)) {
                
                    ?>
                    <tr>
                        <td> <?php echo $no; ?> </td>
                        <td><?php echo $dt['nama'] ?></td>
                        <td><?php echo $dt['matkul'] ?></td>
                        <td><?php echo $dt['semester'] ?></td>
                        <td><a title="Hapus" class="btn btn-outline-danger" href=""
                                onclick="return confirm('Yakin menghapus data ini?')"><i class="fa-solid fa-trash"
                                    style="color: #df1616;"></i></a></td>
                    </tr>
<?php $no++;     } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
?>