<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deleteeducation($koneksi, $id_education) {
    // Query to get education data
    $stmt = $koneksi->prepare("SELECT * FROM tb_education WHERE id_education = ?");
    $stmt->bind_param("i", $id_education);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $education = $result->fetch_assoc();
        
        // Delete associated image files
        // Query to delete the education
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_education WHERE id_education = ?");
        $delete_stmt->bind_param("i", $id_education);

        if ($delete_stmt->execute()) {
            echo "<div class='alert alert-info'>Data Berhasil Dihapus</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=education'>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan saat menghapus data: " . $delete_stmt->error . "</div>";
        }
        $delete_stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
    }
    $stmt->close();
}


// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_education = intval($_GET['id']); // Ensure ID is an integer
    deleteeducation($koneksi, $id_education);
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
}
?>
