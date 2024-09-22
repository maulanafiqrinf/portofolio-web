<div class="col-xxl-1 d-xxl-block d-none">
    <div class="bostami-main-menu-wrap">
        <nav class="bastami-main-menu main_menu">
            <ul>
                <li class=" <?php echo (!isset($_GET['halaman']) || $_GET['halaman'] == 'about') ? 'active' : ''; ?>">
                    <a href="index.php">
                        <span>
                            <i class="fa-light fa-address-card"></i>
                        </span>
                        Tentang Saya
                    </a>
                </li>
                <li class="<?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'resume') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=resume">
                        <span>
                            <i class="fa-light fa-file-user"></i>
                        </span>
                        Resume
                    </a>
                </li>
                <li class="<?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'portfolio') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=portfolio">
                        <span>
                            <i class="fa-light fa-briefcase"></i>
                        </span>
                        Portofolio
                    </a>
                </li>
                <li class="<?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'sertifikat') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=sertifikat">
                        <span>
                            <i class="fa-light fa-newspaper"></i>
                        </span>
                        sertifikat
                    </a>
                </li>
                <li class="<?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'contact') ? 'active' : ''; ?>">
                    <a href="index.php?halaman=contact">
                        <span>
                            <i class="fa-light fa-address-book"></i>
                        </span>
                        Kontak
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>