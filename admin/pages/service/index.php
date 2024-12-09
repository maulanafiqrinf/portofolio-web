<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Layanan</h4>
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
                            <a href="admin/admin.php?halaman=tambah-service" class="btn btn-success btn-rounded" id="addProject-btn">
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
                                <th>Icon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi/koneksi.php';

                            // Fetch data securely using prepared statements
                            $stmt = $koneksi->prepare("SELECT * FROM tb_services");
                            $stmt->execute();
                            $result = $stmt->get_result();

                            $no = 1;
                            while ($row = $result->fetch_assoc()) {
                                $id_services = htmlspecialchars($row['id_services']);
                                $title = htmlspecialchars($row['title']);
                                $icon = htmlspecialchars($row['icon']);
                            ?>
                                <tr align="center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $icon; ?></td>
                                    <td>
                                        <a href="admin/admin.php?halaman=update-service&id=<?php echo $id_services; ?>" class="btn btn-warning">
                                            <i class="mdi mdi-pencil me-1"></i>
                                        </a>
                                        <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete('<?php echo $id_services; ?>');">
                                            <i class="mdi mdi-delete me-1"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            // Close the statement
                            $stmt->close();
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
                // Redirect to delete page
                window.location.href = 'admin/admin.php?halaman=hapus-service&id=' + id;
            }
        });
    }
</script>