<?php if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "dosen") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA DOSEN
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <?php if ($_SESSION['level'] == "admin") { ?>
            <a class="btn btn-warning ml-auto" href="?page=dosen_tambah" role="button">Tambah <i
                    class="fas fa-user-plus"></i></a>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Foto</th>
                        <th scope="col">NIDN</th>
                        <th scope="col">Nama Dosen</th>
                        <th scope="col">L/P</th>
                        <th scope="col">Pendidikan</th>
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php
                    include 'koneksi.php';
                    $sql = "SELECT * FROM tbldosen";
                    $query = mysqli_query($koneksi, $sql);
                    while ($a = mysqli_fetch_array($query)) {
                    ?>
                <tbody>
                    <td><img src="foto/<?php echo $a['foto'] ?>" width="70px" class="img-thumbnail" alt=""></td>
                    <td><?php echo $a['nidn'] ?></td>
                    <td><?php echo $a['nama'] ?></td>
                    <td><?php echo $a['jenis_kelamin'] ?></td>
                    <td><?php echo $a['pendidikan'] ?></td>
                    <td><?php echo $a['alamat'] ?></td>
                    <td><a href="?page=dosen_ubah&&nidn=<?php echo $a['nidn']; ?>" class='btn btn-success'><i
                                class="fas fa-edit"></i></a>
                        <?php if ($_SESSION['level'] == "admin") { ?>
                        <a href="?page=dosen_hapus&&nidn=<?php echo $a['nidn']; ?>"
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini !!!')"
                            class='btn btn-danger'><i class=" fas fa-trash"></i></a>
                        <?php } ?>
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