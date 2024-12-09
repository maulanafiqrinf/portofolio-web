<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" key="t-menu">Menu</li>
                <li>
                    <a href="admin/admin.php?halaman=dashboard" class="waves-effect active">
                        <i class="bx bx-home"></i>
                        <span key="t-dashboards">Dashboards</span>
                    </a>
                </li>
                <li class="menu-title" key="t-data-diri">Data Diri</li>
                <li>
                    <?php
                    // Include file koneksi
                    include '../koneksi/koneksi.php';

                    // Persiapan query
                    $stmt = $koneksi->prepare("SELECT id_about FROM tb_about ORDER BY id_about DESC");

                    // Eksekusi query dan cek error
                    if ($stmt->execute()) {
                        $result = $stmt->get_result();

                        // Cek apakah ada hasil
                        if ($result->num_rows > 0) {
                            // Loop melalui hasil dan tampilkan link
                            while ($row = $result->fetch_assoc()) {
                                $id_about = htmlspecialchars($row['id_about']);
                    ?>
                                <a href="admin/admin.php?halaman=about&id=<?php echo urlencode($id_about); ?>" class="waves-effect active">
                                    <i class="bx bx-user"></i>
                                    <span key="t-datadiri">Tentang Saya</span>
                                </a>
                    <?php
                            }
                        } else {
                            echo '<span class="nav-link-text ms-1">Data tidak ditemukan</span>';
                        }

                        // Tutup hasil
                        $stmt->close();
                    } else {
                        echo '<span class="nav-link-text ms-1">Error dalam menjalankan query</span>';
                    }
                    ?>
                </li>
                <li>
                    <a href="admin/admin.php?halaman=skills" class="waves-effect active">
                        <i class="bx bx-wrench"></i>
                        <span key="t-ketrampilan">Ketrampilan</span>
                    </a>
                </li>
                <li>
                    <a href="admin/admin.php?halaman=service" class="waves-effect active">
                        <i class="bx bx-cog"></i>
                        <span key="t-layanan">Layanan</span>
                    </a>
                </li>
                <li class="menu-title" key="t-resume">Resume</li>
                <li>
                    <a href="admin/admin.php?halaman=education" class="waves-effect active">
                        <i class="bx bxs-school"></i>
                        <span key="t-dashboards">Pendidikan</span>
                    </a>
                </li>
                <li>
                    <a href="admin/admin.php?halaman=experience" class="waves-effect active">
                        <i class="bx bx-briefcase"></i>
                        <span key="t-dashboards">Pengalaman</span>
                    </a>
                </li>
                <li>
                    <a href="admin/admin.php?halaman=project" class="waves-effect active">
                        <i class="bx bx-folder"></i>
                        <span key="t-proyek">Proyek</span>
                    </a>
                </li>
                <li class="menu-title" key="t-lain">Lain - Lain</li>
                <li>
                    <a href="admin/admin.php?halaman=certificate" class="waves-effect active">
                        <i class="bx bx-certification"></i>
                        <span key="t-sertifikat">Sertifikat</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>