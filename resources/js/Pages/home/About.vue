<!-- resources/js/Pages/About.vue -->
<template>
  <HomeLayout>
    <!-- Hero Section About -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-blue-950 via-blue-800 to-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block bg-yellow-400/20 text-yellow-400 px-4 py-1 rounded-full text-sm font-semibold mb-4">
          <i class="fas fa-scale-balanced me-2"></i> Tentang Kami
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">LegalHome</h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90">
          Firma hukum terpercaya dengan pengalaman lebih dari 15 tahun dalam memberikan solusi hukum terbaik
        </p>
      </div>
    </section>

    <!-- Main Content -->
    <section class="py-16 md:py-20">
      <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
          <!-- Konten Kiri -->
          <div>
            <!-- Badge -->
            <span class="text-blue-800 font-semibold uppercase tracking-wider text-sm">Tentang Kami</span>
            
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2 mb-4">
              Menghadirkan Keadilan <br>
              <span class="text-blue-700">Untuk Semua</span>
            </h2>
            
            <p class="text-gray-600 leading-relaxed mb-6">
              LegalHome adalah firma hukum yang berkomitmen memberikan pendampingan hukum profesional, 
              transparan, dan terpercaya untuk individu maupun korporasi. Kami hadir untuk memastikan 
              hak-hak klien terlindungi dengan pendekatan yang humanis dan solutif.
            </p>

            <!-- Statistik -->
            <div class="grid grid-cols-2 gap-4 mb-6">
              <div class="bg-blue-50 rounded-xl p-4 text-center">
                <div class="text-3xl font-bold text-blue-800">15+</div>
                <p class="text-sm text-gray-600">Tahun Pengalaman</p>
              </div>
              <div class="bg-blue-50 rounded-xl p-4 text-center">
                <div class="text-3xl font-bold text-blue-800">500+</div>
                <p class="text-sm text-gray-600">Kasus Berhasil</p>
              </div>
              <div class="bg-blue-50 rounded-xl p-4 text-center">
                <div class="text-3xl font-bold text-blue-800">98%</div>
                <p class="text-sm text-gray-600">Tingkat Kepuasan</p>
              </div>
              <div class="bg-blue-50 rounded-xl p-4 text-center">
                <div class="text-3xl font-bold text-blue-800">50+</div>
                <p class="text-sm text-gray-600">Advokat Profesional</p>
              </div>
            </div>

            <!-- Poin Keunggulan -->
            <div class="space-y-3 mb-6">
              <div class="flex items-start gap-3">
                <div class="bg-blue-700 text-white rounded-full p-2 mt-0.5">
                  <i class="fas fa-check text-sm"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900">Tim Advokat Berpengalaman</h4>
                  <p class="text-sm text-gray-600">Didukung oleh tim profesional dengan sertifikasi dan pengalaman luas</p>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <div class="bg-blue-700 text-white rounded-full p-2 mt-0.5">
                  <i class="fas fa-check text-sm"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900">Pendekatan Humanis</h4>
                  <p class="text-sm text-gray-600">Mengedepankan komunikasi yang hangat dan pemahaman mendalam terhadap kasus klien</p>
                </div>
              </div>
              <div class="flex items-start gap-3">
                <div class="bg-blue-700 text-white rounded-full p-2 mt-0.5">
                  <i class="fas fa-check text-sm"></i>
                </div>
                <div>
                  <h4 class="font-semibold text-gray-900">Transparansi Biaya</h4>
                  <p class="text-sm text-gray-600">Biaya layanan yang jelas dan tidak ada biaya tersembunyi</p>
                </div>
              </div>
            </div>

            <!-- CTA -->
            <a href="/contact" class="btn-primary inline-flex items-center">
              <i class="fas fa-handshake me-2"></i> Konsultasi Sekarang
            </a>
          </div>

          <!-- Konten Kanan - Gambar -->
          <div class="relative">
            <!-- Gambar Utama -->
            <div class="rounded-2xl overflow-hidden shadow-2xl">
              <img 
                src="https://magazineblogs.co.uk/wp-content/uploads/2024/05/house-judges-gavel-table-courtroom-law-enforcement-office_705411-1217.jpg" 
                alt="LegalHome - Firma Hukum Profesional"
                class="w-full h-[500px] object-cover"
                loading="lazy"
              >
            </div>
            
            <!-- Floating Card -->
            <div class="absolute -bottom-6 -left-6 bg-white rounded-xl shadow-xl p-4 max-w-[200px] hidden md:block">
              <div class="flex items-center gap-3">
                <div class="bg-green-100 p-2 rounded-full">
                  <i class="fas fa-check-circle text-green-600 text-2xl"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500">Tingkat Keberhasilan</p>
                  <p class="text-xl font-bold text-gray-900">98%</p>
                </div>
              </div>
            </div>

            <!-- Floating Card 2 -->
            <div class="absolute -top-4 -right-4 bg-white rounded-xl shadow-xl p-4 max-w-[180px] hidden md:block">
              <div class="flex items-center gap-3">
                <div class="bg-blue-100 p-2 rounded-full">
                  <i class="fas fa-users text-blue-600 text-2xl"></i>
                </div>
                <div>
                  <p class="text-xs text-gray-500">Klien Puas</p>
                  <p class="text-xl font-bold text-gray-900">500+</p>
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- Visi Misi -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-16 pt-12 border-t border-gray-200">
          <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-eye text-blue-700 text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-2">Visi</h4>
            <p class="text-gray-600 text-sm">Menjadi firma hukum terkemuka yang dikenal karena integritas, profesionalisme, dan komitmen pada keadilan.</p>
          </div>
          <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-bullseye text-blue-700 text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-2">Misi</h4>
            <p class="text-gray-600 text-sm">Memberikan layanan hukum yang berkualitas, solutif, dan mudah diakses oleh semua lapisan masyarakat.</p>
          </div>
          <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition text-center">
            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-gem text-blue-700 text-2xl"></i>
            </div>
            <h4 class="text-xl font-bold text-gray-900 mb-2">Nilai</h4>
            <p class="text-gray-600 text-sm">Integritas, empati, profesionalisme, dan keberpihakan pada keadilan menjadi dasar setiap langkah kami.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Testimoni -->
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <div class="text-center mb-12">
          <span class="text-blue-800 font-semibold uppercase tracking-wider text-sm">Testimoni</span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-2">Apa Kata Klien Kami</h2>
          <p class="text-gray-600 mt-3">Pengalaman nyata dari mereka yang telah terbantu oleh LegalHome</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div v-for="testimonial in testimonials" :key="testimonial.id" 
               class="bg-white p-6 rounded-2xl shadow-md hover:shadow-lg transition">
            <div class="flex items-center gap-2 text-yellow-400 mb-3">
              <i v-for="n in 5" :key="n" class="fas fa-star"></i>
            </div>
            <p class="text-gray-600 italic mb-4">"{{ testimonial.text }}"</p>
            <div class="flex items-center gap-3">
              <div class="bg-blue-100 w-10 h-10 rounded-full flex items-center justify-center text-blue-700 font-bold">
                {{ testimonial.name.charAt(0) }}
              </div>
              <div>
                <p class="font-semibold text-gray-900 text-sm">{{ testimonial.name }}</p>
                <p class="text-xs text-gray-500">{{ testimonial.position }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CTA -->
    <section class="py-16 md:py-20 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
      <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">Butuh Pendampingan Hukum?</h2>
        <p class="text-lg mb-8 opacity-90 max-w-2xl mx-auto">
          Tim advokat kami siap membantu menyelesaikan masalah hukum Anda dengan pendekatan terbaik
        </p>
        <a href="/contact" class="btn-hero inline-flex items-center">
          <i class="fas fa-phone me-2"></i> Konsultasi Gratis
        </a>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'About',
  components: { HomeLayout },
  data() {
    return {
      testimonials: [
        {
          id: 1,
          name: 'Budi Santoso',
          position: 'Direktur PT Maju Jaya',
          text: 'Tim LegalHome sangat profesional dan membantu menyelesaikan sengketa bisnis kami dengan cepat dan adil.'
        },
        {
          id: 2,
          name: 'Siti Rahayu',
          position: 'Pengusaha UMKM',
          text: 'Terima kasih LegalHome! Pendampingan hukum untuk kontrak usaha saya sangat membantu dan transparan.'
        },
        {
          id: 3,
          name: 'Dr. Andi Wijaya',
          position: 'Konsultan Pendidikan',
          text: 'Pelayanan yang ramah, biaya jelas, dan hasil yang memuaskan. Saya sangat merekomendasikan LegalHome.'
        }
      ]
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-8 py-3 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center;
}
.btn-hero {
  @apply bg-yellow-400 text-blue-900 px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:scale-105 hover:shadow-lg inline-flex items-center;
}
</style>