<?php
session_start();
include '../config/koneksi.php';

$id = $_GET['id'];


$stmt = $conn->prepare("SELECT file_gambar FROM portfolios WHERE id=:id");
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$file = "../assets/img/" . $data['file_gambar'];


if (file_exists($file)) {
    unlink($file);
}


$stmtDel = $conn->prepare("DELETE FROM portfolios WHERE id=:id");
$stmtDel->execute(['id' => $id]);

header("Location: manage_portfolio.php");
