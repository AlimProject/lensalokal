<?php
session_start();
include '../config/koneksi.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("DELETE FROM services WHERE id=:id");
        $stmt->execute(['id' => $id]);

        echo "<script>
                alert('Layanan berhasil dihapus!'); 
                window.location='services.php';
              </script>";
    } catch (PDOException $e) {
        if ($e->getCode() == '23503' || $e->getCode() == 1451) {
            echo "<script>
                    alert('GAGAL MENGHAPUS! \\n\\nLayanan ini tidak bisa dihapus karena SUDAH ADA TRANSAKSI BOOKING yang menggunakan paket ini.\\n\\nSolusi: Hapus dulu data booking terkait di menu pesanan, baru hapus layanan ini.');
                    window.location='services.php';
                  </script>";
        } else {
            echo "Terjadi Error: " . $e->getMessage();
        }
    }
} else {
    header("Location: services.php");
}
