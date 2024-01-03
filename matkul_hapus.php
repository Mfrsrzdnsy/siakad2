<?php
if ($_SESSION['level'] == "admin") {
    include "koneksi.php";
    if (isset($_GET['kode_matkul'])) {
        $kode_matkul = $_GET['kode_matkul'];
        $hapus = "DELETE FROM tblmatkul WHERE kode_matkul = '$kode_matkul'";
        $qhapus = mysqli_query($koneksi, $hapus);
        if ($qhapus) {
            header("location:?page=matkul");
        }
    } else {
        header("location:?page=matkul");
    }
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}