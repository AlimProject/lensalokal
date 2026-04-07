<?php
session_start();
include '../config/koneksi.php';

if (isset($_POST['submit'])) {
    $service_id = $_POST['service_id'];
    $judul = $_POST['judul_karya'];

    $foto = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];

    $nama_baru = 'portofolio_' . rand(0, 9999) . '.jpg';
    $path = "../assets/img/";

    if (move_uploaded_file($tmp, $path . $nama_baru)) {
        $stmt = $conn->prepare("INSERT INTO portfolios (service_id, judul_karya, file_gambar) VALUES (:service_id, :judul, :gambar)");
        $stmt->execute(['service_id' => $service_id, 'judul' => $judul, 'gambar' => $nama_baru]);
        echo "<script>alert('Foto berhasil diupload!'); window.location='manage_portfolio.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Upload Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5" style="max-width: 500px;">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Upload Karya Baru</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label>Judul Karya / Nama Project</label>
                        <input type="text" name="judul_karya" class="form-control" placeholder="Contoh: Wedding Ari & Tyas" required>
                    </div>

                    <div class="mb-3">
                        <label>Kategori Layanan</label>
                        <select name="service_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                            $sql = $conn->query("SELECT * FROM services");
                            while ($data = $sql->fetch(PDO::FETCH_ASSOC)) {
                                echo "<option value='" . $data['id'] . "'>" . $data['nama_layanan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>File Foto</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>

                    <a href="manage_portfolio.php" class="btn btn-secondary">Batal</a>
                    <button type="submit" name="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>