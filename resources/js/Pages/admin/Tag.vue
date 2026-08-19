<!-- resources/js/Pages/admin/Tag.vue -->
<template>
  <HomeLayout>
    <!-- ========== HERO SECTION ========== -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-blue-950 via-blue-800 to-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block bg-yellow-400/20 text-yellow-400 px-4 py-1 rounded-full text-sm font-semibold mb-4">
          <i class="fas fa-tags me-2"></i> 
          <span v-if="mode === 'list'">Kelola Tags</span>
          <span v-else-if="mode === 'create'">Tambah Tag</span>
          <span v-else-if="mode === 'edit'">Edit Tag</span>
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
          <span v-if="mode === 'list'">Manajemen Tags</span>
          <span v-else-if="mode === 'create'">Tambah Tag Baru</span>
          <span v-else-if="mode === 'edit'">Edit Tag</span>
        </h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90">
          <span v-if="mode === 'list'">Kelola semua tag untuk artikel hukum</span>
          <span v-else-if="mode === 'create'">Buat tag baru untuk artikel</span>
          <span v-else-if="mode === 'edit'">Perbarui nama tag</span>
        </p>
      </div>
    </section>

    <!-- ========== MODE LIST ========== -->
    <template v-if="mode === 'list'">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-4xl">
          <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            <div class="flex justify-between items-center flex-wrap gap-4 mb-6">
              <div>
                <h2 class="text-2xl font-bold text-gray-900">Daftar Tags</h2>
                <p class="text-gray-600 text-sm">Total: {{ tags?.length || 0 }} tag</p>
              </div>
              <button @click="switchMode('create')" class="btn-primary inline-flex items-center">
                <i class="fas fa-plus me-2"></i> Tambah Tag
              </button>
            </div>

            <!-- Daftar Tags -->
            <div v-if="tags && tags.length > 0" class="flex flex-wrap gap-3">
              <div v-for="tag in tags" :key="tag.id" 
                   class="group flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-800 px-4 py-2 rounded-full transition">
                <span class="font-medium">{{ tag.nametag }}</span>
                <button @click="switchMode('edit', tag.id)" 
                        class="text-blue-500 hover:text-blue-700 transition opacity-0 group-hover:opacity-100">
                  <i class="fas fa-edit"></i>
                </button>
                <button @click="deleteTag(tag.id)" 
                        class="text-red-400 hover:text-red-600 transition opacity-0 group-hover:opacity-100">
                  <i class="fas fa-times-circle"></i>
                </button>
              </div>
            </div>
            <div v-else class="text-center py-12">
              <i class="fas fa-tags text-5xl text-gray-300 mb-4"></i>
              <p class="text-gray-400">Belum ada tag. Buat tag pertama Anda!</p>
              <button @click="switchMode('create')" class="btn-primary inline-flex items-center mt-4">
                <i class="fas fa-plus me-2"></i> Tambah Tag
              </button>
            </div>
          </div>

          <!-- Tombol Kembali ke Artikel -->
          <div class="mt-6 text-center">
            <a href="/artikel" class="text-blue-700 hover:text-blue-900 transition inline-flex items-center">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Artikel
            </a>
          </div>
        </div>
      </section>
    </template>

    <!-- ========== MODE CREATE ========== -->
    <template v-else-if="mode === 'create'">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-2xl">
          <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            <div class="flex items-center gap-4 mb-6">
              <button @click="switchMode('list')" class="text-blue-700 hover:text-blue-900 transition">
                <i class="fas fa-arrow-left text-xl"></i>
              </button>
              <div>
                <h2 class="text-2xl font-bold text-gray-900">Tambah Tag</h2>
                <p class="text-gray-600">Buat tag baru untuk artikel</p>
              </div>
            </div>

            <form @submit.prevent="submitCreate">
              <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Tag <span class="text-red-500">*</span></label>
                <input type="text" v-model="createForm.nametag" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                       placeholder="Contoh: Hukum Bisnis">
                <p v-if="createForm.errors.nametag" class="text-red-500 text-sm mt-1">
                  {{ createForm.errors.nametag }}
                </p>
              </div>

              <div class="flex gap-4">
                <button type="submit" :disabled="loading" class="btn-primary">
                  <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
                  <i v-else class="fas fa-save me-2"></i>
                  {{ loading ? 'Menyimpan...' : 'Simpan Tag' }}
                </button>
                <button type="button" @click="switchMode('list')" 
                        class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition">
                  Batal
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </template>

    <!-- ========== MODE EDIT ========== -->
    <template v-else-if="mode === 'edit' && selectedTag">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-2xl">
          <div class="bg-white rounded-2xl shadow-md p-6 md:p-8">
            <div class="flex items-center gap-4 mb-6">
              <button @click="switchMode('list')" class="text-blue-700 hover:text-blue-900 transition">
                <i class="fas fa-arrow-left text-xl"></i>
              </button>
              <div>
                <h2 class="text-2xl font-bold text-gray-900">Edit Tag</h2>
                <p class="text-gray-600">Perbarui nama tag</p>
              </div>
            </div>

            <form @submit.prevent="submitEdit">
              <div class="mb-4">
                <label class="block text-sm font-medium mb-1">Nama Tag <span class="text-red-500">*</span></label>
                <input type="text" v-model="editForm.nametag" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                <p v-if="editForm.errors.nametag" class="text-red-500 text-sm mt-1">
                  {{ editForm.errors.nametag }}
                </p>
              </div>

              <div class="flex gap-4">
                <button type="submit" :disabled="loading" class="btn-primary">
                  <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
                  <i v-else class="fas fa-save me-2"></i>
                  {{ loading ? 'Menyimpan...' : 'Perbarui Tag' }}
                </button>
                <button type="button" @click="switchMode('list')" 
                        class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition">
                  Batal
                </button>
              </div>
            </form>
          </div>
        </div>
      </section>
    </template>

    <!-- ========== CTA ========== -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
      <div class="container mx-auto px-4 text-center">
        <h3 class="text-2xl font-bold mb-2">Butuh Bantuan?</h3>
        <p class="text-lg mb-6 opacity-90">Tim admin kami siap membantu Anda</p>
        <a href="/contact" class="btn-hero inline-flex items-center">
          <i class="fas fa-headset me-2"></i> Hubungi Admin
        </a>
      </div>
    </section>
  </HomeLayout>
</template>

<script>
import { useForm, usePage } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'TagManager',
  components: { HomeLayout },
  props: {
    // Data dari server
    tags: {
      type: Array,
      default: () => []
    },
    tag: {
      type: Object,
      default: null
    },
    mode: {
      type: String,
      default: 'list' // list | create | edit
    }
  },
  data() {
    return {
      loading: false,
      selectedTag: this.tag || null,
      // Form Create
      createForm: useForm({
        nametag: ''
      }),
      // Form Edit
      editForm: useForm({
        nametag: this.tag?.nametag || ''
      })
    }
  },
  methods: {
    // ========== SWITCH MODE ==========
    switchMode(mode, id = null) {
      if (mode === 'list') {
        window.location.href = '/tag/list';
      } else if (mode === 'create') {
        window.location.href = '/tag/create';
      } else if (mode === 'edit' && id) {
        window.location.href = `/tag/update/${id}`;
      }
    },

    // ========== CREATE TAG ==========
    submitCreate() {
      this.loading = true;
      this.createForm.post('/tag/create', {
        onSuccess: () => {
          this.loading = false;
          window.location.href = '/tag/list';
        },
        onError: (errors) => {
          this.loading = false;
          console.error('Error:', errors);
        }
      });
    },

    // ========== EDIT TAG ==========
    submitEdit() {
      this.loading = true;
      this.editForm.post(`/tag/update/${this.tag.id}`, {
        onSuccess: () => {
          this.loading = false;
          window.location.href = '/tag/list';
        },
        onError: (errors) => {
          this.loading = false;
          console.error('Error:', errors);
        }
      });
    },

    // ========== DELETE TAG ==========
    deleteTag(id) {
      if (confirm('Apakah Anda yakin ingin menghapus tag ini?')) {
        this.$inertia.post('/tag/delete', { id }, {
          onSuccess: () => {
            window.location.reload();
          },
          onError: (errors) => {
            alert('Gagal menghapus tag: ' + (errors.message || 'Terjadi kesalahan'));
          }
        });
      }
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center justify-center;
}
.btn-hero {
  @apply bg-yellow-400 text-blue-900 px-8 py-3 rounded-full font-semibold transition-all duration-300 hover:scale-105 hover:shadow-2xl inline-flex items-center;
}
</style>