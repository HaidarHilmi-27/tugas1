<?php
require_once 'dbkoneksi.php';

// Hapus
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $stmt = $dbh->prepare("DELETE FROM paramedik WHERE id=?");
    $stmt->execute([$id]);
    header('Location: data_paramedik.php');
    exit;
}

// Simpan (insert/update)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? '';
    $data = [
        $_POST['nama'],
        $_POST['gender'],
        $_POST['tmp_lahir'],
        $_POST['tgl_lahir'],
        $_POST['kategori'],
        $_POST['telpon'],
        $_POST['alamat'],
        $_POST['unit_kerja_id'] ?: null
    ];

    if ($id) {
        // Update
        $data[] = $id;
        $sql = "UPDATE paramedik SET nama=?, gender=?, tmp_lahir=?, tgl_lahir=?, kategori=?, telpon=?, alamat=?, unit_kerja_id=? WHERE id=?";
    } else {
        // Insert
        $sql = "INSERT INTO paramedik (nama, gender, tmp_lahir, tgl_lahir, kategori, telpon, alamat, unit_kerja_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    }

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header('Location: data_paramedik.php');
    exit;
}
