<?php
include '../koneksi/koneksi.php'; // Pastikan path koneksi benar

// Proses penambahan skills
if (isset($_POST['tambah'])) {
    $nama = trim($_POST['nama']); // Hapus spasi tambahan
    $image = $_POST['image'];
    $tanggal = date("Y-m-d H:i:s");

    // Validasi input
    if (!empty($nama)) {
        // Menggunakan prepared statements untuk keamanan
        $stmt = $koneksi->prepare("INSERT INTO tb_skills (nama, image, tgl_input) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nama, $image, $tanggal);

        if ($stmt->execute()) {
            // Pesan sukses
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Data Tersimpan',
                    text: 'Skills berhasil ditambahkan!',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    window.location.href = 'admin/admin.php?halaman=skills';
                });
            </script>";
        } else {
            // Pesan error
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal Menyimpan Data',
                    text: 'Kesalahan: " . htmlspecialchars($stmt->error) . "'
                });
            </script>";
        }

        $stmt->close();
    } else {
        // Pesan input tidak valid
        echo "<script>
            Swal.fire({
                icon: 'warning',
                title: 'Input Tidak Valid',
                text: 'Harap masukkan nama skills yang valid.'
            });
        </script>";
    }
}

// Ambil data skills dari database
$stmt = $koneksi->prepare("SELECT * FROM tb_skills");
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Ketrampilan</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-end">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#newKetrampilanModal" class="btn btn-success btn-rounded waves-effect waves-light mb-2 me-2">
                                <i class="mdi mdi-plus me-1"></i> Tambah Ketrampilan
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap dt-responsive nowrap w-100" id="datatable-buttons">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Ketrampilan</th>
                                <th>Image</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($row = $result->fetch_assoc()) { ?>
                                <tr align="center">
                                    <td><?= $no++; ?></td>
                                    <td><?= htmlspecialchars($row['nama']); ?></td>
                                    <td>
                                        <?php if (!empty($row['image'])) { ?>
                                            <img src="<?= htmlspecialchars($row['image']); ?>" alt="Image" width="50">
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <a href="admin/admin.php?halaman=hapus-skills&id=<?= $row['id_skills']; ?>" class="btn btn-danger">
                                            <i class="bx bx-trash-alt me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="newKetrampilanModal" tabindex="-1" aria-labelledby="newKetrampilanModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newKetrampilanModalLabel">Tambah Ketrampilan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Ketrampilan</label>
                        <input type="text" name="nama" class="form-control" placeholder="Masukkan nama ketrampilan" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">URL Gambar</label>
                        <input type="url" name="image" class="form-control" placeholder="Masukkan URL gambar">
                    </div>
                    <div class="text-end">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" name="tambah" class="btn btn-success">Tambah</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
