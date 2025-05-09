<?php
require_once 'dbkoneksi.php';

$sql = "SELECT * FROM pasien";
$rs = $dbh->query($sql);
?>

<?php
    include_once 'top.php';
?>

<div id="page-content-wrapper">
                <!-- Top navigation-->
                <?php
                    include_once 'menu.php';
                ?>

<div class="container mt-4" class="w-100">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Pasien</h4>
            <a href="form_pasien.php" class="btn btn-light btn-sm">+ Tambah Pasien</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-primary">
                        <tr>
                            <th>Kode</th>
                            <th>Nama</th>
                            <th>tempat lahir</th>
                            <th>tanggal lahir</th>
                            <th>alamat</th>
                            <th>email</th>
                            <th>kelurahan</th>
                            <th>Gender</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($rs as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['kode']) ?></td>
                            <td><?= htmlspecialchars($row['nama']) ?></td>
                            <td><?= htmlspecialchars($row['tmp_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['tgl_lahir']) ?></td>
                            <td><?= htmlspecialchars($row['alamat']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= htmlspecialchars($row['kelurahan_id']) ?></td>
                            <td><?= htmlspecialchars($row['gender']) ?></td>
                            <td>
                                <a href="form_pasien.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="proses_pasien.php?hapus=<?= $row['id'] ?>" 
                                   class="btn btn-danger btn-sm" 
                                   onclick="return confirm('Yakin hapus?')">Hapus</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php if ($rs->rowCount() == 0): ?>
                        <tr>
                            <td colspan="4" class="text-center text-muted">Data tidak tersedia</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>

<?php
 include_once 'bottom.php';
?>
