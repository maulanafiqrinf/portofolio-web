<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Data About</h5>
        <a href="index.php?halaman=tambah-about" class="btn btn-primary">
            <i class="bx bx-plus-circle"></i> Tambah Data
        </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table id="example" class="table table-bordered dt-responsive nowrap table-striped align-middle" style="width:100%">
                <thead>
                    <tr>
                        <th data-ordering="false">No.</th>
                        <th data-ordering="false">Nama</th>
                        <th>Phone</th>
                        <th>Location</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include '../koneksi/koneksi.php';

                    $no = 1;
                    $data = mysqli_query($koneksi, "SELECT * FROM tb_about");

                    while ($row = mysqli_fetch_assoc($data)) {
                        $id_about = htmlspecialchars($row['id_about']);
                        $nama = htmlspecialchars($row['nama']);
                        $phone = htmlspecialchars($row['phone']);
                        $location = htmlspecialchars($row['location']);
                    ?>
                        <tr align="center">
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $nama; ?></td>
                            <td><?php echo $phone; ?></td>
                            <td><?php echo $location; ?></td>
                            <td>
                                <a href="index.php?halaman=update-about&id=<?php echo $id_about; ?>" class="btn btn-warning"><i class="bx bx-edit-alt me-1"></i></a>
                                <a href="index.php?halaman=Hapus-about&id=<?php echo $id_about; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?');"><i class="bx bx-trash-alt me-1"></i></a>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>
<link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<script>
    $(document).ready(function() {
        $('#example').DataTable(); // Ganti '#datatables' dengan '#example'
    });
</script>