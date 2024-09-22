<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

// Function to get education by ID
function geteducationById($koneksi, $id_education)
{
    $stmt = $koneksi->prepare("SELECT * FROM tb_education WHERE id_education = ?");
    $stmt->bind_param("i", $id_education);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Function to update education data
function updateeducation($koneksi, $data, $id_education)
{
    $stmt = $koneksi->prepare("UPDATE tb_education SET 
              title=?, posisi=?, detail=?, tanggal_mulai=?, tanggal_selesai=?
              WHERE id_education=?");

    $stmt->bind_param(
        "sssssi",
        $data['title'],
        $data['posisi'],
        $data['detail'],
        $data['tanggal_mulai'],
        $data['tanggal_selesai'],
        // $data['class'],
        $id_education // Make sure to add this last
    );

    return $stmt->execute();
}


// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_education = intval($_GET['id']); // Ensure ID is an integer
    $education = geteducationById($koneksi, $id_education);

    if (!$education) {
        echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
    exit();
}

// If form is submitted
if (isset($_POST['update'])) {
    // Prepare data from the form
    $data = [
        'title' => $_POST['title'],
        'posisi' => $_POST['posisi'],
        'detail' => $_POST['detail'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
    ];

    // Update education data
    if (updateeducation($koneksi, $data, $id_education)) {
        echo "<div class='alert alert-info'>Data Berhasil Diperbarui</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=education'>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit education</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($education['title']) ?>" required>
                </div>
            </div>
            <!-- Posisi -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="posisi">Posisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="posisi" name="posisi" value="<?= htmlspecialchars($education['posisi']) ?>" required>
                </div>
            </div>
            <!-- Detail -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="detail">Detail</label>
                <div class="col-sm-10">
                    <textarea id="detail" class="form-control" name="detail" required><?= htmlspecialchars($education['detail']) ?></textarea>
                </div>
            </div>
            <!-- Tanggal Mulai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_mulai">Tanggal Mulai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= htmlspecialchars($education['tanggal_mulai']) ?>" required>
                </div>
            </div>
            <!-- Tanggal Selesai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_selesai">Tanggal Selesai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= htmlspecialchars($education['tanggal_selesai']) ?>" required>
                </div>
            </div>
            <!-- Save Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>