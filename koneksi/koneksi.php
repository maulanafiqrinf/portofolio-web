<?php
// Membuat koneksi dengan database
$koneksi = mysqli_connect("localhost", "root", "", "db_portfolio");

// Memeriksa apakah koneksi berhasil
if (mysqli_connect_errno()) {
    // Jika koneksi gagal, tampilkan pesan kesalahan dan hentikan eksekusi
    die("Koneksi database gagal: " . mysqli_connect_error());
}
?>
