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
              Gambar_hasilproject=?, tanggal_mulai=?, tanggal_selesai=?
              WHERE id_project=?");

    $stmt->bind_param(
        "ssssssssi",
        $data['title'],
        $data['posisi'],
        $data['detail'],
        $data['technology'],
        $data['jobdesk'],
        $data['Gambar_hasilproject'],
        $data['tanggal_mulai'],
        $data['tanggal_selesai'],
        $id_project // Ensure this is added last
    );

    return $stmt->execute();
}

// Function to handle file uploads with compression
function handleFileUpload($files)
{
    $uploaded_files = [];
    $target_dir = "storage/Gambar_hasilproject/";

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    foreach ($files['name'] as $key => $name) {
        $file_tmp = $files['tmp_name'][$key];
        $file_name = date("YmdHis") . '-' . basename($name);
        $target_file = $target_dir . $file_name;

        // Compress and move uploaded file
        if (compressImage($file_tmp, $target_file)) {
            $uploaded_files[] = $file_name;
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal meng-upload file',
                    text: 'Gagal meng-upload file $name.'
                });
            </script>";
        }
    }

    return implode(",", $uploaded_files);
}

// Function to compress images
function compressImage($source, $destination, $quality = 75)
{
    $image_info = getimagesize($source);
    if ($image_info['mime'] == 'image/jpeg') {
        $image = imagecreatefromjpeg($source);
        return imagejpeg($image, $destination, $quality);
    } elseif ($image_info['mime'] == 'image/png') {
        $image = imagecreatefrompng($source);
        return imagepng($image, $destination, (9 - round($quality / 10)));
    }
    return false; // Unsupported image type
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_project = intval($_GET['id']); // Ensure ID is an integer
    $project = getProjectById($koneksi, $id_project);

    if (!$project) {
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Data tidak ditemukan',
                text: 'Data project tidak ditemukan.'
            });
        </script>";
        exit();
    }
} else {
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ID tidak valid',
            text: 'Silakan periksa ID yang diberikan.'
        });
    </script>";
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
        'Gambar_hasilproject' => !empty($_FILES['Gambar_hasilproject']['name'][0])
            ? handleFileUpload($_FILES['Gambar_hasilproject'])
            : $project['Gambar_hasilproject'],
    ];

    // Update project data
    if (updateProject($koneksi, $data, $id_project)) {
        // Success message with SweetAlert
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Data Berhasil Diperbarui',
                text: 'Data project telah berhasil diperbarui!',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'admin/admin.php?halaman=project';
            });
        </script>";
    } else {
        // Error message with SweetAlert
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Terjadi kesalahan',
                text: '" . htmlspecialchars($koneksi->error) . "'
            });
        </script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Perbarui Data Proyek</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="title">Nama</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Proyek" value="<?= htmlspecialchars($project['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <input id="posisi" name="posisi" type="text" class="form-control" placeholder="posisi" value="<?= htmlspecialchars($project['posisi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="Keterangan" name="detail" required><?= htmlspecialchars($project['detail']) ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>

                            </div>
                            <div class="mb-3">
                                <label for="technology">Teknologi</label>
                                <input id="technology" name="technology" type="text" class="form-control" placeholder="Teknologi" value="<?= htmlspecialchars($project['technology']) ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="jobdesk">Jobdesk</label>
                                <textarea class="form-control" id="jobdesk" rows="5" placeholder="Pekerjaan" name="jobdesk" required><?= htmlspecialchars($project['jobdesk']) ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai" value="<?= htmlspecialchars($project['tanggal_mulai']) ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" name="tanggal_selesai" value="<?= htmlspecialchars($project['tanggal_selesai']) ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="Gambar_hasilproject">Foto</label>
                                <input type="file" class="form-control" id="Gambar_hasilproject" name="Gambar_hasilproject[]" accept="image/png, image/gif, image/jpeg" multiple>
                                <?php foreach (explode(',', $project['Gambar_hasilproject']) as $img): ?>
                                    <img src="admin/storage/Gambar_hasilproject/<?= htmlspecialchars($img) ?>" alt="Gambar Project" width="100">
                                <?php endforeach; ?>
                                <p style="color: red;"> note: Gambar Bisa Lebih dari 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="update">Perbarui</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>