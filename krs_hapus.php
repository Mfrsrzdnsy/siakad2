<?php
include "koneksi.php";
if (isset($_GET['nim']) && isset($_GET['kode_matkul'])) {
    $nim = $_GET['nim'];
    $kode_matkul = $_GET['kode_matkul'];
    $delete = "DELETE FROM khs WHERE kode_matkul='$kode_matkul' AND nim='$nim'";
    $query = mysqli_query($koneksi, $delete);
    if ($query) {
        echo "<script language='javascript'> alert('Mata kuliah berhasil dihapus!'); document.location='beranda.php?page=krs_isi'; </script>";
    } else {
        echo "matakuliah gagal di hapus";
    }
}
