<?php
include 'koneksi/koneksi.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id_project = intval($_GET['id']);

    $stmt = $koneksi->prepare("SELECT * FROM tb_project WHERE id_project = ?");
    $stmt->bind_param("i", $id_project);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $project = $result->fetch_assoc();
    } else {
        echo "<p>Project not found.</p>";
        exit;
    }

    $stmt->close();
    $koneksi->close();
} else {
    echo "<p>Invalid project ID.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">


<head>
    <!-- META -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Dorbesh - Creative Portfolio Showcase Template">
    <meta name="keywords" content="personal, portfolio new, html, one page, bootstrap, new html template, design, creative, onepage, clean, modern">
    <meta name="author" content="themesvila">
    <!-- PAGE TITLE -->
    <title>Dorbesh - Personal Portfolio HTML Template</title>
    <!-- FAV ICON -->
    <link rel="apple-touch-icon" href="assets/frontend/images/favicon.png">
    <link rel="shortcut icon" type="image/png" href="assets/frontend/images/favicon.png">
    <!-- ALL GOOGLE FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&amp;display=swap" rel="stylesheet">
    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="assets/frontend/css/bootstrap.min.css" />
    <!-- FONT AWESOME CSS -->
    <link rel="stylesheet" href="assets/frontend/fonts/remixicon.css" />
    <!-- MAGNIFIC CSS -->
    <link rel="stylesheet" href="assets/frontend/css/magnific-popup.css">
    <!-- NICE SELECT CSS -->
    <link rel="stylesheet" href="assets/frontend/css/nice-select.min.css" />
    <!-- ANIMATE CSS -->
    <link rel="stylesheet" href="assets/frontend/css/animate.min.css" />
    <!-- SLICK CSS -->
    <link rel="stylesheet" href="assets/frontend/css/slick.min.css" />
    <!-- SPACING CSS -->
    <link rel="stylesheet" href="assets/frontend/css/spacing.css" />
    <!-- MAIN STYLE CSS -->
    <link rel="stylesheet" href="assets/frontend/css/style.css" />
    <!-- RESPONSIVE CSS -->
    <link rel="stylesheet" href="assets/frontend/css/responsive.css">
</head>

<body>
    <header class="main-header">
        <div class="header-upper">
            <div class="container">
                <div class="header-inner d-flex align-items-center">
                    <!-- START LOGO DESIGN AREA -->
                    <div class="logo-outer">
                        <div class="logo">
                            <a href="index.html"><img src="assets/frontend/images/logo.png" alt="Logo" title="Logo" /></a>
                        </div>
                    </div>
                    <!-- / END LOGO DESIGN AREA -->
                    <!-- START NAV DESIGN AREA -->
                    <div class="nav-outer clearfix mx-auto">
                        <!-- Main Menu -->
                        <nav class="main-menu navbar-expand-lg">
                            <div class="navbar-header">
                                <div class="mobile-logo">
                                    <a href="index.html">
                                        <img src="assets/frontend/images/logo.png" alt="Logo" title="Logo" />
                                    </a>
                                </div>
                                <!-- Toggle Button -->
                                <button type="button" class="navbar-toggle" data-bs-toggle="collapse" data-bs-target=".navbar-collapse">
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="navbar-collapse collapse">
                                <ul class="navigation onepage clearfix">
                                    <li><a class="nav-link-click" href="index.html#about">about</a></li>
                                    <li><a class="nav-link-click" href="index.html#service">services</a></li>
                                    <li><a class="nav-link-click" href="index.html#works">works</a></li>
                                    <li><a class="nav-link-click" href="index.html#pricing">Pricing</a></li>
                                    <li><a class="nav-link-click" href="index.html#blog">Blog</a></li>
                                    <li><a class="nav-link-click" href="index.html#contact">Contact</a></li>
                                </ul>
                            </div>
                        </nav>
                        <!-- / END NAV DESIGN AREA -->
                    </div>
                    <div class="menu-btns">
                        <a href="index.html#contact" class="theme-btn">Hire Me<i class="ri-shake-hands-line"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- / END MENU DESIGN AREA -->
    <!-- START SINGLE PAGE DETAILS DESIGN AREA -->
    <div class="single-project-page-design">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center pb-30">
                    <p><?= date("d F Y", strtotime($project['tanggal_mulai'])); ?> - <?= empty($project['tanggal_selesai']) ? "Sampai Sekarang" : date("d F Y", strtotime($project['tanggal_selesai'])); ?></p>
                    <h1><?= htmlspecialchars($project['title']); ?></h1>
                </div>
            </div>
        </div>
        <!-- <div class="single-project-image">
            <img src="assets/frontend/images/projects/single-project.jpg" alt="image">
        </div> -->
        <div class="container pt-30">
            <div class="row">
                <div class="col-lg-4">
                    <!-- START SINGLE LEFT DESIGN AREA -->
                    <div class="single-project-page-left wow fadeInUp delay-0-2s">
                        <div class="single-info">
                            <p>Posisi</p>
                            <h3><?= htmlspecialchars($project['posisi']); ?></h3>
                        </div>
                        <div class="single-info">
                            <p>Teknologi</p>
                            <h3><?= htmlspecialchars($project['technology']); ?></h3>
                        </div>
                        <!-- <div class="single-info">
                            <p>Project</p>
                            <h3>Creative</h3>
                        </div> -->
                    </div>
                    <!-- / END SINGLE LEFT DESIGN AREA -->
                </div>
                <!-- START SINGLE RIGHT DESIGN AREA -->
                <div class="col-lg-8">
                    <div class="single-project-page-right wow fadeInUp delay-0-4s">
                        <h2>
                            Deskripsi
                        </h2>
                        <p><?= nl2br(htmlspecialchars($project['detail'])); ?></p>
                        <p><?= nl2br(htmlspecialchars($project['jobdesk'])); ?></p>
                    </div>
                </div>
                <!-- / END SINGLE RIGHT DESIGN AREA -->
            </div>
            <!-- START SINGLE PAGE GALLERY DESIGN AREA -->
            <?php if (!empty($project['Gambar_hasilproject'])): ?>
                <div class="row pt-30">
                    <?php foreach (explode(',', $project['Gambar_hasilproject']) as $image): ?>
                        <div class="col-lg-6">
                            <div class="single-image wow fadeInUp delay-0-2s">
                                <img src="admin/storage/Gambar_hasilproject/<?= htmlspecialchars($image); ?>" alt="gallery">
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            <!--  / END SINGLE PAGE GALLERY DESIGN AREA -->
        </div>
    </div>
    <!-- / END SINGLE PAGE DETAILS DESIGN AREA -->
    <!-- START CALL TO ACTION DESIGN AREA -->
    <section class="call-to-action-area">
        <div class="container">
            <div class="row">
                <!-- START ABOUT TEXT DESIGN AREA -->
                <div class="col-lg-12">
                    <div class="about-content-part call-to-action-part wow fadeInUp delay-0-2s text-center">
                        <h2>Apakah Anda siap untuk memulai proyek Anda dengan sentuhan keajaiban?</h2>
                        <p>Menjangkau dan mari kita mewujudkannya ✨. Saya juga tersedia untuk penuh-waktu atau paruh-waktu kesempatan untuk mendorong batas-batas desain dan memberikan pekerjaan yang luar biasa.</p>
                        <div class="hero-btns">
                            <a href="index.php#contact" class="theme-btn">Mari Bicara <i class="ri-download-line"></i></a>
                        </div>
                    </div>
                </div>
                <!-- / END ABOUT TEXT DESIGN AREA -->
            </div>
        </div>
    </section>
    <!--  // END CALL TO ACTION DESIGN AREA -->
    <!-- START FOOTER DESIGN AREA -->
    <footer class="main-footer">
        <div class="footer-bottom pt-50 pb-40">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="copyright-text">
                            <p>
                                Copyright @2024, <a href="index.html">Dorbesh</a> All
                                Rights Reserved.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="copyright-text extra-copyright">
                            <p>
                                Crafted with ❤️ Themesvila
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- / END FOOTER DESIGN AREA -->
    <!-- START SCROOL UP DESIGN AREA -->
    <div class="progress-wrap cursor-pointer">
        <i class="ri-arrow-up-double-line"></i>
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- / END SCROOL UP DESIGN AREA -->
    <!-- JQUERY JS -->
    <script src="assets/frontend/js/jquery-3.7.1.min.js"></script>
    <!-- BOOTSTRAP JS-->
    <script src="assets/frontend/js/bootstrap.min.js"></script>
    <!-- APPEAR JS -->
    <script src="assets/frontend/js/appear.min.js"></script>
    <!-- GSAP JS -->
    <script src="assets/frontend/js/gsap.min.js"></script>
    <!-- MAGNIFICANT JS -->
    <script src="assets/frontend/js/jquery.magnific-popup.min.js"></script>
    <!-- SLICK JS-->
    <script src="assets/frontend/js/slick.min.js"></script>
    <!-- NICE SELECT JS-->
    <script src="assets/frontend/js/jquery.nice-select.min.js"></script>
    <!-- IMAGE LOADER JS-->
    <script src="assets/frontend/js/imagesloaded.pkgd.min.js"></script>
    <!-- ISOTOPE JS-->
    <script src="assets/frontend/js/isotope.pkgd.min.js"></script>
    <!--  WOW ANIMATION JS-->
    <script src="assets/frontend/js/wow.min.js"></script>
    <!-- SCRIPT JS-->
    <script src="assets/frontend/js/script.js"></script>
</body>


<!-- Mirrored from wphtml.com/html/tf/dorbesh/single-project.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Nov 2024 01:26:37 GMT -->

</html>