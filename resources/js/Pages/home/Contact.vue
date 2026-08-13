<!-- resources/js/Pages/Contact.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <span class="text-blue-800 font-semibold uppercase tracking-wider">Konsultasi</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Hubungi Kami</h2>
          <p class="text-gray-600 mt-3">Konsultasikan masalah hukum Anda dengan tim profesional kami</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- Form Kiri -->
          <div>
            <form @submit.prevent="submitForm" class="space-y-4">
              <div>
                <label class="block text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" v-model="form.name" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Email</label>
                <input type="email" v-model="form.email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Perihal</label>
                <select v-model="form.subject" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                  <option value="">Pilih Bidang Hukum</option>
                  <option value="bisnis">Hukum Bisnis</option>
                  <option value="perdata">Litigasi Perdata</option>
                  <option value="pidana">Litigasi Pidana</option>
                  <option value="korpri">Hukum Korporasi</option>
                  <option value="lainnya">Lainnya</option>
                </select>
              </div>
              <div>
                <label class="block text-sm font-medium mb-1">Pesan</label>
                <textarea v-model="form.message" rows="4" required
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"></textarea>
              </div>
              <button type="submit" class="btn-primary w-full">
                <i class="fas fa-paper-plane me-2"></i> Kirim Konsultasi
              </button>
            </form>
          </div>
          
          <!-- Peta Kanan -->
          <div>
            <div class="bg-gray-50 p-4 rounded-2xl shadow-md h-full">
              <h5 class="text-xl font-bold mb-3 flex items-center gap-2">
                <i class="fas fa-map-marker-alt text-blue-800"></i>
                Lokasi Kami
              </h5>
              <div class="rounded-xl overflow-hidden h-[400px] md:h-[450px] w-full">
                <iframe 
                  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.333690872703!2d119.87430417377061!3d-0.893038899098316!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d8bedd9e19db635%3A0xbdc233f33d0a62cf!2sNew%20Central%20Stationery%20%26%20Cosmetics!5e0!3m2!1sid!2sid!4v1706494671512!5m2!1sid!2sid" 
                  class="w-full h-full"
                  allowfullscreen="" 
                  loading="lazy" 
                  referrerpolicy="no-referrer-when-downgrade">
                </iframe>
              </div>
              <!-- Info Kontak di Bawah Peta -->
              <div class="grid grid-cols-2 gap-3 mt-4 text-sm">
                <div>
                  <p class="text-gray-500"><i class="fas fa-map-pin text-blue-700 me-1"></i> Alamat</p>
                  <p class="font-medium">Jl. Hukum No. 123, Jakarta Selatan</p>
                </div>
                <div>
                  <p class="text-gray-500"><i class="fas fa-envelope text-blue-700 me-1"></i> Email</p>
                  <p class="font-medium">info@legalhome.com</p>
                </div>
                <div>
                  <p class="text-gray-500"><i class="fas fa-phone text-blue-700 me-1"></i> Telepon</p>
                  <p class="font-medium">+</p>
                </div>
                <div>
                  <p class="text-gray-500"><i class="fas fa-clock text-blue-700 me-1"></i> Jam Kerja</p>
                  <p class="font-medium text-xs">Senin-Jumat: 09.00-17.00 WIB</p>
                </div>
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
      form: { name: '', email: '', subject: '', message: '' }
    }
  },
  methods: {
    submitForm() {
      alert('Terima kasih! Tim LegalHome akan segera menghubungi Anda.');
      this.form = { name: '', email: '', subject: '', message: '' };
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition transform;
}
</style>