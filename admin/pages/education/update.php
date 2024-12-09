<?php
include '../koneksi/koneksi.php'; // Ensure the connection path is correct

// Function to get education by ID
function getEducationById($koneksi, $id_education)
{
    $stmt = $koneksi->prepare("SELECT * FROM tb_education WHERE id_education = ?");
    $stmt->bind_param("i", $id_education);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Function to update education data
function updateEducation($koneksi, $data, $id_education)
{
    $stmt = $koneksi->prepare("UPDATE tb_education SET 
              title=?, posisi=?, detail=?, tanggal_mulai=?, tanggal_selesai=?
              WHERE id_education=?");

    $stmt->bind_param(
        "sssssi",
        $data['title'],
        $data['posisi'],
        $data['detail'],
        $data['tanggal_mulai'],
        $data['tanggal_selesai'],
        $id_education // Make sure to add this last
    );

    return $stmt->execute();
}

// Check if ID is provided via the URL parameter
if (isset($_GET['id'])) {
    $id_education = intval($_GET['id']); // Ensure ID is an integer
    $education = getEducationById($koneksi, $id_education);

    if (!$education) {
        echo "<script>Swal.fire('Error', 'Data tidak ditemukan', 'error');</script>";
        exit();
    }
} else {
    echo "<script>Swal.fire('Error', 'ID tidak valid', 'error');</script>";
    exit();
}

// If form is submitted
if (isset($_POST['update'])) {
    // Sanitize input data
    $data = [
        'title' => htmlspecialchars(trim($_POST['title'])),
        'posisi' => htmlspecialchars(trim($_POST['posisi'])),
        'detail' => htmlspecialchars(trim($_POST['detail'])),
        'tanggal_mulai' => htmlspecialchars(trim($_POST['tanggal_mulai'])),
        'tanggal_selesai' => htmlspecialchars(trim($_POST['tanggal_selesai'])),
    ];

    // Validate that required data is filled
    if (!empty($data['title']) && !empty($data['posisi']) && !empty($data['detail']) && !empty($data['tanggal_mulai'])) {
        // Validate that the end date is after the start date
        if ($data['tanggal_selesai'] < $data['tanggal_mulai']) {
            echo "<script>Swal.fire('Warning', 'Tanggal selesai harus setelah tanggal mulai.', 'warning');</script>";
        } else {
            // Update education data
            if (updateEducation($koneksi, $data, $id_education)) {
                echo "<script>
                        Swal.fire({
                            title: 'Success',
                            text: 'Data Berhasil Diperbarui',
                            icon: 'success'
                        }).then(() => {
                            location.href='admin/admin.php?halaman=education';
                        });
                      </script>";
            } else {
                echo "<script>Swal.fire('Error', 'Terjadi kesalahan: " . addslashes($koneksi->error) . "', 'error');</script>";
            }
        }
    } else {
        echo "<script>Swal.fire('Warning', 'Harap isi semua data wajib', 'warning');</script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update Data Pendidikan</h4>
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
                                <label for="title">Nama Universitas</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama" value="<?= htmlspecialchars($education['title']) ?>"  required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Program Studi / Jurusan</label>
                                <input id="posisi" name="posisi" type="text" class="form-control" placeholder="Program Studi/Jurusan" value="<?= htmlspecialchars($education['posisi']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="detail" name="detail" required><?= nl2br(htmlspecialchars($education['detail'])) ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai" value="<?= htmlspecialchars($education['tanggal_mulai']) ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" name="tanggal_selesai" value="<?= htmlspecialchars($education['tanggal_selesai']) ?>" required />
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