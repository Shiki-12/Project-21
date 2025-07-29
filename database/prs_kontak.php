<?php
include("koneksi.php");

$deskrisi_kontak = $_POST['deskripsi_kontak'];
$alamat = $_POST['alamat'];
$peta = $_POST['peta'];

$sql = "INSERT INTO kontak (deskripsi_kontak, alamat, peta) VALUES ('$deskrisi_kontak', '$alamat', '$peta')";

if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data Kontak berhasil disimpan')
    window.location.href = '../index.php';</script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($koneksi);
}
?>