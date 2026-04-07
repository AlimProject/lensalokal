<?php
session_start();
include '../config/koneksi.php';

if ($_SESSION['status'] != "login") {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];
$status = $_GET['status'];

$stmt = $conn->prepare("UPDATE bookings SET status=:status WHERE id=:id");

if ($stmt->execute(['status' => $status, 'id' => $id])) {
    header("Location: dashboard.php");
} else {
    echo "Gagal update status";
}
