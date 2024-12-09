<?php
include '../koneksi/koneksi.php'; // Pastikan jalur koneksi benar

// Fungsi untuk mendapatkan data experience berdasarkan ID
function getExperienceById($koneksi, $id_experience)
{
    $stmt = $koneksi->prepare("SELECT * FROM tb_experience WHERE id_experience = ?");
    $stmt->bind_param("i", $id_experience);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

// Fungsi untuk memperbarui data experience
function updateExperience($koneksi, $data, $id_experience)
{
    $stmt = $koneksi->prepare("UPDATE tb_experience SET 
        title=?, posisi=?, jobdesk=?, tanggal_mulai=?, tanggal_selesai=? 
        WHERE id_experience=?");

    $stmt->bind_param(
        "sssssi",
        $data['title'],
        $data['posisi'],
        $data['jobdesk'],
        $data['tanggal_mulai'],
        $data['tanggal_selesai'],
        $id_experience
    );

    return $stmt->execute();
}

// Cek apakah ID disediakan melalui URL
if (isset($_GET['id'])) {
    $id_experience = intval($_GET['id']); // Pastikan ID adalah integer
    $experience = getExperienceById($koneksi, $id_experience);

    if (!$experience) {
        echo "<script>Swal.fire('Error', 'Data tidak ditemukan.', 'error');</script>";
        exit();
    }
} else {
    echo "<script>Swal.fire('Error', 'ID tidak valid.', 'error');</script>";
    exit();
}

// Jika form di-submit
if (isset($_POST['update'])) {
    // Persiapkan data dari form
    $data = [
        'title' => $_POST['title'],
        'posisi' => $_POST['posisi'],
        'jobdesk' => $_POST['jobdesk'],
        'tanggal_mulai' => $_POST['tanggal_mulai'],
        'tanggal_selesai' => $_POST['tanggal_selesai']
    ];

    // Update data experience
    if (updateExperience($koneksi, $data, $id_experience)) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data berhasil diperbarui.',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'admin/admin.php?halaman=experience';
            });
        </script>";
    } else {
        echo "<script>Swal.fire('Error', 'Terjadi kesalahan: {$koneksi->error}', 'error');</script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update Data Pengalaman</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="title">Nama</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Sertifikat" value="<?= htmlspecialchars($experience['title']) ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <input id="posisi" name="posisi" type="text" class="form-control" placeholder="Posisi" value="<?= htmlspecialchars($experience['posisi']) ?>" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="jobdesk">Jobdesk</label>
                                <textarea class="form-control" id="jobdesk" rows="5" placeholder="Pekerjaan" name="jobdesk" required><?= htmlspecialchars($experience['jobdesk']) ?></textarea>
                                <p style="color: red;">Untuk membuat new line gunakan Enter</p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" name="tanggal_mulai" value="<?= htmlspecialchars($experience['tanggal_mulai']) ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" name="tanggal_selesai" value="<?= htmlspecialchars($experience['tanggal_selesai']) ?>" required />
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary" name="update">Perbarui</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
