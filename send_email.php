<?php
// Sertakan file koneksi
include 'koneksi/koneksi.php'; // Pastikan path ke file koneksi.php benar

// Prepare the SQL statement untuk mendapatkan nomor WhatsApp dari database
$stmt = $koneksi->prepare("SELECT phone FROM tb_about LIMIT 1");

// Execute the query
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah nomor WhatsApp ditemukan
if ($row = $result->fetch_assoc()) {
    $to = $row['phone']; // Nomor WhatsApp tujuan yang diambil dari database
} else {
    die("Nomor WhatsApp tujuan tidak ditemukan di database.");
}

// Mengecek apakah form telah dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil input dari form
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $message = htmlspecialchars(trim($_POST['message']));

    // Validasi input
    if (!empty($name) && !empty($email) && !empty($message) && filter_var($email, FILTER_VALIDATE_EMAIL)) {

        // Menyiapkan pesan yang akan dikirim melalui WhatsApp
        $body = urlencode("Pesan Baru dari $name\nEmail: $email\nPesan: $message");

        // URL WhatsApp
        $whatsapp_url = "https://api.whatsapp.com/send?phone=$to&text=$body";

        // Redirect ke URL WhatsApp
        header("Location: $whatsapp_url");
        exit; // Keluar setelah redirect
    } else {
        echo "Harap isi semua field dengan benar.";
    }
} else {
    echo "Metode pengiriman tidak valid.";
}

// Menutup statement
$stmt->close();

// Menutup koneksi (opsional, jika tidak dibutuhkan untuk operasi lain)
$koneksi->close();
?>
