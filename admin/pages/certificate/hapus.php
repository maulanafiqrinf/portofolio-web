<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deleteCertificate($koneksi, $id_certificate) {
    // Prepare query to get certificate data
    $stmt = $koneksi->prepare("SELECT Gambar_hasilcertificate FROM tb_certificate WHERE id_certificate = ?");
    $stmt->bind_param("i", $id_certificate);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $certificate = $result->fetch_assoc();

        // Delete associated image files
        deleteAssociatedFiles($certificate['Gambar_hasilcertificate']);

        // Prepare query to delete the certificate
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_certificate WHERE id_certificate = ?");
        $delete_stmt->bind_param("i", $id_certificate);

        if ($delete_stmt->execute()) {
            // Success - use SweetAlert to display success message and redirect
            echo "<script>
                    Swal.fire({
                        title: 'Berhasil!',
                        text: 'Data Berhasil Dihapus',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'admin/admin.php?halaman=certificate';
                    });
                  </script>";
        } else {
            // Failure - use SweetAlert to display error message
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus data: " . htmlspecialchars($delete_stmt->error) . "',
                        icon: 'error'
                    });
                  </script>";
        }
        $delete_stmt->close();
    } else {
        // If certificate not found, use SweetAlert to show warning
        echo "<script>
                Swal.fire({
                    title: 'Data tidak ditemukan!',
                    icon: 'warning'
                });
              </script>";
    }
    $stmt->close();
}

function deleteAssociatedFiles($gambar) {
    $files = explode(",", $gambar);
    foreach ($files as $file) {
        $file_path = "admin/storage/Gambar_hasilcertificate/" . $file;
        if (file_exists($file_path)) {
            if (!unlink($file_path)) {
                echo "<script>
                        Swal.fire({
                            title: 'Warning!',
                            text: 'Gagal menghapus file: $file',
                            icon: 'warning'
                        });
                      </script>";
            }
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Warning!',
                        text: 'File tidak ditemukan: $file',
                        icon: 'warning'
                    });
                  </script>";
        }
    }
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id']) && is_numeric($_GET['id']) && intval($_GET['id']) > 0) {
    $id_certificate = intval($_GET['id']); // Ensure ID is a positive integer
    deleteCertificate($koneksi, $id_certificate);
} else {
    // Invalid ID - show error
    echo "<script>
            Swal.fire({
                title: 'ID tidak valid!',
                icon: 'error'
            });
          </script>";
}

// Close the database connection
$koneksi->close();
?>
