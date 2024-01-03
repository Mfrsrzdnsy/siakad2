<?php if ($_SESSION['level'] == "admin") { ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<div class="card">
    <div class="card-header text-bg-warning">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <h5 class="card-title" style="text-align: center;">Tambah Mahasiswa</h5>
        <hr>
        <?php
            include "koneksi.php";
            if (isset($_POST['simpan'])) {
                $nim = $_POST['nim'];
                $nama_mhs = $_POST['nama_mhs'];
                $prodi = $_POST['prodi'];
                $semester = $_POST['semester'];
                $jnskel = $_POST['jnskel'];
                $email = $_POST['email'];
                $alamat = $_POST['alamat'];

                //validasi Foto
                $foto = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];
                $size = $_FILES['foto']['size'];
                $ekstensi = array('jpg', 'png', 'jpeg');
                $ekstensi_file = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                $ekstensi_ok = in_array($ekstensi_file, $ekstensi);
                $pass = md5("123");

                //validasi
                $cek = mysqli_query($koneksi, "SELECT * FROM tblmahasiswa WHERE nim='$nim'");
                $row = mysqli_num_rows($cek);
                if ($row > 0) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Gagal!!!</strong> Nomor Induk Mahasiswa Sudah Ada!!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                } elseif (strlen($nim) <> 7) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          <strong>Gagal!!!</strong> NIM Harus 7 Karakter!!
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
                    $a = "INSERT into tblmahasiswa values('$nim','$nama_mhs','$prodi','$semester',
	                '$alamat','$jnskel','$email','$foto')";
                    $b = mysqli_query($koneksi, $a);
                    move_uploaded_file($tmp, "foto/$foto");
                    $input = mysqli_query($koneksi, "INSERT INTO user VALUES('$email','$pass','mahasiswa','$nama_mhs')");
                    if ($b) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                              <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=mahasiswa'>LIHAT DATA</a>.
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
                <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa <font color='red'>*
                    </font>
                </label>
                <div class=" col-sm-8">
                    <input type="text" name="nim" class="form-control" id="inputEmail3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama Mahasiswa <font color="red">*</font>
                </label>
                <div class=" col-sm-8">
                    <input type="text" name="nama_mhs" class="form-control" id="inputPassword3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Program Studi <font color="red">*</font>
                </label>
                <div class="col-sm-8">
                    <select name="prodi" class="form-select" aria-label="Default select example" required>
                        <option value="">--- Pilih Program Study ---</option>
                        <option value="Teknik Informatika">Teknik Informatika</option>
                        <option value="Sistem Informasi">Sistem Informasi</option>
                        <option value="Teknologi Informasi">Teknologi Informasi</option>
                        <option value="Manajemen">Manajemen</option>
                        <option value="Manajemen Komputer">Manajemen Komputer</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Semester <font color="red">*</font></label>
                <div class="col-sm-8">
                    <select name="semester" class="form-select" aria-label="Default select example" required>
                        <option value="">--- Pilih Semester ---</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                    </select>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jnskel" id="gridRadios1" value="L" checked>
                        <label class="form-check-label" for="gridRadios1">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jnskel" id="gridRadios2" value="P">
                        <label class="form-check-label" for="gridRadios2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Email <font color="red">*</font>
                </label>
                <div class=" col-sm-8">
                    <input type="email" name="email" class="form-control" id="inputPassword3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3"
                        required></textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                    <img id="showImage" src="foto/<?php echo $a['foto']; ?>" width="70px" class="img-thumbnail"
                        alt="..."></td>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Foto</label>
                <div class="col-sm-8">
                    <input class="form-control" name="foto" type="file" id="image">
                </div>
            </div>
            <input type="submit" class="btn btn-warning" name="simpan" value="SIMPAN">
            <input type="reset" class="btn btn-dark" name="batal" value="BATAL" onclick="history.back()">
        </form>
    </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    $('#image').change(function(e) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#showImage').attr('src', e.target.result);
        }
        reader.readAsDataURL(e.target.files['0']);
    });
});
</script>


<?php
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
?>