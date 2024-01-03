<div class="card">
    <div class="card-header text-bg-warning">
        Biodata <?php echo $_SESSION['level']; ?>
    </div>
    <div class="card-body">
        <table class="table" border="0">
            <tbody>
                <?php
            if ($_SESSION['level'] == "mahasiswa") { 
            $sqltampil = mysqli_query($koneksi, "SELECT * FROM tblmahasiswa WHERE email = '$_SESSION[email]'");
            $data = mysqli_fetch_assoc($sqltampil);
            ?>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>: <?php echo $data['nama_mhs']; ?></td>
                    <td rowspan="7"><img src="foto/<?php echo $data['foto']; ?>" width="150px" class="img-thumbnail"
                            alt="...">
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Mahasiswa</td>
                    <td>: <?php echo $data['nim']; ?></td>
                </tr>
                <tr>
                    <td>Semester</td>
                    <td>: <?php echo $data['semester']; ?></td>
                </tr>
                <tr>
                    <td>Program Study</td>
                    <td>: <?php echo $data['prodi']; ?> </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?php echo $data['jnskel']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?php echo $data['email']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-warning ml-auto" href="?page=mahasiswa_profil_ubah&nim=<?php echo $data['nim'];?>"
                role="button">Update
                Profil </a>
        </div>
    </div>
</div>