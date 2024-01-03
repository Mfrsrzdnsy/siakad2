<?php if ($_SESSION['level'] == "admin") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA MATA KULIAH
    </div>
    <div class="card-body">
        <h5 class="card-title" style="text-align: center;">Tambah Mata Kuliah</h5>
        <hr>
        <?php
            include "koneksi.php";
            if (isset($_POST['simpan'])) {
                $kode_matkul = $_POST['kode_matkul'];
                $matkul = $_POST['matkul'];
                $sks = $_POST['sks'];
                $semester = $_POST['semester'];
                
                //validasi
                $cek = mysqli_query($koneksi, "SELECT * FROM tblmatkul WHERE kode_matkul='$kode_matkul'");
                $row = mysqli_num_rows($cek);
                if ($row > 0) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                            <strong>Gagal!!!</strong> Kode Mata Kuliah Sudah Ada!!
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>";
                } elseif (strlen($kode_matkul) <> 5) {
                    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
                          <strong>Gagal!!!</strong> Kode Mata Kuliah Harus 5 Karakter!!
                          <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                } else {
                $a = "INSERT INTO tblmatkul VALUES('$kode_matkul', '$matkul', '$sks', '$semester')";
                $b = mysqli_query($koneksi, $a);

                if ($b) {
                    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                      <strong>Berhasil!</strong> Data berhasil disimpan, <a href='?page=matkul'>LIHAT DATA</a>.
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
                <label for="inputEmail3" class="col-sm-4 col-form-label">Kode Mata Kuliah <font color="red">*</font>
                </label>
                <div class="col-sm-8">
                    <input type="text" name="kode_matkul" class="form-control" id="inputEmail3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Mata Kuliah <font color="red">*</font>
                </label>
                <div class="col-sm-8">
                    <input type="text" name="matkul" class="form-control" id="inputPassword3" required>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">SKS <font color="red">*</font></label>
                <div class="col-sm-8">
                    <input type="text" name="sks" class="form-control" id="inputPassword3" required>
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