<?php
require_once 'dbkoneksi.php';

// Hapus data
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $dbh->prepare("DELETE FROM pasien WHERE id=?");
    $stmt->execute([$id]);
    header("Location: data_pasien.php");
    exit;
}

// Simpan data (Insert/Update)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id           = $_POST['id'] ?? '';
    $kode         = $_POST['kode'];
    $nama         = $_POST['nama'];
    $tmp_lahir    = $_POST['tmp_lahir'] ?? '';
    $tgl_lahir    = $_POST['tgl_lahir'] ?? '';
    $alamat       = $_POST['alamat'] ?? '';
    $email        = $_POST['email'] ?? '';
    $kelurahan_id = $_POST['kelurahan_id'] ?? null;
    $gender       = $_POST['gender'];

    if ($id) {
        // Update data
        $sql = "UPDATE pasien SET kode=?, nama=?, tmp_lahir=?, tgl_lahir=?, alamat=?, email=?, kelurahan_id=?, gender=? WHERE id=?";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $alamat, $email, $kelurahan_id, $gender, $id]);
    } else {
        // Insert data baru
        $sql = "INSERT INTO pasien (kode, nama, tmp_lahir, tgl_lahir, alamat, email, kelurahan_id, gender) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $dbh->prepare($sql);
        $stmt->execute([$kode, $nama, $tmp_lahir, $tgl_lahir, $alamat, $email, $kelurahan_id, $gender]);
    }

    header("Location: data_pasien.php");
    exit;
}
