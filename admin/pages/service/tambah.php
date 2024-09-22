<?php
if (isset($_POST['save'])) {
    include '../koneksi/koneksi.php'; // Ensure correct path

    // Prepare the SQL statement
    $stmt = $koneksi->prepare("INSERT INTO tb_services (title, detail, icon, class) VALUES (?, ?, ?, ?)");
    if ($stmt) {
        // Fetch and escape data from the form
        $title = mysqli_real_escape_string($koneksi, $_POST['title']);
        $detail = mysqli_real_escape_string($koneksi, $_POST['detail']);
        $icon = mysqli_real_escape_string($koneksi, $_POST['icon']);
        $class = mysqli_real_escape_string($koneksi, $_POST['class']);

        // Bind parameters
        $stmt->bind_param("ssss", $title, $detail, $icon, $class);

        // Execute the statement
        if ($stmt->execute()) {
            // Use JavaScript for alert and redirect
            echo "<script>alert('Data Tersimpan'); location.href='index.php?halaman=service';</script>";
            exit();
        } else {
            echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $stmt->error . "</div>";
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "<div class='alert alert-danger'>Terjadi kesalahan: " . $koneksi->error . "</div>";
    }

    // Close the connection
    $koneksi->close();
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
        <form method="post">
            <!-- Title -->
            <?php
            $fields = [
                'title' => 'Title',
                'detail' => 'Detail',
                'icon' => 'Icon',
                'jobdesk' => 'Jobdesk',
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
            <!-- Class -->
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label" for="class">Class</label>
                <div class="col-sm-10">
                    <select class="form-control" id="class" name="class" required>
                        <option value="">-- Pilih Class --</option>
                        <option value="bg-prink">Pink</option>
                        <option value="bg-catkrill">Grey</option>
                    </select>
                </div>
            </div>
            <!-- Save Button -->
            <div class="row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="save">Simpan</button>
                </div>
            </div>
        </form>
    </div>
</div>