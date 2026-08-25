<!-- resources/js/Pages/admin/GaleriCreate.vue -->
<template>
  <AdminLayout>
    <!-- ===== HEADER ===== -->
    <div class="mb-8">
      <div class="flex items-center gap-3 mb-2">
        <a href="/galery" class="text-gray-400 hover:text-blue-700 transition">
          <i class="fas fa-arrow-left text-xl"></i>
        </a>
        <h1 class="text-2xl font-bold text-gray-800">Tambah Foto</h1>
      </div>
      <p class="text-gray-500">Upload foto kegiatan Anda ke galeri</p>
    </div>

    <!-- ===== FORM ===== -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
      <form @submit.prevent="submitForm" enctype="multipart/form-data" class="p-6 md:p-8">
        
        <!-- ===== JUDUL ===== -->
        <div class="mb-6">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Judul <span class="text-red-500">*</span>
          </label>
          <input type="text" v-model="form.title" required
                 class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 hover:bg-white"
                 placeholder="Masukkan judul foto">
          <p v-if="form.errors.title" class="text-red-500 text-sm mt-1">{{ form.errors.title }}</p>
        </div>

        <!-- ===== KATEGORI ===== -->
        <div class="mb-6">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Kategori
          </label>
          <select v-model="form.category"
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 hover:bg-white appearance-none">
            <option value="">Pilih Kategori</option>
            <option v-for="cat in categories" :key="cat" :value="cat">
              {{ cat }}
            </option>
          </select>
        </div>

        <!-- ===== DESKRIPSI ===== -->
        <div class="mb-6">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Deskripsi
          </label>
          <textarea v-model="form.description" rows="4"
                    class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 hover:bg-white"
                    placeholder="Deskripsi singkat tentang foto ini"></textarea>
        </div>

        <!-- ===== UPLOAD FOTO ===== -->
        <div class="mb-8">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Foto <span class="text-red-500">*</span>
          </label>
          
          <div class="relative">
            <input type="file" @change="handleFileUpload" accept="image/*" required
                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
            
            <div class="w-full p-8 border-2 border-dashed border-gray-300 rounded-xl text-center hover:border-blue-500 transition bg-gray-50/30 hover:bg-blue-50/30">
              <!-- Preview Gambar -->
              <div v-if="previewImage" class="relative">
                <img :src="previewImage" class="max-h-56 mx-auto rounded-lg shadow-sm" alt="Preview">
                <div class="mt-3 flex items-center justify-center gap-3">
                  <span class="text-sm text-green-600 font-medium">
                    <i class="fas fa-check-circle me-1"></i> Foto siap diupload
                  </span>
                  <button type="button" @click="removeImage" 
                          class="text-sm text-red-500 hover:text-red-700 transition">
                    <i class="fas fa-times-circle"></i> Hapus
                  </button>
                </div>
              </div>
              
              <!-- Upload Area -->
              <div v-else>
                <div class="w-20 h-20 bg-blue-50 rounded-2xl flex items-center justify-center mx-auto mb-4">
                  <i class="fas fa-cloud-upload-alt text-3xl text-blue-400"></i>
                </div>
                <p class="text-gray-500 font-medium">Klik atau drag & drop untuk upload foto</p>
                <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, GIF, WebP (Max 5MB)</p>
              </div>
            </div>
          </div>
          
          <p v-if="form.errors.image" class="text-red-500 text-sm mt-2">{{ form.errors.image }}</p>
        </div>

        <!-- ===== TOMBOL ===== -->
        <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200">
          <button type="submit" :disabled="loading" 
                  class="btn-primary px-8 py-3 min-w-[140px]">
            <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
            <i v-else class="fas fa-save me-2"></i>
            {{ loading ? 'Menyimpan...' : 'Simpan Foto' }}
          </button>
          <a href="/galery" 
             class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition text-center text-gray-600">
            Batal
          </a>
        </div>
      </form>
    </div>
  </AdminLayout>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

export default {
  name: 'GaleriCreate',
  components: { AdminLayout },
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
        // Validasi ukuran file (5MB)
        if (file.size > 5 * 1024 * 1024) {
          alert('Ukuran file terlalu besar. Maksimal 5MB.');
          event.target.value = '';
          return;
        }
        this.form.image = file;
        this.previewImage = URL.createObjectURL(file);
      }
    },
    removeImage() {
      this.form.image = null;
      this.previewImage = null;
      // Reset input file
      const fileInput = document.querySelector('input[type="file"]');
      if (fileInput) fileInput.value = '';
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
          const errorMessages = Object.values(errors).flat().join('\n');
          alert('Error:\n' + errorMessages || 'Terjadi kesalahan. Silakan cek kembali form Anda.');
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
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2.5 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center justify-center;
}
</style>