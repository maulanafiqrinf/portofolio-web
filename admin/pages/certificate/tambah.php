<?php
function handleFormSubmission($koneksi)
{
    if (isset($_POST['save'])) {
        $data = [
            'title' => mysqli_real_escape_string($koneksi, $_POST['title']),
            'pihak' => mysqli_real_escape_string($koneksi, $_POST['pihak']),
            'detail' => mysqli_real_escape_string($koneksi, $_POST['detail']),
            'tanggal_mulai' => mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']),
            'tanggal_selesai' => empty($_POST['tanggal_selesai']) ? null : mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']),
        ];

        $uploaded_files = handleFileUpload('Gambar_hasilcertificate', "storage/Gambar_hasilcertificate/");
        $uploaded_files_string = implode(",", $uploaded_files);

        $query = "INSERT INTO tb_certificate (title, pihak, detail, Gambar_hasilcertificate, tanggal_mulai, tanggal_selesai) 
                  VALUES (?, ?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($query)) {
            // Bind parameters, handle `NULL` for tanggal_selesai
            $stmt->bind_param(
                "ssssss",
                $data['title'],
                $data['pihak'],
                $data['detail'],
                $uploaded_files_string,
                $data['tanggal_mulai'],
                $data['tanggal_selesai']
            );

            if ($stmt->execute()) {
                echo "<script>
                    Swal.fire({
                        title: 'Success',
                        text: 'Data Tersimpan',
                        icon: 'success'
                    }).then(() => {
                        location.href='admin/admin.php?halaman=certificate';
                    });
                </script>";
                exit();
            } else {
                echo "<script>
                    Swal.fire('Error', 'Terjadi kesalahan: " . addslashes($stmt->error) . "', 'error');
                </script>";
            }
            $stmt->close();
        } else {
            // SweetAlert error message for query preparation
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan dalam mempersiapkan query: " . $koneksi->error . "',
                    icon: 'error',
                    confirmButtonText: 'OK'
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

        if (move_uploaded_file($file_tmp, $targetDir . $new_file_name)) {
            $uploaded_files[] = $new_file_name;
        } else {
            echo "<script>
                Swal.fire({
                    title: 'Error!',
                    text: 'Gagal meng-upload file $file_name.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            </script>";
        }
    }

    return $uploaded_files;
}

// Include your database connection
include '../koneksi/koneksi.php';
handleFormSubmission($koneksi);
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Data Sertifikat</h4>
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
                                <label for="title">Nama Sertifikat</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Sertifikat" required>
                            </div>
                            <div class="mb-3">
                                <label for="pihak">Pihak Pemberi</label>
                                <input id="pihak" name="pihak" type="text" class="form-control" placeholder="Pihak" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="Keterangan" name="detail" required></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" name="tanggal_selesai" required />
                            </div>
                            <div class="mb-3">
                                <label for="Gambar_hasilcertificate">Foto</label>
                                <input type="file" class="form-control" id="Gambar_hasilcertificate" name="Gambar_hasilcertificate[]" accept="image/png, image/gif, image/jpeg" multiple required>
                                <p style="color: red;"> note: Gambar Bisa Lebih dari 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="save">save</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>