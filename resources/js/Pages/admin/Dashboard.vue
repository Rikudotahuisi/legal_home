<!-- resources/js/Pages/admin/Dashboard.vue -->
<template>
  <AdminLayout>
    <!-- Statistik Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
      <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-blue-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Total Artikel</p>
            <p class="text-3xl font-bold text-gray-800">{{ totalArticles }}</p>
          </div>
          <div class="w-12 h-12 bg-blue-100 rounded-2xl flex items-center justify-center">
            <i class="fas fa-file-alt text-2xl text-blue-600"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-green-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Total User</p>
            <p class="text-3xl font-bold text-gray-800">{{ totalUsers }}</p>
          </div>
          <div class="w-12 h-12 bg-green-100 rounded-2xl flex items-center justify-center">
            <i class="fas fa-users text-2xl text-green-600"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-yellow-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Total Tags</p>
            <p class="text-3xl font-bold text-gray-800">{{ totalTags }}</p>
          </div>
          <div class="w-12 h-12 bg-yellow-100 rounded-2xl flex items-center justify-center">
            <i class="fas fa-tags text-2xl text-yellow-600"></i>
          </div>
        </div>
      </div>
      
      <div class="bg-white rounded-2xl shadow-sm p-6 border-l-4 border-red-600">
        <div class="flex items-center justify-between">
          <div>
            <p class="text-sm text-gray-500">Artikel Terhapus</p>
            <p class="text-3xl font-bold text-gray-800">{{ trashedArticles }}</p>
          </div>
          <div class="w-12 h-12 bg-red-100 rounded-2xl flex items-center justify-center">
            <i class="fas fa-trash text-2xl text-red-600"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Recent Activity -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
      <div class="bg-white rounded-2xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Artikel Terbaru</h3>
        <div v-if="recentArticles.length > 0" class="space-y-3">
          <div v-for="article in recentArticles" :key="article.id" 
               class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-xl transition">
            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
              <i class="fas fa-file-alt text-blue-600"></i>
            </div>
            <div class="flex-1">
              <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ article.artikeltitle }}</p>
              <p class="text-xs text-gray-500">{{ formatDate(article.created_at) }}</p>
            </div>
            <a :href="`/artikel/${article.slug}`" class="text-blue-600 hover:text-blue-800">
              <i class="fas fa-arrow-right"></i>
            </a>
          </div>
        </div>
        <p v-else class="text-gray-400 text-center py-6">Belum ada artikel</p>
      </div>

      <div class="bg-white rounded-2xl shadow-sm p-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Akses Cepat</h3>
        <div class="grid grid-cols-2 gap-3">
          <a href="/artikel/create" 
             class="flex flex-col items-center gap-2 p-4 bg-blue-50 hover:bg-blue-100 rounded-xl transition group">
            <i class="fas fa-plus-circle text-2xl text-blue-600 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-blue-700">Buat Artikel</span>
          </a>
          <a href="/tag/create" 
             class="flex flex-col items-center gap-2 p-4 bg-yellow-50 hover:bg-yellow-100 rounded-xl transition group">
            <i class="fas fa-tag text-2xl text-yellow-600 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-yellow-700">Tambah Tag</span>
          </a>
          <a href="/galery/create" 
             class="flex flex-col items-center gap-2 p-4 bg-green-50 hover:bg-green-100 rounded-xl transition group">
            <i class="fas fa-image text-2xl text-green-600 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-green-700">Tambah Foto</span>
          </a>
          <a href="/artikel/trashed" 
             class="flex flex-col items-center gap-2 p-4 bg-red-50 hover:bg-red-100 rounded-xl transition group">
            <i class="fas fa-trash text-2xl text-red-600 group-hover:scale-110 transition"></i>
            <span class="text-sm font-medium text-red-700">Sampah</span>
          </a>
        </div>
      </div>
    </div>
  </AdminLayout>
</template>

<script>
import AdminLayout from '@/Layouts/AdminLayout.vue';

export default {
  name: 'AdminDashboard',
  components: { AdminLayout },
  props: {
    totalArticles: { type: Number, default: 0 },
    totalUsers: { type: Number, default: 0 },
    totalTags: { type: Number, default: 0 },
    trashedArticles: { type: Number, default: 0 },
    recentArticles: { type: Array, default: () => [] }
  },
  methods: {
    formatDate(date) {
      if (!date) return '-';
      return new Date(date).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      });
    }
  }
}
</script>