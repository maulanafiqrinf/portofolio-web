<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="index.html" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-dark.png" alt="" height="17">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index.html" class="logo logo-light">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-light.png" alt="" height="17">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar">
        <div class="container-fluid">

            <div id="two-column-menu"></div>
            <ul class="navbar-nav" id="navbar-nav">
                <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                <!-- <li class="nav-item">
                    <a class="nav-link menu-link" href="index.php">
                        <i class="ri-honour-line"></i> <span data-key="t-dasboard">Dashboard</span>
                    </a>
                </li> -->
                <li class="menu-title"><span data-key="t-menu">About</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarApps" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarApps">
                        <i class="ri-apps-2-line"></i> <span data-key="t-about">About</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarApps">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'about') ? 'active' : ''; ?>">
                                <a href="index.php?halaman=about" class="nav-link" data-key="t-about"> about
                                </a>
                            </li>
                            <li class="nav-item <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'service') ? 'active' : ''; ?>">
                                <a href="index.php?halaman=service" class="nav-link" data-key="t-service"> service
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="menu-title"><span data-key="t-menu">Resume</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'education') ? 'active' : ''; ?>" href="index.php?halaman=education">
                        <i class="ri-honour-line"></i> <span data-key="t-education">education</span>
                    </a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link menu-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'project') ? 'active' : ''; ?>" href="index.php?halaman=project">
                        <i class="ri-honour-line"></i> <span data-key="t-Project">Project</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'experience') ? 'active' : ''; ?>" href="index.php?halaman=experience">
                        <i class="ri-honour-line"></i> <span data-key="t-experience">Experience</span>
                    </a>
                </li>
                <li class="menu-title"><span data-key="t-lain">Lain - Lain</span></li>

                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'certificate') ? 'active' : ''; ?>" href="index.php?halaman=certificate">
                        <i class="ri-honour-line"></i> <span data-key="t-certificate">Certificate</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link <?php echo (isset($_GET['halaman']) && $_GET['halaman'] == 'skills') ? 'active' : ''; ?>" href="index.php?halaman=skills">
                        <i class="ri-honour-line"></i> <span data-key="t-skills">Skills</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>
</div>