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
    <title>Kelola Galeri - Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">🔧 Admin Panel</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="dashboard.php">Kembali ke Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h3>Daftar Galeri Foto</h3>
        <a href="tambah_portfolio.php" class="btn btn-primary mb-3">+ Upload Foto Baru</a>

        <table class="table table-bordered table-striped">
            <thead class="table-secondary">
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Judul & Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $conn->query("SELECT p.*, s.nama_layanan FROM portfolios p JOIN services s ON p.service_id = s.id ORDER BY p.id DESC");
                $no = 1;
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td>
                            <img src="../assets/img/<?php echo $row['file_gambar']; ?>" width="100" style="border-radius: 5px;">
                        </td>
                        <td>
                            <strong><?php echo $row['judul_karya']; ?></strong><br>
                            <span class="badge bg-info text-dark"><?php echo $row['nama_layanan']; ?></span>
                        </td>
                        <td>
                            <a href="edit_portfolio.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-warning">Edit</a>
                            <a href="hapus_portfolio.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus foto ini?')">Hapus</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>