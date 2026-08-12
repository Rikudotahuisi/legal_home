@extends('master.master')
@section('content')
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="assets/img/jaksa3.jpg" class="d-block w-100" alt="...">
                <!-- PERBAIKAN 1: HAPUS d-none d-md-block -->
                <div class="carousel-caption">
                    <h5>Selamat Datang di Home Legal</h5>
                    <p>Tempat di mana keamanan hukum bukan hanya hak, tetapi juga ke nyamanan. Bersama kami, kepastian hukum ada di ujung jari Anda. </p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/jaksa2.jpg" class="d-block w-100" alt="...">
                <!-- PERBAIKAN 2: HAPUS d-none d-md-block -->
                <div class="carousel-caption">
                    <h5>Akses Cepat, Solusi Terpercaya.</h5>
                    <p>Home Legal mempersembahkan akses cepat ke konsultasi ahli dan solusi hukum terpercaya.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="assets/img/jaksa1.jpg" class="d-block w-100" alt="...">
                <!-- PERBAIKAN 3: HAPUS d-none d-md-block -->
                <div class="carousel-caption">
                    <h5>Keamanan Hukum Tanpa Batas Waktu</h5>
                    <p>Jangan biarkan kepastian hukum menjadi hal yang rumit. Dengan Home Legal, keamanan hukum Anda dapat diakses kapan saja dan di mana saja.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

<div class="container-fluid">
    <section id="hero" class="d-flex align-items-center">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 d-flex flex-column justify-content-center pt-4 pt-lg-0 order-2 order-lg-1">
                    <h2 class="text-dark">Temukan Kepastian Hukum Anda Bersama Home Legal.</h2>
                    <p class="text-dark">Jelajahi Dunia Hukum dengan LegalHome - Tempat di Mana Setiap Hak Anda Diperjuangkan. Dengan mendaftar sekarang, Anda tidak hanya mendapatkan akses eksklusif ke konsultasi hukum online dan penyusunan dokumen, tetapi juga menjadi bagian dari komunitas hukum modern kami. Bergabunglah hari ini untuk mendapatkan kepastian hukum dengan mudah dan cepat. Daftarkan diri Anda, karena setiap langkah awal menuju keamanan hukum dimulai di sini.</p>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="{{ route('register') }}" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>
                <div class="col-lg-6 order-1 order-lg-2 hero-img">
                    <img src="assets/img/img1.jpg" class="img-fluid" alt="" />
                </div>
            </div>
        </div>
    </section>
</div>

@endsection