<?php
include 'koneksi/koneksi.php';
session_start();

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare the SQL query to prevent SQL injection
    $stmt = $koneksi->prepare("SELECT * FROM tb_admin WHERE username = ? AND id_level = ?");
    $id_level = 3; // Ensure only level 3 users can log in
    $stmt->bind_param("si", $username, $id_level);

    // Execute the query and fetch the result
    $stmt->execute();
    $result = $stmt->get_result();

    // Verify that the user exists and the password is correct
    if ($result->num_rows === 1) {
        $akunsuper = $result->fetch_assoc();
        if (password_verify($password, $akunsuper['password'])) {
            // Store necessary session data
            $_SESSION['superadmin'] = $akunsuper;
            $_SESSION['id_admin'] = $akunsuper['id_admin'];
            $_SESSION['username'] = $akunsuper['username'];
            $_SESSION['status'] = "Login";
            $_SESSION['id_level'] = "3";
            
            header('Location: admin/admin.php?pesan=berhasil');
            exit;
        } else {
            redirectToLoginWithError("gagal");
        }
    } else {
        redirectToLoginWithError("gagal");
    }
} else {
    echo "<script type='text/javascript'>alert('Silahkan login terlebih dahulu'); location.href=\"index.php\";</script>";
}

function redirectToLoginWithError($error) {
    header("Location: index.php?pesan=$error");
    exit;
}
?>
