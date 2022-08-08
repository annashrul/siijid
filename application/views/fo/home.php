<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="sistem informasi masjid">
    <meta name="author" content="Annashrul Yusuf">
    <title>SISTEM INFROMASI MASJID ( SI-IJID )</title>
    <!-- Extra details for Live View on GitHub Pages -->
    <!-- Canonical SEO -->
    <link rel="canonical" href="<?=base_url('assets/logo-masjid.png')?>" />
    <!--  Social tags      -->
    <meta name="keywords" content="sistem informasi masjid, aplikasi masjid, aplikasi menejemen masjid, aplikasi masjid berbasis web">
    <!-- Schema.org markup for Google+ -->
    <meta itemprop="name" content="sistem informasi masjid">
    <meta itemprop="description" content="sistem informasi masjid">
    <meta itemprop="image" content="<?=base_url('assets/logo-masjid.png')?>">
    <!-- Twitter Card data -->
    <meta name="twitter:card" content="product">
    <meta name="twitter:site" content="@annashrulyusuf">
    <meta name="twitter:title" content="sistem informasi masjid">
    <meta name="twitter:description" content="sistem informasi masjid">
    <meta name="twitter:creator" content="@annashrulyusuf">
    <meta name="twitter:image" content="<?=base_url('assets/logo-masjid.png')?>">
    <!-- Open Graph data -->
    <meta property="fb:app_id" content="655968634437471">
    <meta property="og:title" content="sistem informasi masjid" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="https://masjid.anasrulysf.com" />
    <meta property="og:image" content="<?=base_url('assets/logo-masjid.png')?>" />
    <meta property="og:description" content="sistem informasi masjid" />
    <meta property="og:site_name" content="sistem informasi masjid" />
    <!-- Google Tag Manager -->
    <script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-NKDMSK6');
    </script>
    <!-- End Google Tag Manager -->
    <!-- Favicon -->
    <link href="<?=base_url('assets/logo-masjid.png')?>" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=ZCOOL+QingKe+HuangYou" rel="stylesheet">
    
    <!-- Icons -->
    <link href="<?=base_url().'assets/fo/'?>assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="<?=base_url().'assets/fo/'?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?=base_url().'assets/plugin/'?>jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- Argon CSS -->
    <link type="text/css" href="<?=base_url().'assets/fo/'?>assets/css/argon.min.css?v=1.0.1" rel="stylesheet">
    <!-- Docs CSS -->
    
    <script src="<?=base_url().'assets/fo/'?>assets/vendor/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url().'assets/plugin/'?>jQuery/jquery-2.2.3.min.js"></script>
    
    <script type="text/javascript" src="<?=base_url().'assets/plugin/'?>jQuery-autocomplete/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="<?=base_url().'assets/plugin/'?>jquery-validation/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?=base_url().'assets/plugin/'?>jquery-validation/additional-methods.min.js"></script>

</head>
<style>
    html{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    body{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    ul{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    li{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    a{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    small{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    title{font-family: 'ZCOOL QingKe HuangYou', cursive!important;}
    .autocomplete-suggestions { border: 1px solid #999; background: #fff; cursor: default; overflow: auto; }
    .autocomplete-suggestion { padding: 10px 5px; font-size: 1.2em; white-space: nowrap; overflow: hidden; }
    .autocomplete-selected { background: #f0f0f0; }
    .autocomplete-suggestions strong { font-weight: normal; color: #3399ff; }
    ::-webkit-input-placeholder { /* Chrome/Opera/Safari */
        font-family: 'ZCOOL QingKe HuangYou', cursive!important;
        color: #525f7f!important;
    }
    ::-moz-placeholder { /* Firefox 19+ */
        font-family: 'ZCOOL QingKe HuangYou', cursive!important;
        color: #525f7f!important;
    }
    :-ms-input-placeholder { /* IE 10+ */
        font-family: 'ZCOOL QingKe HuangYou', cursive!important;
        color: #525f7f!important;
    }
    :-moz-placeholder { /* Firefox 18- */
        font-family: 'ZCOOL QingKe HuangYou', cursive!important;
        color: #525f7f!important;
    }
    input[type=email]
    {
        font-family: 'ZCOOL QingKe HuangYou', cursive!important;
        color: #525f7f!important;
    }
    input.controls{
        font-family: 'ZCOOL QingKe HuangYou', cursive!important;
        color: #525f7f!important;
    }
    /*Scrollbar*/
    .scrollbar
    {
        width: 100%;
        height: 100%;
        overflow-y: scroll;
        overflow-x: hidden;
    }
    .scrollbar::-webkit-scrollbar-track
    {
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3);
        border-radius: 0px;
        background-color: #F5F5F5;
    }
    
    .scrollbar::-webkit-scrollbar
    {
        width: 0px;
        background-color: #F5F5F5;
    }
    
    .scrollbar::-webkit-scrollbar-thumb
    {
        border-radius: 0px;
        -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,.3);
        background-color: rgba(0, 151, 167, 1);
    }
    .has-error{color:red!important;font-size: 14px!important;}
</style>
<style>
    
    a[href^="http://maps.google.com/maps"]{display:none !important}
    a[href^="https://maps.google.com/maps"]{display:none !important}
    
    .gmnoprint a, .gmnoprint span, .gm-style-cc {
        display:none;
    }
    .gmnoprint div {
        background:none !important;
    }
    #map {
        height: 200px;
        width: 100%;
    }
    
    #description {
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
    }
    
    #infowindow-content .title {
        font-weight: bold;
    }
    
    #infowindow-content {
        display: none;
    }
    
    #map #infowindow-content {
        display: inline;
    }
    
    .pac-card {
        margin: 10px 10px 0 0;
        border-radius: 2px 0 0 2px;
        box-sizing: border-box;
        -moz-box-sizing: border-box;
        outline: none;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
        background-color: #fff;
        font-family: Roboto;
    }
    
    #pac-container {
        padding-bottom: 12px;
        margin-right: 12px;
    }
    
    .pac-controls {
        display: inline-block;
        padding: 5px 11px;
    }
    
    .pac-controls label {
        font-family: Roboto;
        font-size: 13px;
        font-weight: 300;
    }
    
    #pac-input {
        background-color: #fff;
        font-family: Roboto;
        font-size: 15px;
        font-weight: 300;
        padding: 0 11px 0 13px;
        text-overflow: ellipsis;
        width: 100%;
    }
    
    #pac-input:focus {
        border-color: #4d90fe;
    }
    
    #title {
        color: #fff;
        background-color: #4d90fe;
        font-size: 25px;
        font-weight: 500;
        padding: 6px 12px;
    }
    #target {
        width: 345px;
    }
    .pac-container {
        background-color: #FFF;
        z-index: 1050;
        position: fixed;
        display: inline-block;
        float: left;
    }
</style>
<body>

<!-- Extra details for Live View on GitHub Pages -->
<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->
<header class="header-global">
    <nav id="navbar-main" class="navbar navbar-main navbar-expand-lg navbar-transparent navbar-light headroom">
        <div class="container">
            <a class="navbar-brand mr-lg-12" href="../index.html">
                <!--        <img src="--><?//=base_url('assets/logo-masjid.png')?><!--">-->
                <h1 class="display-3  text-white"><i class="ni ni-istanbul"></i> SI-IJID</h1>
                <h1 class="display-3  text-white" id="test"><i class="ni ni-istanbul"></i> </h1>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-collapse collapse" id="navbar_global">
                <div class="navbar-collapse-header">
                    <div class="row">
                        <div class="col-6 collapse-brand">
                            <a href="<?=base_url()?>">
                                <i class="ni ni-istanbul"></i> <small>MASJID GBI RW 08</small>
                            </a>
                        </div>
                        <div class="col-6 collapse-close">
                            <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar_global" aria-controls="navbar_global" aria-expanded="false" aria-label="Toggle navigation">
                                <span></span>
                                <span></span>
                            </button>
                        </div>
                    </div>
                </div>
                <ul class="navbar-nav navbar-nav-hover align-items-lg-center">
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#">
                            <span class="nav-link-inner--text">Fitur</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#">
                            <span class="nav-link-inner--text">Fasilitas</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#">
                            <span class="nav-link-inner--text">Assets</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link nav-link-icon" href="#">
                            <span class="nav-link-inner--text">Assets</span>
                        </a>
                    </li>
                </ul>
            
            </div>
        </div>
    </nav>
</header>
<main>
    <div class="position-relative">
        <!-- shape Hero -->
        <section class="section section-lg section-shaped pb-250">
            <div class="shape shape-style-1 shape-default">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
            <div class="container py-lg-md d-flex">
                <div class="col px-0">
                    <div class="row">
                        <div class="col-lg-6">
                            <h1 class="display-3  text-white">GRATIS</h1>
                            <h1 class="display-3  text-white">Sistem Desain yang Indah, Tepat dan Akurat</h1>
                            <p class="lead  text-white">
                                Sistem dilengkapi dengan fitur - fitur yang lengkap untuk memanejemen masjid anda.
                            </p>
                            
                            <div class="btn-wrapper">
                                <button class="btn btn-info btn-icon mb-3 mb-sm-0" onclick="add()">
                                    <span class="btn-inner--icon"><i class="fa fa-user"></i></span>
                                    <span class="btn-inner--text">Registrasi</span>
                                </button>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
            <!-- SVG separator -->
            <div class="separator separator-bottom separator-skew">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </section>
        <!-- 1st Hero Variation -->
    </div>
    <section class="section section-lg pt-lg-0 mt--200">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row row-grid">
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5">
                                    <div class="icon icon-shape icon-shape-primary rounded-circle mb-4">
                                        <i class="fa fa-pencil"></i>
                                    </div>
                                    <h6 class="text-primary text-uppercase">Registrasi</h6>
                                    <p class="description mt-3">Daftarkan Masjid Anda Untuk Menggunakan Sistem Ini.</p>
                                    <div>
                                        <span class="badge badge-pill badge-primary">design</span>
                                        <span class="badge badge-pill badge-primary">system</span>
                                        <span class="badge badge-pill badge-primary">creative</span>
                                    </div>
                                    <a href="#" class="btn btn-primary mt-4">Learn more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5">
                                    <div class="icon icon-shape icon-shape-success rounded-circle mb-4">
                                        <i class="fa fa-lock"></i>
                                    </div>
                                    <h6 class="text-success text-uppercase">Verifikasi</h6>
                                    <p class="description mt-3">Verifikasi Akun Anda Untuk Menyetujui Persyaratan Yang Berlaku.</p>
                                    <div>
                                        <span class="badge badge-pill badge-success">business</span>
                                        <span class="badge badge-pill badge-success">vision</span>
                                        <span class="badge badge-pill badge-success">success</span>
                                    </div>
                                    <a href="#" class="btn btn-success mt-4">Learn more</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card card-lift--hover shadow border-0">
                                <div class="card-body py-5">
                                    <div class="icon icon-shape icon-shape-warning rounded-circle mb-4">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                    <h6 class="text-warning text-uppercase">Gunakan</h6>
                                    <p class="description mt-3">Selamat Menggunakan Aplikasi Sistem Informasi Masjid, Semoga Masjid Anda Bisa terkelola Dengan Baik.</p>
                                    <div>
                                        <span class="badge badge-pill badge-warning">marketing</span>
                                        <span class="badge badge-pill badge-warning">product</span>
                                        <span class="badge badge-pill badge-warning">launch</span>
                                    </div>
                                    <a href="#" class="btn btn-warning mt-4">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <section class="section pb-0 bg-gradient-warning">
        <div class="container">
            <div class="row row-grid align-items-center">
                <div class="col-md-6 order-lg-2 ml-lg-auto">
                    <div class="position-relative pl-md-5">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/ill/ill-2.svg" class="img-center img-fluid">
                    </div>
                </div>
                <div class="col-lg-6 order-lg-1">
                    <div class="d-flex px-3">
                        <div>
                            <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                                <i class="ni ni-building text-primary"></i>
                            </div>
                        </div>
                        <div class="pl-4">
                            <h4 class="display-3 text-white">Modern Interface</h4>
                            <p class="text-white">The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever.</p>
                        </div>
                    </div>
                    <div class="card shadow shadow-lg--hover mt-5">
                        <div class="card-body">
                            <div class="d-flex px-3">
                                <div>
                                    <div class="icon icon-shape bg-gradient-success rounded-circle text-white">
                                        <i class="ni ni-satisfied"></i>
                                    </div>
                                </div>
                                <div class="pl-4">
                                    <h5 class="title text-success">Awesome Support</h5>
                                    <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever.</p>
                                    <a href="#" class="text-success">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow shadow-lg--hover mt-5">
                        <div class="card-body">
                            <div class="d-flex px-3">
                                <div>
                                    <div class="icon icon-shape bg-gradient-warning rounded-circle text-white">
                                        <i class="ni ni-active-40"></i>
                                    </div>
                                </div>
                                <div class="pl-4">
                                    <h5 class="title text-warning">Modular Components</h5>
                                    <p>The Arctic Ocean freezes every winter and much of the sea-ice then thaws every summer, and that process will continue whatever.</p>
                                    <a href="#" class="text-warning">Learn more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <section class="section section-lg">
        <div class="container">
            <div class="row justify-content-center text-center mb-lg">
                <div class="col-lg-8">
                    <h2 class="display-3">The amazing Team</h2>
                    <p class="lead text-muted">According to the National Oceanic and Atmospheric Administration, Ted, Scambos, NSIDClead scentist, puts the potentially record maximum.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="px-4">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/theme/team-1-800x800.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                        <div class="pt-4 text-center">
                            <h5 class="title">
                                <span class="d-block mb-1">Ryan Tompson</span>
                                <small class="h6 text-muted">Web Developer</small>
                            </h5>
                            <div class="mt-3">
                                <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-warning btn-icon-only rounded-circle">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="px-4">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/theme/team-2-800x800.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                        <div class="pt-4 text-center">
                            <h5 class="title">
                                <span class="d-block mb-1">Romina Hadid</span>
                                <small class="h6 text-muted">Marketing Strategist</small>
                            </h5>
                            <div class="mt-3">
                                <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-primary btn-icon-only rounded-circle">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="px-4">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/theme/team-3-800x800.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                        <div class="pt-4 text-center">
                            <h5 class="title">
                                <span class="d-block mb-1">Alexander Smith</span>
                                <small class="h6 text-muted">UI/UX Designer</small>
                            </h5>
                            <div class="mt-3">
                                <a href="#" class="btn btn-info btn-icon-only rounded-circle">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-icon-only rounded-circle">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-info btn-icon-only rounded-circle">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3 mb-5 mb-lg-0">
                    <div class="px-4">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/theme/team-4-800x800.jpg" class="rounded-circle img-center img-fluid shadow shadow-lg--hover" style="width: 200px;">
                        <div class="pt-4 text-center">
                            <h5 class="title">
                                <span class="d-block mb-1">John Doe</span>
                                <small class="h6 text-muted">Founder and CEO</small>
                            </h5>
                            <div class="mt-3">
                                <a href="#" class="btn btn-success btn-icon-only rounded-circle">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="btn btn-success btn-icon-only rounded-circle">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="btn btn-success btn-icon-only rounded-circle">
                                    <i class="fa fa-dribbble"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg pt-0">
        <div class="container">
            <div class="card bg-gradient-warning shadow-lg border-0">
                <div class="p-5">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <h3 class="text-white">We made website building easier for you.</h3>
                            <p class="lead text-white mt-3">I will be the leader of a company that ends up being worth billions of dollars, because I got the answers. I understand culture.</p>
                        </div>
                        <div class="col-lg-3 ml-lg-auto">
                            <a href="https://www.creative-tim.com/product/argon-design-system" class="btn btn-lg btn-block btn-white">Download HTML</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg bg-gradient-default">
        <div class="container pt-lg pb-300">
            <div class="row text-center justify-content-center">
                <div class="col-lg-10">
                    <h2 class="display-3 text-white">Build something</h2>
                    <p class="lead text-white">According to the National Oceanic and Atmospheric Administration, Ted, Scambos, NSIDClead scentist, puts the potentially record low maximum sea ice extent tihs year down to low ice.</p>
                </div>
            </div>
            <div class="row row-grid mt-5">
                <div class="col-lg-4">
                    <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                        <i class="ni ni-settings text-primary"></i>
                    </div>
                    <h5 class="text-white mt-3">Building tools</h5>
                    <p class="text-white mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="col-lg-4">
                    <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                        <i class="ni ni-ruler-pencil text-primary"></i>
                    </div>
                    <h5 class="text-white mt-3">Grow your market</h5>
                    <p class="text-white mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
                <div class="col-lg-4">
                    <div class="icon icon-lg icon-shape bg-gradient-white shadow rounded-circle text-primary">
                        <i class="ni ni-atom text-primary"></i>
                    </div>
                    <h5 class="text-white mt-3">Launch time</h5>
                    <p class="text-white mt-3">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                </div>
            </div>
        </div>
        <!-- SVG separator -->
        <div class="separator separator-bottom separator-skew zindex-100">
            <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
                <polygon class="fill-white" points="2560 0 2560 100 0 100"></polygon>
            </svg>
        </div>
    </section>
    <section class="section section-lg pt-lg-0 section-contact-us">
        <div class="container">
            <div class="row justify-content-center mt--300">
                <div class="col-lg-8">
                    <div class="card bg-gradient-secondary shadow">
                        <div class="card-body p-lg-5">
                            <h4 class="mb-1">Want to work with us?</h4>
                            <p class="mt-0">Your project is very important to us.</p>
                            <div class="form-group mt-5">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-user-run"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Your name" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control" placeholder="Email address" type="email">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <textarea class="form-control form-control-alternative" name="name" rows="4" cols="80" placeholder="Type a message..."></textarea>
                            </div>
                            <div>
                                <button type="button" class="btn btn-default btn-round btn-block btn-lg">Send Message</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section section-lg">
        <div class="container">
            <div class="row row-grid justify-content-center">
                <div class="col-lg-8 text-center">
                    <h2 class="display-3">Do you love this awesome
                        <span class="text-success">Design System for Bootstrap 4?</span>
                    </h2>
                    <p class="lead">Cause if you do, it can be yours for FREE. Hit the button below to navigate to Creative Tim where you can find the Design System in HTML. Start a new project or give an old Bootstrap project a new look!</p>
                    <div class="btn-wrapper">
                        <a href="https://www.creative-tim.com/product/argon-design-system" class="btn btn-primary mb-3 mb-sm-0">Download HTML</a>
                    </div>
                    <div class="text-center">
                        <h4 class="display-4 mb-5 mt-5">Available on these technologies</h4>
                        <div class="row justify-content-center">
                            <div class="col-lg-2 col-4">
                                <a href="https://www.creative-tim.com/product/argon-design-system" target="_blank" data-toggle="tooltip" data-original-title="Bootstrap 4 - Most popular front-end component library">
                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/bootstrap.jpg" class="img-fluid">
                                </a>
                            </div>
                            <div class="col-lg-2 col-4">
                                <a href=" https://www.creative-tim.com/product/vue-argon-design-system" target="_blank" data-toggle="tooltip" data-original-title="Vue.js - The progressive javascript framework">
                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/vue.jpg" class="img-fluid">
                                </a>
                            </div>
                            <div class="col-lg-2 col-4">
                                <a href=" https://www.sketchapp.com/" target="_blank" data-toggle="tooltip" data-original-title="[Coming Soon] Sketch - Digital design toolkit">
                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/sketch.jpg" class="img-fluid opacity-3">
                                </a>
                            </div>
                            <div class="col-lg-2 col-4">
                                <a href=" https://www.adobe.com/products/photoshop.html" target="_blank" data-toggle="tooltip" data-original-title="[Coming Soon] Adobe Photoshop - Software for digital images manipulation">
                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/ps.jpg" class="img-fluid opacity-3">
                                </a>
                            </div>
                            <div class="col-lg-2 col-4">
                                <a href=" https://angularjs.org/" target="_blank" data-toggle="tooltip" data-original-title="[Coming Soon] Angular - One framework. Mobile &amp; desktop">
                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/angular.jpg" class="img-fluid opacity-3">
                                </a>
                            </div>
                            <div class="col-lg-2 col-4">
                                <a href=" https://angularjs.org/" target="_blank" data-toggle="tooltip" data-original-title="[Coming Soon] React - A JavaScript library for building user interfaces">
                                    <img src="https://s3.amazonaws.com/creativetim_bucket/tim_static_images/presentation-page/react.jpg" class="img-fluid opacity-3">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
<footer class="footer has-cards">
    <div class="container container-lg">
        <div class="row">
            <div class="col-md-6 mb-5 mb-md-0">
                <div class="card card-lift--hover shadow border-0">
                    <a href="../examples/landing.html" title="Landing Page">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/theme/landing.jpg" class="card-img">
                    </a>
                </div>
            </div>
            <div class="col-md-6 mb-5 mb-lg-0">
                <div class="card card-lift--hover shadow border-0">
                    <a href="../examples/profile.html" title="Profile Page">
                        <img src="<?=base_url().'assets/fo/'?>assets/img/theme/profile.jpg" class="card-img">
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row row-grid align-items-center my-md">
            <div class="col-lg-6">
                <h3 class="text-primary font-weight-light mb-2">Thank you for supporting us!</h3>
                <h4 class="mb-0 font-weight-light">Let's get in touch on any of these platforms.</h4>
            </div>
            <div class="col-lg-6 text-lg-center btn-wrapper">
                <a target="_blank" href="https://twitter.com/creativetim" class="btn btn-neutral btn-icon-only btn-twitter btn-round btn-lg" data-toggle="tooltip" data-original-title="Follow us">
                    <i class="fa fa-twitter"></i>
                </a>
                <a target="_blank" href="https://www.facebook.com/creativetim" class="btn btn-neutral btn-icon-only btn-facebook btn-round btn-lg" data-toggle="tooltip" data-original-title="Like us">
                    <i class="fa fa-facebook-square"></i>
                </a>
                <a target="_blank" href="https://dribbble.com/creativetim" class="btn btn-neutral btn-icon-only btn-dribbble btn-lg btn-round" data-toggle="tooltip" data-original-title="Follow us">
                    <i class="fa fa-dribbble"></i>
                </a>
                <a target="_blank" href="https://github.com/creativetimofficial" class="btn btn-neutral btn-icon-only btn-github btn-round btn-lg" data-toggle="tooltip" data-original-title="Star on Github">
                    <i class="fa fa-github"></i>
                </a>
            </div>
        </div>
        <hr>
        <div class="row align-items-center justify-content-md-between">
            <div class="col-md-6">
                <div class="copyright">
                    &copy; 2018
                    <a href="https://www.creative-tim.com" target="_blank">Creative Tim</a>.
                </div>
            </div>
            <div class="col-md-6">
                <ul class="nav nav-footer justify-content-end">
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com" class="nav-link" target="_blank">Creative Tim</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
                    </li>
                    <li class="nav-item">
                        <a href="https://github.com/creativetimofficial/argon-design-system/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>
<!--MODAL REGISTRASI-->
<div id="modal_form" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" id="form_input">
                            <div class="col-lg-12">
                                <div class="row row-grid">
                                    <div class="col-sm-6">
                                        <h3 class="text-center">Profile Akun</h3>
                                        <div class="form-group">
                                            <label>Nama</label>
                                            <input class="form-control" type="text" id="nama" name="nama" placeholder="Nama" />
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis kelamin</label>
                                            <select name="jenkel" id="jenkel" class="form-control">
                                                <option value="Laki-Laki">Laki-Laki</option>
                                                <option value="Perempuan">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="row row-grid">
                                                <div class="col-sm-10">
                                                    <label>Photo</label>
                                                    <input id="file_upload" type="file" class="form-control" name="file_upload" onchange="return ValidateFileUpload()" accept="image/*">
                                                </div>
                                                <style>
                                                    #wrapper_img_result{height:45px;bottom: 0;margin-top: 32px;padding-left:0px;}
                                                    #result_image{width:100%!important;height:45px;}
                                                </style>
                                                <div class="col-sm-2" id="wrapper_img_result">
                                                    <img style="" src="<?=base_url().'assets/no_data.png'?>" id="result_image">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <h3 class="text-center">Profile Masjid</h3>
                                        <div class="form-group">
                                            <label>Nama Masjid</label>
                                            <input class="form-control" type="text" id="nama_masjid" name="nama_masjid" placeholder="Nama Masjid" />
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Berdiri Masjid</label>
                                            <input class="form-control" type="date" id="thn_berdiri" name="thn_berdiri"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Cari Lokasi / Tandai Peta</label>
                                            <input id="pac-input" class="controls form-control" name="peta" type="text" placeholder="Cari Lokasi / Tandai Peta">
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-12">
                                        <div id="map"></div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Username</label>
                                            <input class="form-control" type="text" id="username" name="username" placeholder="Username" />
                                        </div>
                                        <div class="form-group">
                                            <label>Password</label>
                                            <div class="input-group mb-3">
                                                <input type="password" id="password" class="form-control" name="password" placeholder="Password" >
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon" onclick="show_pass()"><i class="fa cek fa-eye"></i></span>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Alamat Masjid</label>
                                            <textarea type="text" name="alamat" class="form-control" id="alamat" rows="4" placeholder="Alamat" style="height:108px;" readonly></textarea>
                                        </div>
                                    </div>
                                
                                </div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4" id="simpan" name="simpan">Daftar</button>
                                <button type="submit" class="btn btn-primary my-4" id="simpan" name="simpan">Daftar</button>
                                <input type="hidden" name="lng" id="lng">
                                <input type="hidden" name="lat" id="lat">
                                <input type="hidden" name="param" id="param" value="add">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Core -->


<script>
	$("#pac-input").keypress(function (e) {
		if (e.keyCode == 13) {
			return false;
		}
	});
	
	
	
	function initMap(zoom_=14, lat_=-6.9228583, lng_=107.6058134, id_='map', param_='edit') {
		var uluru = {lat: lat_, lng: lng_};
		var map = new google.maps.Map(document.getElementById(id_), {
			zoom: zoom_,
			center: uluru
		});
		
		var geocoder = new google.maps.Geocoder;
		
		var marker = new google.maps.Marker({
			map: map
		});
		
		// Create the search box and link it to the UI element.
		var input = document.getElementById('pac-input');
		var searchBox = new google.maps.places.SearchBox(input);
		//map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
		
		// Bias the SearchBox results towards current map's viewport.
		map.addListener('bounds_changed', function() {
			searchBox.setBounds(map.getBounds());
		});
		
		var markers = [];
		// Listen for the event fired when the user selects a prediction and retrieve
		// more details for that place.
		searchBox.addListener('places_changed', function() {
			var places = searchBox.getPlaces();
			
			if (places.length == 0) {
				return;
			}
			
			// Clear out the old markers.
			markers.forEach(function(marker) {
				marker.setMap(null);
			});
			markers = [];
			
			// For each place, get the icon, name and location.
			var bounds = new google.maps.LatLngBounds();
			places.forEach(function(place) {
				if (!place.geometry) {
					console.log("Returned place contains no geometry");
					return;
				}
				
				// Create a marker for each place.
				markers.push(new google.maps.Marker({
					map: map,
					title: place.name,
					position: place.geometry.location
				}));
				
				if (place.geometry.viewport) {
					// Only geocodes have viewport.
					bounds.union(place.geometry.viewport);
					$("#alamat").val(place.formatted_address);
					$("#lat").val(place.geometry.location.lat());
					$("#lng").val(place.geometry.location.lng());
				} else {
					bounds.extend(place.geometry.location);
				}
			});
			map.fitBounds(bounds);
		});
		
		if (param_ == 'set' || $("#param").val()=='edit') {
			marker.setPosition(uluru);
		}
		
		google.maps.event.addListener(map, 'click', function(e) {
			if (param_ == 'edit') {
				var latLng = e.latLng;
				marker.setPosition(latLng);
				$("#lat").val(latLng.lat());
				$("#lng").val(latLng.lng());
				markers.forEach(function(marker) {
					marker.setMap(null);
				});
				geocoder.geocode({
					'latLng': latLng
				}, function (results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						if (results[0]) {
							$("#alamat").val(results[0].formatted_address);
							$("#pac-input").val('');
						}
					}
				});
			}
		});
	}
</script>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyDqD1Z03FoLnIGJTbpAgRvjcchrR-NiICk&libraries=places&sensor=false"></script>
<script type="text/javascript">
	api_jadwa_sholat()
	function api_jadwa_sholat(){
		$.ajax({
			url : "http://localhost/masjid/api/api_jadwal_sholat",
			type : "POST",
			dataType : "JSON",
			success : function(res){
				var obj=res.data;
				html="";
				for(var i=0;i<obj.length;i++){
					console.log(obj[i].timings)
				}
				console.log(html);
			}
		});
	}
	
	function show_pass() {
		var x = document.getElementById("password");
		if (x.type === "password") {
			x.type = "text";
			$(".cek").removeClass("fa-eye").addClass("fa-eye-slash");
		} else {
			x.type = "password";
			$(".cek").removeClass("fa-eye-slash").addClass("fa-eye");
		}
	}
	function add() {
		$("#modal_form").modal("show");
		$("#param").val("add");
		initMap();
		setTimeout(function () {
			$("#nama").focus();
		}, 600);
	}
	
	$('#form_input').validate({
		rules: {
			nama        : {required: true},
			nama_masjid : {required: true},
			thn_berdiri : {required: true},
			peta        : {required: true},
			alamat      : {required: true},
			username    : {required: true},
			password    : {required: true},
			file_upload : {required: true,extension: "png,jpg"},
		},
		messages: {
			nama:{required: "Nama Tidak Boleh Kosong!"},
			nama_masjid:{required: "Nama Masjid Tidak Boleh Kosong!"},
			thn_berdiri:{required: "Tahun Berdiri Masjid Tidak Boleh Kosong!"},
			peta:{required: "Tandai Peta Untuk Mendapatkan Alamat Lengkap!"},
			alamat:{required: "Alamat Masjid tidak boleh kosong!"},
			username    : {required: "Username Tidak Boleh Kosong"},
			password    : {required: "Password Tidak Boleh Kosong"},
			file_upload : {required: "Photo Tidak Boleh Kosong",extension:"Masukan Type File jpg atau png"},
			
		},
		highlight: function(element) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		errorElement: 'span',
		errorClass: 'help-block',
		errorPlacement: function(error, element) {
			if(element.parent('.input-group').length) {
				error.insertAfter(element.parent());
			} else {
				error.insertAfter(element);
			}
		},
		submitHandler: function (form) {
			swal({
				type: 'success',
				title: 'Success!',
				text: 'Data Has Been Saved'
			});
//      var myForm = document.getElementById('form_input');
//      $.ajax({
//        url: "<?//=base_url().'fo/register'?>//",
//        type: "POST",
//        data: new FormData(myForm),
//        mimeType: "multipart/form-data",
//        contentType: false,
//        processData: false,
//        beforeSend: function() {
//          $('body').append('<div class="first-loader"><img src="<?//=base_url().'/assets/bo/images/spin.svg'?>//"></div>');
//        },
//        complete: function() {
//          $('.first-loader').remove();
//        },
//        success: function (res) {
//          if (res) {
//            $("#modal_form").modal('hide');
//            swal({
//              type: 'success',
//              title: 'Success!',
//              text: 'Data Has Been Saved'
//            });
//            load_data($("#hal").val());
//          } else {
//            swal({
//              title: 'Error',
//              text: "an error occurred on the server",
//              type: 'warning',
//              confirmButtonColor: '#ff0000',
//              confirmButtonText: 'Oke',
//            })
//            console.log(xhr.responseText);
//          }
//        }
//      });
		}
	});
	
	
	function ValidateFileUpload() {
		var fuData = document.getElementById('file_upload');
		var FileUploadPath = fuData.value;
		var valid = 1;
		$("#alr_file_upload").text("");
		if (FileUploadPath == '') {
		} else {
			var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
			
			if (Extension == "gif" || Extension == "png" || Extension == "bmp" || Extension == "jpeg" || Extension == "jpg") {
				if (fuData.files && fuData.files[0]) {
					var reader = new FileReader();
					reader.onload = function(e) {
						$('#result_image').attr('src', e.target.result);
					};
					reader.readAsDataURL(fuData.files[0]);
				}
			}
		}
		return valid;
	}

</script>
<script>
	$(document).ready(function() {
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-46172202-1']);
		_gaq.push(['_trackPageview']);
		
		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
		})();
		
		// Facebook Pixel Code Don't Delete
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window,
			document, 'script', '//connect.facebook.net/en_US/fbevents.js');
		
		try {
			fbq('init', '111649226022273');
			fbq('track', "PageView");
			
		} catch (err) {
			console.log('Facebook Track Error:', err);
		}
		
	});
</script>
<noscript>
    <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=111649226022273&ev=PageView&noscript=1" />
</noscript>
<script src="<?=base_url().'assets/fo/'?>assets/vendor/popper/popper.min.js"></script>
<script src="<?=base_url().'assets/fo/'?>assets/vendor/bootstrap/bootstrap.min.js"></script>

<script src="<?=base_url().'assets/fo/'?>assets/vendor/headroom/headroom.min.js"></script>

<!--Swal2-->
<link href="<?=base_url().'assets/plugin/'?>sweetalert2/sweetalert2-1.3.3.min.css" rel="stylesheet">
<link href="<?=base_url().'assets/plugin/'?>sweetalert2/sweetalert2-0.4.5.css" rel="stylesheet">
<script src="<?=base_url().'assets/plugin/'?>sweetalert2/sweetalert2-1.3.3.min.js"></script>
<!-- jvectormap -->
<script src="<?=base_url().'assets/plugin/'?>jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="<?=base_url().'assets/plugin/'?>jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- Argon JS -->
<script src="<?=base_url().'assets/fo/'?>assets/js/argon.min.js?v=1.0.1"></script>




</body>

</html>