<?php
include 'koneksi/koneksi.php';

// Ambil data dari tabel `tb_about` dengan limit 1
$query = "SELECT * FROM tb_about LIMIT 1";
$stmt = $koneksi->prepare($query);
$stmt->execute();
$result = $stmt->get_result();

// Jika data ditemukan
if ($row = $result->fetch_assoc()) {
    // Bersihkan data untuk keamanan
    $foto_about = htmlspecialchars($row['foto_about'], ENT_QUOTES, 'UTF-8');
    $nama = htmlspecialchars($row['nama'], ENT_QUOTES, 'UTF-8');
    $profession = htmlspecialchars($row['profession'], ENT_QUOTES, 'UTF-8');
    $location = htmlspecialchars($row['location'], ENT_QUOTES, 'UTF-8');
    $email = htmlspecialchars($row['email'], ENT_QUOTES, 'UTF-8');
    $phone = htmlspecialchars($row['phone'], ENT_QUOTES, 'UTF-8');
    $instagram = htmlspecialchars($row['instagram'], ENT_QUOTES, 'UTF-8');
    $linkedin = htmlspecialchars($row['linkedn'], ENT_QUOTES, 'UTF-8');
    $github = htmlspecialchars($row['github'], ENT_QUOTES, 'UTF-8');
    $about = htmlspecialchars($row['about'], ENT_QUOTES, 'UTF-8');
    $cv = htmlspecialchars($row['cv'], ENT_QUOTES, 'UTF-8');
} else {
    echo "<p>Data tidak ditemukan.</p>";
    exit;
}

// Tutup statement dan koneksi
$stmt->close();
$koneksi->close();
?>

<section id="about" class="about-area">
    <div class="container">
        <div class="row">
            <!-- Bagian Gambar -->
            <div class="col-lg-4">
                <div class="about-image-part wow fadeInUp delay-0-3s">
                    <div class="about-image-part2">
                        <img src="admin/storage/foto_about/<?= $foto_about ?>" alt="About Me" width="600px"/>
                    </div>
                    <h2><?= nl2br($nama) ?></h2>
                    <p><?= nl2br($profession) ?></p>
                    <p><?= nl2br($location) ?> | <?= nl2br($email) ?> | <?= nl2br($phone) ?></p>
                    <div class="about-social text-center">
                        <ul>
                            <li><a href="<?= $instagram ?>" target="_blank"><i class="ri-instagram-line"></i></a></li>
                            <li><a href="<?= $linkedin ?>" target="_blank"><i class="ri-linkedin-fill"></i></a></li>
                            <li><a href="<?= $github ?>" target="_blank"><i class="ri-github-line"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Bagian Konten -->
            <div class="col-lg-8">
                <div class="about-content-part wow fadeInUp delay-0-2s">
                    <p>Halo!</p>
                    <p><?= nl2br($about) ?></p>
                    <div class="hero-btns">
                        <a href="<?= $cv ?>" class="theme-btn" target="_blank">unduh CV <i class="ri-download-line"></i></a>
                    </div>
                </div>
                <div class="about-content-part-bottom wow fadeInUp delay-0-2s">
                    <div class="company-list">
                        <div class="scroller" data-direction="left" data-speed="slow">
                            <div class="scroller__inner">
                                <h4><?= nl2br($profession) ?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
