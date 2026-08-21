<!-- resources/js/Pages/admin/GaleriCreate.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4 max-w-2xl">
        <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
          <!-- Header -->
          <div class="flex items-center gap-4 mb-6">
            <a href="/galery" class="text-blue-700 hover:text-blue-900 transition">
              <i class="fas fa-arrow-left text-xl"></i>
            </a>
            <div>
              <h2 class="text-2xl font-bold text-gray-900">Tambah Foto</h2>
              <p class="text-gray-600">Tambahkan foto ke galeri kegiatan</p>
            </div>
          </div>

          <!-- Form -->
          <form @submit.prevent="submitForm" enctype="multipart/form-data">
            <!-- Title -->
            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Judul <span class="text-red-500">*</span></label>
              <input type="text" v-model="form.title" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                     placeholder="Masukkan judul foto">
            </div>

            <!-- Category - DROPDOWN -->
            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Kategori</label>
              <select v-model="form.category"
                      class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-white">
                <option value="">Pilih Kategori</option>
                <option v-for="cat in categories" :key="cat" :value="cat">
                  {{ cat }}
                </option>
              </select>
            </div>

            <!-- Description -->
            <div class="mb-4">
              <label class="block text-sm font-medium mb-1">Deskripsi</label>
              <textarea v-model="form.description" rows="3"
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Deskripsi singkat tentang foto ini"></textarea>
            </div>

            <!-- Image Upload -->
            <div class="mb-6">
              <label class="block text-sm font-medium mb-1">Foto <span class="text-red-500">*</span></label>
              <div class="relative">
                <input type="file" @change="handleFileUpload" accept="image/*" required
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="w-full px-4 py-8 border-2 border-dashed border-gray-300 rounded-xl text-center hover:border-blue-500 transition">
                  <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                  <p class="text-gray-500" v-if="!previewImage">Klik atau drag & drop untuk upload foto</p>
                  <div v-else class="relative">
                    <img :src="previewImage" class="max-h-48 mx-auto rounded-lg" alt="Preview">
                    <p class="text-sm text-green-600 mt-2">✓ Foto siap diupload</p>
                  </div>
                  <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, GIF, WebP (Max 5MB)</p>
                </div>
              </div>
              <p v-if="form.errors.image" class="text-red-500 text-sm mt-1">{{ form.errors.image }}</p>
            </div>

            <!-- Buttons -->
            <div class="flex gap-4 pt-4 border-t border-gray-200">
              <button type="submit" :disabled="loading" class="btn-primary flex-1 md:flex-none px-8 py-3">
                <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
                <i v-else class="fas fa-save me-2"></i>
                {{ loading ? 'Menyimpan...' : 'Simpan Foto' }}
              </button>
              <a href="/galery" class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition text-center flex-1 md:flex-none">
                Batal
              </a>
            </div>
          </form>
        </div>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'GaleriCreate',
  components: { HomeLayout },
  data() {
    return {
      loading: false,
      previewImage: null,
      categories: [
        'Sidang',
        'Konsultasi',
        'Workshop',
        'Acara',
        'Mediasi',
        'Penandatanganan Kontrak',
        'Sertifikasi',
        'Kegiatan Sosial',
        'Lainnya'
      ],
      form: useForm({
        title: '',
        category: '',
        description: '',
        image: null,
      })
    }
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.form.image = file;
        this.previewImage = URL.createObjectURL(file);
      }
    },
    submitForm() {
      this.loading = true;
      this.form.post('/galery', {
        onSuccess: () => {
          this.loading = false;
          window.location.href = '/galery';
        },
        onError: (errors) => {
          this.loading = false;
          console.error('Error:', errors);
          if (Object.keys(errors).length === 0) {
            alert('Terjadi kesalahan. Silakan cek kembali form Anda.');
          }
        }
      });
    }
  },
  beforeUnmount() {
    if (this.previewImage) {
      URL.revokeObjectURL(this.previewImage);
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center justify-center;
}
</style>