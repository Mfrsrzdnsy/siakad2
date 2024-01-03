<?php
if ($_SESSION['level'] == "admin") {
    include "koneksi.php";
    if (isset($_GET['id_user'])) {
        $id_user = $_GET['id_user'];
        $hapus = "DELETE FROM user WHERE id_user = '$id_user'";
        $qhapus = mysqli_query($koneksi, $hapus);
        if ($qhapus) {
            header("location:?page=user");
        }
    } else {
        header("location:?page=user");
    }
} else {
    echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}
