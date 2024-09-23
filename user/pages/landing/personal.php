<?php
include 'koneksi/koneksi.php';

// Mengambil data dari tabel tb_about
$data = mysqli_query($koneksi, "SELECT * FROM tb_about");

// Memeriksa apakah ada data yang ditemukan
if ($row = mysqli_fetch_assoc($data)) :
?>
    <div class="col-xxl-3 col-xl-3">
        <div class="bostami-parsonal-info-area">
            <div class="bostami-parsonal-info-wrap">

                <!-- Gambar -->
                <div class="bostami-parsonal-info-img">
                    <img src="admin/storage/foto_about/<?= htmlspecialchars($row['foto_about']) ?>" alt="avatar">
                </div>

                <!-- Nama -->
                <h4 class="bostami-parsonal-info-name">
                    <a href="#"><?= htmlspecialchars($row['nama']) ?></a>
                </h4>
                <span class="bostami-parsonal-info-bio mb-15"><?= htmlspecialchars($row['profession']) ?></span>

                <!-- Social Links -->
                <ul class="bostami-parsonal-info-social-link mb-30">
                    <li>
                        <a href="<?= htmlspecialchars($row['facebook']) ?>" class="facebook" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?= htmlspecialchars($row['instagram']) ?>" class="instagram" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?= htmlspecialchars($row['linkedn']) ?>" class="linkedin" target="_blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>

                <!-- Kontak -->
                <div class="bostami-parsonal-info-contact mb-30">
                    <div class="bostami-parsonal-info-contact-item phone">
                        <div class="icon">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                        <div class="text">
                            <span>Phone</span>
                            <p><?= htmlspecialchars($row['phone']) ?></p>
                        </div>
                    </div>

                    <div class="bostami-parsonal-info-contact-item email">
                        <div class="icon">
                            <i class="fa-regular fa-envelope-open-text"></i>
                        </div>
                        <div class="text">
                            <span>Email</span>
                            <p><?= htmlspecialchars($row['email']) ?></p>
                        </div>
                    </div>

                    <div class="bostami-parsonal-info-contact-item location">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text">
                            <span>Location</span>
                            <p><?= htmlspecialchars($row['location']) ?></p>
                        </div>
                    </div>

                    <div class="bostami-parsonal-info-contact-item calendar">
                        <div class="icon">
                            <i class="fa-light fa-calendar-days"></i>
                        </div>
                        <div class="text">
                            <span>Birthday</span>
                            <p><?= htmlspecialchars($row['birthday']) ?></p>
                        </div>
                    </div>
                </div>

                <!-- Tombol CV -->
                <div class="bostami-parsonal-info-btn">
                    <a class="btn-1" href="<?= htmlspecialchars($row['cv']) ?>" target="_blank">
                        <span class="icon">
                            <i class="fa-regular fa-download"></i>
                        </span>
                        Download CV
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php
else :
    echo "<p>Data tidak ditemukan.</p>";
endif;
?>
