<?php
session_start();
include '../koneksi/koneksi.php';
if (empty($_SESSION['id_level'])) {
    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Akses Ditolak</title>
        <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
    </head>
    <body>
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Akses Ditolak',
                text: 'Silahkan login terlebih dahulu!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../index.php';
                }
            });
        </script>
    </body>
    </html>";
    exit();
}
?>
<!doctype html>
<html lang="en">

<head>
    <base href="../">
    <meta charset="utf-8" />
    <title>P</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <!-- App js -->
    <script src="assets/js/plugin.js"></script>

    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="assets/libs/dropzone/dropzone.css" rel="stylesheet" type="text/css" />



</head>

<body data-sidebar="dark">
    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include 'components/navbar.php' ?>
        <!-- Left Sidebar End -->
        <?php include 'components/sidebar.php' ?>
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <?php
                    $pages = [
                        "dashboard" => 'pages/dashboard/index.php',

                        "about" => 'pages/about/index.php',
                        "skills" => 'pages/skills/index.php',
                        "hapus-skills" => 'pages/skills/hapus.php',

                        "service" => 'pages/service/index.php',
                        "tambah-service" => 'pages/service/tambah.php',
                        "update-service" => 'pages/service/update.php',
                        "hapus-service" => 'pages/service/hapus.php',
                        //pendiidkan
                        "education" => 'pages/education/index.php',
                        "tambah-education" => 'pages/education/tambah.php',
                        "update-education" => 'pages/education/update.php',
                        "hapus-education" => 'pages/education/hapus.php',
                        //project
                        "project" => 'pages/project/index.php',
                        "tambah-project" => 'pages/project/tambah.php',
                        "update-project" => 'pages/project/update.php',
                        "hapus-project" => 'pages/project/hapus.php',
                        "experience" => 'pages/experience/index.php',
                        "tambah-experience" => 'pages/experience/tambah.php',
                        "update-experience" => 'pages/experience/update.php',
                        "hapus-experience" => 'pages/experience/hapus.php',
                        //sertifikat
                        "certificate" => 'pages/certificate/index.php',
                        "tambah-certificate" => 'pages/certificate/tambah.php',
                        "update-certificate" => 'pages/certificate/update.php',
                        "hapus-certificate" => 'pages/certificate/hapus.php',
                        
                        "update-profil" => 'pages/profil/update.php',
                    ];

                    // Menentukan halaman yang akan dimuat dengan FILTER_SANITIZE_FULL_SPECIAL_CHARS
                    $halaman = filter_input(INPUT_GET, 'halaman', FILTER_SANITIZE_FULL_SPECIAL_CHARS) ?? 'dashboard';
                    $file_to_include = $pages[$halaman] ?? 'pages/dashboard/index.php';

                    // Sertakan file yang telah ditentukan
                    include $file_to_include;
                    ?>
                </div>
            </div>
            <!-- End Page-content -->


            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Skote.
                        </div>
                        <div class="col-sm-6">
                            <div class="text-sm-end d-none d-sm-block">
                                Design & Develop by Themesbrand
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <!-- end main content-->

    </div>

    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <!-- apexcharts -->
    <script src="assets/libs/apexcharts/apexcharts.min.js"></script>

    <!-- dashboard blog init -->
    <script src="assets/js/pages/dashboard-blog.init.js"></script>

    <script src="assets/js/app.js"></script>


    <!-- bootstrap-datepicker js -->
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <!-- Required datatable js -->
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <!-- Responsive examples -->
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
    <!-- Buttons examples -->
    <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
    <script src="assets/libs/jszip/jszip.min.js"></script>
    <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
    <!-- Datatable init js -->
    <script src="assets/js/pages/datatables.init.js"></script>
    <script src="assets/libs/dropzone/dropzone-min.js"></script>
    <script src="assets/js/pages/project-create.init.js"></script>

    <script>
        function showAlert(type, message) {
            Swal.fire({
                icon: type,
                title: type === 'info' ? 'Success' : 'Error',
                text: message,
                showConfirmButton: true,
                timer: type === 'info' ? 2000 : undefined // Auto close for success
            });
        }
    </script>
</body>


</html>