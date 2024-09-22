<?php
include 'koneksi/koneksi.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Siapkan query untuk memeriksa akun superadmin
    $id_level = 3; // Set nilai id_level untuk superadmin
    
    $stmt = $koneksi->prepare("SELECT * FROM tb_admin WHERE username = ? AND id_level = ?");
    if ($stmt) {
        $stmt->bind_param("si", $username, $id_level);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result && $result->num_rows === 1) {
            $akunsuper = $result->fetch_assoc();
            
            // Verifikasi password
            if (password_verify($password, $akunsuper['password'])) {
                $_SESSION['superadmin'] = $akunsuper;
                $_SESSION['id_admin'] = $akunsuper['id_admin'];
                $_SESSION['username'] = $akunsuper['username'];
                $_SESSION['status'] = "Login";
                $_SESSION['id_level'] = $id_level;
                
                header('Location: admin/index.php?pesan=berhasil');
                exit;
            } else {
                redirectToLoginWithError("gagal");
            }
        } else {
            redirectToLoginWithError("gagal");
        }
        
        $stmt->close();
    } else {
        die("Query error: " . $koneksi->error);
    }
} else {
    echo "<script>alert('Silahkan login terlebih dahulu'); location.href='login.php';</script>";
    exit;
}

// Fungsi untuk mengarahkan kembali ke halaman login dengan pesan error
function redirectToLoginWithError($error) {
    header("Location: login.php?pesan=$error");
    exit;
}
?>
