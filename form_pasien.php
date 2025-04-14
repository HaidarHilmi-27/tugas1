<?php
require_once 'dbkoneksi.php';
require_once 'templates/header.php';

$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}
?>

<h2><?= $id ? 'Edit' : 'Tambah' ?> Pasien</h2>
<form method="POST" action="proses_pasien.php">
    <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

    <div class="form-group">
        <label>Kode</label>
        <input type="text" name="kode" class="form-control" value="<?= $row['kode'] ?? '' ?>">
    </div>

    <div class="form-group">
        <label>Nama</label>
        <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?? '' ?>">
    </div>

    <div class="form-group">
        <label>Gender</label><br>
        <label><input type="radio" name="gender" value="L" <?= ($row['gender'] ?? '') == 'L' ? 'checked' : '' ?>> Laki-laki</label>
        <label><input type="radio" name="gender" value="P" <?= ($row['gender'] ?? '') == 'P' ? 'checked' : '' ?>> Perempuan</label>
    </div>

    <button type="submit" name="proses" value="Simpan" class="btn btn-success">Simpan</button>
    <a href="data_pasien.php" class="btn btn-secondary">Batal</a>
</form>

<?php require_once 'templates/footer.php'; ?>
