<?php
if ($_SESSION['level'] == "admin") {
    include "koneksi.php";
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        $hapus = "DELETE FROM user WHERE email = '$email'";
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
