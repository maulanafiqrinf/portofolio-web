<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

// Function to delete a project and its associated image files
function deleteProject($koneksi, $id_project) {
    // Query to get project data
    $stmt = $koneksi->prepare("SELECT Gambar_hasilproject FROM tb_project WHERE id_project = ?");
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
            // Success message with SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus',
                    text: 'Project berhasil dihapus!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'admin/admin.php?halaman=project';
                });
            </script>";
        } else {
            // Error message with SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Kesalahan saat menghapus data: " . htmlspecialchars($delete_stmt->error) . "'
                });
            </script>";
        }
        $delete_stmt->close();
    } else {
        // Data not found message
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Data tidak ditemukan',
                text: 'Project yang ingin dihapus tidak ditemukan.'
            });
        </script>";
    }
    $stmt->close();
}

// Function to delete associated image files
function deleteAssociatedFiles($gambar) {
    $files = explode(",", $gambar);
    foreach ($files as $file) {
        $file_path = "admin/storage/Gambar_hasilproject/" . $file;
        if (file_exists($file_path)) {
            if (!unlink($file_path)) {
                // Handle error in file deletion
                echo "<script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Gagal menghapus file',
                        text: 'Gagal menghapus file: $file'
                    });
                </script>";
            }
        }
    }
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_project = intval($_GET['id']); // Ensure ID is an integer
    deleteProject($koneksi, $id_project);
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID tidak valid',
            text: 'Silakan periksa kembali ID yang diberikan.'
        });
    </script>";
}
?>
