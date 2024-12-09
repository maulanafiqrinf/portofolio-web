<?php
include '../koneksi/koneksi.php'; // Ensure the path is correct

// Ensure the ID is provided via URL parameter
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($koneksi, $_GET['id']);

    // Fetch services data based on ID
    $result = $koneksi->query("SELECT * FROM tb_services WHERE id_services = '$id'");
    if ($result->num_rows > 0) {
        $data = $result->fetch_assoc();
    } else {
        echo "<script>Swal.fire('Error', 'Data tidak ditemukan', 'error');</script>";
        exit();
    }
} else {
    echo "<script>Swal.fire('Error', 'ID tidak valid', 'error');</script>";
    exit();
}

// If the form is submitted
if (isset($_POST['update'])) {
    // Sanitize input data
    $title = htmlspecialchars(trim($_POST['title']));
    $detail = htmlspecialchars(trim($_POST['detail']));
    $icon = htmlspecialchars(trim($_POST['icon']));

    // Validate that required data is filled
    if (!empty($title) && !empty($detail) && !empty($icon)) {
        // Prepare the update query
        $query = $koneksi->prepare("UPDATE tb_services SET title = ?, detail = ?, icon = ? WHERE id_services = ?");

        // Bind parameters correctly (4 strings and 1 integer for ID)
        $query->bind_param("sssi", $title, $detail, $icon, $id);

        // Execute the query
        if ($query->execute()) {
            echo "<script>
                    Swal.fire({
                        title: 'Success',
                        text: 'Data Berhasil Diperbarui',
                        icon: 'success'
                    }).then(() => {
                        location.href='admin/admin.php?halaman=service';
                    });
                  </script>";
            exit();
        } else {
            echo "<script>Swal.fire('Error', 'Terjadi kesalahan: " . addslashes($query->error) . "', 'error');</script>";
        }
    } else {
        echo "<script>Swal.fire('Warning', 'Harap isi semua data wajib', 'warning');</script>";
    }
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Update Data Layanan</h4>
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
                                <label for="title">Nama</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama" value="<?= htmlspecialchars($data['title']); ?>">
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="detail" name="detail"><?= htmlspecialchars($data['detail']); ?></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="icon">icon</label>
                                <input id="icon" name="icon" type="text" class="form-control" placeholder="icon" value="<?= htmlspecialchars($data['icon']); ?>">
                                <p style="color: red;">untuk icon gunakan font awesom atau yang lain</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="update">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>