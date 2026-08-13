<!-- resources/js/Pages/Legality.vue -->
<template>
  <HomeLayout>
    <!-- Hero Section -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-blue-950 via-blue-800 to-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block bg-yellow-400/20 text-yellow-400 px-4 py-1 rounded-full text-sm font-semibold mb-4">
          <i class="fas fa-file-alt me-2"></i> Legalitas
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Dokumen Legal Perusahaan</h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90">
          LegalHome adalah firma hukum yang terdaftar dan berizin resmi dengan standar kepatuhan tertinggi
        </p>
      </div>
    </section>

    <!-- Konten Legalitas -->
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
          <!-- Card 1 - Identitas -->
          <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition border-t-4 border-blue-700">
            <div class="bg-blue-50 w-16 h-16 rounded-2xl flex items-center justify-center mb-5">
              <i class="fas fa-building text-3xl text-blue-700"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-4">Identitas Perusahaan</h4>
            <ul class="space-y-3 text-sm">
              <li class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-500">Nama Perusahaan</span>
                <span class="font-semibold">PT LegalHome Nusantara</span>
              </li>
              <li class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-500">Bentuk Badan</span>
                <span class="font-semibold">Perseroan Terbatas</span>
              </li>
              <li class="flex justify-between">
                <span class="text-gray-500">Tahun Berdiri</span>
                <span class="font-semibold">2011</span>
              </li>
            </ul>
          </div>

          <!-- Card 2 - Dokumen Legal -->
          <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition border-t-4 border-yellow-500">
            <div class="bg-yellow-50 w-16 h-16 rounded-2xl flex items-center justify-center mb-5">
              <i class="fas fa-file-contract text-3xl text-yellow-600"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-4">Dokumen Legal</h4>
            <ul class="space-y-3 text-sm">
              <li class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-500">NPWP</span>
                <span class="font-semibold">12.345.678.9-012.000</span>
              </li>
              <li class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-500">SIUP</span>
                <span class="font-semibold">123/456/VII/2026</span>
              </li>
              <li class="flex justify-between">
                <span class="text-gray-500">Akta Pendirian</span>
                <span class="font-semibold text-xs">Notaris Dr. H. Ahmad, SH</span>
              </li>
            </ul>
          </div>

          <!-- Card 3 - Sertifikasi -->
          <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition border-t-4 border-green-500">
            <div class="bg-green-50 w-16 h-16 rounded-2xl flex items-center justify-center mb-5">
              <i class="fas fa-certificate text-3xl text-green-600"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-4">Sertifikasi & Kepatuhan</h4>
            <ul class="space-y-3 text-sm">
              <li class="flex items-center gap-2 border-b border-gray-100 pb-2">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>Advokat Terdaftar PERADI</span>
              </li>
              <li class="flex items-center gap-2 border-b border-gray-100 pb-2">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>ISO 9001:2024</span>
              </li>
              <li class="flex items-center gap-2">
                <i class="fas fa-check-circle text-green-500"></i>
                <span>Kepatuhan Anti Pencucian Uang</span>
              </li>
            </ul>
          </div>
        </div>

        <!-- Legal Statement -->
        <div class="mt-12 bg-white p-8 rounded-2xl shadow-md">
          <div class="flex items-start gap-4">
            <div class="bg-blue-100 p-3 rounded-full">
              <i class="fas fa-shield-alt text-2xl text-blue-700"></i>
            </div>
            <div>
              <h4 class="text-xl font-bold text-gray-900 mb-2">Komitmen Kepatuhan Hukum</h4>
              <p class="text-gray-600 leading-relaxed">
                LegalHome berkomitmen untuk selalu menjalankan praktik hukum sesuai dengan peraturan 
                dan undang-undang yang berlaku di Indonesia. Kami secara rutin melakukan pembaruan 
                kepatuhan untuk memastikan layanan kami selalu sesuai dengan standar tertinggi.
              </p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 bg-white">
      <div class="container mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold text-gray-900 mb-2">Butuh Informasi Lebih Lanjut?</h3>
        <p class="text-gray-600 mb-6">Hubungi tim kami untuk konsultasi mengenai legalitas perusahaan</p>
        <a href="/contact" class="btn-primary inline-flex items-center">
          <i class="fas fa-envelope me-2"></i> Hubungi Kami
        </a>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'Legality',
  components: { HomeLayout }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center;
}
</style>