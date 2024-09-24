<?php include 'koneksi/koneksi.php'; ?>

<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">

        <!-- Page Title -->
        <div class="section-wrapper pl-60 pr-60 pt-60">
            <div class="bostami-page-title-wrap mb-15">
                <h2 class="page-title">Resume</h2>
            </div>
        </div>

        <div class="section-wrapper pl-60 pr-60 mb-60">
            <div class="row">

                <!-- Education -->
                <div class="col-xl-6 col-lg-7">
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title"><i class="fa-light fa-school"></i>Pendidikan</h4>
                    </div>
                    <?php
                    $education_query = "SELECT * FROM tb_education";
                    $education_list = mysqli_fetch_all(mysqli_query($koneksi, $education_query), MYSQLI_ASSOC);

                    if (!empty($education_list)) {
                        foreach ($education_list as $education) {
                    ?>
                            <div class="bostami-card-wrap">
                                <div class="bostami-card-item bg-prink mb-20">
                                    <span class="card-subtitle"><?= date("F Y", strtotime($education['tanggal_mulai'])); ?> - <?= date("F Y", strtotime($education['tanggal_selesai'])); ?></span>
                                    <h5 class="card-title"><?= $education['title']; ?> <span></span></h5>
                                    <h6 class="card-text"><?= $education['posisi']; ?></h6>
                                    <p class="card-text"><?= $education['detail']; ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Data tidak ditemukan.";
                    }
                    ?>
                </div>

                <!-- Experience -->
                <div class="col-xl-6 col-lg-5">
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title"><i class="fa-light fa-briefcase"></i>Pengalaman</h4>
                    </div>
                    <?php
                    $experience_query = "SELECT * FROM tb_experience ORDER BY tanggal_selesai DESC";
                    $experience_list = mysqli_fetch_all(mysqli_query($koneksi, $experience_query), MYSQLI_ASSOC);

                    if (!empty($experience_list)) {
                        foreach ($experience_list as $experience) {
                    ?>
                            <div class="bostami-card-wrap">
                                <div class="bostami-card-item mb-20">
                                    <span class="card-subtitle"><?= date("F Y", strtotime($experience['tanggal_mulai'])); ?> - <?= date("F Y", strtotime($experience['tanggal_selesai'])); ?></span>
                                    <h5 class="card-title"><?= $experience['posisi']; ?></h5>
                                    <h6 class="card-title"><?= $experience['title']; ?></h6>
                                    <p class="card-text" style="text-align: justify;"><?= $experience['jobdesk']; ?></p>
                                </div>
                            </div>
                    <?php
                        }
                    } else {
                        echo "Data tidak ditemukan.";
                    }
                    ?>
                </div>

                <!-- Projects -->
                <div class="col-xl-6 col-lg-7">
                    <br />
                    <div class="bostami-section-title-wrap mb-20">
                        <h4 class="section-title"><i class="fa-regular fa-newspaper"></i>Proyek</h4>
                    </div>
                    <?php
                    $project_query = "SELECT * FROM tb_project ORDER BY tanggal_selesai DESC";
                    $project_list = mysqli_fetch_all(mysqli_query($koneksi, $project_query), MYSQLI_ASSOC);

                    if (!empty($project_list)) {
                        foreach ($project_list as $project) {
                    ?>
                            <div class="bostami-card-wrap">
                                <div class="bostami-card-item <?= $project['class']; ?> mb-20">
                                    <span class="card-subtitle"><?= date("F Y", strtotime($project['tanggal_mulai'])); ?> - <?= date("F Y", strtotime($project['tanggal_selesai'])); ?></span>
                                    <h6 class="card-title"><?= $project['posisi']; ?></h6>
                                    <p class="card-text"><?= $project['title']; ?></p>
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
                        <h4 class="section-title">Kemampuan</h4>
                    </div>

                    <div class="knowledeges-item-wrap">
                        <?php
                        $skills_query = "SELECT * FROM tb_skills";
                        $skills_list = mysqli_fetch_all(mysqli_query($koneksi, $skills_query), MYSQLI_ASSOC);

                        if (!empty($skills_list)) {
                            foreach ($skills_list as $skill) {
                        ?>
                                <span class="gk-item"><?= htmlspecialchars($skill['nama']) ?></span>
                        <?php
                            }
                        } else {
                            echo "<p>Data tidak ditemukan.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
