<?php
include '../koneksi/koneksi.php'; // Pastikan path koneksi benar

$id = $_GET['id'];

// Optimasi query menggunakan prepared statement
$stmt = $koneksi->prepare("SELECT * FROM tb_about WHERE id_about = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();  
$data = $result->fetch_assoc();

if (isset($_POST['update'])) {
    // Mengambil data dari form
    $nama = $_POST['nama'];
    $profession = $_POST['profession'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $about = $_POST['about'];
    $linkedn = $_POST['linkedn'];
    $instagram = $_POST['instagram'];
    $github = $_POST['github'];
    $cv = $_POST['cv'];

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

        // Menyimpan file baru dan mengompres gambar
        $image_info = getimagesize($lokasi);
        $image_mime = $image_info['mime'];

        if ($image_mime == 'image/jpeg' || $image_mime == 'image/jpg') {
            $source_image = imagecreatefromjpeg($lokasi);
            imagejpeg($source_image, $target_dir . $namafiks, 75); // Kompresi dengan kualitas 75%
        } elseif ($image_mime == 'image/png') {
            $source_image = imagecreatefrompng($lokasi);
            imagepng($source_image, $target_dir . $namafiks, 6); // Kompresi PNG dengan level 6 (0-9)
        } else {
            echo "<script>Swal.fire('Error', 'Format gambar tidak didukung.', 'error');</script>";
            exit;
        }

        // Menghapus file lama jika ada
        if (file_exists($target_dir . $data['foto_about'])) {
            unlink($target_dir . $data['foto_about']);
        }

        // Update query dengan foto
        $stmt = $koneksi->prepare("UPDATE tb_about SET nama = ?, profession = ?, phone = ?, email = ?, location = ?, foto_about = ?, about = ?, linkedn = ?, instagram = ?, github = ?, cv = ? WHERE id_about = ?");
        $stmt->bind_param("sssssssssssi", $nama, $profession, $phone, $email, $location, $namafiks, $about, $linkedn, $instagram, $github, $cv, $id);
    } else {
        // Update query tanpa foto
        $stmt = $koneksi->prepare("UPDATE tb_about SET nama = ?, profession = ?, phone = ?, email = ?, location = ?, about = ?, linkedn = ?, instagram = ?, github = ?, cv = ? WHERE id_about = ?");
        $stmt->bind_param("ssssssssssi", $nama, $profession, $phone, $email, $location, $about, $linkedn, $instagram, $github, $cv, $id);
    }

    if ($stmt->execute()) {
        echo "<script>
            Swal.fire({
                title: 'Berhasil!',
                text: 'Data Berhasil Diperbarui',
                icon: 'success',
                timer: 1500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = 'admin/admin.php?halaman=about&id=" . urlencode($id) . "';
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
            <h4 class="mb-sm-0 font-size-18">Update Data Diri</h4>
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
                        <div class="foto position-relative ">
                            <center>
                                <img src="admin/storage/foto_about/<?= $data['foto_about']; ?>" height='200px' width='200px' class="img-thumbnail" alt="foto">
                                <div class="btn-foto">
                                    <input id="foto_about" name="foto_about" type="file" class="form-control" placeholder="foto_about" accept="image/png, image/gif, image/jpeg">
                                </div>
                            </center>
                        </div>
                            <div class="mb-3">
                                <label for="nama">Nama</label>
                                <input id="nama" name="nama" type="text" class="form-control" placeholder="Nama" value="<?php echo $data['nama']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="phone">No. HP</label>
                                <input id="phone" name="phone" type="number" class="form-control" placeholder="No.HP" value="<?= $data['phone']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" class="form-control" placeholder="email" value="<?= $data['email']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="location">Lokasi</label>
                                <textarea class="form-control" id="location" rows="5" placeholder="Location" name="location" required><?= $data['location']; ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="about">Tentang Saya</label>
                                <textarea class="form-control" id="about" rows="6" placeholder="Tentang Saya" name="about" required><?= $data['about']; ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                            <div class="mb-3">
                                <label for="profession">Profesi</label>
                                <input id="profession" name="profession" type="text" class="form-control" placeholder="profession" value="<?php echo $data['profession']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="linkedn">Linkedn</label>
                                <input id="linkedn" name="linkedn" type="text" class="form-control" placeholder="linkedn" value="<?php echo $data['linkedn']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="instagram">Instagram</label>
                                <input id="instagram" name="instagram" type="text" class="form-control" placeholder="instagram" value="<?php echo $data['instagram']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="github">Github</label>
                                <input id="github" name="github" type="text" class="form-control" placeholder="Github" value="<?php echo $data['github']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="cv">CV</label>
                                <input id="cv" name="cv" type="text" class="form-control" placeholder="cv" value="<?php echo $data['cv']; ?>" required>
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