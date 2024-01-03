<?php if ($_SESSION['level'] == "admin" || $_SESSION['level'] == "dosen") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA DOSEN
    </div>
    <div class="card-body">
        <h5 class="card-title" style="text-align: center;">Ubah Data Dosen</h5>
        <hr>
        <?php
            include "koneksi.php";
            if (isset($_GET['nidn'])) {
                $nidn = $_GET['nidn'];
                $tampil = "SELECT * FROM tbldosen WHERE nidn='$nidn'";
                $qtampil = mysqli_query($koneksi, $tampil);
                $dt = mysqli_fetch_array($qtampil);
            } else {
                header("location:?page=dosen");
            }
            if (isset($_POST['simpan'])) {
                $nama = $_POST['nama'];
                $pendidikan = $_POST['pendidikan'];
                $jenis_kelamin = $_POST['jenis_kelamin'];
                $alamat = $_POST['alamat'];


                //validasi foto
                $foto = $_FILES['foto']['name'];
                $tmp = $_FILES['foto']['tmp_name'];
                $size = $_FILES['foto']['size'];
                $ekstensi = array('jpg', 'png', 'jpeg');
                $ekstensi_file = strtolower(pathinfo($foto, PATHINFO_EXTENSION));
                $ekstensi_ok = in_array($ekstensi_file, $ekstensi);

                
                if (strlen($foto > 0)) {
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
                    $a = "UPDATE tbldosen SET nama='$nama',pendidikan='$pendidikan',jenis_kelamin='$jenis_kelamin',
		                alamat='$alamat',foto='$foto' where nidn='$nidn'";
                    $b = mysqli_query($koneksi, $a);
                    move_uploaded_file($tmp, "foto/$foto");
                
                    if ($b) {
                        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                        <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=dosen'>LIHAT DATA</a>.
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
                    $a = "UPDATE tbldosen SET nama='$nama',pendidikan='$pendidikan',jenis_kelamin='$jenis_kelamin',
		                alamat='$alamat' where nidn='$nidn'";
                    $b = mysqli_query($koneksi, $a);
                    
                if ($b) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                              <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=dosen'>LIHAT DATA</a>.
                              <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
                          <strong>Berhasil!</strong> Data berhasil disimpan.
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                }
            }
        }
            ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Nomor Induk Dosen Nasional</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['nidn'] ?>" name="nidn" class="form-control"
                        id="inputEmail3" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Nama Dosen</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['nama'] ?>" name="nama" class="form-control"
                        id="inputPassword3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Pendidikan</label>
                <div class="col-sm-8">
                    <select name="pendidikan" class="form-select" aria-label="Default select example">
                        <option value="Magister Ilmu Komputer: M.Kom." <?php if ($dt['pendidikan'] == "Magister Ilmu Komputer: M.Kom.") {
                                                                                echo "selected";
                                                                            } ?>>
                            Magister
                            Ilmu
                            Komputer: M.Kom.
                        </option>
                        <option value="Magister Teknologi Informasi: M.TI." <?php if ($dt['pendidikan'] == "Magister Teknologi Informasi: M.TI.") {
                                                                                    echo "selected";
                                                                                } ?>>
                            Magister
                            Teknologi Informasi: M.TI.
                        </option>
                        <option value="Master of Computer Science: M.Cs." <?php if ($dt['pendidikan'] == "Master of Computer Science: M.Cs.") {
                                                                                    echo "selected";
                                                                                } ?>>
                            Master
                            of
                            Computer Science: M.Cs.</option>
                    </select>
                </div>
            </div>
            <fieldset class="row mb-3">
                <legend class="col-form-label col-sm-4 pt-0">Jenis Kelamin</legend>
                <div class="col-sm-8">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios1" value="L"
                            <?php if ($dt['jenis_kelamin'] == "L") {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                        <label class="form-check-label" for="gridRadios1">
                            Laki-Laki
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="gridRadios2" value="P"
                            <?php if ($dt['jenis_kelamin'] == "P") {
                                                                                                                                echo "checked";
                                                                                                                            } ?>>
                        <label class="form-check-label" for="gridRadios2">
                            Perempuan
                        </label>
                    </div>
                </div>
            </fieldset>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Alamat</label>
                <div class="col-sm-8">
                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1"
                        rows="3"><?php echo $dt['alamat'] ?></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Upload Foto</label>
                <div class="col-sm-8">
                    <img src="foto/<?php echo $dt['foto'] ?>" width="70px" class="img-thumbnail" alt="">
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