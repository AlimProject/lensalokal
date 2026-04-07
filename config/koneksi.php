<?php
// Ganti password_anda_disini dengan password asli Supabase Anda!
$host = "aws-1-ap-southeast-1.pooler.supabase.com"; 
$port = "5432";
$db   = "postgres";
$user = "postgres.zdbdkvateablzsantiqh"; 
$pass = "@AlimFawass";

try {
    $conn = new PDO("pgsql:host=$host;port=$port;dbname=$db", $user, $pass);
    // Set status error ke exception untuk debugging
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi Gagal: " . $e->getMessage());
}
?>