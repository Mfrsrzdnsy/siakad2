<div class="card">
    <div class="card-header text-bg-warning">
        Biodata <?php echo $_SESSION['level']; ?>
    </div>
    <div class="card-body">

        <div class="table-responsive">
            <table class="table" border="0">
                <thead>
                    <tr><img src="img/hacker.png" width="200px" alt=""></tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Id User</td>
                        <td>:
                        <td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>: <?php echo $_SESSION['nama_lengkap'] ?></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>: <?php echo $_SESSION['email'] ?></td>
                    </tr>
                    <tr>
                        <td>Level</td>
                        <td>: <?php echo $_SESSION['level'] ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-end mb-3">
            <a class="btn btn-warning ml-auto" href="?page=profil_ubah" role="button">Update Profil </a>
        </div>
    </div>
</div>