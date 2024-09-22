<?php
include 'koneksi/koneksi.php';

?>


<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">

        <?php $data = mysqli_query($koneksi, "SELECT * FROM tb_about");

        // Memeriksa apakah ada data yang ditemukan
        if ($row = mysqli_fetch_assoc($data)) {
        ?>
            <!-- page title -->
            <div class="section-wrapper pl-60 pr-60 pt-60">
                <div class="bostami-page-title-wrap mb-35">
                    <h2 class="page-title">Tentang Saya</h2>
                    <p><?php echo $row['about'] ?></p>
                </div>
            </div>
        <?php
        } else {
            echo "Data tidak ditemukan.";
        }
        ?>

        <!-- what-do -->
        <div class="section-wrapper pl-60 pr-60">

            <div class="bostami-section-title-wrap mb-30">
                <h3 class="section-title">What I do!</h3>
            </div>

            <div class="bostami-what-do-wrap mb-30">
                <div class="row">
                    <?php
                    $services = mysqli_query($koneksi, "SELECT * FROM tb_services");

                    // Mengambil semua data sekaligus dan mengubahnya menjadi array asosiatif
                    $service_list = mysqli_fetch_all($services, MYSQLI_ASSOC);

                    // Memeriksa apakah ada data yang ditemukan
                    if (!empty($service_list)) {
                        foreach ($service_list as $service) {
                    ?>
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="bostami-what-do-item <?php echo $service['class']; ?>">
                                    <div class="icon">
                                        <i class="<?php echo $service['icon']; ?>"></i>
                                    </div>
                                    <div class="text">
                                        <h4 class="title"><?php echo $service['title']; ?></h4>
                                        <p><?php echo $service['detail']; ?>.</p>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Data tidak ditemukan.";
                    }
                    ?>
                </div>

            </div>

        </div>

        <!-- footer copyright -->
        <div class="footer-copyright text-center pt-25 pb-25">
            <span>© 2024 All Rights Reserved by <a href="https://themeforest.net/user/elite-themes24"
                    target="_blank" rel="noopener noreferrer">elite-themes24</a>.</span>
        </div>

    </div>
</div>