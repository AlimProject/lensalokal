<?php
session_start();
if ($_SESSION['status'] != "login") {
    header("Location: index.php");
}
include '../config/koneksi.php';
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="dashboard.php">🔧 Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link text-warning" href="../index.php" target="_blank">🌐 Lihat Website</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link active" href="dashboard.php">📦 Pesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">📷 Kelola Layanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manage_portfolio.php">🖼️ Kelola Galeri</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="logout.php">🚪 Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="alert alert-success">
                    <?php
                    $incomeStmt = $conn->query("SELECT SUM(s.harga) as total FROM bookings b JOIN services s ON b.service_id = s.id WHERE b.status IN ('Confirmed', 'Completed')");
                    $income = $incomeStmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <h5>💰 Total Potensi Pendapatan:</h5>
                    <h3>Rp <?php echo number_format($income['total'], 0, ',', '.'); ?></h3>
                </div>
            </div>
            <div class="col-md-6">
                <div class="alert alert-primary">
                    <?php
                    $jobStmt = $conn->query("SELECT COUNT(*) as total FROM bookings");
                    $job = $jobStmt->fetch(PDO::FETCH_ASSOC);
                    ?>
                    <h5>📅 Total Pekerjaan Masuk:</h5>
                    <h3><?php echo $job['total']; ?> Pesanan</h3>
                </div>
            </div>
        </div>

        <div class="card shadow">
            <div class="card-header bg-white">
                <h5 class="mb-0">Daftar Booking Masuk</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama Pemesan</th>
                            <th>Layanan</th>
                            <th>Tgl Acara</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT b.*, s.nama_layanan, s.harga FROM bookings b JOIN services s ON b.service_id = s.id ORDER BY b.created_at DESC";
                        $result = $conn->query($sql);
                        $no = 1;

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td>
                                    <strong><?php echo $row['nama_pemesan']; ?></strong><br>
                                    <small class="text-muted"><?php echo $row['no_wa']; ?></small>
                                </td>
                                <td><?php echo $row['nama_layanan']; ?><br>
                                    <small>(Rp <?php echo number_format($row['harga']); ?>)</small>
                                </td>
                                <td><?php echo $row['tanggal_acara']; ?></td>
                                <td>
                                    <?php
                                    if ($row['status'] == 'Pending') {
                                        echo '<span class="badge bg-warning text-dark">Pending</span>';
                                    } elseif ($row['status'] == 'Confirmed') {
                                        echo '<span class="badge bg-success">Dikonfirmasi</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">' . $row['status'] . '</span>';
                                    }
                                    ?>
                                </td>
                                <td>
                                    <div class="d-flex gap-1">
                                        <?php if ($row['status'] == 'Pending') { ?>
                                            <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Confirmed" class="btn btn-sm btn-success" onclick="return confirm('Terima pesanan ini?')">Terima ✅</a>
                                            <a href="update_status.php?id=<?php echo $row['id']; ?>&status=Cancelled" class="btn btn-sm btn-warning" onclick="return confirm('Tolak pesanan ini?')">Tolak ❌</a>
                                        <?php } else { ?>
                                            <button class="btn btn-sm btn-secondary" disabled>Selesai</button>
                                        <?php } ?>

                                        <a href="hapus_booking.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data booking ini secara permanen?')">
                                            🗑️
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>

</html>