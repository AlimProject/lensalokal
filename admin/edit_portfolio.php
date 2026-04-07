<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != "login") {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$stmt = $conn->prepare("SELECT * FROM portfolios WHERE id=:id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['update'])) {
    $judul = $_POST['judul_karya'];
    $service_id = $_POST['service_id'];
    $gambar_lama = $_POST['gambar_lama'];
    $judul_aman = $judul; // PDO prepare handles escaping

    if ($_FILES['gambar']['error'] === 4) {
        $nama_gambar = $gambar_lama;
    } else {

        $foto = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];


        $nama_gambar = 'portofolio_' . rand(0, 9999) . '.jpg';


        move_uploaded_file($tmp, "../assets/img/" . $nama_gambar);
        if (file_exists("../assets/img/" . $gambar_lama)) {
            unlink("../assets/img/" . $gambar_lama);
        }
    }


    $query_update = "UPDATE portfolios SET service_id = :service_id, judul_karya = :judul, file_gambar = :nama_gambar WHERE id = :id";
    $stmtUpdate = $conn->prepare($query_update);

    if ($stmtUpdate->execute(['service_id' => $service_id, 'judul' => $judul, 'nama_gambar' => $nama_gambar, 'id' => $id])) {
        echo "<script>alert('Data berhasil diupdate!'); window.location='manage_portfolio.php';</script>";
    } else {

        echo "Gagal update data";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Portofolio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-5" style="max-width: 600px;">
        <div class="card shadow">
            <div class="card-header bg-warning">
                <h5 class="mb-0">Edit Karya Portofolio</h5>
            </div>
            <div class="card-body">
                <form method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="gambar_lama" value="<?php echo $data['file_gambar']; ?>">

                    <div class="mb-3">
                        <label>Judul Karya</label>
                        <input type="text" name="judul_karya" class="form-control" value="<?php echo $data['judul_karya']; ?>" required>
                    </div>

                    <div class="mb-3">
                        <label>Kategori Layanan</label>
                        <select name="service_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php
                            $sql_services = $conn->query("SELECT * FROM services");
                            while ($row_svc = $sql_services->fetch(PDO::FETCH_ASSOC)) {

                                $selected = ($row_svc['id'] == $data['service_id']) ? 'selected' : '';

                                echo "<option value='" . $row_svc['id'] . "' $selected>" . $row_svc['nama_layanan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label>Gambar Saat Ini</label><br>
                        <img src="../assets/img/<?php echo $data['file_gambar']; ?>" width="150" class="img-thumbnail mb-2">
                    </div>

                    <div class="mb-3">
                        <label>Ganti Gambar (Opsional)</label>
                        <input type="file" name="gambar" class="form-control">
                        <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="manage_portfolio.php" class="btn btn-secondary">Batal</a>
                        <button type="submit" name="update" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>