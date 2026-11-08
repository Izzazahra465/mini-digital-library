<?php
// Koneksi ke database MySQL (mysqli)
$host     = "localhost";
$user     = "root";
$pass     = "";
$database = "db_perpustakaan";

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
try {
    $conn = mysqli_connect($host, $user, $pass, $database);
    mysqli_set_charset($conn, "utf8mb4");
} catch (mysqli_sql_exception $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
