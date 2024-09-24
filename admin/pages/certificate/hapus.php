<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deletecertificate($koneksi, $id_certificate) {
    // Query to get certificate data
    $stmt = $koneksi->prepare("SELECT * FROM tb_certificate WHERE id_certificate = ?");
    $stmt->bind_param("i", $id_certificate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $certificate = $result->fetch_assoc();
        
        // Delete associated image files
        deleteAssociatedFiles($certificate['Gambar_hasilcertificate']);

        // Query to delete the certificate
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_certificate WHERE id_certificate = ?");
        $delete_stmt->bind_param("i", $id_certificate);

        if ($delete_stmt->execute()) {
            echo "<div class='alert alert-info'>Data Berhasil Dihapus</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=certificate'>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat menghapus data: " . $delete_stmt->error . "</div>";
        }
        $delete_stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    }
    $stmt->close();
}

function deleteAssociatedFiles($gambar) {
    $files = explode(",", $gambar);
    foreach ($files as $file) {
        $file_path = "storage/Gambar_hasilcertificate/" . $file;
        if (file_exists($file_path)) {
            unlink($file_path); // Delete the file
        }
    }
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_certificate = intval($_GET['id']); // Ensure ID is an integer
    deletecertificate($koneksi, $id_certificate);
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
}
?>
