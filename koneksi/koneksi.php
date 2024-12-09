<?php
// Mengaktifkan laporan error untuk koneksi database
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    // Membuat koneksi dengan database menggunakan OOP-style
    $koneksi = new mysqli("localhost", "root", "", "db_portofiqri");

    // Mengatur charset untuk memastikan keamanan dan kompatibilitas karakter
    $koneksi->set_charset("utf8mb4");

} catch (mysqli_sql_exception $e) {
    // Jika koneksi gagal, tampilkan pesan kesalahan dan hentikan eksekusi
    die("Koneksi database gagal: " . $e->getMessage());
}
?>
