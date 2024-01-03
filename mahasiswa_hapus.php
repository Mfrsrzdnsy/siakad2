<?php
if ($_SESSION['level'] == "admin") {
	include "koneksi.php";
	if (isset($_GET['email'])) {
		$email = $_GET['email'];
		$hapus = "delete from tblmahasiswa where email='$email'";
		$qhapus = mysqli_query($koneksi, $hapus);
		$del = mysqli_query($koneksi, "DELETE FROM user WHERE email = '$email'");
		if ($qhapus) {
			header("location:?page=mahasiswa");
		}
	} else {
		header("location:?page=mahasiswa");
	}
} else {
	echo "<font color='red'><h3>Anda bukan Admin</h3></font>";
}