@extends('master.master')
@section('content')

<div class="container py-5">
    <h1 class="text-center" style="color: #1a3c6e; font-weight: bold;">Galeri Kegiatan</h1>
    <p class="text-center mb-5" style="color: #666;">Dokumentasi kegiatan dan acara hukum LegalHome dalam memberikan pelayanan terbaik</p>

    <!-- FILTER BUTTON -->
    <div class="filter-buttons text-center mb-4">
        <button class="btn btn-filter active" data-filter="all">Semua</button>
        <button class="btn btn-filter" data-filter="sidang">Sidang</button>
        <button class="btn btn-filter" data-filter="konsultasi">Konsultasi</button>
        <button class="btn btn-filter" data-filter="workshop">Workshop</button>
        <button class="btn btn-filter" data-filter="acara">Acara</button>
    </div>

    <!-- GRID GALERI -->
    <div class="row gallery-grid">
        @forelse($galeri as $item)
        <div class="col-md-4 col-sm-6 mb-4 gallery-item" data-category="{{ $item->kategori }}">
            <div class="gallery-card" data-index="{{ $loop->index }}">
                <img src="{{ asset('storage/' . $item->gambar) }}" 
                     class="img-fluid" 
                     alt="{{ $item->judul }}">
                <div class="gallery-overlay">
                    <i class="fas fa-search-plus"></i>
                    <p class="mt-2">{{ $item->judul }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i> Belum ada foto kegiatan. 
                <a href="#" class="alert-link">Tambahkan sekarang!</a>
            </div>
        </div>
        @endforelse
    </div>
</div>

<!-- MODAL LIGHTBOX -->
<div class="modal fade" id="galleryModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content bg-dark">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" data-bs-dismiss="modal" style="z-index: 1050;"></button>
                
                <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        @foreach($galeri as $index => $item)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $item->gambar) }}" 
                                 class="d-block w-100" 
                                 style="max-height: 80vh; object-fit: contain;"
                                 alt="{{ $item->judul }}">
                            <div class="carousel-caption bg-dark bg-opacity-50 p-3 rounded">
                                <h5>{{ $item->judul }}</h5>
                                <p>{{ $item->deskripsi ?? '' }}</p>
                                <small class="text-muted">Kategori: {{ ucfirst($item->kategori ?? 'Umum') }}</small>
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <!-- Tombol Prev/Next -->
                    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon bg-dark rounded-circle p-4"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon bg-dark rounded-circle p-4"></span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('styles')
<style>
    /* FILTER BUTTON */
    .btn-filter {
        background: #f0f0f0;
        border: none;
        padding: 8px 25px;
        margin: 0 5px;
        border-radius: 25px;
        font-weight: 500;
        transition: all 0.3s;
        color: #333;
    }
    .btn-filter:hover {
        background: #1a3c6e;
        color: white;
        transform: translateY(-2px);
    }
    .btn-filter.active {
        background: #1a3c6e;
        color: white;
        box-shadow: 0 4px 15px rgba(26, 60, 110, 0.3);
    }

    /* GALLERY CARD */
    .gallery-card {
        position: relative;
        overflow: hidden;
        border-radius: 12px;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transition: transform 0.3s, box-shadow 0.3s;
        height: 250px;
    }
    .gallery-card:hover {
        transform: scale(1.03);
        box-shadow: 0 8px 30px rgba(0,0,0,0.2);
    }
    .gallery-card img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(26, 60, 110, 0.8);
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s;
        color: white;
    }
    .gallery-card:hover .gallery-overlay {
        opacity: 1;
    }
    .gallery-overlay i {
        font-size: 40px;
        animation: pulse 1.5s infinite;
    }
    .gallery-overlay p {
        font-weight: 500;
        margin: 0;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* ANIMASI GALLERY ITEM */
    .gallery-item {
        animation: fadeInUp 0.6s ease;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* CAROUSEL CONTROL */
    .carousel-control-prev-icon,
    .carousel-control-next-icon {
        background-size: 50% 50%;
        padding: 25px;
        border-radius: 50%;
    }

    .carousel-caption {
        background: linear-gradient(transparent, rgba(0,0,0,0.7));
        padding: 30px;
        border-radius: 10px;
    }
</style>
@endpush

@push('scripts')
<script>
    // ========== FILTER ==========
    document.querySelectorAll('.filter-btn').forEach(button => {
        button.addEventListener('click', function() {
            // Remove active class
            document.querySelectorAll('.filter-btn').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');

            const filter = this.dataset.filter;
            document.querySelectorAll('.gallery-item').forEach(item => {
                if (filter === 'all' || item.dataset.category === filter) {
                    item.style.display = 'block';
                    item.style.animation = 'fadeInUp 0.5s ease';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });

    // ========== MODAL LIGHTBOX ==========
    document.querySelectorAll('.gallery-card').forEach(card => {
        card.addEventListener('click', function() {
            const index = parseInt(this.dataset.index);
            const carousel = document.getElementById('galleryCarousel');
            
            // Pindah ke slide yang diklik
            const items = carousel.querySelectorAll('.carousel-item');
            items.forEach((item, i) => {
                item.classList.toggle('active', i === index);
            });

            // Buka modal
            const modal = new bootstrap.Modal(document.getElementById('galleryModal'));
            modal.show();
        });
    });

    // Reset carousel saat modal ditutup
    document.getElementById('galleryModal').addEventListener('hidden.bs.modal', function() {
        const carousel = document.getElementById('galleryCarousel');
        const items = carousel.querySelectorAll('.carousel-item');
        items.forEach((item, i) => {
            item.classList.toggle('active', i === 0);
        });
    });

    // Keyboard navigation (panah kiri/kanan)
    document.addEventListener('keydown', function(e) {
        if (document.getElementById('galleryModal').classList.contains('show')) {
            if (e.key === 'ArrowLeft') {
                document.querySelector('.carousel-control-prev').click();
            } else if (e.key === 'ArrowRight') {
                document.querySelector('.carousel-control-next').click();
            }
        }
    });
</script>
@endpush