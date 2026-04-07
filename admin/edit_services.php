<?php
session_start();
include '../config/koneksi.php';

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM services WHERE id=:id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $nama = $_POST['nama_layanan'];
    $deskripsi = $_POST['deskripsi'];
    $harga = $_POST['harga'];
    $gambar_lama = $_POST['gambar_lama'];


    if ($_FILES['gambar']['error'] === 4) {
        $gambar = $gambar_lama; 
    } else {
        
        $foto = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $gambar = rand(0, 9999) . '_' . $foto;
        move_uploaded_file($tmp, "../assets/img/" . $gambar);
    }

    $stmt = $conn->prepare("UPDATE services SET nama_layanan=:nama, deskripsi=:deskripsi, harga=:harga, gambar=:gambar WHERE id=:id");

    if ($stmt->execute(['nama' => $nama, 'deskripsi' => $deskripsi, 'harga' => $harga, 'gambar' => $gambar, 'id' => $id])) {
        echo "<script>alert('Data Berhasil Diupdate!'); window.location='services.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Layanan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5" style="max-width: 600px;">
        <h3>Edit Paket</h3>
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="gambar_lama" value="<?php echo $data['gambar']; ?>">

            <div class="mb-3">
                <label>Nama Paket</label>
                <input type="text" name="nama_layanan" class="form-control" value="<?php echo $data['nama_layanan']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Harga (Rp)</label>
                <input type="number" name="harga" class="form-control" value="<?php echo $data['harga']; ?>" required>
            </div>
            <div class="mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"><?php echo $data['deskripsi']; ?></textarea>
            </div>
            <div class="mb-3">
                <label>Ganti Gambar (Kosongkan jika tidak ingin ganti)</label><br>
                <img src="../assets/img/<?php echo $data['gambar']; ?>" width="100" class="mb-2">
                <input type="file" name="gambar" class="form-control">
            </div>
            <a href="services.php" class="btn btn-secondary">Batal</a>
            <button type="submit" name="update" class="btn btn-success">Update Data</button>
        </form>
    </div>
</body>

</html>