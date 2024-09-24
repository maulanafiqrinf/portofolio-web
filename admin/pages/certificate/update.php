<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

// Function to get certificate by ID
function getcertificateById($koneksi, $id_certificate)
{
    $stmt = $koneksi->prepare("SELECT * FROM tb_certificate WHERE id_certificate = ?");
    $stmt->bind_param("i", $id_certificate);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Function to update certificate data
function updatecertificate($koneksi, $data, $id_certificate)
{
    $query = "UPDATE tb_certificate SET 
              title=?, pihak=?, detail=?, jobdesk=?, Gambar_hasilcertificate=?, tanggal_mulai=?, tanggal_selesai=? 
              WHERE id_certificate=?";
              
    // Prepare the statement
    $stmt = $koneksi->prepare($query);

    // If 'tanggal_selesai' is empty, set it to NULL
    $tanggal_selesai = !empty($data['tanggal_selesai']) ? $data['tanggal_selesai'] : NULL;

    // Bind parameters, where the last 'i' represents an integer, and the second-to-last '?' can be NULL
    $stmt->bind_param(
        "sssssssi",
        $data['title'],
        $data['pihak'],
        $data['detail'],
        $data['jobdesk'],
        $data['Gambar_hasilcertificate'],
        $data['tanggal_mulai'],
        $tanggal_selesai, // This can be NULL if not provided
        $id_certificate // This must be the last parameter
    );

    // Execute the query and return the result
    return $stmt->execute();
}

// Function to handle file uploads
function handleFileUpload($files)
{
    $uploaded_files = [];
    $target_dir = "storage/Gambar_hasilcertificate/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    foreach ($files['name'] as $key => $name) {
        $file_name = date("YmdHis") . '-' . basename($name);
        $file_tmp = $files['tmp_name'][$key];

        if (move_uploaded_file($file_tmp, $target_dir . $file_name)) {
            $uploaded_files[] = $file_name;
        } else {
            echo "<div class='alert alert-danger'>Gagal meng-upload file {$name}.</div>";
        }
    }

    return implode(",", $uploaded_files);
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_certificate = intval($_GET['id']); // Ensure ID is an integer
    $certificate = getcertificateById($koneksi, $id_certificate);

    if (!$certificate) {
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
        'pihak' => $_POST['pihak'],
        'detail' => $_POST['detail'],
        'jobdesk' => $_POST['jobdesk'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'], // Can be NULL
        'Gambar_hasilcertificate' => !empty($_FILES['Gambar_hasilcertificate']['name'][0])
            ? handleFileUpload($_FILES['Gambar_hasilcertificate'])
            : $certificate['Gambar_hasilcertificate'],
    ];

    // Update certificate data
    if (updatecertificate($koneksi, $data, $id_certificate)) {
        echo "<div class='alert alert-info'>Data Berhasil Diperbarui</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=certificate'>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit certificate</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($certificate['title']) ?>" required>
                </div>
            </div>
            <!-- pihak -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="pihak">pihak</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="pihak" name="pihak" value="<?= htmlspecialchars($certificate['pihak']) ?>" required>
                </div>
            </div>
            <!-- Detail -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="detail">Detail</label>
                <div class="col-sm-10">
                    <textarea id="detail" class="form-control" name="detail" required><?= htmlspecialchars($certificate['detail']) ?></textarea>
                </div>
            </div>
            <!-- Technology -->
            <!-- Jobdesk -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jobdesk">Jobdesk</label>
                <div class="col-sm-10">
                    <textarea id="jobdesk" class="form-control" name="jobdesk" required><?= htmlspecialchars($certificate['jobdesk']) ?></textarea>
                </div>
            </div>
            <!-- Gambar Hasil certificate -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="Gambar_hasilcertificate">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="Gambar_hasilcertificate" name="Gambar_hasilcertificate[]" multiple>
                    <!-- Display existing images -->
                    <?php foreach (explode(',', $certificate['Gambar_hasilcertificate']) as $img): ?>
                        <img src="storage/Gambar_hasilcertificate/<?= htmlspecialchars($img) ?>" alt="Gambar certificate" width="100">
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Tanggal Mulai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_mulai">Tanggal Mulai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= htmlspecialchars($certificate['tanggal_mulai']) ?>" required>
                </div>
            </div>
            <!-- Tanggal Selesai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_selesai">Tanggal Selesai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= htmlspecialchars($certificate['tanggal_selesai']) ?>">
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