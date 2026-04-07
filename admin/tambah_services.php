<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['submit'])) {
    $nama = $_POST['nama_layanan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];

    $foto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "../assets/img/";

    $nama_baru = rand(0, 9999) . '_' . $foto;

    if (move_uploaded_file($tmp, $path . $nama_baru)) {
        $stmt = $conn->prepare("INSERT INTO services (nama_layanan, deskripsi, harga, gambar) VALUES (:nama, :deskripsi, :harga, :gambar)");
        if ($stmt->execute(['nama' => $nama, 'deskripsi' => $deskripsi, 'harga' => $harga, 'gambar' => $nama_baru])) {
            echo "<script>alert('Berhasil tambah layanan!'); window.location='services.php';</script>";
        }
    } else {
        echo "Gagal upload gambar";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Tambah Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5" style="max-width: 600px;">
        <h3>Tambah Paket Baru</h3>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Nama Paket</label>
                <input type="text" name="nama_layanan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label>Gambar Cover</label>
                <input type="file" name="gambar" class="form-control" required>
            </div>
            <a href="services.php" class="btn btn-secondary">Batal</a>
            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>

</html>