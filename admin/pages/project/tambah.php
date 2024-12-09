<?php
function handleFormSubmission($koneksi)
{
    if (isset($_POST['save'])) {
        $data = [
            'title' => $_POST['title'],
            'posisi' => $_POST['posisi'],
            'detail' => $_POST['detail'],
            'technology' => $_POST['technology'],
            'jobdesk' => $_POST['jobdesk'],
            'tanggal_mulai' => $_POST['tanggal_mulai'],
            'tanggal_selesai' => $_POST['tanggal_selesai'],
        ];

        // Use prepared statements to prevent SQL injection
        $query = "INSERT INTO tb_project (title, posisi, detail, technology, jobdesk, Gambar_hasilproject, tanggal_mulai, tanggal_selesai) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

        $uploaded_files = handleFileUpload('Gambar_hasilproject', "storage/Gambar_hasilproject/");
        $uploaded_files_string = implode(",", $uploaded_files);

        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param(
                "ssssssss",
                $data['title'],
                $data['posisi'],
                $data['detail'],
                $data['technology'],
                $data['jobdesk'],
                $uploaded_files_string,
                $data['tanggal_mulai'],
                $data['tanggal_selesai'],
            );

            if ($stmt->execute()) {
                // Success message with SweetAlert
                echo "<script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Tersimpan',
                        text: 'Data project berhasil disimpan!',
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
                        text: '" . htmlspecialchars($stmt->error) . "'
                    });
                </script>";
            }
            $stmt->close();
        } else {
            // Error preparing query with SweetAlert
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Terjadi kesalahan',
                    text: '" . htmlspecialchars($koneksi->error) . "'
                });
            </script>";
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

        // Compress image before uploading
        if (compressImage($file_tmp, $targetDir . $new_file_name)) {
            $uploaded_files[] = $new_file_name;
        } else {
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal meng-upload file',
                    text: 'Gagal meng-upload file $file_name.'
                });
            </script>";
        }
    }

    return $uploaded_files;
}

function compressImage($source, $destination, $quality = 75)
{
    $image_info = getimagesize($source);
    if ($image_info === false) {
        return false;
    }

    switch ($image_info['mime']) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            imagejpeg($image, $destination, $quality);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            imagepng($image, $destination, (int)(9 * ($quality / 120))); // PNG quality is 0-9
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            imagegif($image, $destination);
            break;
        default:
            return false;
    }

    imagedestroy($image);
    return true;
}

// Include your database connection
include '../koneksi/koneksi.php';
handleFormSubmission($koneksi);
?>



<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Data Proyek</h4>
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
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Proyek" required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <input id="posisi" name="posisi" type="text" class="form-control" placeholder="posisi" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="Keterangan" name="detail" required></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>

                            </div>
                            <div class="mb-3">
                                <label for="technology">Teknologi</label>
                                <input id="technology" name="technology" type="text" class="form-control" placeholder="Teknologi" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="jobdesk">Jobdesk</label>
                                <textarea class="form-control" id="jobdesk" rows="5" placeholder="Pekerjaan" name="jobdesk" required></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" name="tanggal_selesai" required />
                            </div>
                            <div class="mb-3">
                                <label for="Gambar_hasilproject">Foto</label>
                                <input type="file" class="form-control" id="Gambar_hasilproject" name="Gambar_hasilproject[]" accept="image/png, image/gif, image/jpeg" multiple required>
                                <p style="color: red;"> note: Gambar Bisa Lebih dari 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="save">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>