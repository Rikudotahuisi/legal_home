<!-- resources/js/Layouts/AdminLayout.vue -->
<template>
  <div class="admin-layout min-h-screen bg-gray-100">
    <!-- ===== SIDEBAR ===== -->
    <aside class="fixed top-0 left-0 z-40 h-screen w-64 bg-gradient-to-b from-blue-950 via-blue-900 to-blue-800 shadow-2xl transition-transform -translate-x-full lg:translate-x-0">
      <!-- Logo -->
      <div class="flex items-center gap-3 px-6 py-5 border-b border-blue-700/50">
        <div class="w-10 h-10 bg-yellow-400 rounded-xl flex items-center justify-center">
          <i class="fas fa-scale-balanced text-blue-900 text-xl"></i>
        </div>
        <div>
          <span class="text-white text-xl font-bold">Legal<span class="text-yellow-400">Home</span></span>
          <span class="block text-xs text-blue-300">Admin Panel</span>
        </div>
      </div>

      <!-- Menu -->
      <nav class="px-4 py-6 space-y-1">
        <p class="text-xs text-blue-300 uppercase tracking-wider font-semibold px-3 mb-3">Menu Utama</p>
        
        <a href="/admin/dashboard" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group"
           :class="$page.component === 'admin/Dashboard' ? 'bg-blue-700/50 text-white' : ''">
          <i class="fas fa-chart-pie w-5 text-center"></i>
          <span>Dashboard</span>
        </a>
        
        <a href="/artikel" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group">
          <i class="fas fa-newspaper w-5 text-center"></i>
          <span>Artikel</span>
        </a>
        
        <a href="/artikel/create" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group">
          <i class="fas fa-plus-circle w-5 text-center"></i>
          <span>Buat Artikel</span>
        </a>
        
        <a href="/tag/list" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group"
           :class="$page.component === 'admin/Tag' ? 'bg-blue-700/50 text-white' : ''">
          <i class="fas fa-tags w-5 text-center"></i>
          <span>Kelola Tags</span>
        </a>
        
        <a href="/artikel/trashed" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group">
          <i class="fas fa-trash w-5 text-center"></i>
          <span>Sampah</span>
        </a>
        
        <a href="/galery" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group">
          <i class="fas fa-images w-5 text-center"></i>
          <span>Galeri</span>
        </a>
        
        <a href="/galery/create" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group">
          <i class="fas fa-plus-circle w-5 text-center"></i>
          <span>Tambah Foto</span>
        </a>

        <hr class="border-blue-700/30 my-4">
        
        <p class="text-xs text-blue-300 uppercase tracking-wider font-semibold px-3 mb-3">Lainnya</p>
        
        <a href="/" 
           class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-blue-200 hover:bg-blue-700/50 hover:text-white transition group">
          <i class="fas fa-globe w-5 text-center"></i>
          <span>Lihat Website</span>
        </a>
        
        <button @click="logout" 
                class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-red-300 hover:bg-red-500/20 hover:text-red-200 transition group w-full">
          <i class="fas fa-sign-out-alt w-5 text-center"></i>
          <span>Keluar</span>
        </button>
      </nav>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div class="lg:ml-64">
      <!-- ===== TOP BAR ===== -->
      <header class="sticky top-0 z-30 bg-white/95 backdrop-blur-sm shadow-sm">
        <div class="flex items-center justify-between px-6 py-4">
          <div class="flex items-center gap-4">
            <!-- Mobile Menu Button -->
            <button @click="sidebarOpen = !sidebarOpen" class="lg:hidden text-gray-600 hover:text-blue-700 transition">
              <i class="fas fa-bars text-2xl"></i>
            </button>
            
            <!-- Breadcrumb -->
            <div class="hidden sm:block">
              <h1 class="text-xl font-bold text-gray-800">{{ pageTitle }}</h1>
              <p class="text-sm text-gray-500">{{ pageSubtitle }}</p>
            </div>
          </div>

          <!-- Right Side -->
          <div class="flex items-center gap-4">
            <!-- Notification -->
            <button class="relative text-gray-500 hover:text-blue-700 transition">
              <i class="fas fa-bell text-xl"></i>
              <span class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-[10px] text-white flex items-center justify-center">3</span>
            </button>
            
            <!-- User Info -->
            <div class="flex items-center gap-3">
              <div class="w-9 h-9 bg-gradient-to-br from-blue-600 to-blue-800 rounded-full flex items-center justify-center text-white font-bold">
                {{ user?.name?.charAt(0) || 'A' }}
              </div>
              <div class="hidden md:block">
                <p class="text-sm font-semibold text-gray-800">{{ user?.name || 'Admin' }}</p>
                <p class="text-xs text-gray-500">Administrator</p>
              </div>
            </div>
          </div>
        </div>
      </header>

      <!-- ===== PAGE CONTENT ===== -->
      <main class="p-6">
        <slot />
      </main>
    </div>

    <!-- ===== MOBILE SIDEBAR OVERLAY ===== -->
    <div v-if="sidebarOpen" 
         @click="sidebarOpen = false"
         class="fixed inset-0 z-30 bg-black/50 lg:hidden"></div>
  </div>
</template>

<script>
import { usePage } from '@inertiajs/vue3';

export default {
  name: 'AdminLayout',
  data() {
    return {
      sidebarOpen: false
    }
  },
  computed: {
    user() {
      return usePage().props.auth?.user || null;
    },
    pageTitle() {
      const titles = {
        'admin/Dashboard': 'Dashboard',
        'admin/Tag': 'Kelola Tags',
        'admin/TagCreate': 'Tambah Tag',
        'admin/TagEdit': 'Edit Tag',
        'admin/GaleriCreate': 'Tambah Foto',
        'home/Artikel': 'Artikel',
        'home/ArtikelCreate': 'Buat Artikel',
        'home/ArtikelEdit': 'Edit Artikel',
        'home/ArtikelTrashed': 'Sampah',
        'Galery': 'Galeri'
      };
      return titles[usePage().component] || 'Admin Panel';
    },
    pageSubtitle() {
      const subtitles = {
        'admin/Dashboard': 'Ringkasan data dan statistik',
        'admin/Tag': 'Kelola semua tag artikel',
        'home/Artikel': 'Kelola semua artikel',
        'Galery': 'Kelola galeri foto'
      };
      return subtitles[usePage().component] || '';
    }
  },
  methods: {
    logout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        this.$inertia.post('/logout', {}, {
          onSuccess: () => {
            window.location.href = '/';
          }
        });
      }
    }
  }
}
</script>

<style scoped>
/* Scrollbar styling */
.admin-layout ::-webkit-scrollbar {
  width: 6px;
}
.admin-layout ::-webkit-scrollbar-track {
  background: #f1f1f1;
}
.admin-layout ::-webkit-scrollbar-thumb {
  background: #1a2a6c;
  border-radius: 3px;
}
.admin-layout ::-webkit-scrollbar-thumb:hover {
  background: #0f1a4a;
}
</style>