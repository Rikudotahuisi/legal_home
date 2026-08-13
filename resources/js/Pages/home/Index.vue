<!-- resources/js/Pages/Index.vue -->
<template>
  <HomeLayout>
    <!-- Hero Section -->
    <section class="min-h-[90vh] flex items-center relative overflow-hidden">
      <div class="absolute inset-0 bg-gradient-to-br from-blue-950 via-blue-800 to-gray-900"></div>
      
      <div class="container mx-auto px-4 relative z-10 text-white">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
          <div>
            <div class="flex items-center gap-2 mb-4">
              <i class="fas fa-scale-balanced text-2xl text-yellow-400"></i>
              <span class="text-yellow-400 font-semibold">Firma Hukum Terpercaya</span>
            </div>
            <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
              Solusi Hukum <br>
              <span class="text-yellow-400">Profesional & Terpercaya</span>
            </h1>
            <p class="text-lg md:text-xl mb-8 max-w-lg opacity-90">
              LegalHome hadir untuk memberikan pendampingan hukum terbaik bagi bisnis dan individu Anda.
            </p>
            <div class="flex flex-wrap gap-4">
              <a href="/contact" class="btn-hero inline-block">
                <i class="fas fa-handshake me-2"></i> Konsultasi Gratis
              </a>
              <a href="/about" class="btn-hero-outline inline-block">
                <i class="fas fa-info-circle me-2"></i> Tentang Kami
              </a>
            </div>
          </div>
          <div class="hidden lg:block">
            <div class="bg-white/10 backdrop-blur-sm p-8 rounded-2xl border border-white/20">
              <i class="fas fa-gavel text-8xl text-yellow-400 block mb-4"></i>
              <h3 class="text-2xl font-bold mb-2">Pengalaman 15+ Tahun</h3>
              <p class="text-gray-300">Ribuan kasus telah kami tangani dengan tingkat keberhasilan tinggi.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Layanan Hukum -->
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <span class="text-blue-800 font-semibold uppercase tracking-wider">Layanan Kami</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Bidang Hukum yang Kami Tangani</h2>
          <p class="text-gray-600 mt-3">Solusi hukum komprehensif untuk berbagai kebutuhan Anda</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div v-for="service in services" :key="service.id" 
               class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 hover:-translate-y-2 text-center border-t-4 border-blue-700">
            <i :class="[service.icon, 'text-5xl text-blue-800 mb-4']"></i>
            <h5 class="text-xl font-bold mb-2">{{ service.title }}</h5>
            <p class="text-gray-600">{{ service.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Statistik -->
    <section class="py-16 md:py-20 bg-white">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
          <div>
            <div class="text-4xl font-bold text-blue-800">15+</div>
            <p class="text-gray-600 mt-2">Tahun Pengalaman</p>
          </div>
          <div>
            <div class="text-4xl font-bold text-blue-800">500+</div>
            <p class="text-gray-600 mt-2">Kasus Berhasil</p>
          </div>
          <div>
            <div class="text-4xl font-bold text-blue-800">98%</div>
            <p class="text-gray-600 mt-2">Tingkat Kepuasan</p>
          </div>
          <div>
            <div class="text-4xl font-bold text-blue-800">50+</div>
            <p class="text-gray-600 mt-2">Advokat Profesional</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 md:py-20 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Pendampingan Hukum?</h2>
        <p class="text-lg mb-8 opacity-90">Konsultasikan masalah hukum Anda dengan tim profesional kami</p>
        <a href="/contact" class="btn-hero bg-yellow-400 text-blue-900 hover:bg-yellow-300 inline-block">
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
      services: [
        { id: 1, icon: 'fas fa-handshake', title: 'Hukum Bisnis', desc: 'Pendampingan kontrak, M&A, dan struktur bisnis.' },
        { id: 2, icon: 'fas fa-gavel', title: 'Litigasi', desc: 'Penanganan sengketa perdata dan pidana.' },
        { id: 3, icon: 'fas fa-building', title: 'Hukum Korporasi', desc: 'Legal audit, due diligence, dan kepatuhan.' }
      ]
    }
  }
}
</script>

<style scoped>
.btn-hero {
  @apply bg-gradient-to-r from-yellow-400 to-yellow-500 text-blue-900 px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:scale-105 hover:shadow-lg;
}
.btn-hero-outline {
  @apply border-2 border-white text-white px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:bg-white hover:text-blue-900;
}
</style>