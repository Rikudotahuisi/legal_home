<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Legal Home</title>
    <meta name="description" content="" />
    <meta name="keywords" content="" />

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/css/navbar.css" />
    <link rel="stylesheet" href="/assets/css/about.css" />
    <link rel="stylesheet" href="/assets/css/home.css" />
    <link rel="stylesheet" href="/assets/css/legalitas.css" />

    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />

    <link href="/theme/home/assets/vendor/aos/aos.css" rel="stylesheet" />
    <link href="/theme/home/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
    <link href="/theme/home/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet" />
    <link href="/theme/home/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet" />
    <link href="/theme/home/assets/vendor/remixicon/remixicon.css" rel="stylesheet" />
    <link href="/theme/home/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet" />

    <link href="/css/about.css" rel="stylesheet" />
    <link href="/css/login.css" rel="stylesheet" />
    <link href="/css/contact.css" rel="stylesheet" />
    <link href="/css/user.css" rel="stylesheet" />
    <link href="/css/footer.css" rel="stylesheet" />

    <!-- Favicons -->
    <link href="/theme/home/assets/img/favicon.png" rel="icon" />
    <link href="/theme/home/assets/img/apple-touch-icon.png" rel="apple-touch-icon" />

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400&family=Roboto:wght@600&display=swap" rel="stylesheet" />

</head>

<body>
    <!-- AOS -->
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

    @include('master.layout_home.header')

    @yield('content')

    @include('master.layout_home.footer')

    <!-- JS VENDOR -->
    <script src="/theme/home/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/theme/home/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/theme/home/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/theme/home/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/theme/home/assets/vendor/php-email-form/validate.js"></script>
    <script src="/theme/home/assets/js/main.js"></script>

    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')
</body>
</html>
