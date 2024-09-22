<?php
include '../koneksi/koneksi.php'; // Pastikan path koneksi benar

$id = $_GET['id'];
$result = $koneksi->query("SELECT * FROM tb_about WHERE id_about = '$id'");
$data = $result->fetch_assoc();

if (isset($_POST['update'])) {
    // Mengambil data dari form
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $profession = mysqli_real_escape_string($koneksi, $_POST['profession']);
    $phone = mysqli_real_escape_string($koneksi, $_POST['phone']);
    $email = mysqli_real_escape_string($koneksi, $_POST['email']);
    $location = mysqli_real_escape_string($koneksi, $_POST['location']);
    $birthday = mysqli_real_escape_string($koneksi, $_POST['birthday']);
    $about = mysqli_real_escape_string($koneksi, $_POST['about']);
    $linkedn = mysqli_real_escape_string($koneksi, $_POST['linkedn']);
    $instagram = mysqli_real_escape_string($koneksi, $_POST['instagram']);
    $facebook = mysqli_real_escape_string($koneksi, $_POST['facebook']);
    $cv = mysqli_real_escape_string($koneksi, $_POST['cv']);

    // Mengambil data file
    if (!empty($_FILES['foto_about']['name'])) {
        $foto_about = $_FILES['foto_about']['name'];
        $lokasi = $_FILES['foto_about']['tmp_name'];
        $namafiks = date("YmdHis") . '-' . basename($foto_about);

        // Pastikan direktori penyimpanan ada
        $target_dir = "storage/foto_about/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        // Menyimpan file baru ke direktori
        if (move_uploaded_file($lokasi, $target_dir . $namafiks)) {
            // Menghapus file lama
            if (file_exists($target_dir . $data['foto_about'])) {
                unlink($target_dir . $data['foto_about']);
            }

            // Update query dengan foto
            $query = "UPDATE tb_about SET nama = '$nama', profession='$profession' ,phone = '$phone', email = '$email', location = '$location', birthday = '$birthday', foto_about = '$namafiks', about = '$about', linkedn = '$linkedn', instagram = '$instagram', facebook = '$facebook', cv ='$cv' WHERE id_about = '$id'";
        }
    } else {
        // Update query tanpa foto
        $query = "UPDATE tb_about SET nama = '$nama',profession='$profession', phone = '$phone', email = '$email', location = '$location', birthday = '$birthday', about = '$about', linkedn = '$linkedn', instagram = '$instagram', facebook = '$facebook', cv ='$cv' WHERE id_about = '$id'";
    }

    if ($koneksi->query($query)) {
        echo "<div class='alert alert-info'>Data Berhasil Diperbarui</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=about'>";
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }
}
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Form Edit About</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Nama -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="nama">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $data['nama']; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="profession">profession</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="profession" name="profession" value="<?php echo $data['profession']; ?>" required>
                </div>
            </div>
            <!-- Phone -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="phone" name="phone" value="<?= $data['phone']; ?>" required>
                </div>
            </div>
            <!-- Email -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $data['email']; ?>" required>
                </div>
            </div>
            <!-- Location -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="location">Location</label>
                <div class="col-sm-10">
                    <textarea id="location" class="form-control" name="location" required><?= $data['location']; ?></textarea>
                </div>
            </div>
            <!-- Birthday -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="birthday">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="birthday" name="birthday" value="<?= $data['birthday']; ?>" required>
                </div>
            </div>
            <!-- Foto About -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="foto_about">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="foto_about" name="foto_about">
                    <img src="storage/foto_about/<?= $data['foto_about']; ?>" width="100">
                </div>
            </div>
            <!-- About -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="about">About</label>
                <div class="col-sm-10">
                    <textarea id="about" class="form-control" name="about" required><?= $data['about']; ?></textarea>
                </div>
            </div>
            <!-- LinkedIn -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="linkedn">LinkedIn</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="linkedn" name="linkedn" value="<?= $data['linkedn']; ?>" required>
                </div>
            </div>
            <!-- Instagram -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="instagram">Instagram</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?= $data['instagram']; ?>" required>
                </div>
            </div>
            <!-- Facebook -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="facebook">Facebook</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?= $data['facebook']; ?>" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="cv">cv</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cv" name="cv" value="<?= $data['cv']; ?>" required>
                </div>
            </div>
            <!-- Tombol Simpan -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="update">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>