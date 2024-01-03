<?php
if ($_SESSION['level'] == "admin") {
    include "koneksi.php";
    if (isset($_GET['nidn'])) {
        $nidn = $_GET['nidn'];
        $hapus = "DELETE FROM tbldosen WHERE nidn = '$nidn'";
        $qhapus = mysqli_query($koneksi, $hapus);
        if ($qhapus) {
            header("location:?page=dosen");
        }
    } else {
        header("location:?page=dosen");
    }
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
