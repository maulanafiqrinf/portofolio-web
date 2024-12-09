<?php
include 'koneksi/koneksi.php';
?>
<section id="resume" class="resume-area">
    <div class="container">
        <div class="resume-items">
            <div class="row">
                <!-- Bagian Pengalaman -->
                <div class="col-xl-6 col-md-12">
                    <div class="single-resume">
                        <h2>Pengalaman</h2>
                        <div class="experience-list">
                            <?php
                            $stmt_experience = $koneksi->prepare("SELECT * FROM tb_experience ORDER BY tanggal_selesai DESC");
                            $stmt_experience->execute();
                            $experience_list = $stmt_experience->get_result()->fetch_all(MYSQLI_ASSOC);

                            if (!empty($experience_list)) {
                                foreach ($experience_list as $experience) {
                                    $start_date = date("F Y", strtotime($experience['tanggal_mulai']));
                                    $end_date = date("F Y", strtotime($experience['tanggal_selesai']));
                            ?>
                                    <div class="resume-item wow fadeInUp delay-0-3s">
                                        <div class="icon">
                                            <i class="ri-book-line"></i>
                                        </div>
                                        <div class="content">
                                            <span class="years"><?= $start_date; ?> - <?= $end_date; ?></span>
                                            <h4><?= htmlspecialchars($experience['title']); ?></h4>
                                            <span class="company"><?= htmlspecialchars($experience['posisi']); ?></span>
                                            <p><?= nl2br(htmlspecialchars($experience['jobdesk'])); ?></p>
                                        </div>
                                    </div>
                            <?php
                                }
                            } else {
                                echo "<p>Data tidak ditemukan.</p>";
                            }
                            ?>
                        </div>
                    </div>
                </div>


                <!-- Bagian Pendidikan -->
                <div class="col-xl-6 col-md-12">
                    <div class="experience-list">
                        <div class="single-resume">
                            <h2>Pendidikan</h2>
                            <?php
                            $stmt_education = $koneksi->prepare("SELECT * FROM tb_education ORDER BY tanggal_selesai DESC");
                            $stmt_education->execute();
                            $education_list = $stmt_education->get_result()->fetch_all(MYSQLI_ASSOC);

                            if (!empty($education_list)) {
                                foreach ($education_list as $education) {
                                    $start_date = date("F Y", strtotime($education['tanggal_mulai']));
                                    $end_date = date("F Y", strtotime($education['tanggal_selesai']));
                            ?>
                                    <div class="resume-item wow fadeInUp delay-0-3s">
                                        <div class="icon">
                                            <i class="ri-book-line"></i>
                                        </div>
                                        <div class="content">
                                            <span class="years"><?= $start_date; ?> - <?= $end_date; ?></span>
                                            <h4><?= htmlspecialchars($education['posisi']); ?></h4>
                                            <span class="company"><?= htmlspecialchars($education['title']); ?></span>
                                            <p><?= nl2br(htmlspecialchars($education['detail'])); ?></p>
                                        </div>
                                    </div>
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
</section>

<?php
$stmt_experience->close();
$stmt_education->close();
$koneksi->close();
?>