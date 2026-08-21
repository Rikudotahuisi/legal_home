<!-- resources/js/Layouts/HomeLayout.vue -->
<template>
  <div class="home-layout">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-md">
      <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold hover:opacity-80 transition flex items-center gap-2">
          <i class="fas fa-scale-balanced text-blue-800"></i>
          <span class="text-blue-900">Legal</span><span class="text-gray-700">Home</span>
        </a>
        
        <!-- Mobile Menu Button -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="lg:hidden text-2xl p-2 hover:bg-gray-100 rounded-lg transition">
          <i :class="mobileMenuOpen ? 'fas fa-times' : 'fas fa-bars'"></i>
        </button>

        <!-- Desktop Menu -->
        <ul class="hidden lg:flex space-x-8 items-center">
          <li><a href="/" class="hover:text-blue-800 transition font-medium text-gray-700">Beranda</a></li>
          <li><a href="/about" class="hover:text-blue-800 transition font-medium text-gray-700">Tentang Kami</a></li>
          <li><a href="/artikel" class="hover:text-blue-800 transition font-medium text-gray-700">Artikel Hukum</a></li>
          <li><a href="/galery" class="hover:text-blue-800 transition font-medium text-gray-700">Dokumentasi</a></li>
          <li><a href="/contact" class="hover:text-blue-800 transition font-medium text-gray-700">Konsultasi</a></li>
          <li><a href="/legality" class="hover:text-blue-800 transition font-medium text-gray-700">Legalitas</a></li>
          
          <!-- Admin Menu (hanya untuk admin) -->
          <li v-if="isAdmin">
            <div class="relative group">
              <button class="text-yellow-600 hover:text-yellow-700 transition font-medium flex items-center gap-1">
                <i class="fas fa-crown"></i> Admin
                <i class="fas fa-chevron-down text-xs"></i>
              </button>
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 hidden group-hover:block">
                <a href="/admin/dashboard" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                  <i class="fas fa-chart-pie me-2"></i> Dashboard
                </a>
                <a href="/admin/tags" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                  <i class="fas fa-tags me-2"></i> Kelola Tags
                </a>
                <a href="/artikel/trashed" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                  <i class="fas fa-trash me-2"></i> Sampah
                </a>
                <a href="/galery/create" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                  <i class="fas fa-plus me-2"></i> Tambah Foto
                </a>
              </div>
            </div>
          </li>
          
          <!-- Auth Links -->
          <li v-if="!isLoggedIn">
            <a href="/login" class="btn-primary">Masuk</a>
          </li>
          <li v-if="isLoggedIn">
            <div class="relative group">
              <button class="flex items-center gap-2 text-gray-700 hover:text-blue-800 transition">
                <i class="fas fa-user-circle text-2xl"></i>
                <span>{{ user?.name || 'User' }}</span>
                <span v-if="isAdmin" class="text-xs bg-yellow-500 text-white px-2 py-0.5 rounded-full">Admin</span>
                <i class="fas fa-chevron-down text-xs"></i>
              </button>
              <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 hidden group-hover:block">
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                  <i class="fas fa-user me-2"></i> Profil
                </a>
                <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                  <i class="fas fa-cog me-2"></i> Pengaturan
                </a>
                <hr class="my-1 border-gray-100">
                <button @click="logout" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-50 transition">
                  <i class="fas fa-sign-out-alt me-2"></i> Keluar
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>

      <!-- Mobile Menu -->
      <div v-show="mobileMenuOpen" class="lg:hidden bg-white border-t">
        <ul class="flex flex-col p-4 space-y-3">
          <li><a href="/" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Beranda</a></li>
          <li><a href="/about" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Tentang Kami</a></li>
          <li><a href="/artikel" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Artikel Hukum</a></li>
          <li><a href="/galery" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Dokumentasi</a></li>
          <li><a href="/contact" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Konsultasi</a></li>
          <li><a href="/legality" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Legalitas</a></li>
          
          <!-- Admin Mobile -->
          <li v-if="isAdmin" class="border-t border-gray-100 pt-3">
            <p class="text-sm font-semibold text-yellow-600 mb-2"><i class="fas fa-crown me-2"></i> Admin Menu</p>
            <a href="/admin/dashboard" class="block text-sm text-gray-700 hover:bg-gray-50 transition px-2 py-1 rounded" @click="mobileMenuOpen = false">
              <i class="fas fa-chart-pie me-2"></i> Dashboard
            </a>
            <a href="/admin/tags" class="block text-sm text-gray-700 hover:bg-gray-50 transition px-2 py-1 rounded" @click="mobileMenuOpen = false">
              <i class="fas fa-tags me-2"></i> Kelola Tags
            </a>
            <a href="/artikel/trashed" class="block text-sm text-gray-700 hover:bg-gray-50 transition px-2 py-1 rounded" @click="mobileMenuOpen = false">
              <i class="fas fa-trash me-2"></i> Sampah
            </a>
          </li>
          
          <!-- Auth Mobile -->
          <li v-if="!isLoggedIn" class="border-t border-gray-100 pt-3">
            <a href="/login" class="btn-primary block text-center">Masuk</a>
          </li>
          <li v-if="isLoggedIn" class="border-t border-gray-100 pt-3">
            <p class="text-sm text-gray-600 mb-2">
              <i class="fas fa-user me-2"></i> {{ user?.name || 'User' }}
              <span v-if="isAdmin" class="text-xs bg-yellow-500 text-white px-2 py-0.5 rounded-full ml-2">Admin</span>
            </p>
            <button @click="logout" class="text-red-600 text-sm w-full text-left hover:text-red-800 transition">
              <i class="fas fa-sign-out-alt me-2"></i> Keluar
            </button>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white">
      <div class="container mx-auto px-4 py-16">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
          <!-- Kolom 1: Brand -->
          <div>
            <h5 class="text-2xl font-bold mb-4 flex items-center gap-2">
              <i class="fas fa-scale-balanced text-yellow-400"></i>
              <span>LegalHome</span>
            </h5>
            <p class="text-gray-400 leading-relaxed mb-4">
              Solusi hukum terpercaya untuk bisnis dan individu dengan pendekatan humanis dan profesional.
            </p>
            <div class="flex space-x-4 text-xl">
              <a href="#" class="text-gray-400 hover:text-yellow-400 transition hover:scale-110 transform">
                <i class="fab fa-facebook"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-yellow-400 transition hover:scale-110 transform">
                <i class="fab fa-twitter"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-yellow-400 transition hover:scale-110 transform">
                <i class="fab fa-instagram"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-yellow-400 transition hover:scale-110 transform">
                <i class="fab fa-linkedin"></i>
              </a>
              <a href="#" class="text-gray-400 hover:text-yellow-400 transition hover:scale-110 transform">
                <i class="fab fa-youtube"></i>
              </a>
            </div>
          </div>

          <!-- Kolom 2: Layanan -->
          <div>
            <h6 class="text-lg font-semibold mb-4 text-white">Layanan Kami</h6>
            <ul class="space-y-3 text-gray-400">
              <li><a href="#" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Hukum Bisnis
              </a></li>
              <li><a href="#" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Litigasi
              </a></li>
              <li><a href="#" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Hukum Korporasi
              </a></li>
              <li><a href="#" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Konsultasi Hukum
              </a></li>
            </ul>
          </div>

          <!-- Kolom 3: Tautan Cepat -->
          <div>
            <h6 class="text-lg font-semibold mb-4 text-white">Tautan Cepat</h6>
            <ul class="space-y-3 text-gray-400">
              <li><a href="/about" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Tentang Kami
              </a></li>
              <li><a href="/artikel" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Artikel Hukum
              </a></li>
              <li><a href="/galery" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Dokumentasi
              </a></li>
              <li><a href="/contact" class="hover:text-yellow-400 transition flex items-center gap-2">
                <i class="fas fa-chevron-right text-xs text-yellow-400"></i> Kontak
              </a></li>
            </ul>
          </div>

          <!-- Kolom 4: Kontak -->
          <div>
            <h6 class="text-lg font-semibold mb-4 text-white">Hubungi Kami</h6>
            <ul class="space-y-4 text-gray-400">
              <li class="flex items-start gap-3">
                <i class="fas fa-map-marker-alt text-yellow-400 mt-1"></i>
                <span>Jl. Hukum No. 123, Jakarta Selatan</span>
              </li>
              <li class="flex items-start gap-3">
                <i class="fas fa-phone text-yellow-400 mt-1"></i>
                <span>+62 812 3456 7890</span>
              </li>
              <li class="flex items-start gap-3">
                <i class="fas fa-envelope text-yellow-400 mt-1"></i>
                <span>info@legalhome.com</span>
              </li>
              <li class="flex items-start gap-3">
                <i class="fas fa-clock text-yellow-400 mt-1"></i>
                <span>Senin - Jumat: 09.00 - 17.00 WIB</span>
              </li>
            </ul>
          </div>
        </div>

        <div class="border-t border-gray-800 my-8"></div>

        <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
          <p>&copy; 2026 LegalHome. All rights reserved.</p>
          <div class="flex space-x-6">
            <a href="#" class="hover:text-yellow-400 transition">Kebijakan Privasi</a>
            <a href="#" class="hover:text-yellow-400 transition">Syarat & Ketentuan</a>
            <a href="#" class="hover:text-yellow-400 transition">Cookie</a>
          </div>
        </div>
      </div>
    </footer>
  </div>
</template>

<script>
import { usePage } from '@inertiajs/vue3';

export default {
  name: 'HomeLayout',
  data() {
    return {
      mobileMenuOpen: false
    }
  },
  computed: {
    isLoggedIn() {
      // ===== PERBAIKAN: Cek dengan aman =====
      return !!usePage().props.auth?.user;
    },
    user() {
      // ===== PERBAIKAN: Cek dengan aman =====
      return usePage().props.auth?.user || null;
    },
    isAdmin() {
      // ===== PERBAIKAN: Cek dengan aman =====
      return this.user?.role === 'admin';
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
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-5 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-block;
}
</style>