<?php
require_once 'dbkoneksi.php';

if (isset($_GET['hapus'])) {
    $stmt = $dbh->prepare("DELETE FROM pasien WHERE id=?");
    $stmt->execute([$_GET['hapus']]);
    header("Location: data_pasien.php");
    exit;
}

if ($_POST['proses'] == 'Simpan') {
    $data = [
        $_POST['kode'],
        $_POST['nama'],
        $_POST['gender']
    ];

    if ($_POST['id']) {
        $sql = "UPDATE pasien SET kode=?, nama=?, gender=? WHERE id=?";
        $data[] = $_POST['id'];
    } else {
        $sql = "INSERT INTO pasien (kode, nama, gender) VALUES (?, ?, ?)";
    }

    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    header("Location: data_pasien.php");
}
