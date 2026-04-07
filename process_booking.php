<?php
include 'config/koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $wa = $_POST['no_wa'];
    $tanggal = $_POST['tanggal'];
    $lokasi = $_POST['lokasi'];
    $service_id = $_POST['service_id'];

    $sql = "INSERT INTO bookings (nama_pemesan, no_wa, tanggal_acara, lokasi_acara, service_id) 
            VALUES (:nama, :wa, :tanggal, :lokasi, :service_id)";
    
    try {
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'nama' => $nama,
            'wa' => $wa,
            'tanggal' => $tanggal,
            'lokasi' => $lokasi,
            'service_id' => $service_id
        ]);
        echo "<script>alert('Pesanan berhasil dibuat! Admin akan menghubungi Anda via WA.'); window.location='index.php';</script>";
    } catch(PDOException $e) {
        echo "Error: " . $sql . "<br>" . $e->getMessage();
    }
}
?>