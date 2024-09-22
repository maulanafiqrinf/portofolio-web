<?php
include 'koneksi/koneksi.php';

// Mengambil data dari tabel tb_about
$data = mysqli_query($koneksi, "SELECT * FROM tb_about");

// Memeriksa apakah ada data yang ditemukan
if ($row = mysqli_fetch_assoc($data)) {
?>
    <div class="col-xxl-3 col-xl-3">
        <div class="bostami-parsonal-info-area">
            <div class="bostami-parsonal-info-wrap">

                <!-- img -->
                <div class="bostami-parsonal-info-img">
                    <img src="admin/storage/foto_about/<?php echo $row['foto_about']?>" alt="avatar">
                </div>

                <!-- name -->
                <h4 class="bostami-parsonal-info-name">
                    <a href="#"><?php echo $row['nama']; ?></a>
                </h4>
                <span class="bostami-parsonal-info-bio mb-15"><?php echo $row['profession']; ?></span>

                <!-- social link -->
                <ul class="bostami-parsonal-info-social-link mb-30">
                    <li>
                        <a href="<?php echo $row['facebook']; ?>" class="facebook" target="_blank">
                            <i class="fa-brands fa-facebook-f"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $row['instagram']; ?>" class="instagram" target="_blank">
                            <i class="fa-brands fa-instagram"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo $row['linkedn']; ?>" class="linkedin" target="blank">
                            <i class="fa-brands fa-linkedin-in"></i>
                        </a>
                    </li>
                </ul>

                <!-- contact -->
                <div class="bostami-parsonal-info-contact mb-30">
                    <div class="bostami-parsonal-info-contact-item phone">
                        <div class="icon">
                            <i class="fa-solid fa-mobile-screen-button"></i>
                        </div>
                        <div class="text">
                            <span>Phone</span>
                            <p><?php echo $row['phone']; ?></p>
                        </div>
                    </div>

                    <div class="bostami-parsonal-info-contact-item email">
                        <div class="icon">
                            <i class="fa-regular fa-envelope-open-text"></i>
                        </div>
                        <div class="text">
                            <span>Email</span>
                            <p><?php echo $row['email']; ?></p>
                        </div>
                    </div>

                    <div class="bostami-parsonal-info-contact-item location">
                        <div class="icon">
                            <i class="fa-solid fa-location-dot"></i>
                        </div>
                        <div class="text">
                            <span>Location</span>
                            <p><?php echo $row['location']; ?></p>
                        </div>
                    </div>

                    <div class="bostami-parsonal-info-contact-item calendar">
                        <div class="icon">
                            <i class="fa-light fa-calendar-days"></i>
                        </div>
                        <div class="text">
                            <span>Birthday</span>
                            <p><?php echo $row['birthday']; ?></p>
                        </div>
                    </div>
                </div>

                <!-- cv button -->
                <div class="bostami-parsonal-info-btn">
                    <a class="btn-1" href="<?php echo $row['cv']; ?>" target="_blank">
                        <span class="icon">
                            <i class="fa-regular fa-download"></i>
                        </span>
                        download cv
                    </a>
                </div>

            </div>
        </div>
    </div>

<?php
} else {
    echo "Data tidak ditemukan.";
}
?>
