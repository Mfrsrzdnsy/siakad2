<?php
if ($_SESSION['level'] == "admin") {
    // Ambil data dosen untuk dropdown Nama Dosen
    $queryDosen = mysqli_query($koneksi, "SELECT * FROM tbldosen");
    
    // Ambil data mata kuliah untuk dropdown Mata Kuliah
    $queryMatkul = mysqli_query($koneksi, "SELECT * FROM tblmatkul");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $selectedDosen = $_POST["selectDosen"];
        $selectedMatkul = $_POST["selectMatkul"];

        // Gunakan nilai yang dipilih untuk mengambil data yang berelasi
        $result = mysqli_query($koneksi, "SELECT * FROM tbldosen, tblmatkul, mengajar WHERE tbldosen.nidn = mengajar.nidn AND tblmatkul.kode_matkul = mengajar.kode_matkul AND tbldosen.nidn = '$selectedDosen' AND tblmatkul.kode_matkul = '$selectedMatkul'");
        
        // Tampilkan hasil kueri untuk memeriksa
        if (!$result) {
            die("Error in query: " . mysqli_error($koneksi));
        }

        // Tampilkan data yang berelasi
        while ($data = mysqli_fetch_array($result)) {
            // Tampilkan data yang diperlukan
            echo "Nama Dosen: " . $data['nama_dosen'] . "<br>";
            echo "Mata Kuliah: " . $data['nama_matkul'] . "<br>";
            // Tampilkan data lainnya sesuai kebutuhan
        }
    }
    ?>
    <div class="card">
        <div class="card-header text-bg-warning">
            DATA MENGAJAR
        </div>
        <div class="card-body">
            <h5 class="card-title" style="text-align: center;">Tambah Dosen Mengajar</h5>
            <hr>
            <form method="POST" action="" enctype="multipart/form-data">
                <div class="row mb-3">
                    <label for="selectDosen" class="col-sm-4 col-form-label">Nama Dosen</label>
                    <div class="col-sm-8">
                        <select name="selectDosen" class="form-control" id="selectDosen">
                            <?php
                            // Tampilkan data dosen dalam dropdown
                            while ($dosen = mysqli_fetch_array($queryDosen)) {
                                echo "<option value='" . $dosen['nidn'] . "'>" . $dosen['nama_dosen'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="selectMatkul" class="col-sm-4 col-form-label">Mata Kuliah</label>
                    <div class="col-sm-8">
                        <select name="selectMatkul" class="form-control" id="selectMatkul">
                            <?php
                            // Tampilkan data mata kuliah dalam dropdown
                            while ($matkul = mysqli_fetch_array($queryMatkul)) {
                                echo "<option value='" . $matkul['kode_matkul'] . "'>" . $matkul['nama_matkul'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <input type="submit" class="btn btn-warning" name="simpan" value="SIMPAN">
                <input type="reset" class="btn btn-dark" name="batal" value="BATAL">
            </form>
        </div>
    </div>
    <?php
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
?>
