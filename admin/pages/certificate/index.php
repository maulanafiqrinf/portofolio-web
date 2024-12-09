<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">Sertifikat</h4>
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
                            <a href="admin/admin.php?halaman=tambah-certificate" class="btn btn-success btn-rounded" id="addProject-btn">
                                <i class="bx bx-plus"></i> Tambah
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
                                <th>Pihak</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../koneksi/koneksi.php';

                            // Cek apakah ada error koneksi
                            if ($koneksi->connect_error) {
                                echo "<tr><td colspan='4' class='text-center'>Error connecting to database: " . htmlspecialchars($koneksi->connect_error) . "</td></tr>";
                                exit();
                            }

                            $no = 1;
                            // Query untuk mengambil data
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
                                                <a href="admin/admin.php?halaman=update-certificate&id=<?php echo $id_certificate; ?>" class="btn btn-warning">
                                                    <i class="bx bx-edit-alt"></i>
                                                </a>
                                                <a href="javascript:void(0);" class="btn btn-danger" onclick="confirmDelete('<?php echo $id_certificate; ?>');">
                                                    <i class="bx bx-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                            <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='4' class='text-center'>No data available</td></tr>";
                                }
                                $result->free();
                            } else {
                                echo "<tr><td colspan='4' class='text-center'>Error fetching data: " . htmlspecialchars($koneksi->error) . "</td></tr>";
                            }

                            // Tutup koneksi
                            $koneksi->close();
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
                window.location.href = 'admin/admin.php?halaman=hapus-certificate&id=' + id;
            }
        });
    }
</script>