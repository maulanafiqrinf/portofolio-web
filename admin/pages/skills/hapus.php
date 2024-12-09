<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deleteskills($koneksi, $id_skills)
{
    // Query to get skills data
    $stmt = $koneksi->prepare("SELECT * FROM tb_skills WHERE id_skills = ?");
    $stmt->bind_param("i", $id_skills);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $skills = $result->fetch_assoc();

        // Query to delete the skills
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_skills WHERE id_skills = ?");
        $delete_stmt->bind_param("i", $id_skills);

        if ($delete_stmt->execute()) {
            return "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data Berhasil Dihapus',
                    text: 'Skill berhasil dihapus!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'admin/admin.php?halaman=skills';
                });
            </script>";
        } else {
            return "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: 'Kesalahan saat menghapus data: " . htmlspecialchars($delete_stmt->error) . "'
                });
            </script>";
        }
        $delete_stmt->close();
    } else {
        return "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Data tidak ditemukan',
                text: 'Skill yang ingin dihapus tidak ditemukan.'
            });
        </script>";
    }
    $stmt->close();
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_skills = intval($_GET['id']); // Ensure ID is an integer
    echo deleteskills($koneksi, $id_skills);
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID tidak valid',
            text: 'Silakan periksa kembali ID yang diberikan.'
        });
    </script>";
}
