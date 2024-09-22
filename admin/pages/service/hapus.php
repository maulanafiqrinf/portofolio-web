<?php
include '../koneksi/koneksi.php'; // Ensure the path is correct

// Check if the id parameter exists in the URL
if (isset($_GET['id'])) {
    // Get id from URL parameter
    $id_services = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Prepare delete query
    $delete_query = $koneksi->prepare("DELETE FROM tb_services WHERE id_services = ?");
    $delete_query->bind_param("i", $id_services);
    
    // Execute the delete query
    if ($delete_query->execute()) {
        if ($delete_query->affected_rows > 0) {
            echo "<script>alert('Data terhapus');</script>";
        } else {
            echo "<script>alert('Data tidak ditemukan');</script>";
        }
    } else {
        echo "<script>alert('Gagal menghapus data');</script>";
    }

    // Redirect after a brief pause
    echo "<script>setTimeout(function() { location='index.php?halaman=service'; }, 1500);</script>";
} else {
    echo "<script>alert('ID tidak valid');</script>";
}
?>
