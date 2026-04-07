<?php
session_start();
include '../config/koneksi.php';

$username = $_POST['username'];
$password = $_POST['password'];

$stmt = $conn->prepare("SELECT * FROM admins WHERE username=:username AND password=:password");
$stmt->execute(['username' => $username, 'password' => $password]);
$cek = $stmt->rowCount();

if ($cek > 0) {
    $_SESSION['status'] = "login";
    header("Location: dashboard.php");
} else {
    echo "<script>alert('Login Gagal!'); window.location='index.php';</script>";
}
