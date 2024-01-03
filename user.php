<?php if ($_SESSION['level'] == "admin") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA USER
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <?php if ($_SESSION['level'] == "admin") { ?>
            <a class="btn btn-warning ml-auto" href="?page=user_tambah" role="button">Tambah <i
                    class="fas fa-user-plus"></i></a>
            <?php } ?>
        </div>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Nama</th>
                        <th scope="col">Level</th>
                        <th scope="col">Email</th>
                        <!-- <th scope="col">Password</th> -->
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <?php
                    include 'koneksi.php';
                    $sql = "SELECT * FROM user";
                    $query = mysqli_query($koneksi, $sql);
                    while ($a = mysqli_fetch_array($query)) {
                    ?>
                <tbody>
                    <td><?php echo $a['nama_lengkap'] ?></td>
                    <td><?php echo $a['level'] ?></td>
                    <td><?php echo $a['email'] ?></td>
                    <td><a href="?page=user_ubah&&email=<?php echo $a['email']; ?>" class='btn btn-success'><i
                                class="fas fa-edit"></i></a>
                        <?php if ($_SESSION['level'] == "admin") { ?>
                        <a href="?page=user_hapus&&=email<?php echo $a['email']; ?>" class='btn btn-danger'
                            onclick="return confirm('Apakah anda yakin ingin menghapus data ini !!!')"><i
                                class=" fas fa-trash"></i></a>
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