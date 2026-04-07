<?php
session_start();
include '../config/koneksi.php';


if ($_SESSION['status'] != "login") {
    header("Location: index.php");
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $stmt = $conn->prepare("DELETE FROM bookings WHERE id=:id");

    if ($stmt->execute(['id' => $id])) {
        echo "<script>
                alert('Data pesanan berhasil dihapus!'); 
                window.location='dashboard.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus data'); 
                window.location='dashboard.php';
              </script>";
    }
} else {
    header("Location: dashboard.php");
}
