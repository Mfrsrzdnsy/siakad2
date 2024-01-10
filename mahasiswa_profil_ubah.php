<?php if ($_SESSION['level'] == "mahasiswa") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <h5 class="card-title" style="text-align: center;">Ubah Mahasiswa</h5>
        <hr>
        <?php
            include "koneksi.php";
            if (isset($_GET['nim'])) {
                $nim = $_GET['nim'];
                $tampil = "SELECT * FROM tblmahasiswa WHERE nim='$nim'";
                $qtampil = mysqli_query($koneksi, $tampil);
                $dt = mysqli_fetch_array($qtampil);
            } else {
                header("location:?page=mahasiswa");
            }
            
            if (isset($_POST['simpan'])) {
                $nama_mhs = $_POST['nama_mhs'];
                $prodi = $_POST['prodi'];
                $semester = $_POST['semester'];
                $alamat = $_POST['alamat'];
                $jnskel = $_POST['jnskel'];

                //validasi foto
                $foto = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];
                $size = $_FILES['foto']['size'];
                $ekstensi = array('jpg', 'png', 'jpeg');
                $ekstensi_file = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                $ekstensi_ok = in_array($ekstensi_file, $ekstensi);
                
                if (strlen($foto) > 0) {
                    if ($size > 1000000) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Gagal!!!</strong> Ukuran Foto Tidak Boleh Lebih Dari 1Mb!!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    } elseif (!$ekstensi_ok) {
                        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Gagal!!!</strong> Format Foto harus jpg, png, jpeg!!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    } else {
                        $a = "UPDATE tblmahasiswa SET nama_mhs='$nama_mhs',prodi='$prodi',semester='$semester',
                            alamat='$alamat',jnskel='$jnskel',foto='$foto' WHERE nim='$nim'";
                        $b = mysqli_query($koneksi, $a);
                        move_uploaded_file($tmp, "foto/$foto");
            
                        if ($b) {
                            echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=mahasiswa_profil' style='text-decoration: none;'>LIHAT DATA</a>.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        } else {
                            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                                <strong>Gagal!</strong> Data gagal disimpan.
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                        }
                    }
                } else {
                    $a = "UPDATE tblmahasiswa SET nama_mhs='$nama_mhs',prodi='$prodi',semester='$semester',
                        alamat='$alamat',jnskel='$jnskel' WHERE nim='$nim'";
                    $b = mysqli_query($koneksi, $a);
            
                    if ($b) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                              <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=mahasiswa_profil' style='text-decoration: none;'>LIHAT DATA</a>.
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                    } else {
                        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                            <strong>Gagal!</strong> Data gagal disimpan.
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                }
            }
        

            ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor Induk Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['nim']; ?>" name="nim" class="form-control"
                        id="inputEmail3" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama Mahasiswa</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['nama_mhs']; ?>" name="nama_mhs" class="form-control"
                        id="inputPassword3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Program Studi</label>
                <div class="col-sm-8">
                    <select name="prodi" class="form-select" aria-label="Default select example">
                        <option value="Teknik Informatika" <?php if ($dt['prodi'] == "Teknik Informatika") {
                                                                    echo "selected";
                                                                } ?>>Teknik Informatika
                        </option>
                        <option value="Sistem Informasi" <?php if ($dt['prodi'] == "Sistem Informasi") {
                                                                    echo "selected";
                                                                } ?>>Sistem Informasi</option>
                        <option value="Teknologi Informasi" <?php if ($dt['prodi'] == "Teknologi Informasi") {
                                                                    echo "selected";
                                                                } ?>>Teknologi Informasi
                        </option>
                        <option value="Manajemen" <?php if ($dt['prodi'] == "Manajemen") {
                                                            echo "selected";
                                                        } ?>>Manajemen</option>
                        <option value="Manajemen Komputer" <?php if ($dt['prodi'] == "Menajemen Komputer") {
                                                                    echo "selected";
                                                                } ?>>Manajemen Komputer</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Semester</label>
                <div class="col-sm-8">
                    <select name="semester" class="form-select" aria-label="Default select example">
                        <option value="1" <?php if ($dt['semester'] == "1") {
                                                    echo "selected";
                                                } ?>>1</option>
                        <option value="2" <?php if ($dt['semester'] == "2") {
                                                    echo "selected";
                                                } ?>>2</option>
                        <option value="3" <?php if ($dt['semester'] == "3") {
                                                    echo "selected";
                                                } ?>>3</option>
                        <option value="4" <?php if ($dt['semester'] == "4") {
                                                    echo "selected";
                                                } ?>>4</option>
                        <option value="5" <?php if ($dt['semester'] == "5") {
                                                    echo "selected";
                                                } ?>>5</option>
                        <option value="6" <?php if ($dt['semester'] == "6") {
                                                    echo "selected";
                                                } ?>>6</option>
                        <option value="7" <?php if ($dt['semester'] == "7") {
                                                    echo "selected";
                                                } ?>>7</option>
                        <option value="8" <?php if ($dt['semester'] == "8") {
                                                    echo "selected";
                                                } ?>>8</option>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1"
                        rows="3"><?php echo $dt['alamat']; ?></textarea>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jnskel" id="gridRadios1" value="L"
                            <?php if ($dt['jnskel'] == "L") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
                        <label class="form-check-label" for="gridRadios1">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jnskel" id="gridRadios2" value="P"
                            <?php if ($dt['jnskel'] == "P") {
                                                                                                                        echo "checked";
                                                                                                                    } ?>>
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
                    <input type="email" name="email" value="<?php echo $dt['email']; ?>" class="form-control"
                        id="inputPassword3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Foto</label>
                <div class="col-sm-8">
                    <img src="foto/<?php echo $dt['foto']; ?>" width="70px" class="img-thumbnail" alt="...">
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