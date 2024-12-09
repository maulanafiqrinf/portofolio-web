<?php
// Menghubungkan ke database
include 'koneksi/koneksi.php';

try {
    // Menyiapkan dan mengeksekusi query untuk mendapatkan data "about"
    $stmt_about = $koneksi->prepare("SELECT * FROM tb_about LIMIT 1");
    $stmt_about->execute();
    $about_data = $stmt_about->get_result();
    $about_row = $about_data->fetch_assoc();
} catch (Exception $e) {
    // Menangkap error dan mengatur data default
    $about_row = [
        'location' => 'Data not available',
        'phone' => 'Data not available',
        'email' => 'Data not available'
    ];
    error_log("Error fetching about data: " . $e->getMessage());
}
?>
<section id="contact" class="contact-area">
    <div class="container">
        <div class="container-inner">
            <!-- Bagian Judul -->
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-title text-center wow fadeInUp delay-0-2s">
                        <p>Kontak</p>
                        <h2>Hubungi Saya!</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Informasi Kontak -->
                <div class="col-lg-4">
                    <div class="contact-content-part wow fadeInUp delay-0-2s">
                        <div class="single-contact wow fadeInUp" data-wow-delay=".2s">
                            <div class="contact-icon">
                                <i class="ri-map-pin-line"></i>
                            </div>
                            <h2>Rumah:</h2>
                            <p><?= htmlspecialchars($about_row['location'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <div class="single-contact wow fadeInUp" data-wow-delay=".4s">
                            <div class="contact-icon">
                                <i class="ri-phone-line"></i>
                            </div>
                            <h2>No. HP:</h2>
                            <p><?= htmlspecialchars($about_row['phone'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                        <div class="single-contact wow fadeInUp" data-wow-delay=".6s">
                            <div class="contact-icon">
                                <i class="ri-mail-line"></i>
                            </div>
                            <h2>Email:</h2>
                            <p><?= htmlspecialchars($about_row['email'], ENT_QUOTES, 'UTF-8') ?></p>
                        </div>
                    </div>
                </div>
                <!-- Formulir Kontak -->
                <div class="col-lg-8">
                    <div class="contact-form contact-form-area wow fadeInUp delay-0-4s">
                        <form id="contactForm" class="contactForm" name="contactForm" action="send_email.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Nama Lengkap</label>
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Steve Milner" required />
                                        <label for="name" class="for-icon"><i class="far fa-user"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Alamat Email</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="hello@websitename.com" required />
                                        <label for="email" class="for-icon"><i class="far fa-envelope"></i></label>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Pesan</label>
                                        <textarea name="message" id="message" class="form-control" rows="4" placeholder="Write Your message" required></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mb-0">
                                        <button type="submit" class="theme-btn">
                                            Kirimkan saya pesan <i class="ri-mail-line"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bagian Call to Action -->
<section class="call-to-action-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="call-to-action-part wow fadeInUp delay-0-2s text-center">
                    <h2>Apakah Anda siap <span> untuk memulai proyek Anda</span> dengan sentuhan keajaiban?</h2>
                    <p>Menjangkau dan mari kita mewujudkannya ✨. Saya juga tersedia untuk penuh-waktu atau paruh-waktu kesempatan untuk mendorong batas-batas desain dan memberikan pekerjaan yang luar biasa.</p>
                    <a href="#contact" class="theme-btn">Mari Bicara <i class="ri-download-line"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bagian Peta -->
<section class="map_area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="map_title">Lihat Lokasi Peta Langsung Saya</h2>
                <div class="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3023.957183635167!2d-74.00402768559431!3d40.71895904512855!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c2598a1316e7a7%3A0x47bb20eb6074b3f0!2sNew%20Work%20City%20-%20(CLOSED)!5e0!3m2!1sbn!2sbd!4v1600305497356!5m2!1sbn!2sbd"
                        style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    <h2 class="close_btn">Sembunyikan Peta</h2>
                </div>
            </div>
        </div>
    </div>
</section>
<?php
// Menutup koneksi
if (isset($stmt_about)) {
    $stmt_about->close();
}
if (isset($koneksi)) {
    $koneksi->close();
}
?>