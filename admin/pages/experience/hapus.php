<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deleteexperience($koneksi, $id_experience) {
    // Query to get experience data
    $stmt = $koneksi->prepare("SELECT * FROM tb_experience WHERE id_experience = ?");
    $stmt->bind_param("i", $id_experience);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $experience = $result->fetch_assoc();
        
        // Delete associated image files
        deleteAssociatedFiles($experience['Gambar_hasilexperience']);

        // Query to delete the experience
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_experience WHERE id_experience = ?");
        $delete_stmt->bind_param("i", $id_experience);

        if ($delete_stmt->execute()) {
            echo "<div class='alert alert-info'>Data Berhasil Dihapus</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=experience'>";
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
        $file_path = "storage/Gambar_hasilexperience/" . $file;
        if (file_exists($file_path)) {
            unlink($file_path); // Delete the file
        }
    }
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_experience = intval($_GET['id']); // Ensure ID is an integer
    deleteexperience($koneksi, $id_experience);
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
}
?>
