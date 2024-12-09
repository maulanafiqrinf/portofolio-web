<section id="works" class="projects-area">
    <div class="container">
        <div class="container-inner">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-title text-center wow fadeInUp delay-0-2s">
                        <h2>Karya & Proyek</h2>
                        <p>Lihatlah beberapa proyek desain saya, yang dibuat dengan cermat dengan penuh dedikasi, masing-masing mencerminkan semangat dan jiwa yang saya tuangkan ke dalam setiap detail.</p>
                    </div>
                </div>
            </div>
            <div class="row project-masonry-active">
                <?php
                include 'koneksi/koneksi.php';

                // Query untuk mengambil data proyek
                $stmt = $koneksi->prepare("SELECT id_project, posisi, title, Gambar_hasilproject FROM tb_project ORDER BY tanggal_selesai DESC");
                $stmt->execute();
                $result = $stmt->get_result();

                // Jika terdapat proyek
                if ($result->num_rows > 0) {
                    while ($project = $result->fetch_assoc()) {
                        // Sanitasi data
                        $id_project = htmlspecialchars($project['id_project'], ENT_QUOTES, 'UTF-8');
                        $posisi = htmlspecialchars($project['posisi'], ENT_QUOTES, 'UTF-8');
                        $title = htmlspecialchars($project['title'], ENT_QUOTES, 'UTF-8');
                        $gambar = htmlspecialchars($project['Gambar_hasilproject'], ENT_QUOTES, 'UTF-8');

                        // Pisahkan gambar menjadi array
                        $gambar_array = explode(',', $gambar);
                        // Ambil gambar pertama
                        $gambar_pertama = trim($gambar_array[0]);
                ?>
                <div class="col-lg-4 col-md-6 item branding game">
                    <div class="project-item style-two wow fadeInUp delay-0-3s">
                        <div class="project-image">
                            <img src="admin/storage/Gambar_hasilproject/<?= $gambar_pertama; ?>" alt="<?= $title; ?>">
                            <a href="portfolio-detail.php?id=<?= $id_project; ?>" class="details-btn">
                                <i class="ri-arrow-right-up-line"></i>
                            </a>
                        </div>
                        <div class="project-content">
                            <span class="sub-title"><?= $posisi; ?></span>
                            <h3><?= $title; ?></h3>
                        </div>
                    </div>
                </div>
                <?php
                    }
                } else {
                    // Tampilkan pesan jika tidak ada proyek
                    echo '<p>No projects found.</p>';
                }

                // Tutup statement dan koneksi
                $stmt->close();
                $koneksi->close();
                ?>
            </div>
        </div>
    </div>
</section>
