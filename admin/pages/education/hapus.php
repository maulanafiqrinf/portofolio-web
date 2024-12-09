<?php
include '../koneksi/koneksi.php';
function deleteEducation($koneksi, $id_education) {
    $stmt = $koneksi->prepare("SELECT * FROM tb_education WHERE id_education = ?");
    $stmt->bind_param("i", $id_education);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $education = $result->fetch_assoc();
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_education WHERE id_education = ?");
        $delete_stmt->bind_param("i", $id_education);

        if ($delete_stmt->execute()) {
            echo "<script>
                    Swal.fire({
                        title: 'Success',
                        text: 'Data Berhasil Dihapus',
                        icon: 'success'
                    }).then(() => {
                        location.href='admin/admin.php?halaman=education';
                    });
                  </script>";
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan saat menghapus data: " . htmlspecialchars($delete_stmt->error) . "',
                        icon: 'error'
                    });
                  </script>";
        }
        $delete_stmt->close();
    } else {
        echo "<script>
                Swal.fire({
                    title: 'Error',
                    text: 'Data tidak ditemukan',
                    icon: 'error'
                });
              </script>";
    }
    $stmt->close();
}
if (isset($_GET['id']) && is_numeric($_GET['id']) && intval($_GET['id']) > 0) {
    $id_education = intval($_GET['id']);
    deleteEducation($koneksi, $id_education);
} else {
    echo "<script>
            Swal.fire({
                title: 'Error',
                text: 'ID tidak valid',
                icon: 'error'
            });
          </script>";
}

$koneksi->close();
?>
