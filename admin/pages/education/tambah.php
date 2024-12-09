<?php
function handleFormSubmission($koneksi)
{
    if (isset($_POST['save'])) {
        $data = [
            'title' => mysqli_real_escape_string($koneksi, $_POST['title']),
            'posisi' => mysqli_real_escape_string($koneksi, $_POST['posisi']),
            'detail' => mysqli_real_escape_string($koneksi, $_POST['detail']),
            'tanggal_mulai' => mysqli_real_escape_string($koneksi, $_POST['tanggal_mulai']),
            'tanggal_selesai' => mysqli_real_escape_string($koneksi, $_POST['tanggal_selesai']),
        ];

        // Validate that the end date is after the start date, if provided
        if (!empty($data['tanggal_selesai']) && $data['tanggal_selesai'] < $data['tanggal_mulai']) {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Tanggal selesai harus setelah tanggal mulai.',
                        icon: 'error'
                    });
                  </script>";
            return;
        }

        $query = "INSERT INTO tb_education (title, posisi, detail, tanggal_mulai, tanggal_selesai) 
                  VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $koneksi->prepare($query)) {
            $stmt->bind_param(
                "sssss",
                $data['title'],
                $data['posisi'],
                $data['detail'],
                $data['tanggal_mulai'],
                $data['tanggal_selesai']
            );

            if ($stmt->execute()) {
                echo "<script>
                        Swal.fire({
                            title: 'Success',
                            text: 'Data Tersimpan',
                            icon: 'success'
                        }).then(() => {
                            location.href='admin/admin.php?halaman=education';
                        });
                      </script>";
            } else {
                echo "<script>
                        Swal.fire({
                            title: 'Error',
                            text: 'Terjadi kesalahan: " . htmlspecialchars($stmt->error) . "',
                            icon: 'error'
                        });
                      </script>";
            }
            $stmt->close();
        } else {
            echo "<script>
                    Swal.fire({
                        title: 'Error',
                        text: 'Terjadi kesalahan dalam mempersiapkan query: " . htmlspecialchars($koneksi->error) . "',
                        icon: 'error'
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
            <h4 class="mb-sm-0 font-size-18">Tambah Data Pendidikan</h4>
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
                                <label for="title">Nama Universitas</label>
                                <input id="title" name="title" type="text" class="form-control" placeholder="Nama Universitas"  required>
                            </div>
                            <div class="mb-3">
                                <label for="posisi">Posisi</label>
                                <input id="posisi" name="posisi" type="text" class="form-control" placeholder="Program Studi/Jurusan"  required>
                            </div>
                            <div class="mb-3">
                                <label for="detail">Keterangan</label>
                                <textarea class="form-control" id="detail" rows="5" placeholder="detail" name="detail" required></textarea>
                                <p style="color: red;">untuk membuat new line gunakan enter</p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="mb-3">
                                <label for="tanggal_mulai">Tanggal Mulai</label>
                                <input type="date" id="tanggal_mulai" class="form-control" placeholder="Tanggal Mulai" name="tanggal_mulai"  required />
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