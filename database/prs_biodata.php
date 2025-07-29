<?php
include 'koneksi.php';

// --- FUNGSI UNTUK UPLOAD FILE ---
// Fungsi ini bisa dipakai ulang untuk upload foto dan hero
function uploadFile($fileKey, $targetDir) {
    // Cek apakah fileKey ada di $_FILES dan tidak ada error
    if (!isset($_FILES[$fileKey]) || $_FILES[$fileKey]['error'] != UPLOAD_ERR_OK) {
        return ['success' => false, 'message' => "Tidak ada file yang diupload atau terjadi error."];
    }

    $originalFileName = basename($_FILES[$fileKey]["name"]);
    $target_file = $targetDir . $originalFileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check jika file adalah gambar asli
    $check = getimagesize($_FILES[$fileKey]["tmp_name"]);
    if ($check === false) {
        return ['success' => false, 'message' => "File bukan gambar."];
    }

    // --- PENGECEKAN FILE DUPLIKAT (DIBUAT LEBIH CANGGIH) ---
    // Jika file dengan nama yang sama sudah ada, tambahkan ID unik di belakangnya
    if (file_exists($target_file)) {
        $fileNameWithoutExt = pathinfo($originalFileName, PATHINFO_FILENAME);
        $target_file = $targetDir . $fileNameWithoutExt . '_' . uniqid() . '.' . $imageFileType;
    }

    // Izinkan format file tertentu
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        return ['success' => false, 'message' => "Maaf, hanya file JPG, JPEG, PNG & GIF yang diizinkan."];
    }

    // Coba upload file
    if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $target_file)) {
        // Mengembalikan path relatif untuk disimpan di DB
        return ['success' => true, 'path' => $target_file];
    } else {
        return ['success' => false, 'message' => "Maaf, terjadi error saat mengupload file."];
    }
}

// --- PROSES UPLOAD ---
// Direktori upload relatif dari file prs_biodata.php
$uploadDirFoto = '../uploads/foto/';
$uploadDirHero = '../uploads/hero/';

// Pastikan direktori ada, kalau tidak, buat baru
if (!is_dir($uploadDirFoto)) {
    mkdir($uploadDirFoto, 0777, true);
}
if (!is_dir($uploadDirHero)) {
    mkdir($uploadDirHero, 0777, true);
}


$uploadFoto = uploadFile('fileToUpload', $uploadDirFoto);
$uploadHero = uploadFile('fileToUpload2', $uploadDirHero);

// Jika salah satu upload gagal, hentikan proses
if (!$uploadFoto['success'] || !$uploadHero['success']) {
    $errorMsg = !$uploadFoto['success'] ? $uploadFoto['message'] : $uploadHero['message'];
    die("Error upload: " . $errorMsg);
}

// --- PERBAIKAN PATH ---
// Ambil path file yang berhasil diupload dan bersihkan '../'
$url_foto = str_replace('../', '', $uploadFoto['path']);
$url_hero = str_replace('../', '', $uploadHero['path']);


// --- AMBIL DATA DARI POST ---
$nama_depan = $_POST['nama_depan'];
$nama_belakang = $_POST['nama_belakang'];
$tentang = $_POST['tentang'];
$profesi = $_POST['profesi'];
$deskripsi_profesi = $_POST['deskripsi_profesi'];
$tgl_lahir = $_POST['tgl_lahir'];
$website = $_POST['website'];
$gelar = $_POST['gelar'];
$hp = $_POST['hp'];
$email = $_POST['email'];
$kota = $_POST['kota'];
$freelance = $_POST['freelance'];
$keterangan_about = $_POST['keterangan_about'];
$keterangan_skill = $_POST['keterangan_skill'];
$skill = $_POST['skill'];


// --- SIMPAN KE DATABASE (CARA AMAN DENGAN PREPARED STATEMENT) ---
$sql = "INSERT INTO biodata (nama_depan, nama_belakang, tentang, profesi, deskripsi_profesi, tgl_lahir, website, gelar, hp, email, kota, freelance, keterangan_about, keterangan_skill, skill, url_hero, url_foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = mysqli_prepare($koneksi, $sql);

if ($stmt) {
    mysqli_stmt_bind_param(
        $stmt,
        "sssssssssssssssss", // s = string
        $nama_depan,
        $nama_belakang,
        $tentang,
        $profesi,
        $deskripsi_profesi,
        $tgl_lahir,
        $website,
        $gelar,
        $hp,
        $email,
        $kota,
        $freelance,
        $keterangan_about,
        $keterangan_skill,
        $skill,
        $url_hero,
        $url_foto
    );

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Data berhasil disimpan');
        window.location.href = '../index.php';</script>"; // Redirect ke index.php
    } else {
        echo "Error: " . mysqli_stmt_error($stmt);
    }
    mysqli_stmt_close($stmt);
} else {
    echo "Error: " . mysqli_error($koneksi);
}

mysqli_close($koneksi);
?>