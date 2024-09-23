<?php
include 'koneksi/koneksi.php';

// Ambil data dari tabel `tb_about`
$about_data = mysqli_query($koneksi, "SELECT * FROM tb_about");
?>

<div class="col-xxl-8 col-xl-9">
    <div class="bostami-page-content-wrap">
        
        <?php if ($about_row = mysqli_fetch_assoc($about_data)) : ?>
            <!-- Page Title -->
            <div class="section-wrapper pl-60 pr-60 pt-60">
                <div class="bostami-page-title-wrap mb-35">
                    <h2 class="page-title">Tentang Saya</h2>
                    <p><?= htmlspecialchars($about_row['about']) ?></p>
                </div>
            </div>
        <?php else : ?>
            <p>Data tidak ditemukan.</p>
        <?php endif; ?>

        <!-- Kompetensi -->
        <div class="section-wrapper pl-60 pr-60">
            <div class="bostami-section-title-wrap mb-30">
                <h3 class="section-title">Kompetensi Saya!</h3>
            </div>

            <div class="bostami-what-do-wrap mb-30">
                <div class="row">
                    <?php
                    // Ambil data dari tabel `tb_services`
                    $services_data = mysqli_query($koneksi, "SELECT * FROM tb_services");
                    $services = mysqli_fetch_all($services_data, MYSQLI_ASSOC);
                    ?>

                    <?php if (!empty($services)) : ?>
                        <?php foreach ($services as $service) : ?>
                            <div class="col-xxl-6 col-xl-6 col-lg-6">
                                <div class="bostami-what-do-item <?= htmlspecialchars($service['class']) ?>">
                                    <div class="icon">
                                        <i class="<?= htmlspecialchars($service['icon']) ?>"></i>
                                    </div>
                                    <div class="text">
                                        <h4 class="title"><?= htmlspecialchars($service['title']) ?></h4>
                                        <p><?= htmlspecialchars($service['detail']) ?>.</p>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <p>Data tidak ditemukan.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
