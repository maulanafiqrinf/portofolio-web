<?php
function handleFormSubmission($koneksi)
{
    if (isset($_POST['save'])) {
        $data = [
            'title' => mysqli_real_escape_string($koneksi, $_POST['title']),
            'pihak' => mysqli_real_escape_string($koneksi, $_POST['pihak']),
            'detail' => mysqli_real_escape_string($koneksi, $_POST['detail']),
            'jobdesk' => mysqli_real_escape_string($koneksi, $_POST['jobdesk']),
            'tanggal_mulai' => mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']),
            'tanggal_selesai' => empty($_POST['tanggal_selesai']) ? null : mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']),
        ];

        $uploaded_files = handleFileUpload('Gambar_hasilcertificate', "storage/Gambar_hasilcertificate/");
        $uploaded_files_string = implode(",", $uploaded_files);
        
        $query = "INSERT INTO tb_certificate (title, pihak, detail, jobdesk, Gambar_hasilcertificate, tanggal_mulai, tanggal_selesai) 
                  VALUES (?, ?, ?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($query)) {
            // Bind parameters, handle `NULL` for tanggal_selesai
            $stmt->bind_param(
                "sssssss",
                $data['title'],
                $data['pihak'],
                $data['detail'],
                $data['jobdesk'],
                $uploaded_files_string,
                $data['tanggal_mulai'],
                $data['tanggal_selesai']
            );

            if ($stmt->execute()) {
                echo "<div class='alert alert-info'>Data Tersimpan</div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=certificate'>";
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
        <h5 class="card-title mb-0">Tambah certificate</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <?php
            $fields = [
                'title' => 'Title',
                'pihak' => 'pihak',
                'detail' => 'Detail',
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
                <label class="col-sm-2 col-form-label" for="Gambar_hasilcertificate">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="Gambar_hasilcertificate" name="Gambar_hasilcertificate[]" multiple required>
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
                                    <input type='date' class='form-control' id='$name' name='$name'>
                                </div>
                            </div>";
            }
            ?>

            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>