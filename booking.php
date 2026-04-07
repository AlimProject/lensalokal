<?php
include 'config/koneksi.php';

if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM services WHERE id = :id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Booking: <?php echo $data['nama_layanan']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <a href="index.php" class="btn btn-secondary mb-3">&larr; Kembali</a>

        <div class="row">
            <div class="col-md-5">
                <div class="card shadow-sm">
                    <img src="assets/img/<?php echo $data['gambar']; ?>" class="card-img-top" alt="Service">
                    <div class="card-body">
                        <h3><?php echo $data['nama_layanan']; ?></h3>
                        <p><?php echo $data['deskripsi']; ?></p>
                        <h4 class="text-primary">Rp <?php echo number_format($data['harga'], 0, ',', '.'); ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm p-4">
                    <h4 class="mb-3">Isi Data Pemesanan</h4>
                    <form action="process_booking.php" method="POST">
                        <input type="hidden" name="service_id" value="<?php echo $data['id']; ?>">

                        <div class="mb-3">
                            <label>Nama Lengkap</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Nomor WhatsApp (Aktif)</label>
                            <input type="number" name="no_wa" class="form-control" placeholder="0812..." required>
                        </div>

                        <div class="mb-3">
                            <label>Tanggal Acara</label>
                            <input type="date" name="tanggal" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Lokasi Acara (Alamat Lengkap)</label>
                            <textarea name="lokasi" class="form-control" rows="3" required></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary w-100 btn-lg">Konfirmasi Booking</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>