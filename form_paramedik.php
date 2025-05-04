<?php
require_once 'dbkoneksi.php';

$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM paramedik WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}

// Ambil data unit kerja untuk dropdown
$unitStmt = $dbh->query("SELECT id, nama FROM unit_kerja");
$unitList = $unitStmt->fetchAll();
?>

<?php include_once 'top.php'; ?>
<div id="page-content-wrapper">
<?php include_once 'menu.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= $id ? 'Edit' : 'Tambah' ?> Paramedik</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="proses_paramedik.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <label class="me-2"><input type="radio" name="gender" value="L" <?= ($row['gender'] ?? '') == 'L' ? 'checked' : '' ?>> Laki-laki</label>
                    <label><input type="radio" name="gender" value="P" <?= ($row['gender'] ?? '') == 'P' ? 'checked' : '' ?>> Perempuan</label>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tmp_lahir" class="form-control" value="<?= $row['tmp_lahir'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tgl_lahir" class="form-control" value="<?= $row['tgl_lahir'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <select name="kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        <option value="dokter" <?= ($row['kategori'] ?? '') == 'dokter' ? 'selected' : '' ?>>Dokter</option>
                        <option value="perawat" <?= ($row['kategori'] ?? '') == 'perawat' ? 'selected' : '' ?>>Perawat</option>
                        <option value="bidan" <?= ($row['kategori'] ?? '') == 'bidan' ? 'selected' : '' ?>>Bidan</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Telpon</label>
                    <input type="text" name="telpon" class="form-control" value="<?= $row['telpon'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= $row['alamat'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Unit Kerja</label>
                    <select name="unit_kerja_id" class="form-select">
                        <option value="">-- Pilih Unit Kerja --</option>
                        <?php foreach ($unitList as $unit): ?>
                            <option value="<?= $unit['id'] ?>" <?= ($row['unit_kerja_id'] ?? '') == $unit['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($unit['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="proses" value="Simpan" class="btn btn-success">Simpan</button>
                <a href="data_paramedik.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</div>
<?php include_once 'bottom.php'; ?>
