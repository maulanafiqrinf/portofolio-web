<?php
include '../koneksi/koneksi.php'; // Ensure the path is correct

// Ensure the ID is provided via URL parameter
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);
    
    // Fetch services data based on ID
    $result = $koneksi->query("SELECT * FROM tb_services WHERE id_services = '$id'");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-danger'>Data tidak ditemukan</div>";
        exit();
    }
} else {
    echo "<div class='alert alert-danger'>ID tidak valid</div>";
    exit();
}

// If the form is submitted
if (isset($_POST['update'])) {
    // Sanitize input data
    $title = mysqli_real_escape_string($koneksi, $_POST['title']);
    $detail = mysqli_real_escape_string($koneksi, $_POST['detail']);
    $icon = mysqli_real_escape_string($koneksi, $_POST['icon']);
    $class = mysqli_real_escape_string($koneksi, $_POST['class']);
    
    // Validate that required data is filled
    if (!empty($title) && !empty($detail) && !empty($icon) && !empty($class)) {
        // Prepare the update query
        $query = $koneksi->prepare("UPDATE tb_services SET title = ?, detail = ?, icon = ?, class = ? WHERE id_services = ?");
        
        // Bind parameters correctly (4 strings and 1 integer for ID)
        $query->bind_param("ssssi", $title, $detail, $icon, $class, $id);
        
        // Execute the query
        if ($query->execute()) {
            // Use JavaScript to alert and redirect
            echo "<script>alert('Data Berhasil Diperbarui'); location.href='index.php?halaman=service';</script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $query->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Harap isi semua data wajib</div>";
    }
}
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Form Edit About</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($data['title']); ?>" required>
                </div>
            </div>
            <!-- Detail -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="detail">Detail</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="detail" name="detail" value="<?= htmlspecialchars($data['detail']); ?>" required>
                </div>
            </div>
            <!-- Icon -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="icon">Icon</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="icon" name="icon" value="<?= htmlspecialchars($data['icon']); ?>" required>
                </div>
            </div>
            <!-- Class -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="class">Class</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="class" required>
                        <option value="<?= htmlspecialchars($data["class"]) ?>"><?= htmlspecialchars($data["class"]) ?></option>
                        <option value="bg-prink">Pink</option>
                        <option value="bg-catkrill">Grey</option>
                    </select>
                </div>
            </div>
            <!-- Update Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>