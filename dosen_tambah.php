<?php if ($_SESSION['level'] == "admin") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA DOSEN
    </div>
    <div class="card-body">
        <h5 class="card-title" style="text-align: center;">Tambah Dosen</h5>
        <hr>
        <?php
            include "koneksi.php";
            if (isset($_POST['simpan'])) {
                $nidn = $_POST['nidn'];
                $nama = $_POST['nama'];
                $pendidikan = $_POST['pendidikan'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $email = $_POST['email'];
                $alamat = $_POST['alamat'];

                // Validasi Foto
                $foto = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];
                $size = $_FILES['foto']['size'];
                $ekstensi = array('jpg', 'png', 'jpeg');
                $ekstensi_file = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                $ekstensi_ok = in_array($ekstensi_file, $ekstensi);
                $pass = md5("111");

                // Validasi
                $cek = mysqli_query($koneksi, "SELECT * FROM tbldosen WHERE nidn='$nidn'");
                $row = mysqli_num_rows($cek);
                if ($row > 0) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Gagal!!!</strong> Nomor Induk Dosen Nasional Sudah Ada!!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                } elseif (strlen($nidn) <> 7) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          <strong>Gagal!!!</strong> NIDN Harus 7 Karakter!!
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } elseif ($size > 1000000) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          <strong>Gagal!!!</strong> Ukuran Foto Tidak Boleh Lebih Dari 1Mb!!
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } elseif ((!$ekstensi_ok)) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                              <strong>Gagal!!!</strong> Format Foto harus jpg, png, jpeg!!
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                } else {
                
                $a = "INSERT INTO tbldosen VALUES('$nidn', '$nama', '$pendidikan',
                 '$jenis_kelamin', '$alamat','$email', '$foto')";
                $b = mysqli_query($koneksi, $a);
                move_uploaded_file($tmp, "foto/$foto");
                $input = mysqli_query($koneksi, "INSERT INTO user VALUES('$email','$pass','dosen','$nama')");
                if ($b) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                          <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=dosen'>LIHAT DATA</a>.
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                    <strong>Berhasil!</strong> Data gagal disimpan.
                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                  </div>";
                }
            }
        }
            ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor Induk Dosen Nasional <font color="red">*
                    </font></label>
                <div class="col-sm-8">
                    <input type="text" name="nidn" class="form-control" id="inputEmail3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama Dosen <font color="red">*</font>
                </label>
                <div class="col-sm-8">
                    <input type="text" name="nama" class="form-control" id="inputPassword3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Pendidikan <font color="red">*</font></label>
                <div class="col-sm-8">
                    <select name="pendidikan" class="form-select" aria-label="Default select example" required>
                        <option value="">--- Pilih Pendidikan ---</option>
                        <option value="Magister Ilmu Komputer: M.Kom">Magister Ilmu Komputer: M.Kom.</option>
                        <option value="Magister Teknologi Informasi: M.TI.">Magister Teknologi Informasi: M.TI.
                        </option>
                        <option value="Master of Computer Science: M.Cs.">Master of Computer Science: M.Cs.</option>
                    </select>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1" value="L"
                            checked>
                        <label class="form-check-label" for="gridRadios1">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2" value="P">
                        <label class="form-check-label" for="gridRadios2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"
                        required></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Email <font color="red">*</font>
                </label>
                <div class=" col-sm-8">
                    <input type="email" name="email" class="form-control" id="inputPassword3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Foto <font color="red">*</font>
                </label>
                <div class="col-sm-8">
                    <input class="form-control" name="foto" type="file" id="formFile">
                </div>
            </div>
            <input type="submit" class="btn btn-warning" name="simpan" value="SIMPAN">
            <input type="reset" class="btn btn-dark" name="batal" value="BATAL" onclick="history.back()">
        </form>
    </div>
</div>
<?php
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
?>