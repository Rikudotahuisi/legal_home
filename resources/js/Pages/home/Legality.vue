<!-- resources/js/Pages/Legality.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <span class="text-blue-800 font-semibold uppercase tracking-wider">Legalitas</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Dokumen Legal Perusahaan</h2>
          <p class="text-gray-600 mt-3">LegalHome adalah firma hukum yang terdaftar dan berizin resmi</p>
        </div>
        
        <div class="max-w-4xl mx-auto">
          <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div class="border-b md:border-b-0 md:border-r border-gray-200 pb-4 md:pb-0 md:pr-6">
                <h5 class="font-bold text-blue-800 mb-3"><i class="fas fa-building me-2"></i>Identitas Perusahaan</h5>
                <ul class="space-y-3">
                  <li class="flex justify-between">
                    <span class="text-gray-600">Nama Perusahaan</span>
                    <span class="font-semibold">PT LegalHome Nusantara</span>
                  </li>
                  <li class="flex justify-between">
                    <span class="text-gray-600">Bentuk Badan</span>
                    <span class="font-semibold">Perseroan Terbatas</span>
                  </li>
                  <li class="flex justify-between">
                    <span class="text-gray-600">Tahun Berdiri</span>
                    <span class="font-semibold">2011</span>
                  </li>
                </ul>
              </div>
              <div>
                <h5 class="font-bold text-blue-800 mb-3"><i class="fas fa-file-alt me-2"></i>Dokumen Legal</h5>
                <ul class="space-y-3">
                  <li class="flex justify-between">
                    <span class="text-gray-600">NPWP</span>
                    <span class="font-semibold">12.345.678.9-012.000</span>
                  </li>
                  <li class="flex justify-between">
                    <span class="text-gray-600">SIUP</span>
                    <span class="font-semibold">123/456/VII/2026</span>
                  </li>
                  <li class="flex justify-between">
                    <span class="text-gray-600">Akta Pendirian</span>
                    <span class="font-semibold">Notaris Dr. H. Ahmad, SH</span>
                  </li>
                </ul>
              </div>
            </div>
            
            <hr class="my-6">
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <h5 class="font-bold text-blue-800 mb-3"><i class="fas fa-certificate me-2"></i>Sertifikasi</h5>
                <ul class="space-y-2 text-gray-600">
                  <li><i class="fas fa-check-circle text-green-500 me-2"></i>Advokat Terdaftar PERADI</li>
                  <li><i class="fas fa-check-circle text-green-500 me-2"></i>ISO 9001:2024</li>
                </ul>
              </div>
              <div>
                <h5 class="font-bold text-blue-800 mb-3"><i class="fas fa-shield-alt me-2"></i>Kepatuhan</h5>
                <ul class="space-y-2 text-gray-600">
                  <li><i class="fas fa-check-circle text-green-500 me-2"></i>Kepatuhan Anti Pencucian Uang</li>
                  <li><i class="fas fa-check-circle text-green-500 me-2"></i>Perlindungan Data Pribadi</li>
                </ul>
              </div>
            </div>
          </div>
        </div>
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