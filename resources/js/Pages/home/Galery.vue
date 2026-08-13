<!-- resources/js/Pages/Galery.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <span class="text-blue-800 font-semibold uppercase tracking-wider">Dokumentasi</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Galeri Kegiatan</h2>
          <p class="text-gray-600 mt-3">Dokumentasi kegiatan dan acara hukum LegalHome</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div v-for="item in galleries" :key="item.id" 
               class="overflow-hidden rounded-xl shadow-md hover:shadow-xl transition hover:scale-105 cursor-pointer">
            <img :src="item.image" class="w-full h-64 object-cover" :alt="item.title">
            <div class="p-4 bg-white">
              <p class="text-sm text-gray-600">{{ item.title }}</p>
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
  name: 'Galery',
  components: { HomeLayout },
  data() {
    return {
      galleries: [
        { id: 1, title: 'Sidang Perdata', image: 'https://via.placeholder.com/400x300' },
        { id: 2, title: 'Konsultasi Hukum', image: 'https://via.placeholder.com/400x300' },
        { id: 3, title: 'Workshop Hukum', image: 'https://via.placeholder.com/400x300' },
        { id: 4, title: 'Penandatanganan Kontrak', image: 'https://via.placeholder.com/400x300' },
        { id: 5, title: 'Acara Mediasi', image: 'https://via.placeholder.com/400x300' },
        { id: 6, title: 'Sertifikasi Advokat', image: 'https://via.placeholder.com/400x300' }
      ]
    }
  }
}
</script>