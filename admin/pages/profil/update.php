<?php
include '../koneksi/koneksi.php'; // Pastikan file koneksi benar

// Ambil data user admin (pastikan variabel $data_user_admin terdefinisi sebelumnya)
$id_admin = $data_user_admin['id_admin'];
$email = $data_user_admin['email'];
$username = $data_user_admin['username'];

// Proses update profil
if (isset($_POST['simpan'])) {
    // Ambil data input dan sanitasi
    $new_username = strtolower(stripcslashes($_POST['username']));
    $new_email = strtolower(stripcslashes($_POST['alamatemail']));
    
    // Validasi email
    if (!filter_var($new_email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>Swal.fire('Error', 'Format email tidak valid', 'error');</script>";
    } else {
        // Cek jika password diisi, berarti ingin mengubah password
        $new_password = $_POST['password'];
        if (!empty($new_password)) {
            // Hash password sebelum menyimpan ke database
            $hashedPassword = password_hash($new_password, PASSWORD_DEFAULT);
            $query = "UPDATE tb_admin SET username=?, password=?, email=? WHERE id_admin=?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("sssi", $new_username, $hashedPassword, $new_email, $id_admin);
        } else {
            // Jika password kosong, jangan update password
            $query = "UPDATE tb_admin SET username=?, email=? WHERE id_admin=?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssi", $new_username, $new_email, $id_admin);
        }

        // Eksekusi query dan cek hasilnya
        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    title: 'Berhasil!',
                    text: 'Profil telah diperbarui',
                    icon: 'success',
                    timer: 2000,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'admin/logout.php'; // Logout untuk mereset session
                });
            </script>";
        } else {
            echo "<script>Swal.fire('Error', 'Gagal memperbarui data: " . $koneksi->error . "', 'error');</script>";
        }
        $stmt->close();
    }
}
?>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Perbarui Data</h4>
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
                                <label for="username">Username</label>
                                <input id="username" name="username" type="text" class="form-control" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                            </div>
                            <div class="mb-3">
                                <label for="alamatemail">Email</label>
                                <input id="alamatemail" name="alamatemail" type="email" class="form-control" placeholder="Alamat Email" value="<?php echo htmlspecialchars($email); ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary" name="simpan">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
