<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">

        <!-- Page Title -->
        <div class="section-wrapper pl-60 pr-60 pt-60">
            <div class="bostami-page-title-wrap mb-15">
                <h2 class="page-title">Portofolio</h2>
            </div>
        </div>

        <!-- Portfolio Section -->
        <div class="section-wrapper pr-60 pl-60 mb-60">
            <div class="row">

                <!-- fillter Buttons -->
                <!-- <div class="col-12">
                    <ul class="fillter-btn-wrap buttonGroup isotop-menu-wrapper mb-30">
                        <li class="fillter-btn is-checked" data-fillter="*">All</li>
                        <li class="fillter-btn" data-fillter=".mockup">Mockup</li>
                        <li class="fillter-btn" data-fillter=".design">Graphic Design</li>
                        <li class="fillter-btn" data-fillter=".logo">Logo</li>
                    </ul>
                </div> -->

                <!-- Portfolio Items -->
                <div class="col-12">
                    <div id="fillter-item-active" class="fillter-item-wrap">
                        <div class="grid-sizer"></div>

                        <?php
                        include 'koneksi/koneksi.php';
                        $query = "SELECT * FROM tb_project ORDER BY tanggal_selesai DESC";
                        $projects = mysqli_query($koneksi, $query);

                        if (mysqli_num_rows($projects) > 0) {
                            while ($project = mysqli_fetch_assoc($projects)) {
                                $modal_id = 'portfolio-' . $project['id_project'];
                                ?>

                                <!-- Portfolio Item -->
                                <div class="isotop-item">
                                    <div class="fillter-item <?= $project['class']; ?>">
                                        <a class="img" href="#" data-bs-toggle="modal" data-bs-target="#<?= $modal_id; ?>">
                                            <img src="admin/storage/Gambar_hasilproject/<?= $project['Gambar_hasilproject']; ?>" alt="">
                                        </a>
                                        <span class="item-subtitle"><?= $project['posisi']; ?></span>
                                        <h6 class="item-title">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#<?= $modal_id; ?>"><?= $project['title']; ?></a>
                                        </h6>
                                    </div>
                                </div>

                                <!-- Modal -->
                                <div class="modal portfolio-modal-box fade" id="<?= $modal_id; ?>" tabindex="-1" role="dialog">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-bs-dismiss="modal">
                                                    <i class="far fa-times"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="blog-title"><?= $project['title']; ?></h6>
                                                <div class="portfolio-modal-table">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h3 class="portfolio-modal-table-text">
                                                                <i class="fa-regular fa-file-lines"></i> Posisi:
                                                                <span><?= $project['posisi']; ?></span>
                                                            </h3>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3 class="portfolio-modal-table-text">
                                                                <i class="fa-solid fa-code"></i> Technology:
                                                                <span><?= $project['technology']; ?></span>
                                                            </h3>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <h3 class="portfolio-modal-table-text">
                                                                <i class="fa-regular fa-calendar"></i> Tanggal:
                                                                <span><?= date("F Y", strtotime($project['tanggal_mulai'])); ?> - <?= date("F Y", strtotime($project['tanggal_selesai'])); ?></span>
                                                            </h3>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-paragraph">
                                                    <p><?= $project['detail']; ?></p>
                                                </div>

                                                <div class="modal-paragraph">
                                                    <h5>Job Desk:</h5>
                                                    <p><?= $project['jobdesk']; ?></p>
                                                </div>

                                                <div class="modal-img">
                                                    <img src="admin/storage/Gambar_hasilproject/<?= $project['Gambar_hasilproject']; ?>" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <?php
                            }
                        } else {
                            echo "<p>No projects found.</p>";
                        }
                        ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
