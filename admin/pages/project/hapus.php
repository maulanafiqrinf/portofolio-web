<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deleteProject($koneksi, $id_project) {
    // Query to get project data
    $stmt = $koneksi->prepare("SELECT * FROM tb_project WHERE id_project = ?");
    $stmt->bind_param("i", $id_project);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
        
        // Delete associated image files
        deleteAssociatedFiles($project['Gambar_hasilproject']);

        // Query to delete the project
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_project WHERE id_project = ?");
        $delete_stmt->bind_param("i", $id_project);

        if ($delete_stmt->execute()) {
            echo "<div class='alert alert-info'>Data Berhasil Dihapus</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=project'>";
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
        $file_path = "storage/Gambar_hasilproject/" . $file;
        if (file_exists($file_path)) {
            unlink($file_path); // Delete the file
        }
    }
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_project = intval($_GET['id']); // Ensure ID is an integer
    deleteProject($koneksi, $id_project);
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
}
?>
