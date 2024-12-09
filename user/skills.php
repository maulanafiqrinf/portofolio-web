<?php
include 'koneksi/koneksi.php';
?>
<section id="skills" class="skill-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-12 col-lg-12">
                <div class="section-title text-center mb-60 wow fadeInUp delay-0-2s">
                    <p>Keterampilan</p>
                    <h2>Mari Jelajahi Keterampilan Saya</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="skill-items-wrap">
                    <div class="row">
                        <?php
                        $stmt_skills = $koneksi->prepare("SELECT * FROM tb_skills");
                        $stmt_skills->execute();
                        $skills_list = $stmt_skills->get_result()->fetch_all(MYSQLI_ASSOC);

                        if (!empty($skills_list)) {
                            foreach ($skills_list as $skill) {
                        ?>
                                <div class="col-lg-3 col-sm-6 col-xs-12">
                                    <div class="skill-item wow fadeInUp delay-0-2s">
                                        <img src="<?= $skill['image']; ?>" alt="Skill" width="60px"/>
                                        <h5><?= htmlspecialchars($skill['nama']) ?></h5>
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
</section>

<?php
$stmt_skills->close();
$koneksi->close();
?>