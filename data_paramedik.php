<?php
require_once 'dbkoneksi.php';

$sql = "SELECT * FROM paramedik";
$rs = $dbh->query($sql);
?>

<?php include_once 'top.php'; ?>
<div id="page-content-wrapper">
<?php include_once 'menu.php'; ?>

<div class="container mt-4 w-100">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Paramedik</h4>
            <a href="form_paramedik.php" class="btn btn-light btn-sm">+ Tambah Paramedik</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama</th>
                            <th>Gender</th>
                            <th>Tempat Lahir</th>
                            <th>Tanggal Lahir</th>
                            <th>Kategori</th>
                            <th>Telpon</th>
                            <th>Alamat</th>
                            <th>Unit Kerja</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['gender']) ?></td>
                            <td><?= htmlspecialchars($row['tmp_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['kategori']) ?></td>
                            <td><?= htmlspecialchars($row['telpon']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['unit_kerja_id']) ?></td>
                            <td>
                                <a href="form_paramedik.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses_paramedik.php?hapus=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if ($rs->rowCount() == 0): ?>
                        <tr>
                            <td colspan="9" class="text-center text-muted">Data tidak tersedia</td>
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
