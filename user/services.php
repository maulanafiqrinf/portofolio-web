<?php
// Menghubungkan ke database
include 'koneksi/koneksi.php';

try {
    // Menyiapkan dan mengeksekusi query untuk mendapatkan data layanan
    $stmt_services = $koneksi->prepare("SELECT * FROM tb_services");
    $stmt_services->execute();
    $services = $stmt_services->get_result()->fetch_all(MYSQLI_ASSOC);
} catch (Exception $e) {
    // Menangkap error dan menampilkan pesan error
    $services = [];
    error_log("Error fetching services: " . $e->getMessage());
}
?>
<section id="service" class="services-area innerpage-single-area">
    <div class="container">
        <div class="container-inner">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    <div class="section-title text-center wow fadeInUp delay-0-2s">
                        <p>Layanan</p>
                        <h2>Layanan Berkualitas</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if (!empty($services)) : ?>
                    <?php foreach ($services as $service) : ?>
                        <div class="col-lg-4 col-md-6">
                            <div class="service-item wow fadeInUp delay-0-2s">
                                <!-- Escaping HTML untuk keamanan -->
                                <i class="<?= htmlspecialchars($service['icon'], ENT_QUOTES, 'UTF-8') ?>"></i>
                                <h4><?= htmlspecialchars($service['title'], ENT_QUOTES, 'UTF-8') ?></h4>
                                <p><?= htmlspecialchars($service['detail'], ENT_QUOTES, 'UTF-8') ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <div class="col-md-12 text-center">
                        <p>Data tidak ditemukan.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php
// Membersihkan resource statement dan koneksi
if (isset($stmt_services)) {
    $stmt_services->close();
}
if (isset($koneksi)) {
    $koneksi->close();
}
?>
