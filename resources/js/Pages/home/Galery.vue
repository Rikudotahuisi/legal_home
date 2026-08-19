<!-- resources/js/Pages/Galery.vue -->
<template>
  <HomeLayout>
    <!-- Hero Section -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-blue-950 via-blue-800 to-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block bg-yellow-400/20 text-yellow-400 px-4 py-1 rounded-full text-sm font-semibold mb-4">
          <i class="fas fa-images me-2"></i> Dokumentasi
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Kegiatan</h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90">
          Dokumentasi kegiatan dan acara hukum LegalHome dalam memberikan pelayanan terbaik
        </p>
      </div>
    </section>

    <!-- Galeri Grid -->
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <!-- Filter -->
        <div class="flex flex-wrap justify-center gap-3 mb-10">
          <button v-for="filter in filters" :key="filter" 
                  @click="activeFilter = filter"
                  :class="[
                    'px-5 py-2 rounded-full font-medium transition',
                    activeFilter === filter 
                      ? 'bg-blue-700 text-white' 
                      : 'bg-white text-gray-600 hover:bg-gray-100'
                  ]">
            {{ filter }}
          </button>
        </div>

        <!-- Grid Gallery -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="(item, index) in filteredGalleries" :key="item.id" 
               @click="openLightbox(index)"
               class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer">
            <img :src="item.image" class="w-full h-72 object-cover group-hover:scale-110 transition duration-700" :alt="item.title">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6">
              <h4 class="text-white font-bold text-lg">{{ item.title }}</h4>
              <p class="text-gray-300 text-sm">{{ item.category }}</p>
            </div>
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-blue-800">
              {{ item.category }}
            </div>
            <!-- Icon Zoom -->
            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-500">
              <div class="bg-white/80 backdrop-blur-sm rounded-full p-4 transform hover:scale-110 transition">
                <i class="fas fa-search-plus text-3xl text-blue-800"></i>
              </div>
            </div>
          </div>
        </div>

        <!-- Empty State -->
        <div v-if="filteredGalleries.length === 0" class="text-center py-12">
          <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
          <p class="text-gray-400">Tidak ada gambar untuk kategori ini</p>
        </div>
      </div>
    </section>

    <!-- ============================================================ -->
    <!-- LIGHTBOX MODAL - GAMBAR LEBIH BESAR -->
    <!-- ============================================================ -->
    <div v-if="lightboxOpen" 
         class="fixed inset-0 z-[9999] bg-black/95 flex items-center justify-center"
         @click.self="closeLightbox">
      
      <!-- Tombol Close -->
      <button @click="closeLightbox" 
              class="absolute top-4 right-4 text-white text-3xl hover:text-yellow-400 transition z-20 w-12 h-12 flex items-center justify-center rounded-full hover:bg-white/10">
        <i class="fas fa-times"></i>
      </button>

      <!-- Tombol Prev -->
      <button @click="prevImage" 
              class="absolute left-2 md:left-6 text-white text-4xl md:text-6xl hover:text-yellow-400 transition z-20 p-3 rounded-full hover:bg-white/10">
        <i class="fas fa-chevron-circle-left"></i>
      </button>

      <!-- Tombol Next -->
      <button @click="nextImage" 
              class="absolute right-2 md:right-6 text-white text-4xl md:text-6xl hover:text-yellow-400 transition z-20 p-3 rounded-full hover:bg-white/10">
        <i class="fas fa-chevron-circle-right"></i>
      </button>

      <!-- Gambar - LEBIH BESAR -->
      <div class="relative w-full h-full flex items-center justify-center px-4 md:px-16">
        <div class="relative max-w-7xl max-h-[92vh] w-full h-full flex items-center justify-center">
          <img :src="currentImage?.image" 
               :alt="currentImage?.title"
               class="max-w-full max-h-[88vh] w-auto h-auto object-contain rounded-lg shadow-2xl"
               style="min-width: 60%; min-height: 40%;">
          
          <!-- Info Gambar di Bawah -->
          <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent p-6 rounded-b-lg">
            <div class="flex items-center justify-between flex-wrap gap-2">
              <div>
                <h3 class="text-white text-xl md:text-2xl font-bold">{{ currentImage?.title }}</h3>
                <p class="text-gray-300">{{ currentImage?.category }}</p>
              </div>
              <div class="bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full">
                <span class="text-white text-sm font-medium">
                  {{ currentIndex + 1 }} / {{ filteredGalleries.length }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Keyboard Navigation Hint -->
      <div class="absolute bottom-20 left-1/2 -translate-x-1/2 text-white/30 text-sm flex items-center gap-6 bg-black/50 backdrop-blur-sm px-4 py-2 rounded-full">
        <span class="flex items-center gap-2">
          <i class="fas fa-arrow-left"></i> 
          <span class="hidden sm:inline">Prev</span>
        </span>
        <span class="w-px h-4 bg-white/30"></span>
        <span class="flex items-center gap-2">
          <i class="fas fa-arrow-right"></i> 
          <span class="hidden sm:inline">Next</span>
        </span>
        <span class="w-px h-4 bg-white/30"></span>
        <span class="flex items-center gap-2">
          <i class="fas fa-times"></i> 
          <span class="hidden sm:inline">Close</span>
        </span>
      </div>
    </div>

    <!-- CTA -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Tertarik Bekerja Sama?</h3>
        <p class="text-gray-600 mb-6">Kami siap memberikan pendampingan hukum terbaik untuk Anda</p>
        <a href="/contact" class="btn-primary inline-flex items-center">
          <i class="fas fa-handshake me-2"></i> Hubungi Kami
        </a>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'Galery',
  components: { HomeLayout },
  data() {
    return {
      activeFilter: 'Semua',
      filters: ['Semua', 'Sidang', 'Konsultasi', 'Workshop', 'Acara'],
      lightboxOpen: false,
      currentIndex: 0,
      galleries: [
        { 
          id: 1, 
          title: 'Sidang Perdata', 
          category: 'Sidang', 
          image: 'https://th.bing.com/th/id/OIP.vC3XKqmMLQP-x9h8ZoXg9AAAAA?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3' 
        },
        { 
          id: 2, 
          title: 'Konsultasi Hukum', 
          category: 'Konsultasi', 
          image: 'https://th.bing.com/th/id/OIP.vC3XKqmMLQP-x9h8ZoXg9AAAAA?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3' 
        },
        { 
          id: 3, 
          title: 'Workshop Hukum Bisnis', 
          category: 'Workshop', 
          image: 'https://th.bing.com/th/id/OIP.vC3XKqmMLQP-x9h8ZoXg9AAAAA?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3' 
        },
        { 
          id: 4, 
          title: 'Penandatanganan Kontrak', 
          category: 'Acara', 
          image: 'https://th.bing.com/th/id/OIP.vC3XKqmMLQP-x9h8ZoXg9AAAAA?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3' 
        },
        { 
          id: 5, 
          title: 'Acara Mediasi', 
          category: 'Acara', 
          image: 'https://th.bing.com/th/id/OIP.vC3XKqmMLQP-x9h8ZoXg9AAAAA?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3' 
        },
        { 
          id: 6, 
          title: 'Sertifikasi Advokat', 
          category: 'Workshop', 
          image: 'https://th.bing.com/th/id/OIP.vC3XKqmMLQP-x9h8ZoXg9AAAAA?r=0&o=7rm=3&rs=1&pid=ImgDetMain&o=7&rm=3' 
        }
      ]
    }
  },
  computed: {
    filteredGalleries() {
      if (this.activeFilter === 'Semua') return this.galleries;
      return this.galleries.filter(item => item.category === this.activeFilter);
    },
    currentImage() {
      return this.filteredGalleries[this.currentIndex] || null;
    }
  },
  methods: {
    // ========== LIGHTBOX ==========
    openLightbox(index) {
      this.currentIndex = index;
      this.lightboxOpen = true;
      document.body.style.overflow = 'hidden';
    },
    
    closeLightbox() {
      this.lightboxOpen = false;
      document.body.style.overflow = '';
    },
    
    nextImage() {
      if (this.currentIndex < this.filteredGalleries.length - 1) {
        this.currentIndex++;
      } else {
        this.currentIndex = 0;
      }
    },
    
    prevImage() {
      if (this.currentIndex > 0) {
        this.currentIndex--;
      } else {
        this.currentIndex = this.filteredGalleries.length - 1;
      }
    },

    // ========== KEYBOARD NAVIGATION ==========
    handleKeydown(e) {
      if (!this.lightboxOpen) return;
      
      if (e.key === 'Escape') {
        this.closeLightbox();
      } else if (e.key === 'ArrowRight') {
        e.preventDefault();
        this.nextImage();
      } else if (e.key === 'ArrowLeft') {
        e.preventDefault();
        this.prevImage();
      }
    }
  },
  mounted() {
    window.addEventListener('keydown', this.handleKeydown);
  },
  beforeUnmount() {
    window.removeEventListener('keydown', this.handleKeydown);
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center;
}

/* Animasi fade untuk lightbox */
.fixed {
  animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
  from { opacity: 0; transform: scale(0.95); }
  to { opacity: 1; transform: scale(1); }
}

/* Gambar di lightbox dengan transisi halus */
.fixed img {
  animation: zoomIn 0.3s ease;
}

@keyframes zoomIn {
  from { opacity: 0; transform: scale(0.9); }
  to { opacity: 1; transform: scale(1); }
}
</style>