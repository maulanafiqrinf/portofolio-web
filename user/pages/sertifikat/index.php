<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">
        <!-- page title -->
        <div class="section-wrapper pl-60 pr-60 pt-60">
            <div class="bostami-page-title-wrap mb-15">
                <h2 class="page-title">Sertifikat</h2>
            </div>
        </div>

        <div class="section-wrapper pr-60 pl-60 mb-60">
            <div class="row">

                <div class="col-12">
                    <ul class="fillter-btn-wrap buttonGroup isotop-menu-wrapper mb-30">
                        <li class="fillter-btn is-checked" data-filter="*">All</li>
                        <li class="fillter-btn" data-filter=".mockup">Mockup</li>
                        <li class="fillter-btn" data-filter=".design">Graphic Design</li>
                        <li class="fillter-btn" data-filter=".logo">Logo</li>
                    </ul>
                </div>

                <div class="col-12">
                    <div id="fillter-item-active" class="fillter-item-wrap">
                        <div class="grid-sizer"></div>

                        <?php
                        include 'koneksi/koneksi.php';
                        $certificates = mysqli_query($koneksi, "SELECT * FROM tb_certificate ORDER BY tanggal_selesai DESC");
                        if (mysqli_num_rows($certificates) > 0) {
                            while ($certificate = mysqli_fetch_assoc($certificates)) {
                                $modal_id = 'portfolio-' . $certificate['id_certificate'];
                        ?>
                                <div class="isotop-item ">
                                    <div class="fillter-item">
                                        <a class="img" href="#" data-bs-toggle="modal" data-bs-target="#<?php echo $modal_id; ?>">
                                            <img src="admin/storage/Gambar_hasilcertificate/<?php echo $certificate['Gambar_hasilcertificate']; ?>" alt="">
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
                                                                Posisi: <span><?php echo $certificate['pihak']; ?></span>
                                                            </h3>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3 class="portfolio-modal-table-text">
                                                                <i class="fa-regular fa-calendar"></i>
                                                                Tanggal: <span><?php echo date("F Y", strtotime($certificate['tanggal_mulai'])); ?> - <?php echo date("F Y", strtotime($certificate['tanggal_selesai'])); ?></span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="h1-modal-paragraph">
                                                    <p><?php echo $certificate['detail']; ?></p>
                                                </div>
                                                <div class="h1-modal-img">
                                                    <img src="admin/storage/Gambar_hasilcertificate/<?php echo $certificate['Gambar_hasilcertificate']; ?>" alt="">
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
