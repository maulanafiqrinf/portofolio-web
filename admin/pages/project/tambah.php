<?php
function handleFormSubmission($koneksi)
{
    if (isset($_POST['save'])) {
        $data = [
            'title' => mysqli_real_escape_string($koneksi, $_POST['title']),
            'posisi' => mysqli_real_escape_string($koneksi, $_POST['posisi']),
            'detail' => mysqli_real_escape_string($koneksi, $_POST['detail']),
            'technology' => mysqli_real_escape_string($koneksi, $_POST['technology']),
            'jobdesk' => mysqli_real_escape_string($koneksi, $_POST['jobdesk']),
            'tanggal_mulai' => mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']),
            'tanggal_selesai' => mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']),
            'class' => mysqli_real_escape_string($koneksi, $_POST['class']),
        ];
        $uploaded_files = handleFileUpload('Gambar_hasilproject', "storage/Gambar_hasilproject/");
        $uploaded_files_string = implode(",", $uploaded_files);
        $query = "INSERT INTO tb_project (title, posisi, detail, technology, jobdesk, Gambar_hasilproject, tanggal_mulai, tanggal_selesai, class) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param(
                "sssssssss",
                $data['title'],
                $data['posisi'],
                $data['detail'],
                $data['technology'],
                $data['jobdesk'],
                $uploaded_files_string,
                $data['tanggal_mulai'],
                $data['tanggal_selesai'],
                $data['class']
            );

            if ($stmt->execute()) {
                echo "<div class='alert alert-info'>Data Tersimpan</div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=project'>";
            } else {
                echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan dalam mempersiapkan query: " . $koneksi->error . "</div>";
        }
    }
}

function handleFileUpload($inputName, $targetDir)
{
    $uploaded_files = [];
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0755, true);
    }

    foreach ($_FILES[$inputName]['name'] as $key => $file_name) {
        $file_tmp = $_FILES[$inputName]['tmp_name'][$key];
        $new_file_name = date("YmdHis") . '-' . basename($file_name);

        if (move_uploaded_file($file_tmp, $targetDir . $new_file_name)) {
            $uploaded_files[] = $new_file_name;
        } else {
            echo "<div class='alert alert-danger'>Gagal meng-upload file $file_name.</div>";
        }
    }

    return $uploaded_files;
}

// Include your database connection
include '../koneksi/koneksi.php';
handleFormSubmission($koneksi);
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tambah Project</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <?php
            $fields = [
                'title' => 'Title',
                'posisi' => 'Posisi',
                'detail' => 'Detail',
                'technology' => 'Technology',
                'jobdesk' => 'Jobdesk',
            ];

            foreach ($fields as $name => $label) {
                if ($name == 'detail' || $name == 'jobdesk') {
                    echo "
                                <div class='row mb-3'>
                                    <label class='col-sm-2 col-form-label' for='$name'>$label</label>
                                    <div class='col-sm-10'>
                                        <textarea id='$name' class='form-control' name='$name' required></textarea>
                                    </div>
                                </div>";
                } else {
                    echo "
                                <div class='row mb-3'>
                                    <label class='col-sm-2 col-form-label' for='$name'>$label</label>
                                    <div class='col-sm-10'>
                                        <input type='text' class='form-control' id='$name' name='$name' required>
                                    </div>
                                </div>";
                }
            }
            ?>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="Gambar_hasilproject">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="Gambar_hasilproject" name="Gambar_hasilproject[]" multiple required>
                </div>
            </div>

            <?php
            $dateFields = [
                'tanggal_mulai' => 'Tanggal Mulai',
                'tanggal_selesai' => 'Tanggal Selesai',
            ];

            foreach ($dateFields as $name => $label) {
                echo "
                            <div class='row mb-3'>
                                <label class='col-sm-2 col-form-label' for='$name'>$label</label>
                                <div class='col-sm-6'>
                                    <input type='date' class='form-control' id='$name' name='$name' required>
                                </div>
                            </div>";
            }
            ?>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="class">Class</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="class" required>
                        <option value="">-- Pilih Class --</option>
                        <option value="bg-prink">Pink</option>
                        <option value="bg-catkrill">Grey</option>
                    </select>
                </div>
            </div>

            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>