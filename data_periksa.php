<?php
require_once 'dbkoneksi.php';

// Ambil data pasien & dokter (paramedik) sebagai referensi
$pasienList = $dbh->query("SELECT id, nama FROM pasien")->fetchAll(PDO::FETCH_KEY_PAIR);
$dokterList = $dbh->query("SELECT id, nama FROM paramedik")->fetchAll(PDO::FETCH_KEY_PAIR);

$sql = "SELECT * FROM periksa";
$rs = $dbh->query($sql);
?>

<?php include_once 'top.php'; ?>
<div id="page-content-wrapper">
<?php include_once 'menu.php'; ?>

<div class="container mt-4 w-100">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Periksa</h4>
            <a href="form_periksa.php" class="btn btn-light btn-sm">+ Tambah Periksa</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>Berat (kg)</th>
                            <th>Tinggi (cm)</th>
                            <th>Tensi</th>
                            <th>Keterangan</th>
                            <th>Pasien</th>
                            <th>Dokter</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['tanggal']) ?></td>
                            <td><?= htmlspecialchars($row['berat']) ?></td>
                            <td><?= htmlspecialchars($row['tinggi']) ?></td>
                            <td><?= htmlspecialchars($row['tensi']) ?></td>
                            <td><?= htmlspecialchars($row['keterangan']) ?></td>
                            <td><?= htmlspecialchars($pasienList[$row['pasien_id']] ?? '-') ?></td>
                            <td><?= htmlspecialchars($dokterList[$row['dokter_id']] ?? '-') ?></td>
                            <td>
                                <a href="form_periksa.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses_periksa.php?hapus=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if ($rs->rowCount() == 0): ?>
                        <tr>
                            <td colspan="8" class="text-center text-muted">Data tidak tersedia</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

<?php include_once 'bottom.php'; ?>
