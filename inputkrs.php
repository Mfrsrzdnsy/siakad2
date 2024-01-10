<?php
error_reporting(0);
include "koneksi.php";

if (isset($_GET['nim']) && isset($_GET['kode_matkul']))  {
    $nim = $_GET['nim'];
    $kode_matkul = $_GET['kode_matkul'];
    $semester = $_GET['semester'];

    $input = "INSERT INTO khs VALUES ('NULL', '$nim', '$kode_matkul', '$semester', '')";
    $query = mysqli_query($koneksi, $input);
    if ($query) {
        echo "<script language='javascript'>
alert('Input KRS sukses');
document.location='beranda.php?page=tambahmk&&nim=$_GET[nim]';
</script>";

    } else {
        echo "Input Mata Kuliah ke KRS gagal";
    }
}
?>