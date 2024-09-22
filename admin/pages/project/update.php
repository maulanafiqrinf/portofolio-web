<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

// Function to get project by ID
function getProjectById($koneksi, $id_project)
{
    $stmt = $koneksi->prepare("SELECT * FROM tb_project WHERE id_project = ?");
    $stmt->bind_param("i", $id_project);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Function to update project data
function updateProject($koneksi, $data, $id_project)
{
    $stmt = $koneksi->prepare("UPDATE tb_project SET 
              title=?, posisi=?, detail=?, technology=?, jobdesk=?, 
              Gambar_hasilproject=?, tanggal_mulai=?, tanggal_selesai=?, class=? 
              WHERE id_project=?");

    $stmt->bind_param(
        "ssssssssii",
        $data['title'],
        $data['posisi'],
        $data['detail'],
        $data['technology'],
        $data['jobdesk'],
        $data['Gambar_hasilproject'],
        $data['tanggal_mulai'],
        $data['tanggal_selesai'],
        $data['class'],
        $id_project // Make sure to add this last
    );

    return $stmt->execute();
}

// Function to handle file uploads
function handleFileUpload($files)
{
    $uploaded_files = [];
    $target_dir = "storage/Gambar_hasilproject/";

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
    $id_project = intval($_GET['id']); // Ensure ID is an integer
    $project = getProjectById($koneksi, $id_project);

    if (!$project) {
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
        'class' => $_POST['class'],
        'Gambar_hasilproject' => !empty($_FILES['Gambar_hasilproject']['name'][0])
            ? handleFileUpload($_FILES['Gambar_hasilproject'])
            : $project['Gambar_hasilproject'],
    ];

    // Update project data
    if (updateProject($koneksi, $data, $id_project)) {
        echo "<div class='alert alert-info'>Data Berhasil Diperbarui</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=project'>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Edit Project</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Title -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="title">Title</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($project['title']) ?>" required>
                </div>
            </div>
            <!-- Posisi -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="posisi">Posisi</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="posisi" name="posisi" value="<?= htmlspecialchars($project['posisi']) ?>" required>
                </div>
            </div>
            <!-- Detail -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="detail">Detail</label>
                <div class="col-sm-10">
                    <textarea id="detail" class="form-control" name="detail" required><?= htmlspecialchars($project['detail']) ?></textarea>
                </div>
            </div>
            <!-- Technology -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="technology">Technology</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="technology" name="technology" value="<?= htmlspecialchars($project['technology']) ?>" required>
                </div>
            </div>
            <!-- Jobdesk -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="jobdesk">Jobdesk</label>
                <div class="col-sm-10">
                    <textarea id="jobdesk" class="form-control" name="jobdesk" required><?= htmlspecialchars($project['jobdesk']) ?></textarea>
                </div>
            </div>
            <!-- Gambar Hasil Project -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="Gambar_hasilproject">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="Gambar_hasilproject" name="Gambar_hasilproject[]" multiple>
                    <!-- Display existing images -->
                    <?php foreach (explode(',', $project['Gambar_hasilproject']) as $img): ?>
                        <img src="storage/Gambar_hasilproject/<?= htmlspecialchars($img) ?>" alt="Gambar Project" width="100">
                    <?php endforeach; ?>
                </div>
            </div>
            <!-- Tanggal Mulai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_mulai">Tanggal Mulai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= htmlspecialchars($project['tanggal_mulai']) ?>" required>
                </div>
            </div>
            <!-- Tanggal Selesai -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="tanggal_selesai">Tanggal Selesai</label>
                <div class="col-sm-6">
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= htmlspecialchars($project['tanggal_selesai']) ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="class">Class</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="class" required>
                        <option value="<?= htmlspecialchars($project["class"]) ?>"><?= htmlspecialchars($project["class"]) ?></option>
                        <option value="bg-prink">Pink</option>
                        <option value="bg-catkrill">Grey</option>
                    </select>
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