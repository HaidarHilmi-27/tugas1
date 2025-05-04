<?php
require_once 'dbkoneksi.php';

$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM periksa WHERE id = ?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}

// Ambil data pasien dan paramedik (dokter) untuk dropdown
$pasien = $dbh->query("SELECT id, nama FROM pasien")->fetchAll();
$dokter = $dbh->query("SELECT id, nama FROM paramedik WHERE kategori='dokter'")->fetchAll();
?>

<?php include_once 'top.php'; ?>
<div id="page-content-wrapper">
<?php include_once 'menu.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= $id ? 'Edit' : 'Tambah' ?> Data Periksa</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="proses_periksa.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Berat (kg)</label>
                    <input type="number" name="berat" step="0.01" class="form-control" value="<?= $row['berat'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tinggi (cm)</label>
                    <input type="number" name="tinggi" step="0.01" class="form-control" value="<?= $row['tinggi'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Tensi</label>
                    <input type="text" name="tensi" class="form-control" value="<?= $row['tensi'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"><?= $row['keterangan'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Pasien</label>
                    <select name="pasien_id" class="form-select" required>
                        <option value="">-- Pilih Pasien --</option>
                        <?php foreach ($pasien as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= ($row['pasien_id'] ?? '') == $p['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Dokter</label>
                    <select name="dokter_id" class="form-select" required>
                        <option value="">-- Pilih Dokter --</option>
                        <?php foreach ($dokter as $d): ?>
                            <option value="<?= $d['id'] ?>" <?= ($row['dokter_id'] ?? '') == $d['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($d['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <button type="submit" name="proses" value="Simpan" class="btn btn-success">Simpan</button>
                <a href="data_periksa.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</div>
<?php include_once 'bottom.php'; ?>
