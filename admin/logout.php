<?php
session_start();

// Hapus semua variabel sesi
$_SESSION = [];

// Hapus cookie sesi jika ada (opsional, untuk lebih aman)
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Hancurkan sesi
session_destroy();

// Redirect ke halaman login dengan pesan logout
header("Location: ../index.php?pesan=logout");
exit();
?>
