<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Sertifikat</h5>
        <a href="index.php?halaman=tambah-certificate" class="btn btn-primary">
            <i class="bx bx-plus-circle"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th data-ordering="false">No.</th>
                        <th data-ordering="false">Title</th>
                        <th>Pihak</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi/koneksi.php';

                    $no = 1;
                    $query = "SELECT * FROM tb_certificate";
                    if ($result = $koneksi->query($query)) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id_certificate = htmlspecialchars($row['id_certificate']);
                                $title = htmlspecialchars($row['title']);
                                $pihak = htmlspecialchars($row['pihak']);
                    ?>
                                <tr class="text-center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $pihak; ?></td>
                                    <td>
                                        <a href="index.php?halaman=update-certificate&id=<?php echo $id_certificate; ?>" class="btn btn-warning">
                                            <i class="bx bx-edit-alt me-1"></i>
                                        </a>
                                        <a href="index.php?halaman=hapus-certificate&id=<?php echo $id_certificate; ?>" class="btn btn-danger">
                                            <i class="bx bx-trash-alt me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Error fetching data: " . $koneksi->error . "</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>