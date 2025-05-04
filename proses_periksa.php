<?php
require_once 'dbkoneksi.php';

// Handle hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $dbh->prepare("DELETE FROM periksa WHERE id = ?");
    $stmt->execute([$id]);
    header('Location: data_periksa.php');
    exit;
}

// Ambil data dari POST
$_tanggal    = $_POST['tanggal'] ?? '';
$_berat      = $_POST['berat'] ?? null;
$_tinggi     = $_POST['tinggi'] ?? null;
$_tensi      = $_POST['tensi'] ?? '';
$_keterangan = $_POST['keterangan'] ?? '';
$_pasien_id  = $_POST['pasien_id'] ?? null;
$_dokter_id  = $_POST['dokter_id'] ?? null;
$_id         = $_POST['id'] ?? '';

// Simpan data
if (!empty($_id)) {
    // Update
    $sql = "UPDATE periksa SET tanggal=?, berat=?, tinggi=?, tensi=?, keterangan=?, pasien_id=?, dokter_id=? WHERE id=?";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_tanggal, $_berat, $_tinggi, $_tensi, $_keterangan, $_pasien_id, $_dokter_id, $_id]);
} else {
    // Insert
    $sql = "INSERT INTO periksa (tanggal, berat, tinggi, tensi, keterangan, pasien_id, dokter_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $dbh->prepare($sql);
    $stmt->execute([$_tanggal, $_berat, $_tinggi, $_tensi, $_keterangan, $_pasien_id, $_dokter_id]);
}

// Kembali ke halaman utama
header('Location: data_periksa.php');
exit;
?>
