<?php
session_start();
include '../koneksi/koneksi.php';
if ($_SESSION['id_level'] == "") {
    echo "<script>alert('Silahkan login terlebih dahulu!'); location='../login.php';</script>";
}
?>
<!doctype html>
<html lang="en" data-layout="vertical" data-layout-style="detached" data-sidebar="light" data-topbar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>

    <meta charset="utf-8" />
    <title>Dashboard | Portofolio - Maulana Fiqri</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Layout config Js -->
    <script src="../assets/js/layout.js"></script>
    <!-- Bootstrap Css -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="../assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="../assets/css/app.min.css" rel="stylesheet" type="text/css" />
    <!-- custom Css-->
    <link href="../assets/css/custom.min.css" rel="stylesheet" type="text/css" />

    <!--datatable css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <!--datatable responsive css-->
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">


</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">
        <?php include 'pages/components/topbar.php'; ?>
        <!-- ========== App Menu ========== -->
        <?php include 'pages/components/sidebar.php'; ?>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <?php
                            if (isset($_GET['halaman'])) {
                                if ($_GET['halaman'] == "dashboard") {
                                    include 'pages/landing/index.php';
                                } elseif ($_GET['halaman'] == "about") {
                                    include 'pages/about/index.php';
                                } elseif ($_GET['halaman'] == "tambah-about") {
                                    include 'pages/about/tambah.php';
                                } elseif ($_GET['halaman'] == "update-about") {
                                    include 'pages/about/update.php';
                                } elseif ($_GET['halaman'] == "service") {
                                    include 'pages/service/index.php';
                                } elseif ($_GET['halaman'] == "tambah-service") {
                                    include 'pages/service/tambah.php';
                                } elseif ($_GET['halaman'] == "update-service") {
                                    include 'pages/service/update.php';
                                } elseif ($_GET['halaman'] == "hapus-service") {
                                    include 'pages/service/hapus.php';
                                } elseif ($_GET['halaman'] == "education") {
                                    include 'pages/education/index.php';
                                } elseif ($_GET['halaman'] == "tambah-education") {
                                    include 'pages/education/tambah.php';
                                } elseif ($_GET['halaman'] == "update-education") {
                                    include 'pages/education/update.php';
                                } elseif ($_GET['halaman'] == "hapus-education") {
                                    include 'pages/education/hapus.php';
                                } elseif ($_GET['halaman'] == "project") {
                                    include 'pages/project/index.php';
                                } elseif ($_GET['halaman'] == "tambah-project") {
                                    include 'pages/project/tambah.php';
                                } elseif ($_GET['halaman'] == "update-project") {
                                    include 'pages/project/update.php';
                                } elseif ($_GET['halaman'] == "hapus-project") {
                                    include 'pages/project/hapus.php';
                                } elseif ($_GET['halaman'] == "experience") {
                                    include 'pages/experience/index.php';
                                } elseif ($_GET['halaman'] == "tambah-experience") {
                                    include 'pages/experience/tambah.php';
                                } elseif ($_GET['halaman'] == "update-experience") {
                                    include 'pages/experience/update.php';
                                } elseif ($_GET['halaman'] == "hapus-experience") {
                                    include 'pages/experience/hapus.php';
                                } elseif ($_GET['halaman'] == "certificate") {
                                    include 'pages/certificate/index.php';
                                } elseif ($_GET['halaman'] == "tambah-certificate") {
                                    include 'pages/certificate/tambah.php';
                                } elseif ($_GET['halaman'] == "update-certificate") {
                                    include 'pages/certificate/update.php';
                                } elseif ($_GET['halaman'] == "hapus-certificate") {
                                    include 'pages/certificate/hapus.php';
                                } elseif ($_GET['halaman'] == "skills") {
                                    include 'pages/skills/index.php';
                                } elseif ($_GET['halaman'] == "hapus-skills") {
                                    include 'pages/skills/hapus.php';
                                } elseif ($_GET['halaman'] == "update-profil") {
                                    include 'pages/landing/updatedata.php';
                                }
                            } else {
                                include 'pages/landing/index.php';
                            }
                            ?>
                        </div>
                    </div>
                    <!-- end page title -->

                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->



    <!--start back-to-top-->
    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>
    <!--end back-to-top-->

    <!--preloader-->
    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../assets/js/plugins.js"></script>

    <!-- App js -->
    <script src="../assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--datatable js-->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script src="../assets/js/pages/datatables.init.js"></script>

</body>

</html>