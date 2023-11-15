<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard</title>
    <!-- base:css -->
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/vendors/typicons.font/font/typicons.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    
    <link href="<?php echo base_url; ?>Assets/css/jquery-ui.min.css" rel="stylesheet" />
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?php echo base_url; ?>Assets/img/logo.png" />
    
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/alertify.core.css" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/alertify.default.css" id="toggleCSS" />
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/vendors/fullcalendar/css/main.min.css"/>
    <link href="<?php echo base_url; ?>Assets/DataTables/datatables.min.css" rel="stylesheet" />

    <style>
        .ui-autocomplete {
            z-index: 5000;
        }
    </style>
</head>

<body class="sidebar-icon-only">
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
            <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
                <a class="navbar-brand brand-logo" href="<?php echo base_url; ?>">Renta Car</a>
                <a class="navbar-brand brand-logo-mini" href="<?php echo base_url; ?>">Renta Car</a>
                <button class="navbar-toggler navbar-toggler align-self-center d-none d-lg-flex" type="button" data-toggle="minimize">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
            <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
                <ul class="navbar-nav mr-lg-2">
                    <li class="nav-item  d-none d-lg-flex">
                        <a class="nav-link active" href="<?php echo base_url . 'reservas'; ?>">
                            Reservas
                        </a>
                    </li>
                </ul>
                <ul class="navbar-nav navbar-nav-right">
                    
                    <li class="nav-item nav-profile dropdown">
                        <a class="nav-link dropdown-toggle  pl-0 pr-0" href="#" data-toggle="dropdown" id="profileDropdown">
                            <i class="typcn typcn-user-outline mr-0"></i>
                            <span class="nav-profile-name"><?php echo $_SESSION['nombre']; ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                            <a class="dropdown-item" href="<?php echo base_url; ?>clientes/perfil">
                                <i class="typcn typcn-cog text-primary"></i>
                                Perfil
                            </a>
                            <a class="dropdown-item" href="<?php echo base_url; ?>usuarios/salir">
                                <i class="typcn typcn-power text-primary"></i>
                                Logout
                            </a>
                        </div>
                    </li>
                </ul>
                <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                    <span class="typcn typcn-th-menu"></span>
                </button>
            </div>
        </nav>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="typcn typcn-cog-outline"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close typcn typcn-delete-outline"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>
                        Light
                    </div>
                    <div class="sidebar-bg-options selected" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>
                        Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles primary"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default border"></div>
                    </div>
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            <nav class="sidebar sidebar-offcanvas" id="sidebar">
                <ul class="nav">
                    <li class="nav-item">
                        <div class="d-flex sidebar-profile">
                            <div class="sidebar-profile-image">
                                <img src="<?php echo base_url . 'assets/img/logo.png'; ?>" alt="image">
                                <span class="sidebar-status-indicator"></span>
                            </div>
                            <div class="sidebar-profile-name">
                                <p class="sidebar-name">
                                    <?php echo $_SESSION['nombre']; ?>
                                </p>
                                <p class="sidebar-designation">
                                    <?php echo $_SESSION['correo']; ?>
                                </p>
                            </div>
                        </div>
                        <p class="sidebar-menu-title">Dash menu</p>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="<?php echo base_url . 'reservas'; ?>">
                            <i class="typcn typcn-device-desktop menu-icon"></i>
                            <span class="menu-title">Reservas</span>
                        </a>
                    </li>
                </ul>

            </nav>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">