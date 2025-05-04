<?php
require_once 'dbkoneksi.php';

// Ambil data pasien jika ada ID
$id = $_GET['id'] ?? '';
$row = [];

if ($id) {
    $stmt = $dbh->prepare("SELECT * FROM pasien WHERE id=?");
    $stmt->execute([$id]);
    $row = $stmt->fetch();
}

// Ambil data kelurahan untuk dropdown
$kelurahanStmt = $dbh->query("SELECT id, nama FROM kelurahan");
$kelurahanList = $kelurahanStmt->fetchAll();
?>

<?php include_once 'top.php'; ?>
<div id="page-content-wrapper">
<?php include_once 'menu.php'; ?>

<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0"><?= $id ? 'Edit' : 'Tambah' ?> Data Pasien</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="proses_pasien.php">
                <input type="hidden" name="id" value="<?= $row['id'] ?? '' ?>">

                <div class="mb-3">
                    <label class="form-label">Kode</label>
                    <input type="text" name="kode" class="form-control" value="<?= $row['kode'] ?? '' ?>" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Nama</label>
                    <input type="text" name="nama" class="form-control" value="<?= $row['nama'] ?? '' ?>" required>
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
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control"><?= $row['alamat'] ?? '' ?></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" value="<?= $row['email'] ?? '' ?>">
                </div>

                <div class="mb-3">
                    <label class="form-label">Kelurahan</label>
                    <select name="kelurahan_id" class="form-select">
                        <option value="">-- Pilih Kelurahan --</option>
                        <?php foreach ($kelurahanList as $kel): ?>
                            <option value="<?= $kel['id'] ?>" <?= ($row['kelurahan_id'] ?? '') == $kel['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($kel['nama']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Gender</label><br>
                    <label class="me-2"><input type="radio" name="gender" value="L" <?= ($row['gender'] ?? '') == 'L' ? 'checked' : '' ?>> Laki-laki</label>
                    <label><input type="radio" name="gender" value="P" <?= ($row['gender'] ?? '') == 'P' ? 'checked' : '' ?>> Perempuan</label>
                </div>

                <button type="submit" name="proses" value="Simpan" class="btn btn-success">Simpan</button>
                <a href="data_pasien.php" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</div>
<?php include_once 'bottom.php'; ?>
