<?php if ($_SESSION['level'] == "admin") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA MATA KULIAH
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <?php if ($_SESSION['level'] == "admin") { ?>
            <a class="btn btn-warning ml-auto" href="?page=matkul_tambah" role="button">Tambah</a>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Kode Mata Kuliah</th>
                        <th scope="col">Mata Kuliah</th>
                        <th scope="col">SKS</th>
                        <th scope="col">Semester</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php
                    include 'koneksi.php';
                    $sql = "SELECT * FROM tblmatkul";
                    $query = mysqli_query($koneksi, $sql);
                    while ($a = mysqli_fetch_array($query)) {
                    ?>
                <tbody>
                    <td><?php echo $a['kode_matkul'] ?></td>
                    <td><?php echo $a['matkul'] ?></td>
                    <td><?php echo $a['sks'] ?></td>
                    <td><?php echo $a['semester'] ?></td>
                    <td><a href="?page=matkul_ubah&&kode_matkul=<?php echo $a['kode_matkul']; ?>"
                            class='btn btn-success'><i class="fas fa-edit"></i></a>
                        <a href="?page=matkul_hapus&&kode_matkul=<?php echo $a['kode_matkul']; ?>"
                            class='btn btn-danger'
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini !!!')"><i
                                class=" fas fa-trash"></i></a>
                    </td>
                </tbody>
                <?php
                    }
                    ?>
            </table>
        </div>
    </div>
</div>
<?php
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
?>