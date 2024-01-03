<?php if ($_SESSION['level'] == "admin") { ?>
<div class="card">
    <div class="card-header text-bg-warning">
        DATA MAHASISWA
    </div>
    <div class="card-body">
        <h5 class="card-title" style="text-align: center;">Ubah Mahasiswa</h5>
        <hr>
        <?php
            include "koneksi.php";
            if (isset($_GET['kode_matkul'])) {
                $kode_matkul = $_GET['kode_matkul'];
                $tampil = "SELECT * FROM tblmatkul WHERE kode_matkul='$kode_matkul'";
                $qtampil = mysqli_query($koneksi, $tampil);
                $dt = mysqli_fetch_array($qtampil);
            } else {
                header("location:?page=matkul");
            }
            if (isset($_POST['simpan'])) {
                $matkul = $_POST['matkul'];
                $sks = $_POST['sks'];
                $semester = $_POST['semester'];
                $a = "UPDATE tblmatkul SET matkul='$matkul',sks='$sks',semester='$semester' WHERE kode_matkul='$kode_matkul'";
                $b = mysqli_query($koneksi, $a);
                if ($b) {
                    header("location:?page=matkul");
                } else {
                    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
  <strong>Berhasil!</strong> Data berhasil disimpan.
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
                }
            }
            ?>
        <form method="POST" action="" enctype="multipart/form-data">
            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-4 col-form-label">Kode Mata Kuliah</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['kode_matkul'] ?>" name="kode_matkul" class="form-control"
                        id="inputEmail3" disabled>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">Mata Kuliah</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['matkul'] ?>" name="matkul" class="form-control"
                        id="inputPassword3">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-4 col-form-label">SKS</label>
                <div class="col-sm-8">
                    <input type="text" value="<?php echo $dt['sks'] ?>" name="sks" class="form-control"
                        id="inputPassword3">
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