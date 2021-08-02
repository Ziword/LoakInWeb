<!doctype html>
<html lang="en" class="no-focus">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title><?= $judul ?></title>

    <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <!-- Open Graph Meta -->
    <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <!-- Icons -->
    <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/media/favicons/favicon.png">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= base_url(); ?>assets/media/favicons/favicon-192x192.png">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= base_url(); ?>assets/media/favicons/apple-touch-icon-180x180.png">
    <!-- END Icons -->

    <!-- Stylesheets -->
    <!-- Fonts and Codebase framework -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="<?= base_url(); ?>assets/css/codebase.min.css">
    <link href="<?= base_url(); ?>assets/css/select2.min.css" rel="stylesheet" />

    <!-- Codebase JS -->
    <script src="<?= base_url(); ?>assets/js/codebase.core.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/codebase.app.min.js"></script>

    <!-- Page JS DATATABLES -->
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url(); ?>assets/js/plugins/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page JS DATATABLES -->
    <script src="<?= base_url(); ?>assets/js/pages/be_tables_datatables.min.js"></script>

    <!-- Page JS CHART -->
    <script src="<?= base_url(); ?>assets/js/plugins/chartjs/Chart.bundle.min.js"></script>

    <!-- Page JS CHART -->
    <script src="<?= base_url(); ?>assets/js/pages/be_pages_dashboard.min.js"></script>

    <!-- JS FOR SELECT2 -->
    <script src="<?= base_url(); ?>assets/js/select2.min.js"></script>

    <!-- PDF Object -->
    <script type="text/javascript" src="<?= base_url() ?>assets/js/pdfobject.js"></script>

</head>

<body>
    <div id="page-container" class="sidebar-o side-scroll page-header-modern main-content-boxed enable-page-overlay">
        <!-- Side Overlay-->
        <aside id="side-overlay">
            <!-- Side Header -->
            <div class="content-header content-header-fullrow">
                <div class="content-header-section align-parent">
                    <!-- Close Side Overlay -->
                    <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary align-v-r" data-toggle="layout" data-action="side_overlay_close">
                        <i class="fa fa-times text-danger"></i>
                    </button>
                    <!-- END Close Side Overlay -->

                    <!-- User Info -->
                    <div class="content-header-item">
                        <a class="img-link mr-5" href="">
                            <img class="img-avatar img-avatar32" src="<?= base_url(); ?>assets/media/avatars/avatar0.jpg" alt="">
                        </a>
                        <a class="align-middle link-effect text-primary-dark font-w600" href="">Admin</a>
                    </div>
                    <!-- END User Info -->
                </div>
            </div>
            <!-- END Side Header -->

            <!-- Side Content -->
            <div class="content-side">
                <!-- Search -->
                <div class="block pull-t pull-r-l">
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <form>
                            <div class="input-group">
                                <input type="text" class="form-control" id="side-overlay-search" name="side-overlay-search" placeholder="Search..">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary px-10">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Search -->

                <!-- Mini Stats -->
                <div class="block pull-r-l">
                    <div class="block-content block-content-full block-content-sm bg-body-light">
                        <div class="row">
                            <div class="col-4">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Stat</div>
                                <div class="font-size-h4">100</div>
                            </div>
                            <div class="col-4">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Stat</div>
                                <div class="font-size-h4">200</div>
                            </div>
                            <div class="col-4">
                                <div class="font-size-sm font-w600 text-uppercase text-muted">Stat</div>
                                <div class="font-size-h4">300</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END Mini Stats -->

                <!-- Block -->
                <div class="block pull-r-l">
                    <div class="block-header bg-body-light">
                        <h3 class="block-title">Title</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                            <button type="button" class="btn-block-option" data-toggle="block-option" data-action="content_toggle"></button>
                        </div>
                    </div>
                    <div class="block-content">
                        <p>Content...</p>
                    </div>
                </div>
                <!-- END Block -->
            </div>
            <!-- END Side Content -->
        </aside>
        <!-- END Side Overlay -->

        <nav id="sidebar">
            <!-- Sidebar Content -->
            <div class="sidebar-content">
                <!-- Side Header -->
                <div class="content-header content-header-fullrow px-15">
                    <!-- Mini Mode -->
                    <div class="content-header-section sidebar-mini-visible-b">
                        <!-- Logo -->
                        <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                            <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                        </span>
                        <!-- END Logo -->
                    </div>
                    <!-- END Mini Mode -->

                    <!-- Normal Mode -->
                    <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                        <!-- Close Sidebar, Visible only on mobile screens -->
                        <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                        <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                            <i class="fa fa-times text-danger"></i>
                        </button>
                        <!-- END Close Sidebar -->

                        <!-- Logo -->
                        <div class="content-header-item">
                            <a class="link-effect font-w700" href="">
                                <i class="si si-fire text-primary"></i>
                                <span class="font-size-xl text-dual-primary-dark">code</span><span class="font-size-xl text-primary">base</span>
                            </a>
                        </div>
                        <!-- END Logo -->
                    </div>
                    <!-- END Normal Mode -->
                </div>
                <!-- END Side Header -->

                <!-- Side User -->
                <div class="content-side content-side-full content-side-user px-10 align-parent">
                    <!-- Visible only in mini mode -->
                    <div class="sidebar-mini-visible-b align-v animated fadeIn">
                        <img class="img-avatar img-avatar32" src="<?= base_url(); ?>assets/media/avatars/avatar0.jpg" alt="">
                    </div>
                    <!-- END Visible only in mini mode -->

                    <!-- Visible only in normal mode -->
                    <div class="sidebar-mini-hidden-b text-center">
                        <a class="img-link" href="">
                            <img class="img-avatar" src="<?= base_url(); ?>assets/media/avatars/avatar0.jpg" alt="">
                        </a>
                        <ul class="list-inline mt-10">
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href=""><?= $this->session->userdata('nama_pegawai'); ?></a>
                            </li>
                            <li class="list-inline-item">
                                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                <a class="link-effect text-dual-primary-dark" id="darkSidebarButton1" onclick="setDarkMode(true)" href="#">
                                    <i class="si si-drop"></i>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a class="link-effect text-dual-primary-dark" href="<?= base_url(); ?>Clogin/logout">
                                    <i class="si si-logout"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Visible only in normal mode -->
                </div>
                <!-- END Side User -->

                <!-- Side Navigation -->
                <div class="content-side content-side-full">
                    <ul class="nav-main">
                        <li>
                            <a class="<?php if ($judul == "Dashboard") {
                                            echo "active";
                                        } ?>" href="<?= base_url(); ?>Chome">
                                <i class="si si-cup"></i>
                                <span class="sidebar-mini-hide">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-main-heading">
                            <span class="sidebar-mini-visible">HD</span>
                            <span class="sidebar-mini-hidden">Transaksi</span>
                        </li>

                        <li class="<?php if ($judul == "Pendaftaran") {
                                        echo "open";
                                    } ?>">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                <i class="si si-puzzle"></i>
                                <span class="sidebar-mini-hide">Pendaftaran</span>
                            </a>
                            <ul>
                                <li>
                                    <a class="<?php if ($judul == "MDM Supplier") {
                                                    echo "active";
                                                } ?>" href="<?= base_url(); ?>ControllerMDT/indexAgenBaru">Pendaftaran Agen Baru</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if ($judul == "MDM Transaksi") {
                                        echo "open";
                                    } ?>">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                <i class="si si-puzzle"></i>
                                <span class="sidebar-mini-hide">Transaksi</span>
                            </a>
                            <ul>
                                <li>
                                    <a class="<?php if ($judul == "MDM Transaksi") {
                                                    echo "active";
                                                } ?>" href="<?= base_url(); ?>ControllerMDM/mdmStatusTransaksi">Data Status Transaksi</a>
                                </li>
                                <li>
                                    <a class="<?php if ($judul == "MDM Transaksi") {
                                                    echo "active";
                                                } ?>" href="<?= base_url(); ?>ControllerMDM/mdmJenisTransaksi">Data Jenis Transaksi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="<?php if ($judul == "MDM User") {
                                        echo "open";
                                    } ?>">
                            <a class="nav-submenu" data-toggle="nav-submenu" href="#">
                                <i class="si si-puzzle"></i>
                                <span class="sidebar-mini-hide">User</span>
                            </a>
                            <ul>
                                <li>
                                    <a class="<?php if ($judul == "MDM Supplier") {
                                                    echo "active";
                                                } ?>" href="<?= base_url(); ?>ControllerMDM/mdmJenisUser">Data Jenis User</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- END Side Navigation -->
            </div>
            <!-- Sidebar Content -->
        </nav>
        <!-- END Sidebar -->

        <!-- Header -->
        <header id="page-header">
            <!-- Header Content -->
            <div class="content-header">
                <!-- Left Section -->
                <div class="content-header-section">
                    <!-- Toggle Sidebar -->
                    <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                    <button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                        <i class="fa fa-navicon"></i>
                    </button>
                    <!-- END Toggle Sidebar -->

                    <!-- Color Themes (used just for demonstration) -->
                    <!-- Themes functionality initialized in Codebase() -> uiHandleTheme() -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-circle btn-dual-secondary" id="page-header-themes-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-paint-brush"></i>
                        </button>
                        <div class="dropdown-menu min-width-150" aria-labelledby="page-header-themes-dropdown">
                            <h6 class="dropdown-header text-center">Color Themes</h6>
                            <div class="row no-gutters text-center mb-5">
                                <div class="col-4 mb-5">
                                    <a class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-4 mb-5">
                                    <a class="text-elegance" data-toggle="theme" data-theme="<?= base_url(); ?>assets/css/themes/elegance.min.css" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-4 mb-5">
                                    <a class="text-pulse" data-toggle="theme" data-theme="<?= base_url(); ?>assets/css/themes/pulse.min.css" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-4 mb-5">
                                    <a class="text-flat" data-toggle="theme" data-theme="<?= base_url(); ?>assets/css/themes/flat.min.css" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-4 mb-5">
                                    <a class="text-corporate" data-toggle="theme" data-theme="<?= base_url(); ?>assets/css/themes/corporate.min.css" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                                <div class="col-4 mb-5">
                                    <a class="text-earth" data-toggle="theme" data-theme="<?= base_url(); ?>assets/css/themes/earth.min.css" href="javascript:void(0)">
                                        <i class="fa fa-2x fa-circle"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="dropdown-divider"></div>
                            <button type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" id="darkSidebarButton2" onclick="setDarkMode(true)">Sidebar Style</button>
                        </div>
                    </div>
                    <!-- END Color Themes -->
                </div>
                <!-- END Left Section -->

                <!-- Right Section -->
                <div class="content-header-section">
                    <!-- User Dropdown -->
                    <div class="btn-group" role="group">
                        <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $this->session->userdata('nama_admin'); ?><i class="fa fa-angle-down ml-5"></i>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right min-width-150" aria-labelledby="page-header-user-dropdown">

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url(); ?>Clogin/logout">
                                <i class="si si-logout mr-5"></i> Sign Out
                            </a>
                        </div>
                    </div>
                    <!-- END User Dropdown -->

                </div>
                <!-- END Right Section -->
            </div>
            <!-- END Header Content -->

            <!-- Header Search -->
            <div id="page-header-search" class="overlay-header">
                <div class="content-header content-header-fullrow">
                    <form>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <!-- Close Search Section -->
                                <!-- Layout API, functionality initialized in Codebase() -> uiApiLayout() -->
                                <button type="button" class="btn btn-secondary px-15" data-toggle="layout" data-action="header_search_off">
                                    <i class="fa fa-times"></i>
                                </button>
                                <!-- END Close Search Section -->
                            </div>
                            <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                            <div class="input-group-append">
                                <button type="submit" class="btn btn-secondary px-15">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- END Header Search -->

            <!-- Header Loader -->
            <div id="page-header-loader" class="overlay-header bg-primary">
                <div class="content-header content-header-fullrow text-center">
                    <div class="content-header-item">
                        <i class="fa fa-sun-o fa-spin text-white"></i>
                    </div>
                </div>
            </div>
            <!-- END Header Loader -->
        </header>
        <!-- END Header -->


        <Script>
            if (localStorage.getItem('sideBar-theme') == 'dark') {
                setDarkMode(true);
            }

            function setDarkMode(isDark) {
                var darksideButton = document.getElementById('darkSidebarButton1');
                var darksideButton2 = document.getElementById('darkSidebarButton2');
                if (isDark) {
                    document.getElementById("page-container").classList.add('sidebar-inverse');
                    localStorage.setItem('sideBar-theme', 'dark');
                    darksideButton.setAttribute('onclick', 'setDarkMode(false)');
                    darksideButton2.setAttribute('onclick', 'setDarkMode(false)');
                } else {
                    document.getElementById("page-container").classList.remove('sidebar-inverse');
                    localStorage.removeItem('sideBar-theme');
                    darksideButton.setAttribute('onclick', 'setDarkMode(true)');
                    darksideButton2.setAttribute('onclick', 'setDarkMode(true)');
                }
            }
        </Script>