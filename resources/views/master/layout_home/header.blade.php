<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-light fixed-top py-3 custom-navbar" style="box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); width: 100%; z-index: 1000;">
    <div class="container-fluid">
        <a href="{{ route('home') }}" class="navbar-brand" style="margin-left: 30px;">
            <img src="img/img.png" class="logo-home">
        </a>
        <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navmenu" aria-controls="navmenu" aria-expanded="false" aria-label="Toggle navigation" style="touch-action: manipulation; user-select: none; pointer-events: auto; border: none; padding: 0.5rem 0.75rem;">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navmenu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('home') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('about') }}">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('legality') }}">Legality</a>
                </li>
                <!-- 👇 TAMBAHKAN INI -->
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('kegiatan.galeri') }}">
                        <i class="fas fa-images"></i> Galeri
                    </a>
                </li>
                <!-- 👆 TAMBAHKAN INI -->
                <li class="nav-item">
                    <a href="{{ route('register') }}" class="nav-link">Register</a>
                </li>
                <li class="nav-item button">
                    <a href="{{ route('login') }}" class="nav-link button">Login</a>
                </li>
            </ul>
        </div>
    </div>
</nav>