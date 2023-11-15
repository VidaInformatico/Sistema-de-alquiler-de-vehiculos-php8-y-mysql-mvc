<!DOCTYPE html>
<html lang="en">

<head>
    <title>Renta Card</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/animate.css">

    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/magnific-popup.css">

    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/aos.css">

    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/ionicons.min.css">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/css/intlTelInput.css">

    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/flaticon.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/icomoon.css">
    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/major/css/style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/major/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url; ?>Assets/major/slick/slick-theme.css"/>

    <link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/alertify.core.css" />
	<link rel="stylesheet" href="<?php echo base_url; ?>Assets/css/alertify.default.css" id="toggleCSS" />
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="<?php echo base_url; ?>">Renta<span>Car</span></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item <?php echo ($data['active'] == 'about') ? 'active' : ''; ?>"><a href="<?php echo base_url . 'about'; ?>" class="nav-link">Sobre Nosotros</a></li>
                    <li class="nav-item <?php echo ($data['active'] == 'services') ? 'active' : ''; ?>"><a href="<?php echo base_url . 'services'; ?>" class="nav-link">Servicios</a></li>
                    <li class="nav-item <?php echo ($data['active'] == 'pricing') ? 'active' : ''; ?>"><a href="<?php echo base_url . 'pricing'; ?>" class="nav-link">Precios</a></li>
                    <li class="nav-item <?php echo ($data['active'] == 'cars') ? 'active' : ''; ?>"><a href="<?php echo base_url . 'cars'; ?>" class="nav-link">Vehículos</a></li>
                    <li class="nav-item <?php echo ($data['active'] == 'contact') ? 'active' : ''; ?>"><a href="<?php echo base_url . 'contact'; ?>" class="nav-link">Contactos</a></li>
                    <li class="nav-item"><a href="<?php echo base_url . 'login'; ?>" class="nav-link">Login</a></li>
                </ul>
            </div>
        </div>
    </nav>