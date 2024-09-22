<?php
if (isset($_POST['save'])) {
    include '../koneksi/koneksi.php';

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
    $foto_about = $_FILES['foto_about']['name'];
    $lokasi = $_FILES['foto_about']['tmp_name'];
    $namafiks = date("YmdHis") . '-' . basename($foto_about);

    // Pastikan direktori penyimpanan ada
    $target_dir = "storage/foto_about/";
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Menyimpan file ke direktori
    if (move_uploaded_file($lokasi, $target_dir . $namafiks)) {
        // Menyimpan data ke database
        $query = "INSERT INTO tb_about (nama, profession, phone, email, location, birthday, foto_about, about, linkedn, instagram, facebook, cv) 
                  VALUES ('$nama','$profession','$phone','$email','$location','$birthday','$namafiks','$about','$linkedn','$instagram','$facebook', '$cv')";

        if ($koneksi->query($query)) {
            echo "<div class='alert alert-info'>Data Tersimpan</div>";
            echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=about'>";
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
        }
    } else {
        echo "<div class='alert alert-danger'>Gagal meng-upload file.</div>";
    }
}
?>
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data About</h5>
        <a href="index.php?halaman=Tambah-about" class="btn btn-primary">
            <i class="bx bx-plus-circle"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <!-- Nama -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="nama">Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="nama" name="nama" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="profession">profession</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="profession" name="profession" required>
                </div>
            </div>
            <!-- Phone -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="phone">Phone</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" id="phone" name="phone" required>
                </div>
            </div>
            <!-- Email -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="email">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <!-- Location -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="location">Location</label>
                <div class="col-sm-10">
                    <textarea id="location" class="form-control" name="location" required></textarea>
                </div>
            </div>
            <!-- Birthday -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="birthday">Birthday</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" id="birthday" name="birthday" required>
                </div>
            </div>
            <!-- Foto Produk -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="foto_about">Foto</label>
                <div class="col-sm-10">
                    <input type="file" class="form-control" id="foto_about" name="foto_about" required>
                </div>
            </div>
            <!-- About -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="about">About</label>
                <div class="col-sm-10">
                    <textarea id="about" class="form-control" name="about" required></textarea>
                </div>
            </div>
            <!-- LinkedIn -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="linkedn">LinkedIn</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="linkedn" name="linkedn" required>
                </div>
            </div>
            <!-- Instagram -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="instagram">Instagram</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="instagram" name="instagram" required>
                </div>
            </div>
            <!-- Facebook -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="facebook">Facebook</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="facebook" name="facebook" required>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="cv">cv</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="cv" name="cv" required>
                </div>
            </div>
            <!-- Tombol Simpan -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>