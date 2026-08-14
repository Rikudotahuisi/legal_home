<!-- resources/js/Layouts/GuestLayout.vue -->
<template>
  <div class="min-h-screen bg-gray-50">
    <!-- Navbar Sederhana -->
    <nav class="bg-white shadow-sm">
      <div class="container mx-auto px-4 py-3">
        <Link href="/" class="text-2xl font-bold">
          <span class="text-blue-900">Legal</span><span class="text-gray-700">Home</span>
        </Link>
      </div>
    </nav>

    <!-- Content -->
    <main>
      <slot />
    </main>

    <!-- Footer Sederhana -->
    <footer class="bg-gray-900 text-white py-6 mt-8">
      <div class="container mx-auto px-4 text-center text-sm text-gray-400">
        &copy; 2026 LegalHome. All rights reserved.
      </div>
    </footer>
  </div>
</template>

<script>
import { Link } from '@inertiajs/vue3';

export default {
  name: 'GuestLayout',
  components: { Link }
}
</script>