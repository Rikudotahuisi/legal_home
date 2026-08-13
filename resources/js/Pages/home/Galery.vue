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
        <!-- Filter (opsional) -->
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

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          <div v-for="item in filteredGalleries" :key="item.id" 
               class="group relative overflow-hidden rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 cursor-pointer">
            <img :src="item.image" class="w-full h-72 object-cover group-hover:scale-110 transition duration-700" :alt="item.title">
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition duration-500 flex flex-col justify-end p-6">
              <h4 class="text-white font-bold text-lg">{{ item.title }}</h4>
              <p class="text-gray-300 text-sm">{{ item.category }}</p>
            </div>
            <div class="absolute top-3 right-3 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full text-xs font-medium text-blue-800">
              {{ item.category }}
            </div>
          </div>
        </div>
      </div>
    </section>

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
      galleries: [
        { id: 1, title: 'Sidang Perdata', category: 'Sidang', image: 'https://via.placeholder.com/400x300/1a2a6c/ffffff?text=Sidang+Perdata' },
        { id: 2, title: 'Konsultasi Hukum', category: 'Konsultasi', image: 'https://via.placeholder.com/400x300/1a2a6c/ffffff?text=Konsultasi+Hukum' },
        { id: 3, title: 'Workshop Hukum Bisnis', category: 'Workshop', image: 'https://via.placeholder.com/400x300/1a2a6c/ffffff?text=Workshop+Bisnis' },
        { id: 4, title: 'Penandatanganan Kontrak', category: 'Acara', image: 'https://via.placeholder.com/400x300/1a2a6c/ffffff?text=Kontrak' },
        { id: 5, title: 'Acara Mediasi', category: 'Acara', image: 'https://via.placeholder.com/400x300/1a2a6c/ffffff?text=Mediasi' },
        { id: 6, title: 'Sertifikasi Advokat', category: 'Workshop', image: 'https://via.placeholder.com/400x300/1a2a6c/ffffff?text=Sertifikasi' }
      ]
    }
  },
  computed: {
    filteredGalleries() {
      if (this.activeFilter === 'Semua') return this.galleries;
      return this.galleries.filter(item => item.category === this.activeFilter);
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center;
}
</style>