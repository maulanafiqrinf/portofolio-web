<?php
if (isset($_POST['save'])) {
    include '../koneksi/koneksi.php'; // Ensure correct path

    // Prepare the SQL statement
    $stmt = $koneksi->prepare("INSERT INTO tb_services (title, detail, icon) VALUES (?, ?, ?)");

    if ($stmt) {
        // Fetch and escape data from the form using htmlspecialchars to prevent XSS
        $title = htmlspecialchars(trim($_POST['title']));
        $detail = htmlspecialchars(trim($_POST['detail']));
        $icon = htmlspecialchars(trim($_POST['icon']));
        $stmt->bind_param("sss", $title, $detail, $icon);
        if ($stmt->execute()) {
            echo "<script>
                Swal.fire({
                    title: 'Success',
                    text: 'Data Tersimpan',
                    icon: 'success'
                }).then(() => {
                    location.href='admin/admin.php?halaman=service';
                });
            </script>";
            exit();
        } else {
            echo "<script>
                Swal.fire('Error', 'Terjadi kesalahan: " . addslashes($stmt->error) . "', 'error');
            </script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<script>
            Swal.fire('Error', 'Terjadi kesalahan: " . addslashes($koneksi->error) . "', 'error');
        </script>";
    }

    // Close the connection
    $koneksi->close();
}
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Data Layanan</h4>
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
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama" required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="detail" name="detail" required></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="icon">icon</label>
                                <input id="icon" name="icon" type="text" class="form-control" placeholder="icon" required>
                                <p style="color: red;">untuk icon gunakan font awesom atau yang lain</p>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap gap-2">
                        <button type="submit" class="btn btn-primary waves-effect waves-light" name="save">Simpan</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>