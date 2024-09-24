<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">
        <!-- Page Title -->
        <div class="section-wrapper pl-60 pr-60 pt-60">
            <div class="bostami-page-title-wrap mb-15">
                <h2 class="page-title">Sertifikat</h2>
            </div>
        </div>

        <div class="section-wrapper pr-60 pl-60 mb-60">
            <div class="row">

                <?php
                include 'koneksi/koneksi.php'; // Ensure the connection path is correct

                // Query to get distinct values from 'pihak' column in 'tb_certificate' table
                $query = "SELECT DISTINCT pihak FROM tb_certificate";
                $result = $koneksi->query($query);

                if ($result->num_rows > 0) {
                    // Output the filter buttons dynamically
                    echo '<div class="col-12">';
                    echo '<ul class="fillter-btn-wrap buttonGroup isotop-menu-wrapper mb-30">';
                    echo '<li class="fillter-btn is-checked" data-filter="*">All</li>'; // 'All' filter button

                    // Loop through each distinct 'pihak' and create a filter button
                    while ($row = $result->fetch_assoc()) {
                        // Clean the pihak value to use it as a CSS class for filtering
                        $pihak = htmlspecialchars($row['pihak']);
                        $class = strtolower(str_replace(' ', '-', $pihak)); // Replace spaces with hyphens and convert to lowercase

                        echo '<li class="fillter-btn" data-filter=".' . $class . '">' . $pihak . '</li>';
                    }

                    echo '</ul>';
                    echo '</div>';
                } else {
                    echo "<div class='alert alert-warning'>No data found in tb_certificate.</div>";
                }
                ?>

                <div class="col-12">
                    <div id="fillter-item-active" class="fillter-item-wrap">
                        <div class="grid-sizer"></div>

                        <?php
                        $certificates = mysqli_query($koneksi, "SELECT * FROM tb_certificate ORDER BY tanggal_selesai DESC");

                        if (mysqli_num_rows($certificates) > 0) {
                            while ($certificate = mysqli_fetch_assoc($certificates)) {
                                $modal_id = 'certificate-' . $certificate['id_certificate'];
                                // Split the image filenames into an array if stored as a comma-separated string
                                $certificate_images = explode(',', $certificate['Gambar_hasilcertificate']);
                                
                                // Generate class for filtering based on 'pihak'
                                $pihak_class = strtolower(str_replace(' ', '-', $certificate['pihak']));
                        ?>
                                <div class="isotop-item <?= $pihak_class; ?>">
                                    <div class="fillter-item">
                                        <a class="img" href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $modal_id; ?>">
                                            <?php if (!empty($certificate_images)) : ?>
                                                <img src="admin/storage/Gambar_hasilcertificate/<?php echo trim($certificate_images[0]); ?>" alt="Certificate Image">
                                            <?php else : ?>
                                                <p>No images found.</p>
                                            <?php endif; ?>
                                        </a>
                                        <span class="item-subtitle"><?php echo $certificate['pihak']; ?></span>
                                        <h6 class="item-title">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $modal_id; ?>"><?php echo $certificate['title']; ?></a>
                                        </h6>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal portfolio-modal-box fade" id="<?php echo $modal_id; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-bs-dismiss="modal">
                                                    <i class="far fa-times"></i>
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                <h6 class="blog-title"><?php echo $certificate['title']; ?></h6>
                                                <div class="portfolio-modal-table">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h3 class="portfolio-modal-table-text">
                                                                <i class="fa-regular fa-file-lines"></i>
                                                                Pihak: <span><?php echo $certificate['pihak']; ?></span>
                                                            </h3>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3 class="portfolio-modal-table-text">
                                                                <i class="fa-regular fa-calendar"></i>
                                                                Tanggal: <span><?php echo date("F Y", strtotime($certificate['tanggal_mulai'])); ?> - <?php
                                                                                                                                                        echo empty($certificate['tanggal_selesai'])
                                                                                                                                                            ? "Sampai Sekarang"
                                                                                                                                                            : date("F Y", strtotime($certificate['tanggal_selesai']));
                                                                                                                                                        ?>
                                                                </span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="h1-modal-img">
                                                    <div class="swiper-container">
                                                        <div class="swiper-wrapper">
                                                            <?php foreach ($certificate_images as $image) : ?>
                                                                <div class="swiper-slide">
                                                                    <img src="admin/storage/Gambar_hasilcertificate/<?php echo trim($image); ?>" alt="Certificate Image">
                                                                </div>
                                                            <?php endforeach; ?>
                                                        </div>
                                                        <!-- Add Pagination -->
                                                        <div class="swiper-pagination"></div>
                                                        <!-- Add Navigation -->
                                                        <div class="swiper-button-next"></div>
                                                        <div class="swiper-button-prev"></div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php
                            }
                        } else {
                            echo "<p>No certificates found.</p>";
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
