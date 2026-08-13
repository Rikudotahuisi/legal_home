<!-- resources/js/Pages/About.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
          <div>
            <span class="text-blue-800 font-semibold uppercase tracking-wider">Tentang Kami</span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">Home Legal</h2>
            <p class="text-gray-600 mb-6">Kami adalah firma hukum terpercaya yang berkomitmen memberikan solusi hukum terbaik untuk klien kami.</p>
            <ul class="space-y-3">
              <li class="flex items-center gap-2">
                <i class="fas fa-check-circle text-blue-600"></i>
                <span>Pengalaman 15+ tahun di bidang hukum</span>
              </li>
              <li class="flex items-center gap-2">
                <i class="fas fa-check-circle text-blue-600"></i>
                <span>500+ klien puas dari berbagai sektor</span>
              </li>
              <li class="flex items-center gap-2">
                <i class="fas fa-check-circle text-blue-600"></i>
                <span>Tim advokat profesional dan bersertifikasi</span>
              </li>
            </ul>
            <a href="/contact" class="btn-primary inline-block mt-6">
              <i class="fas fa-handshake me-2"></i> Konsultasi Sekarang
            </a>
          </div>
          <div>
            <img src="https://via.placeholder.com/600x400" class="w-full rounded-2xl shadow-lg" alt="About HomeLegal">
          </div>
        </div>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'About',
  components: { HomeLayout }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-block;
}
</style>