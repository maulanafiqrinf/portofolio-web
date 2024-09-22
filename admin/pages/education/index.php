<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Education</h5>
        <a href="index.php?halaman=tambah-education" class="btn btn-primary">
            <i class="bx bx-plus-circle"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Title</th>
                        <th>Posisi</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi/koneksi.php';

                    $no = 1;
                    $query = "SELECT * FROM tb_education";
                    if ($result = $koneksi->query($query)) {
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $id_education = htmlspecialchars($row['id_education']);
                                $title = htmlspecialchars($row['title']);
                                $posisi = htmlspecialchars($row['posisi']);
                    ?>
                                <tr class="text-center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $title; ?></td>
                                    <td><?php echo $posisi; ?></td>
                                    <td>
                                        <a href="index.php?halaman=update-education&id=<?php echo $id_education; ?>" class="btn btn-warning">
                                            <i class="bx bx-edit-alt me-1"></i>
                                        </a>
                                        <a href="index.php?halaman=hapus-education&id=<?php echo $id_education; ?>" class="btn btn-danger">
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





<!-- Include jQuery and DataTables -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "paging": true,           // Enable pagination
            "lengthChange": true,      // Allow the user to change the number of rows per page
            "searching": true,         // Enable search functionality
            "ordering": true,          // Enable column ordering
            "info": true,              // Show table information
            "autoWidth": false,        // Disable auto column width calculation
            "responsive": true,        // Make table responsive
            "language": {
                "paginate": {
                    "previous": "Previous",
                    "next": "Next"
                }
            }
        });
    });
</script> -->
