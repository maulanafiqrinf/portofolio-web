<?php
session_start();
include '../koneksi/koneksi.php';

// Redirect to login if not logged in
if (empty($_SESSION['id_level'])) {
    echo "<script>alert('Silahkan login terlebih dahulu!'); location='../login.php';</script>";
    exit();
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
    <link rel="shortcut icon" href="../assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/icons.min.css" rel="stylesheet" />
    <link href="../assets/css/app.min.css" rel="stylesheet" />
    <link href="../assets/css/custom.min.css" rel="stylesheet" />

    <!-- DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" />
</head>

<body>
    <div id="layout-wrapper">
        <?php include 'pages/components/topbar.php'; ?>
        <?php include 'pages/components/sidebar.php'; ?>
        <div class="vertical-overlay"></div>

        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <?php
                            $halaman = $_GET['halaman'] ?? 'dashboard';
                            $pages = [
                                "dashboard" => 'pages/landing/index.php',
                                "about" => 'pages/about/index.php',
                                "tambah-about" => 'pages/about/tambah.php',
                                "update-about" => 'pages/about/update.php',
                                "service" => 'pages/service/index.php',
                                "tambah-service" => 'pages/service/tambah.php',
                                "update-service" => 'pages/service/update.php',
                                "hapus-service" => 'pages/service/hapus.php',
                                "education" => 'pages/education/index.php',
                                "tambah-education" => 'pages/education/tambah.php',
                                "update-education" => 'pages/education/update.php',
                                "hapus-education" => 'pages/education/hapus.php',
                                "project" => 'pages/project/index.php',
                                "tambah-project" => 'pages/project/tambah.php',
                                "update-project" => 'pages/project/update.php',
                                "hapus-project" => 'pages/project/hapus.php',
                                "experience" => 'pages/experience/index.php',
                                "tambah-experience" => 'pages/experience/tambah.php',
                                "update-experience" => 'pages/experience/update.php',
                                "hapus-experience" => 'pages/experience/hapus.php',
                                "certificate" => 'pages/certificate/index.php',
                                "tambah-certificate" => 'pages/certificate/tambah.php',
                                "update-certificate" => 'pages/certificate/update.php',
                                "hapus-certificate" => 'pages/certificate/hapus.php',
                                "skills" => 'pages/skills/index.php',
                                "hapus-skills" => 'pages/skills/hapus.php',
                                "update-profil" => 'pages/landing/updatedata.php',
                            ];
                            
                            include $pages[$halaman] ?? 'pages/landing/index.php';
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
        <i class="ri-arrow-up-line"></i>
    </button>

    <div id="preloader">
        <div id="status">
            <div class="spinner-border text-primary avatar-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="../assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/libs/simplebar/simplebar.min.js"></script>
    <script src="../assets/libs/node-waves/waves.min.js"></script>
    <script src="../assets/libs/feather-icons/feather.min.js"></script>
    <script src="../assets/js/pages/plugins/lord-icon-2.1.0.js"></script>
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
