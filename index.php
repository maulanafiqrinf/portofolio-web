<?php
include 'koneksi/koneksi.php';
?>
<!Doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Portfolio | Maulana Fiqri Nurul Fawaid</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/frontend/img/favicon.png">
    <link rel="stylesheet" href="assets/frontend/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/frontend/css/animate.min.css">
    <link rel="stylesheet" href="assets/frontend/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/frontend/css/all.min.css">
    <link rel="stylesheet" href="assets/frontend/css/odometer.min.css">
    <!-- <link rel="stylesheet" href="assets/frontend/css/jquery.modal.min.css"> -->
    <link rel="stylesheet" href="assets/frontend/css/meanmenu.css">
    <link rel="stylesheet" href="assets/frontend/css/swipper.css">
    <link rel="stylesheet" href="assets/frontend/css/main.css">
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body class="dark-theme">

    <div class="page-wrapper home-1">
        <!-- <div id="preloader">
            <div class="loader_line"></div>
        </div> -->
        <div class="bostami-header-area mb-30 z-index-5">
            <div class="container">
                <div class="bostami-header-wrap">
                    <div class="row align-items-center">
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <div class="bostami-header-menu-btn text-right">
                                <!-- <div class="dark-btn dark-btn-stored dark-btn-icon">
                                    <i class="fa-light fa-moon"></i>
                                    <i class="fa-light fa-sun"></i>
                                </div> -->
                                <div class="menu-btn toggle_menu">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="mobile-menu-wrap">
                    <div class="mobile-menu mobile_menu">
                    </div>
                </div>
            </div>
        </div>

        <div class="container z-index-3">
            <div class="row">
                <?php include 'user/pages/landing/personal.php' ?>

                <?php
                $page = $_GET['halaman'] ?? 'about'; // Default to 'about' if not set
                switch ($page) {
                    case 'about':
                        include 'user/pages/landing/about.php';
                        break;
                    case 'resume':
                        include 'user/pages/resume/resume.php';
                        break;
                    case 'portfolio':
                        include 'user/pages/portfolio/index.php';
                        break;
                    case 'sertifikat':
                        include 'user/pages/sertifikat/index.php';
                        break;
                    case 'contact':
                        include 'user/pages/contact/contact.php';
                        break;
                    default:
                        include 'user/pages/landing/about.php';
                }
                ?>

                <?php include 'user/components/sidebar.php' ?>
            </div>
        </div>
    </div>

    <script src="assets/frontend/js/jquery.min.js"></script>
    <script src="assets/frontend/js/bootstrap.bundle.min.js"></script>
    <script src="assets/frontend/js/swipper-bundle.min.js"></script>
    <script src="assets/frontend/js/jquery.meanmenu.min.js"></script>
    <script src="assets/frontend/js/wow.min.js"></script>
    <script src="assets/frontend/js/isotope.pkgd.min.js"></script>
    <script src="assets/frontend/js/odometer.min.js"></script>
    <script src="assets/frontend/js/jquery.modal.min.js"></script>
    <script src="assets/frontend/js/appear.min.js"></script>
    <script src="assets/frontend/js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper('.swiper-container', {
            slidesPerView: 1,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev',
            },
        });
    </script>

</body>

</html>