<!-- resources/js/Pages/Index.vue -->
<template>
  <HomeLayout>
    <!-- Hero Section Premium -->
    <section class="relative min-h-screen flex items-center overflow-hidden">
      <!-- Background dengan efek gradien animasi -->
      <div class="absolute inset-0 bg-gradient-to-br from-blue-950 via-blue-800 to-gray-900"></div>
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-20 right-20 w-96 h-96 bg-yellow-400 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute bottom-20 left-20 w-96 h-96 bg-blue-400 rounded-full blur-3xl animate-pulse delay-1000"></div>
      </div>
      
      <div class="container mx-auto px-4 relative z-10 text-white">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-sm px-4 py-2 rounded-full mb-6">
              <i class="fas fa-scale-balanced text-yellow-400"></i>
              <span class="text-sm font-medium">Firma Hukum Terpercaya Sejak 2011</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
              Solusi Hukum <br>
              <span class="text-yellow-400 relative">
                Profesional & Terpercaya
                <svg class="absolute -bottom-2 left-0 w-full" viewBox="0 0 300 10" fill="none">
                  <path d="M0 5 Q75 0 150 5 Q225 10 300 5" stroke="#fbbf24" stroke-width="3"/>
                </svg>
              </span>
            </h1>
            <p class="text-lg md:text-xl mb-8 max-w-lg opacity-90 leading-relaxed">
              LegalHome hadir untuk memberikan pendampingan hukum terbaik bagi bisnis dan individu 
              dengan pendekatan humanis dan solutif.
            </p>
            <div class="flex flex-wrap gap-4">
              <a href="/contact" class="btn-hero inline-flex items-center group">
                <i class="fas fa-handshake me-2 group-hover:rotate-12 transition"></i> 
                Konsultasi Gratis
              </a>
              <a href="/about" class="btn-hero-outline inline-flex items-center group">
                <i class="fas fa-info-circle me-2 group-hover:scale-110 transition"></i> 
                Tentang Kami
              </a>
            </div>
          </div>
          <div class="hidden lg:grid grid-cols-2 gap-4">
            <div class="space-y-4">
              <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <i class="fas fa-gavel text-3xl text-yellow-400 mb-3"></i>
                <h3 class="font-bold text-lg">15+ Tahun</h3>
                <p class="text-sm text-gray-300">Pengalaman Hukum</p>
              </div>
              <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <i class="fas fa-users text-3xl text-yellow-400 mb-3"></i>
                <h3 class="font-bold text-lg">50+ Advokat</h3>
                <p class="text-sm text-gray-300">Tim Profesional</p>
              </div>
            </div>
            <div class="space-y-4 mt-8">
              <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <i class="fas fa-check-circle text-3xl text-yellow-400 mb-3"></i>
                <h3 class="font-bold text-lg">500+ Kasus</h3>
                <p class="text-sm text-gray-300">Berhasil Ditangani</p>
              </div>
              <div class="bg-white/10 backdrop-blur-sm p-6 rounded-2xl border border-white/20 hover:bg-white/20 transition">
                <i class="fas fa-star text-3xl text-yellow-400 mb-3"></i>
                <h3 class="font-bold text-lg">98%</h3>
                <p class="text-sm text-gray-300">Tingkat Kepuasan</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Layanan Hukum - DENGAN IKON YANG DIPERBAIKI -->
    <section class="py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-16">
          <span class="text-blue-800 font-semibold uppercase tracking-wider text-sm">Layanan Kami</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Bidang Hukum yang Kami Tangani</h2>
          <div class="w-20 h-1 bg-blue-700 mx-auto mt-4 rounded-full"></div>
          <p class="text-gray-600 mt-4 max-w-2xl mx-auto">Solusi hukum komprehensif untuk berbagai kebutuhan Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
          <!-- Card 1: Hukum Bisnis -->
          <div class="group bg-white p-8 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 text-center border-b-4 border-transparent hover:border-blue-700">
            <div class="bg-blue-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-blue-700 transition duration-300 relative">
              <!-- Ikon dengan efek -->
              <i class="fas fa-handshake text-4xl text-blue-700 group-hover:text-white transition duration-300"></i>
              <div class="absolute -top-2 -right-2 bg-yellow-400 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-blue-900">
                1
              </div>
            </div>
            <h5 class="text-xl font-bold mb-3">Hukum Bisnis</h5>
            <p class="text-gray-600 leading-relaxed">Pendampingan kontrak, M&A, dan struktur bisnis untuk korporasi.</p>
            <a href="/contact" class="inline-flex items-center text-blue-700 font-semibold mt-4 group-hover:translate-x-2 transition">
              Konsultasi <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>

          <!-- Card 2: Litigasi -->
          <div class="group bg-white p-8 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 text-center border-b-4 border-transparent hover:border-blue-700">
            <div class="bg-blue-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-blue-700 transition duration-300 relative">
              <i class="fas fa-gavel text-4xl text-blue-700 group-hover:text-white transition duration-300"></i>
              <div class="absolute -top-2 -right-2 bg-yellow-400 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-blue-900">
                2
              </div>
            </div>
            <h5 class="text-xl font-bold mb-3">Litigasi</h5>
            <p class="text-gray-600 leading-relaxed">Penanganan sengketa perdata, pidana, dan tata usaha negara.</p>
            <a href="/contact" class="inline-flex items-center text-blue-700 font-semibold mt-4 group-hover:translate-x-2 transition">
              Konsultasi <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>

          <!-- Card 3: Hukum Korporasi -->
          <div class="group bg-white p-8 rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-3 text-center border-b-4 border-transparent hover:border-blue-700">
            <div class="bg-blue-50 w-20 h-20 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:bg-blue-700 transition duration-300 relative">
              <i class="fas fa-building text-4xl text-blue-700 group-hover:text-white transition duration-300"></i>
              <div class="absolute -top-2 -right-2 bg-yellow-400 w-6 h-6 rounded-full flex items-center justify-center text-xs font-bold text-blue-900">
                3
              </div>
            </div>
            <h5 class="text-xl font-bold mb-3">Hukum Korporasi</h5>
            <p class="text-gray-600 leading-relaxed">Legal audit, due diligence, dan kepatuhan perusahaan.</p>
            <a href="/contact" class="inline-flex items-center text-blue-700 font-semibold mt-4 group-hover:translate-x-2 transition">
              Konsultasi <i class="fas fa-arrow-right ms-2"></i>
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistik -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
          <div v-for="stat in stats" :key="stat.label" 
               class="text-center group">
            <div class="text-4xl md:text-5xl font-bold text-blue-800 group-hover:scale-110 transition">
              {{ stat.value }}
            </div>
            <p class="text-gray-600 mt-2">{{ stat.label }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-20 bg-gradient-to-r from-blue-900 to-blue-700 text-white relative overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-64 h-64 bg-yellow-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 text-center relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Pendampingan Hukum?</h2>
        <p class="text-lg mb-8 opacity-90 max-w-2xl mx-auto">
          Konsultasikan masalah hukum Anda dengan tim profesional kami secara gratis
        </p>
        <a href="/contact" class="btn-hero-cta inline-flex items-center">
          <i class="fas fa-phone me-2"></i> Hubungi Kami Sekarang
        </a>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'Index',
  components: { HomeLayout },
  data() {
    return {
      stats: [
        { value: '15+', label: 'Tahun Pengalaman' },
        { value: '500+', label: 'Kasus Berhasil' },
        { value: '98%', label: 'Tingkat Kepuasan' },
        { value: '50+', label: 'Advokat Profesional' }
      ]
    }
  }
}
</script>

<style scoped>
.btn-hero {
  @apply bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-900 px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:scale-105 hover:shadow-2xl;
}
.btn-hero-outline {
  @apply border-2 border-white text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-white hover:text-blue-900;
}
.btn-hero-cta {
  @apply bg-yellow-400 text-blue-900 px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:scale-105 hover:shadow-2xl;
}
</style>