<div class="card">
    <div class="card-header text-bg-warning">
        Biodata <?php echo $_SESSION['level']; ?>
    </div>
    <div class="card-body">
        <table class="table" border="0">
            <tbody>
                <?php
            if ($_SESSION['level'] == "dosen") { 
            $sqltampil = mysqli_query($koneksi, "SELECT * FROM tbldosen WHERE email = '$_SESSION[email]'");
            $data = mysqli_fetch_assoc($sqltampil);
            ?>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>: <?php echo $data['nama']; ?></td>
                    <td rowspan="7"><img src="foto/<?php echo $data['foto']; ?>" width="150px" class="img-thumbnail"
                            alt="...">
                    </td>
                </tr>
                <tr>
                    <td>Nomor Induk Dosen Nasional</td>
                    <td>: <?php echo $data['nidn']; ?></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: <?php echo $data['jenis_kelamin']; ?></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td>: <?php echo $data['pendidikan']; ?> </td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>: <?php echo $data['email']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-warning ml-auto" href="?page=dosen_profil_ubah&nidn=<?php echo $data['nidn'];?>"
                role="button">Update
                Profil </a>
        </div>
    </div>
</div>