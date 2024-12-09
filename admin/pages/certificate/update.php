<?php
include '../koneksi/koneksi.php'; // Pastikan koneksi sudah benar

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
              title=?, pihak=?, detail=?,  Gambar_hasilcertificate=?, tanggal_mulai=?, tanggal_selesai=? 
              WHERE id_certificate=?";

    // Prepare the statement
    $stmt = $koneksi->prepare($query);

    // If 'tanggal_selesai' is empty, set it to NULL
    $tanggal_selesai = !empty($data['tanggal_selesai']) ? $data['tanggal_selesai'] : NULL;

    // Bind parameters, where the last 'i' represents an integer, and the second-to-last '?' can be NULL
    $stmt->bind_param(
        "ssssssi",
        $data['title'],
        $data['pihak'],
        $data['detail'],
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
            echo "<script>Swal.fire('Error', 'Gagal meng-upload file {$name}.', 'error');</script>";
        }
    }

    return implode(",", $uploaded_files);
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_certificate = intval($_GET['id']); // Ensure ID is an integer
    $certificate = getcertificateById($koneksi, $id_certificate);

    if (!$certificate) {
        echo "<script>Swal.fire('Error', 'Data tidak ditemukan.', 'error');</script>";
        exit();
    }
} else {
    echo "<script>Swal.fire('Error', 'ID tidak valid.', 'error');</script>";
    exit();
}

// If form is submitted
if (isset($_POST['update'])) {
    // Prepare data from the form
    $data = [
        'title' => $_POST['title'],
        'pihak' => $_POST['pihak'],
        'detail' => $_POST['detail'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai'], // Can be NULL
        'Gambar_hasilcertificate' => !empty($_FILES['Gambar_hasilcertificate']['name'][0])
            ? handleFileUpload($_FILES['Gambar_hasilcertificate'])
            : $certificate['Gambar_hasilcertificate'],
    ];

    // Update certificate data
    if (updatecertificate($koneksi, $data, $id_certificate)) {
        echo "<script>
                Swal.fire({
                    title: 'Sukses!',
                    text: 'Data berhasil diperbarui.',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(function() {
                    window.location.href = 'admin/admin.php?halaman=certificate';
                });
              </script>";
    } else {
        echo "<script>Swal.fire('Error', 'Terjadi kesalahan: " . $koneksi->error . "', 'error');</script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update Data Sertifikat</h4>
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
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Sertifikat" value="<?= htmlspecialchars($certificate['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="pihak">Pihak Pemberi</label>
                                <input id="pihak" name="pihak" type="text" class="form-control" placeholder="Pihak" value="<?= htmlspecialchars($certificate['pihak']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="Keterangan" name="detail" required><?= htmlspecialchars($certificate['detail']) ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai" value="<?= htmlspecialchars($certificate['tanggal_mulai']) ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" name="tanggal_selesai" value="<?= htmlspecialchars($certificate['tanggal_selesai']) ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="Gambar_hasilcertificate">Foto</label>
                                <input type="file" class="form-control" id="Gambar_hasilcertificate" name="Gambar_hasilcertificate[]" accept="image/png, image/gif, image/jpeg" multiple>
                                <!-- Display existing images -->
                                <?php foreach (explode(',', $certificate['Gambar_hasilcertificate']) as $img): ?>
                                    <img src="admin/storage/Gambar_hasilcertificate/<?= htmlspecialchars($img) ?>" alt="Gambar certificate" width="120">
                                <?php endforeach; ?>
                                <p style="color: red;"> note: Gambar Bisa Lebih dari 1</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="update">Update</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>