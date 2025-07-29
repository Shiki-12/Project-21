<?php
include 'koneksi.php';

// Cek apakah form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama_pengirim = $_POST['name'];
    $email_pengirim = $_POST['email'];    
    $judul_pesan = $_POST['subject'];
    $pesan = $_POST['message'];
    $tgl_pesan = date('Y-m-d H:i:s');

    // Query insert sederhana
    $sql = "INSERT INTO pesan (nama_pengirim, email_pengirim, judul_pesan, pesan, tgl_pesan) 
            VALUES ('$nama_pengirim', '$email_pengirim', '$judul_pesan', '$pesan', '$tgl_pesan')";

    // Eksekusi query
    if (mysqli_query($koneksi, $sql)) {
        echo "<script>
            document.location.reload(true);
            window.location.href = '../contact.php';
        </script>";
        exit();
    } else {
        echo "<script>
            alert('Error: " . mysqli_error($koneksi) . "');
            window.location.href = '../contact.php';
        </script>";
    }

    mysqli_close($koneksi);
}
?>