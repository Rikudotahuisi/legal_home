<!-- resources/js/Pages/Artikel.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <span class="text-blue-800 font-semibold uppercase tracking-wider">Artikel Hukum</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Wawasan & Informasi Hukum</h2>
          <p class="text-gray-600 mt-3">Artikel terbaru seputar hukum dan peraturan di Indonesia</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div v-for="post in posts" :key="post.id" 
               class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition">
            <img :src="post.image" class="w-full h-48 object-cover" alt="Thumbnail">
            <div class="p-6">
              <span class="text-xs text-blue-600 font-semibold uppercase">{{ post.category }}</span>
              <h5 class="text-xl font-bold mb-2 mt-1">{{ post.title }}</h5>
              <p class="text-gray-600 mb-4">{{ post.excerpt }}</p>
              <a :href="`/artikel/${post.id}`" class="text-blue-700 font-semibold hover:text-blue-900 transition">
                Baca Selengkapnya →
              </a>
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
  name: 'Artikel',
  components: { HomeLayout },
  data() {
    return {
      posts: [
        { id: 1, title: 'Perubahan UU Cipta Kerja 2026', excerpt: 'Dampak terbaru terhadap dunia usaha di Indonesia.', category: 'Hukum Bisnis', image: 'https://via.placeholder.com/350x200' },
        { id: 2, title: 'Tips Menyusun Kontrak Kerja', excerpt: 'Panduan praktis untuk menghindari sengketa.', category: 'Hukum Ketenagakerjaan', image: 'https://via.placeholder.com/350x200' },
        { id: 3, title: 'Perlindungan Data Pribadi', excerpt: 'Hal-hal yang perlu diketahui tentang UU PDP.', category: 'Hukum Teknologi', image: 'https://via.placeholder.com/350x200' }
      ]
    }
  }
}
</script>