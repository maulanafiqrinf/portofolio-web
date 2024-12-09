<?php
include '../koneksi/koneksi.php'; // Pastikan jalur koneksi benar

// Function untuk menghapus pengalaman berdasarkan ID
function deleteExperience($koneksi, $id_experience) {
    // Query untuk mendapatkan data pengalaman
    $stmt = $koneksi->prepare("SELECT * FROM tb_experience WHERE id_experience = ?");
    $stmt->bind_param("i", $id_experience);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $experience = $result->fetch_assoc();
        // Query untuk menghapus pengalaman
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_experience WHERE id_experience = ?");
        $delete_stmt->bind_param("i", $id_experience);

        if ($delete_stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil dihapus',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = 'admin/admin.php?halaman=experience';
                        }
                    });
                </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat menghapus data: " . $delete_stmt->error . "',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                </script>";
        }
        $delete_stmt->close();
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Data tidak ditemukan',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
              </script>";
    }
    $stmt->close();
}

// Cek apakah ID diberikan melalui parameter URL
if (isset($_GET['id'])) {
    $id_experience = intval($_GET['id']); // Pastikan ID adalah integer
    deleteExperience($koneksi, $id_experience);
} else {
    echo "<script>
            Swal.fire({
                title: 'Error!',
                text: 'ID tidak valid',
                icon: 'error',
                confirmButtonText: 'OK'
            });
          </script>";
}
?>
