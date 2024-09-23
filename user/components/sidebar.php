<div class="col-xxl-1 d-xxl-block d-none">
    <div class="bostami-main-menu-wrap">
        <nav class="bastami-main-menu main_menu">
            <ul>
                <!-- Tentang Saya -->
                <li class="<?= (!isset($_GET['halaman']) || $_GET['halaman'] == 'about') ? 'active' : ''; ?>">
                    <a href="index.php">
                        <span><i class="fa-light fa-address-card"></i></span>
                        Tentang Saya
                    </a>
                </li>

                <!-- Resume -->
                <li class="<?= (isset($_GET['halaman']) && $_GET['halaman'] == 'resume') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=resume">
                        <span><i class="fa-light fa-file-user"></i></span>
                        Resume
                    </a>
                </li>

                <!-- Portofolio -->
                <li class="<?= (isset($_GET['halaman']) && $_GET['halaman'] == 'portfolio') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=portfolio">
                        <span><i class="fa-light fa-briefcase"></i></span>
                        Portofolio
                    </a>
                </li>

                <!-- Sertifikat -->
                <li class="<?= (isset($_GET['halaman']) && $_GET['halaman'] == 'sertifikat') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=sertifikat">
                        <span><i class="fa-light fa-newspaper"></i></span>
                        Sertifikat
                    </a>
                </li>

                <!-- Kontak -->
                <li class="<?= (isset($_GET['halaman']) && $_GET['halaman'] == 'contact') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=contact">
                        <span><i class="fa-light fa-address-book"></i></span>
                        Kontak
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
