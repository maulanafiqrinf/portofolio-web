<?php
include '../koneksi/koneksi.php'; // Pastikan path koneksi benar

// Proses penambahan skills
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama'];
    $tanggal = date("Y-m-d H:i:s");

    // Menggunakan prepared statements untuk menghindari SQL injection
    $stmt = $koneksi->prepare("INSERT INTO tb_skills (nama, tgl_input) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama, $tanggal);

    if ($stmt->execute()) {
        echo "<div class='alert alert-info'>Data Tersimpan</div>";
        echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=skills'>";
    } else {
        echo "<div class='alert alert-danger'>Gagal Menyimpan Data: " . $stmt->error . "</div>";
    }

    // Menutup statement
    $stmt->close();
}

// Ambil data skills dari database
$dataskills = mysqli_query($koneksi, "SELECT * FROM tb_skills");
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Skills</h5>
    </div>

    <div class="card-body">
        <!-- Form untuk tambah skills -->
        <form method="post" action="">
            <div class="form-group col-md-4">
                <input type="text" name="nama" class="form-control" placeholder="Masukkan skills Baru" required>
            </div>
            <div class="form-group">
                <button type="submit" name="tambah" class="btn btn-primary">
                <i class="bx bx-plus-circle"></i> Tambah Data
                </button>
            </div>
        </form>
    </div>

    <hr />

    <div class="card-body">
        <!-- Tabel data skills -->
        <div class="table-responsive">
            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Skills</th>
                        <th>Tanggal Input</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    while ($row = mysqli_fetch_assoc($dataskills)) { ?>
                        <tr align="center">
                            <td><?= $no++; ?></td>
                            <td><?= htmlspecialchars($row['nama']); ?></td>
                            <td><?= htmlspecialchars($row['tgl_input']); ?></td>
                            <td>
                                <a href="index.php?halaman=hapus-skills&id=<?= $row['id_skills']; ?>" class="btn btn-danger">
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
