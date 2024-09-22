<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data About</h5>
        <a href="index.php?halaman=tambah-service" class="btn btn-primary">
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
                        <th>Detail</th>
                        <th>Icon</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi/koneksi.php';

                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM tb_services");

                    while ($row = mysqli_fetch_assoc($data)) {
                        $id_services = htmlspecialchars($row['id_services']);
                        $title = htmlspecialchars($row['title']);
                        $detail = htmlspecialchars($row['detail']);
                        $icon = htmlspecialchars($row['icon']);
                    ?>
                        <tr align="center">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td><?php echo $detail; ?></td>
                            <td><?php echo $icon; ?></td>
                            <td>
                                <a href="index.php?halaman=update-service&id=<?php echo $id_services; ?>" class="btn btn-warning">
                                    <i class="bx bx-edit-alt me-1"></i>
                                </a>
                                <a href="index.php?halaman=hapus-service&id=<?php echo $id_services; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">
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