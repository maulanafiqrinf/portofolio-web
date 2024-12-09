<?php
include '../koneksi/koneksi.php'; // Ensure the path is correct

// Check if the id parameter exists in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Get id from URL parameter
    $id_services = intval($_GET['id']); // Ensure the ID is treated as an integer

    // Prepare delete query
    if ($delete_query = $koneksi->prepare("DELETE FROM tb_services WHERE id_services = ?")) {
        $delete_query->bind_param("i", $id_services);
        
        // Execute the delete query
        if ($delete_query->execute()) {
            if ($delete_query->affected_rows > 0) {
                echo "
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Data telah terhapus.',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(function() {
                        window.location.href = 'admin/admin.php?halaman=service';
                    });
                </script>";
            } else {
                echo "
                <script>
                    Swal.fire({
                        icon: 'warning',
                        title: 'Tidak ditemukan!',
                        text: 'Data tidak ditemukan.',
                        showConfirmButton: true
                    });
                </script>";
            }
        } else {
            echo "
            <script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: 'Gagal menghapus data.',
                    showConfirmButton: true
                });
            </script>";
        }

        // Close the prepared statement
        $delete_query->close();
    } else {
        echo "
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: 'Gagal menyiapkan query.',
                showConfirmButton: true
            });
        </script>";
    }
} else {
    echo "
    <script>
        Swal.fire({
            icon: 'error',
            title: 'ID Tidak Valid!',
            text: 'ID yang diberikan tidak valid.',
            showConfirmButton: true
        });
    </script>";
}

// Close the database connection
$koneksi->close();
?>
