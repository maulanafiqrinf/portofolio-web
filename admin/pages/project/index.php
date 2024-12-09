<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Proyek</h4>
        </div>
    </div>
</div>
<!-- end page title -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <div class="text-sm-end">
                            <a href="admin/admin.php?halaman=tambah-project" class="btn btn-success btn-rounded" id="addProject-btn">
                                <i class="mdi mdi-plus me-1"></i> Tambah
                            </a>
                        </div>
                    </div><!-- end col-->
                </div>

                <div class="table-responsive">
                    <table class="table align-middle table-nowrap dt-responsive nowrap w-100" id="datatable-buttons">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Posisi</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                    <?php
                    include '../koneksi/koneksi.php';

                    $no = 1;
                    $query = "SELECT * FROM tb_project";
                    if ($result = $koneksi->query($query)) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id_project = htmlspecialchars($row['id_project']);
                                $title = htmlspecialchars($row['title']);
                                $posisi = htmlspecialchars($row['posisi']);
                    ?>
                                <tr class="text-center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $posisi; ?></td>
                                    <td>
                                        <a href="admin/admin.php?halaman=update-project&id=<?php echo $id_project; ?>" class="btn btn-warning" title="Edit">
                                            <i class="mdi mdi-pencil me-1"></i>
                                        </a>
                                        <button class="btn btn-danger" title="Delete" onclick="confirmDelete(<?php echo $id_project; ?>)">
                                            <i class="mdi mdi-delete me-1"></i>
                                        </button>
                                    </td>
                                </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4' class='text-center'>Error fetching data: " . htmlspecialchars($koneksi->error) . "</td></tr>";
                    }
                    ?>
                </tbody>
                    </table>
                    <!-- end table -->
                </div>
                <!-- end table responsive -->
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->
    </div>
    <!-- end col -->
</div>

<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You won\'t be able to revert this!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'admin/admin.php?halaman=hapus-project&id=' + id;
            }
        });
    }
</script>