<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

// Function to get experience by ID
function getexperienceById($koneksi, $id_experience)
{
    $stmt = $koneksi->prepare("SELECT * FROM tb_experience WHERE id_experience = ?");
    $stmt->bind_param("i", $id_experience);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Function to update experience data
function updateexperience($koneksi, $data, $id_experience)
{
    $stmt = $koneksi->prepare("UPDATE tb_experience SET 
              title=?, posisi=?, detail=?, technology=?, jobdesk=?, 
              Gambar_hasilexperience=?, tanggal_mulai=?, tanggal_selesai=?
              WHERE id_experience=?");

    $stmt->bind_param(
        "ssssssssi",
        $data['title'],
        $data['posisi'],
        $data['detail'],
        $data['technology'],
        $data['jobdesk'],
        $data['Gambar_hasilexperience'],
        $data['tanggal_mulai'],
        $data['tanggal_selesai'],
        // $data['class'],
        $id_experience // Make sure to add this last
    );

    return $stmt->execute();
}

// Function to handle file uploads
function handleFileUpload($files)
{
    $uploaded_files = [];
    $target_dir = "storage/Gambar_hasilexperience/";

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
    $id_experience = intval($_GET['id']); // Ensure ID is an integer
    $experience = getexperienceById($koneksi, $id_experience);

    if (!$experience) {
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
        'technology' => $_POST['technology'],
        'jobdesk' => $_POST['jobdesk'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'],
        // 'class' => $_POST['class'],
        'Gambar_hasilexperience' => !empty($_FILES['Gambar_hasilexperience']['name'][0])
            ? handleFileUpload($_FILES['Gambar_hasilexperience'])
            : $experience['Gambar_hasilexperience'],
    ];

    // Update experience data
    if (updateexperience($koneksi, $data, $id_experience)) {
        echo "<div class='alert alert-info'>Data Berhasil Diperbarui</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=experience'>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit experience</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($experience['title']) ?>" required>
                </div>
            </div>
            <!-- Posisi -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="posisi">Posisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="posisi" name="posisi" value="<?= htmlspecialchars($experience['posisi']) ?>" required>
                </div>
            </div>
            <!-- Detail -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="detail">Detail</label>
                <div class="col-sm-10">
                    <textarea id="detail" class="form-control" name="detail" required><?= htmlspecialchars($experience['detail']) ?></textarea>
                </div>
            </div>
            <!-- Technology -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="technology">Technology</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="technology" name="technology" value="<?= htmlspecialchars($experience['technology']) ?>" required>
                </div>
            </div>
            <!-- Jobdesk -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jobdesk">Jobdesk</label>
                <div class="col-sm-10">
                    <textarea id="jobdesk" class="form-control" name="jobdesk" required><?= htmlspecialchars($experience['jobdesk']) ?></textarea>
                </div>
            </div>
            <!-- Gambar Hasil experience -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="Gambar_hasilexperience">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="Gambar_hasilexperience" name="Gambar_hasilexperience[]" multiple>
                    <!-- Display existing images -->
                    <?php foreach (explode(',', $experience['Gambar_hasilexperience']) as $img): ?>
                        <img src="storage/Gambar_hasilexperience/<?= htmlspecialchars($img) ?>" alt="Gambar experience" width="100">
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Tanggal Mulai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_mulai">Tanggal Mulai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= htmlspecialchars($experience['tanggal_mulai']) ?>" required>
                </div>
            </div>
            <!-- Tanggal Selesai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_selesai">Tanggal Selesai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= htmlspecialchars($experience['tanggal_selesai']) ?>" required>
                </div>
            </div>
            <!-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="class">Class</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="class" required>
                        <option value="<?= htmlspecialchars($experience["class"]) ?>"><?= htmlspecialchars($experience["class"]) ?></option>
                        <option value="bg-prink">Pink</option>
                        <option value="bg-catkrill">Grey</option>
                    </select>
                </div>
            </div> -->
            <!-- Save Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>