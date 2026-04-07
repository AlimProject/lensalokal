<?php
session_start();
include '../config/koneksi.php';
if ($_SESSION['status'] != "login") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Kelola Layanan - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5">
        <h2>Daftar Paket Layanan</h2>
        <a href="dashboard.php" class="btn btn-secondary mb-3">&larr; Kembali ke Dashboard</a>
        <a href="tambah_services.php" class="btn btn-primary mb-3 float-end">+ Tambah Paket Baru</a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Gambar</th>
                    <th>Nama Layanan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT * FROM services ORDER BY id DESC");
                $no = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <img src="../assets/img/<?php echo $row['gambar']; ?>" width="80" height="80" style="object-fit:cover;">
                        </td>
                        <td>
                            <strong><?php echo $row['nama_layanan']; ?></strong><br>
                            <small class="text-muted"><?php echo substr($row['deskripsi'], 0, 50); ?>...</small>
                        </td>
                        <td>Rp <?php echo number_format($row['harga']); ?></td>
                        <td>
                            <a href="edit_services.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus_services.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus paket ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>