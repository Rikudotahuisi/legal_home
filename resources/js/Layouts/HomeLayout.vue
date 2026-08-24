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
          <li><a href="/" class="hover:text-blue-800 transition font-medium text-gray-700">Home</a></li>
          <li><a href="/about" class="hover:text-blue-800 transition font-medium text-gray-700">About</a></li>
          <li><a href="/artikel" class="hover:text-blue-800 transition font-medium text-gray-700">Article</a></li>
          <li><a href="/galery" class="hover:text-blue-800 transition font-medium text-gray-700">Gallery</a></li>
          <li><a href="/contact" class="hover:text-blue-800 transition font-medium text-gray-700">Contact</a></li>
          <li><a href="/legality" class="hover:text-blue-800 transition font-medium text-gray-700">Legality</a></li>
          
          <!-- Admin Menu (hanya untuk admin) -->
          <li v-if="isAdmin">
            <div class="relative">
              <!-- ===== DROPDOWN BUTTON - LEBIH MUDAH DIKLIK ===== -->
              <button @click="toggleAdminDropdown" 
                      class="text-yellow-600 hover:text-yellow-700 transition font-medium flex items-center gap-1 px-3 py-2 rounded-lg hover:bg-yellow-50">
                <i class="fas fa-crown"></i> 
                <span>Admin</span>
                <i class="fas fa-chevron-down text-xs transition-transform" 
                   :class="adminDropdownOpen ? 'rotate-180' : ''"></i>
              </button>
              
              <!-- ===== DROPDOWN MENU ===== -->
              <div v-show="adminDropdownOpen" 
                   @mouseleave="adminDropdownOpen = false"
                   class="absolute right-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                <a href="/admin/dashboard" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                  <i class="fas fa-chart-pie me-2"></i> Dashboard
                </a>
                <a href="/tag/list" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                  <i class="fas fa-tags me-2"></i> Manage Tags
                </a>
                <a href="/artikel/trashed" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                  <i class="fas fa-trash me-2"></i> Trash
                </a>
              </div>
            </div>
          </li>
          
          <!-- Auth Links -->
          <li v-if="!isLoggedIn">
            <a href="/login" class="btn-primary">Masuk</a>
          </li>
          <li v-if="isLoggedIn">
            <div class="relative">
              <!-- ===== DROPDOWN BUTTON USER ===== -->
              <button @click="toggleUserDropdown" 
                      class="flex items-center gap-2 text-gray-700 hover:text-blue-800 transition px-3 py-2 rounded-lg hover:bg-blue-50">
                <i class="fas fa-user-circle text-2xl"></i>
                <span>{{ user?.name || 'User' }}</span>
                <span v-if="isAdmin" class="text-xs bg-yellow-500 text-white px-2 py-0.5 rounded-full">Admin</span>
                <i class="fas fa-chevron-down text-xs transition-transform" 
                   :class="userDropdownOpen ? 'rotate-180' : ''"></i>
              </button>
              
              <!-- ===== DROPDOWN MENU USER ===== -->
              <div v-show="userDropdownOpen" 
                   @mouseleave="userDropdownOpen = false"
                   class="absolute right-0 mt-1 w-52 bg-white rounded-xl shadow-xl border border-gray-100 py-2 z-50">
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                  <i class="fas fa-user me-2"></i> Profile
                </a>
                <a href="#" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">
                  <i class="fas fa-cog me-2"></i> Settings
                </a>
                <hr class="my-1 border-gray-100">
                <button @click="logout" class="block w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                  <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
              </div>
            </div>
          </li>
        </ul>
      </div>

      <!-- Mobile Menu -->
      <div v-show="mobileMenuOpen" class="lg:hidden bg-white border-t">
        <ul class="flex flex-col p-4 space-y-3">
          <li><a href="/" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Home</a></li>
          <li><a href="/about" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">About</a></li>
          <li><a href="/artikel" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Article</a></li>
          <li><a href="/galery" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Gallery</a></li>
          <li><a href="/contact" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Contact</a></li>
          <li><a href="/legality" class="block hover:text-blue-800 transition font-medium" @click="mobileMenuOpen = false">Legality</a></li>
          
          <!-- Admin Mobile -->
          <li v-if="isAdmin" class="border-t border-gray-100 pt-3">
            <p class="text-sm font-semibold text-yellow-600 mb-2"><i class="fas fa-crown me-2"></i> Admin Menu</p>
            <a href="/admin/dashboard" class="block text-sm text-gray-700 hover:bg-gray-50 transition px-2 py-1.5 rounded" @click="mobileMenuOpen = false">
              <i class="fas fa-chart-pie me-2"></i> Dashboard
            </a>
            <a href="/tag/list" class="block text-sm text-gray-700 hover:bg-gray-50 transition px-2 py-1.5 rounded" @click="mobileMenuOpen = false">
              <i class="fas fa-tags me-2"></i> Manage Tags
            </a>
            <a href="/artikel/trashed" class="block text-sm text-gray-700 hover:bg-gray-50 transition px-2 py-1.5 rounded" @click="mobileMenuOpen = false">
              <i class="fas fa-trash me-2"></i> Trash
            </a>
          </li>
          
          <!-- Auth Mobile -->
          <li v-if="!isLoggedIn" class="border-t border-gray-100 pt-3">
            <a href="/login" class="btn-primary block text-center">Login</a>
          </li>
          <li v-if="isLoggedIn" class="border-t border-gray-100 pt-3">
            <p class="text-sm text-gray-600 mb-2">
              <i class="fas fa-user me-2"></i> {{ user?.name || 'User' }}
              <span v-if="isAdmin" class="text-xs bg-yellow-500 text-white px-2 py-0.5 rounded-full ml-2">Admin</span>
            </p>
            <button @click="logout" class="text-red-600 text-sm w-full text-left hover:text-red-800 transition">
              <i class="fas fa-sign-out-alt me-2"></i> Logout
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
      mobileMenuOpen: false,
      adminDropdownOpen: false,
      userDropdownOpen: false
    }
  },
  computed: {
    isLoggedIn() {
      return !!usePage().props.auth?.user;
    },
    user() {
      return usePage().props.auth?.user || null;
    },
    isAdmin() {
      return this.user?.role === 'admin';
    }
  },
  methods: {
    // ===== TOGGLE DROPDOWN =====
    toggleAdminDropdown() {
      this.adminDropdownOpen = !this.adminDropdownOpen;
      // Tutup dropdown user jika terbuka
      if (this.userDropdownOpen) this.userDropdownOpen = false;
    },
    toggleUserDropdown() {
      this.userDropdownOpen = !this.userDropdownOpen;
      // Tutup dropdown admin jika terbuka
      if (this.adminDropdownOpen) this.adminDropdownOpen = false;
    },
    
    // ===== LOGOUT =====
    logout() {
      if (confirm('Apakah Anda yakin ingin keluar?')) {
        this.$inertia.post('/logout', {}, {
          onSuccess: () => {
            window.location.href = '/';
          }
        });
      }
    },

    // ===== CLOSE DROPDOWN SAAT KLIK DI LUAR =====
    handleClickOutside(event) {
      const adminDropdown = document.querySelector('.admin-dropdown');
      const userDropdown = document.querySelector('.user-dropdown');
      
      if (adminDropdown && !adminDropdown.contains(event.target)) {
        this.adminDropdownOpen = false;
      }
      if (userDropdown && !userDropdown.contains(event.target)) {
        this.userDropdownOpen = false;
      }
    }
  },
  mounted() {
    // Tambahkan event listener untuk klik di luar dropdown
    document.addEventListener('click', this.handleClickOutside);
  },
  beforeUnmount() {
    document.removeEventListener('click', this.handleClickOutside);
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-5 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-block;
}

/* Animasi dropdown */
.absolute {
  animation: dropdownFade 0.2s ease;
}

@keyframes dropdownFade {
  from {
    opacity: 0;
    transform: translateY(-8px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>