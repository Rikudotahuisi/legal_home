<!-- resources/js/Pages/Contact.vue -->
<template>
  <HomeLayout>
    <!-- Hero Section -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-blue-950 via-blue-800 to-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block bg-yellow-400/20 text-yellow-400 px-4 py-1 rounded-full text-sm font-semibold mb-4">
          <i class="fas fa-phone me-2"></i> Konsultasi
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">Hubungi Kami</h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90">
          Konsultasikan masalah hukum Anda dengan tim profesional kami secara gratis
        </p>
      </div>
    </section>

    <!-- Konten Utama -->
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
          <!-- Form (3 kolom) -->
          <div class="lg:col-span-3">
            <div class="bg-white p-6 md:p-8 rounded-2xl shadow-md">
              <h3 class="text-2xl font-bold text-gray-900 mb-2">Kirim Pesan</h3>
              <p class="text-gray-600 mb-6">Isi formulir di bawah ini, tim kami akan segera merespon</p>
              
              <form @submit.prevent="submitForm" class="space-y-5">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label class="block text-sm font-medium mb-1">Nama Lengkap <span class="text-red-500">*</span></label>
                    <input type="text" v-model="form.name" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                  </div>
                  <div>
                    <label class="block text-sm font-medium mb-1">Email <span class="text-red-500">*</span></label>
                    <input type="email" v-model="form.email" required
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                  </div>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1">Perihal <span class="text-red-500">*</span></label>
                  <select v-model="form.subject" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <option value="">Pilih Bidang Hukum</option>
                    <option value="bisnis">Hukum Bisnis</option>
                    <option value="perdata">Litigasi Perdata</option>
                    <option value="pidana">Litigasi Pidana</option>
                    <option value="korpri">Hukum Korporasi</option>
                    <option value="lainnya">Lainnya</option>
                  </select>
                </div>
                <div>
                  <label class="block text-sm font-medium mb-1">Pesan <span class="text-red-500">*</span></label>
                  <textarea v-model="form.message" rows="5" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="Ceritakan masalah hukum Anda..."></textarea>
                </div>
                <button type="submit" :disabled="loading" 
                        class="btn-primary w-full py-4 text-lg">
                  <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
                  <i v-else class="fas fa-paper-plane me-2"></i>
                  {{ loading ? 'Mengirim...' : 'Kirim Konsultasi' }}
                </button>
              </form>
            </div>
          </div>

          <!-- Info & Peta (2 kolom) -->
          <div class="lg:col-span-2 space-y-6">
            <!-- Info Kontak -->
            <div class="bg-white p-6 rounded-2xl shadow-md">
              <h4 class="text-lg font-bold text-gray-900 mb-4">Informasi Kontak</h4>
              <div class="space-y-4">
                <div class="flex items-start gap-3">
                  <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-map-marker-alt text-blue-700"></i>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p class="font-medium">Jl. Hukum No. 123, Jakarta Selatan</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-envelope text-blue-700"></i>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">info@legalhome.com</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-phone text-blue-700"></i>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Telepon</p>
                    <p class="font-medium">+62 812 3456 7890</p>
                  </div>
                </div>
                <div class="flex items-start gap-3">
                  <div class="bg-blue-100 p-3 rounded-full">
                    <i class="fas fa-clock text-blue-700"></i>
                  </div>
                  <div>
                    <p class="text-sm text-gray-500">Jam Kerja</p>
                    <p class="font-medium">Senin - Jumat: 09.00 - 17.00 WIB</p>
                  </div>
                </div>
              </div>
            </div>

            <!-- Peta -->
            <div class="bg-white p-4 rounded-2xl shadow-md">
              <h4 class="text-lg font-bold text-gray-900 mb-3">Lokasi Kami</h4>
              <div class="rounded-xl overflow-hidden h-64">
                <iframe 
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.333690872703!2d119.87430417377061!3d-0.893038899098316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d8bedd9e19db635%3A0xbdc233f33d0a62cf!2sNew%20Central%20Stationery%20%26%20Cosmetics!5e0!3m2!1sid!2sid!4v1706494671512!5m2!1sid!2sid" 
                  class="w-full h-full"
                  allowfullscreen="" 
                  loading="lazy">
                </iframe>
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
  name: 'Contact',
  components: { HomeLayout },
  data() {
    return {
      loading: false,
      form: { name: '', email: '', subject: '', message: '' }
    }
  },
  methods: {
    submitForm() {
      this.loading = true;
      setTimeout(() => {
        alert('Terima kasih! Tim LegalHome akan segera menghubungi Anda.');
        this.form = { name: '', email: '', subject: '', message: '' };
        this.loading = false;
      }, 1500);
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center justify-center;
}
</style>