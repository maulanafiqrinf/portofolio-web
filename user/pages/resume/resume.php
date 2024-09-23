<?php include 'koneksi/koneksi.php'; ?>

<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">

        <!-- page title -->
        <div class="section-wrapper pl-60 pr-60 pt-60">
            <div class="bostami-page-title-wrap mb-15">
                <h2 class="page-title">Resume</h2>
            </div>
        </div>

        <div class="section-wrapper pl-60 pr-60 mb-60">
            <div class="row">

                <!-- education -->
                <div class="col-xl-6 col-lg-7">
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title"><i class="fa-light fa-school"></i>Pendidikan</h4>
                    </div>
                    <?php
                    $education = mysqli_query($koneksi, "SELECT * FROM tb_education");

                    // Mengambil semua data sekaligus dan mengubahnya menjadi array asosiatif
                    $education_list = mysqli_fetch_all($education, MYSQLI_ASSOC);

                    // Memeriksa apakah ada data yang ditemukan
                    if (!empty($education_list)) {
                        foreach ($education_list as $education) {
                    ?>
                            <div class="bostami-card-wrap">
                                <div class="bostami-card-item bg-prink mb-20">
                                    <span class="card-subtitle"><?php echo $education['tanggal']; ?></span>
                                    <h6 class="card-title"><?php echo $education['jurusan']; ?> <span>- University,</span></h6>
                                    <p class="card-text"><?php echo $education['nama']; ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Data tidak ditemukan.";
                    }
                    ?>

                </div>

                <!-- experience -->
                <div class="col-xl-6 col-lg-5">
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title"><i class="fa-light fa-briefcase"></i>Pengalaman</h4>
                    </div>
                    <?php
                    $experience = mysqli_query($koneksi, "SELECT * FROM tb_experience ORDER BY tanggal_selesai DESC");
                    $experience_list = mysqli_fetch_all($experience, MYSQLI_ASSOC);
                    if (!empty($experience_list)) {
                        foreach ($experience_list as $experience) {
                    ?>
                            <div class="bostami-card-wrap">
                                <div class="bostami-card-item mb-20">
                                    <span class="card-subtitle"><?php echo date("F Y", strtotime($experience['tanggal_mulai'])); ?> - <?php echo date("F Y", strtotime($experience['tanggal_selesai'])); ?></span>
                                    <h5 class="card-title"><?php echo $experience['posisi']; ?></h5>
                                    <h6 class="card-title"><?php echo $experience['title']; ?></h6>
                                    <br />
                                    <p class="card-text" style="text-align: justify;"><?php echo $experience['jobdesk']; ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Data tidak ditemukan.";
                    }
                    ?>
                </div>

                <!--Proyek-->
                <div class="col-xl-6 col-lg-7">
                    <br />
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title"><i class="fa-light fa-school"></i>Proyek</h4>
                    </div>
                    <?php
                    $project = mysqli_query($koneksi, "SELECT * FROM tb_project ORDER BY tanggal_selesai DESC");
                    $project_list = mysqli_fetch_all($project, MYSQLI_ASSOC);
                    if (!empty($project_list)) {
                        foreach ($project_list as $project) {
                    ?>
                            <div class="bostami-card-wrap">
                                <div class="bostami-card-item <?php echo $project['class']; ?> mb-20">
                                    <span class="card-subtitle"><?php echo date("F Y", strtotime($project['tanggal_mulai'])); ?> - <?php echo date("F Y", strtotime($project['tanggal_selesai'])); ?></span>
                                    <h6 class="card-title"><?php echo $project['posisi']; ?></h6>
                                    <p class="card-text"><?php echo $project['title']; ?></p>
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

        <div class="section-wrapper bg-light-white-2 pt-70 pb-60 pl-60 pr-60">
            <div class="row">

                <div class="col-xl-12 col-lg-5">
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title">Knowledges</h4>
                    </div>

                    <div class="knowledeges-item-wrap">
                        <?php
                        $project = mysqli_query($koneksi, "SELECT * FROM tb_project");
                        $project_list = mysqli_fetch_all($project, MYSQLI_ASSOC);
                        if (!empty($project_list)) {
                            foreach ($project_list as $project) {
                        ?>
                                <span class="gk-item">Digital Design</span>
                        <?php
                            }
                        } else {
                            echo "Data tidak ditemukan.";
                        }
                        ?>
                    </div>

                </div>

            </div>



        </div>
    </div>
</div>