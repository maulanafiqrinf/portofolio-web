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
                echo "<div class='alert alert-info'>Data Tersimpan</div>";
                echo "<meta http-equiv='refresh' content='1;url=index.php?halaman=education'>";
            } else {
                echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan dalam mempersiapkan query: " . $koneksi->error . "</div>";
        }
    }
}

// Include your database connection
include '../koneksi/koneksi.php';
handleFormSubmission($koneksi);
?>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Tambah education</h5>
    </div>
    <div class="card-body">
        <form method="post" enctype="multipart/form-data">
            <?php
            $fields = [
                'title' => 'Title',
                'posisi' => 'Posisi',
                'detail' => 'Detail',
            ];

            foreach ($fields as $name => $label) {
                if ($name == 'detail' || $name == 'jobdesk') {
                    echo "
                                <div class='row mb-3'>
                                    <label class='col-sm-2 col-form-label' for='$name'>$label</label>
                                    <div class='col-sm-10'>
                                        <textarea id='$name' class='form-control' name='$name' required></textarea>
                                    </div>
                                </div>";
                } else {
                    echo "
                                <div class='row mb-3'>
                                    <label class='col-sm-2 col-form-label' for='$name'>$label</label>
                                    <div class='col-sm-10'>
                                        <input type='text' class='form-control' id='$name' name='$name' required>
                                    </div>
                                </div>";
                }
            }
            ?>

            <?php
            $dateFields = [
                'tanggal_mulai' => 'Tanggal Mulai',
                'tanggal_selesai' => 'Tanggal Selesai',
            ];

            foreach ($dateFields as $name => $label) {
                echo "
                            <div class='row mb-3'>
                                <label class='col-sm-2 col-form-label' for='$name'>$label</label>
                                <div class='col-sm-6'>
                                    <input type='date' class='form-control' id='$name' name='$name' required>
                                </div>
                            </div>";
            }
            ?>

            <!-- <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="class">Class</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="class" required>
                        <option value="">-- Pilih Class --</option>
                        <option value="bg-prink">Pink</option>
                        <option value="bg-catkrill">Grey</option>
                    </select>
                </div>
            </div> -->

            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>