<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

function deleteskills($koneksi, $id_skills) {
    // Query to get skills data
    $stmt = $koneksi->prepare("SELECT * FROM tb_skills WHERE id_skills = ?");
    $stmt->bind_param("i", $id_skills);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $skills = $result->fetch_assoc();
        
        // Delete associated image files
        // Query to delete the skills
        $delete_stmt = $koneksi->prepare("DELETE FROM tb_skills WHERE id_skills = ?");
        $delete_stmt->bind_param("i", $id_skills);

        if ($delete_stmt->execute()) {
            echo "<div class='alert alert-info'>Data Berhasil Dihapus</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=skills'>";
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
    $id_skills = intval($_GET['id']); // Ensure ID is an integer
    deleteskills($koneksi, $id_skills);
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
}
?>
