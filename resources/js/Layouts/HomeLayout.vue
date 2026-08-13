<!-- resources/js/Layouts/HomeLayout.vue -->
<template>
  <div class="home-layout">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-sm shadow-md">
      <div class="container mx-auto px-4 py-3 flex justify-between items-center">
        <!-- Logo -->
        <a href="/" class="text-2xl font-bold hover:opacity-80 transition flex items-center gap-2">
          <i class="fas fa-scale-balanced text-blue-800"></i>
          <span class="text-blue-900">Home</span><span class="text-gray-700">Legal</span>
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
          <li v-if="!isLoggedIn">
            <a href="/login" class="btn-primary">Login</a>
          </li>
          <li v-if="isLoggedIn">
            <button @click="logout" class="btn-primary">Logout</button>
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
          <li v-if="!isLoggedIn">
            <a href="/login" class="btn-primary block text-center">Login</a>
          </li>
          <li v-if="isLoggedIn">
            <button @click="logout" class="btn-primary w-full">Logout</button>
          </li>
        </ul>
      </div>
    </nav>

    <!-- Main Content -->
    <main class="pt-20">
      <slot />
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
          <div>
            <h5 class="text-xl font-bold mb-3 flex items-center gap-2">
              <i class="fas fa-scale-balanced"></i>
              <span>Home Legal</span>
            </h5>
            <p class="text-gray-400">Solusi hukum terpercaya untuk bisnis dan individu.</p>
          </div>
          <div>
            <h6 class="font-semibold mb-3">Layanan</h6>
            <ul class="space-y-2 text-gray-400">
              <li><a href="#" class="hover:text-white transition">Konsultasi Hukum</a></li>
              <li><a href="#" class="hover:text-white transition">Litigasi</a></li>
              <li><a href="#" class="hover:text-white transition">Kontrak Bisnis</a></li>
            </ul>
          </div>
          <div>
            <h6 class="font-semibold mb-3">Tautan</h6>
            <ul class="space-y-2 text-gray-400">
              <li><a href="/about" class="hover:text-white transition">Tentang Kami</a></li>
              <li><a href="/artikel" class="hover:text-white transition">Artikel</a></li>
              <li><a href="/contact" class="hover:text-white transition">Konsultasi</a></li>
            </ul>
          </div>
          <div>
            <h6 class="font-semibold mb-3">Kontak</h6>
            <ul class="space-y-2 text-gray-400">
              <li><i class="fas fa-phone me-2"></i> +62 812 3456 7890</li>
              <li><i class="fas fa-envelope me-2"></i> info@legalhome.com</li>
              <li><i class="fas fa-map-marker-alt me-2"></i> Jakarta, Indonesia</li>
            </ul>
          </div>
        </div>
        <hr class="border-gray-700 my-6">
        <p class="text-center text-gray-400 text-sm">&copy; 2026 Home Legal. All rights reserved.</p>
      </div>
    </footer>
  </div>
</template>

<script>
export default {
  name: 'HomeLayout',
  data() {
    return {
      mobileMenuOpen: false
    }
  },
  computed: {
    isLoggedIn() {
      return !!localStorage.getItem('token');
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('token');
      window.location.href = '/login';
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-5 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-block;
}
</style>