<?php if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "mahasiswa") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <div class="d-flex justify-content-end mb-3">
            <?php if ($_SESSION['level'] == "admin") { ?>
            <a class="btn btn-warning ml-auto" href="?page=mahasiswa_tambah" role="button">Tambah <i
                    class="fas fa-user-plus"></i></a>
            <?php } ?>
        </div>
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
                        <th scope="col">Alamat</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        include "koneksi.php";
                        $sql = "select * from tblmahasiswa";
                        $query = mysqli_query($koneksi, $sql);
                        while ($a = mysqli_fetch_array($query)) {
                        ?>
                    <tr>
                        <td><img src="foto/<?php echo $a['foto']; ?>" width="70px" class="img-thumbnail" alt="..."></td>
                        <td><?php echo $a['nim']; ?></td>
                        <td><?php echo $a['nama_mhs']; ?></td>
                        <td><?php echo $a['jnskel']; ?></td>
                        <td><?php echo $a['prodi']; ?></td>
                        <td><?php echo $a['semester']; ?></td>
                        <td><?php echo $a['alamat']; ?></td>
                        <td>
                            <a href="?page=mahasiswa_ubah&&nim=<?php echo $a['nim']; ?>" class='btn btn-success'><i
                                    class="fas fa-edit"></i></a>
                            <?php if ($_SESSION['level'] == "admin") { ?>
                            <a href="?page=mahasiswa_hapus&&email=<?php echo $a['email']; ?>" class='btn btn-danger'
                                onclick="return confirm('Apakah anda yakin ingin menghapus data ini !!!')"><i
                                    class=" fas fa-trash"></i></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php } ?>
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