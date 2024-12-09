<?php
function handleFormSubmission($koneksi)
{
    if (isset($_POST['save'])) {
        // Allow null values for all fields
        $data = [
            'title' => !empty($_POST['title']) ? $_POST['title'] : null,
            'posisi' => !empty($_POST['posisi']) ? $_POST['posisi'] : null,
            'jobdesk' => !empty($_POST['jobdesk']) ? $_POST['jobdesk'] : null,
            'tanggal_mulai' => !empty($_POST['tanggal_mulai']) ? $_POST['tanggal_mulai'] : null,
            'tanggal_selesai' => !empty($_POST['tanggal_selesai']) ? $_POST['tanggal_selesai'] : null,
        ];

        // Prepared statement for inserting data
        $query = "INSERT INTO tb_experience (title, posisi, jobdesk, tanggal_mulai, tanggal_selesai) 
                  VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param(
                "sssss",
                $data['title'],
                $data['posisi'],
                $data['jobdesk'],
                $data['tanggal_mulai'],
                $data['tanggal_selesai']
            );

            if ($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Data Tersimpan',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        setTimeout(function() {
                            window.location.href = 'admin/admin.php?halaman=experience';
                        }, 1500);
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Terjadi kesalahan',
                            text: '" . $stmt->error . "'
                        });
                      </script>";
            }
            $stmt->close();
        } else {
            echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Terjadi kesalahan',
                        text: '" . $koneksi->error . "'
                    });
                  </script>";
        }
    }
}

// Include your database connection
include '../koneksi/koneksi.php';
handleFormSubmission($koneksi);
?>

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Tambah Data Pengalaman</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="title">Nama</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Sertifikat" required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <input id="posisi" name="posisi" type="text" class="form-control" placeholder="Posisi" required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="jobdesk">Keterangan</label>
                                <textarea class="form-control" id="jobdesk" rows="5" placeholder="Pekerjaan" name="jobdesk" required></textarea>
                                <p style="color: red;">Gunakan Enter untuk membuat baris baru</p>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai" required />
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_selesai">Tanggal Selesai</label>
                                <input type="date" id="tanggal_selesai" class="form-control" placeholder="Tanggal Selesai" name="tanggal_selesai" required />
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
