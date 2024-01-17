<div class="card">
    <div class="card-header text-bg-warning">
        SELAMAT DATANG
    </div>
    
    <div class="card-body">

        <h5 class="card-title text-center">INPUT NILAI</h5>
        
        <table class="table table-hover">
            <tbody>
                <?php
                include 'koneksi.php';
                if ($_SESSION['level'] == 'dosen') {
                    $sqltampil = mysqli_query($koneksi, "SELECT * FROM tbldosen WHERE email='$_SESSION[email]'");
                    $data = mysqli_fetch_assoc($sqltampil);
                ?>
                <tr>
                    <td>Nama Lengkap</td>
                    <td>: <?php echo $data['nama']; ?></td>
                    <td rowspan="7"><img src="foto/<?php echo $data['foto']; ?>" width="150px" class="img-thumbnail"
                            alt="..."></td>
                </tr>
                <tr>
                    <td>Nomor Induk Dosen Nasional</td>
                    <td>: <?php echo $data['nidn']; ?></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td>: <?php echo $data['pendidikan']; ?></td>
                </tr>
                <tr>
                    <td>Alamat</td>
                    <td>: <?php echo $data['alamat']; ?></td>
                </tr>
                <tr>
                    <td>Mata Kuliah</td>
                    <td>: <?php echo $data['matkul'] ?> </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>