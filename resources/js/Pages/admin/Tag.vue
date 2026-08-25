<!-- resources/js/Pages/admin/Tag.vue -->
<template>
  <AdminLayout>
    <!-- ============================================================ -->
    <!-- MODE LIST - Daftar Tags -->
    <!-- ============================================================ -->
    <template v-if="mode === 'list'">
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center justify-between flex-wrap gap-4">
          <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Tags</h1>
            <p class="text-gray-500">Kelola semua tag untuk artikel hukum</p>
          </div>
          <button @click="switchMode('create')" class="btn-primary inline-flex items-center">
            <i class="fas fa-plus me-2"></i> Tambah Tag
          </button>
        </div>
      </div>

      <!-- Daftar Tags -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6">
          <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-gray-500">Total: <span class="font-semibold text-gray-700">{{ tags?.length || 0 }}</span> tag</p>
          </div>

          <div v-if="tags && tags.length > 0" class="flex flex-wrap gap-3">
            <div v-for="tag in tags" :key="tag.id" 
                 class="group flex items-center gap-2 bg-blue-50 hover:bg-blue-100 text-blue-800 px-4 py-2.5 rounded-full transition border border-blue-200/50">
              <span class="font-medium">{{ tag.name }}</span>
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
            <div class="w-20 h-20 bg-gray-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
              <i class="fas fa-tags text-3xl text-gray-400"></i>
            </div>
            <p class="text-gray-400">Belum ada tag</p>
            <button @click="switchMode('create')" class="btn-primary inline-flex items-center mt-4">
              <i class="fas fa-plus me-2"></i> Buat Tag Pertama
            </button>
          </div>

          <!-- Tombol Kembali -->
          <div class="mt-6 pt-4 border-t border-gray-200">
            <a href="/artikel" class="text-blue-700 hover:text-blue-900 transition inline-flex items-center text-sm">
              <i class="fas fa-arrow-left me-2"></i> Kembali ke Artikel
            </a>
          </div>
        </div>
      </div>
    </template>

    <!-- ============================================================ -->
    <!-- MODE CREATE - Tambah Tag -->
    <!-- ============================================================ -->
    <template v-else-if="mode === 'create'">
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
          <button @click="switchMode('list')" class="text-gray-400 hover:text-blue-700 transition">
            <i class="fas fa-arrow-left text-xl"></i>
          </button>
          <h1 class="text-2xl font-bold text-gray-800">Tambah Tag</h1>
        </div>
        <p class="text-gray-500">Buat tag baru untuk artikel</p>
      </div>

      <!-- Form -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form @submit.prevent="submitCreate" class="p-6 md:p-8">
          <!-- Nama Tag -->
          <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Nama Tag <span class="text-red-500">*</span>
            </label>
            <input type="text" v-model="createForm.name" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 hover:bg-white"
                   placeholder="Contoh: Hukum Bisnis">
            <p v-if="createForm.errors.name" class="text-red-500 text-sm mt-1">{{ createForm.errors.name }}</p>
            <p class="text-xs text-gray-400 mt-1">
              <i class="fas fa-info-circle me-1"></i> Tag akan otomatis memiliki slug dari nama yang dimasukkan
            </p>
          </div>

          <!-- Tombol -->
          <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200">
            <button type="submit" :disabled="loading" 
                    class="btn-primary px-8 py-3 min-w-[140px]">
              <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
              <i v-else class="fas fa-save me-2"></i>
              {{ loading ? 'Menyimpan...' : 'Simpan Tag' }}
            </button>
            <button type="button" @click="switchMode('list')" 
                    class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition text-center text-gray-600">
              Batal
            </button>
          </div>
        </form>
      </div>
    </template>

    <!-- ============================================================ -->
    <!-- MODE EDIT - Edit Tag -->
    <!-- ============================================================ -->
    <template v-else-if="mode === 'edit' && tag">
      <!-- Header -->
      <div class="mb-8">
        <div class="flex items-center gap-3 mb-2">
          <button @click="switchMode('list')" class="text-gray-400 hover:text-blue-700 transition">
            <i class="fas fa-arrow-left text-xl"></i>
          </button>
          <h1 class="text-2xl font-bold text-gray-800">Edit Tag</h1>
        </div>
        <p class="text-gray-500">Perbarui nama tag</p>
      </div>

      <!-- Form -->
      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <form @submit.prevent="submitEdit" class="p-6 md:p-8">
          <!-- Nama Tag -->
          <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">
              Nama Tag <span class="text-red-500">*</span>
            </label>
            <input type="text" v-model="editForm.name" required
                   class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition bg-gray-50/50 hover:bg-white">
            <p v-if="editForm.errors.name" class="text-red-500 text-sm mt-1">{{ editForm.errors.name }}</p>
          </div>

          <!-- Tombol -->
          <div class="flex flex-wrap gap-3 pt-6 border-t border-gray-200">
            <button type="submit" :disabled="loading" 
                    class="btn-primary px-8 py-3 min-w-[140px]">
              <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
              <i v-else class="fas fa-save me-2"></i>
              {{ loading ? 'Menyimpan...' : 'Perbarui Tag' }}
            </button>
            <button type="button" @click="switchMode('list')" 
                    class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition text-center text-gray-600">
              Batal
            </button>
          </div>
        </form>
      </div>
    </template>
  </AdminLayout>
</template>

<script>
import { useForm } from '@inertiajs/vue3';
import AdminLayout from '@/Layouts/AdminLayout.vue';

export default {
  name: 'TagManager',
  components: { AdminLayout },
  props: {
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
      default: 'list'
    }
  },
  data() {
    return {
      loading: false,
      createForm: useForm({
        name: ''
      }),
      editForm: useForm({
        name: this.tag?.name || ''
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

    // ========== CREATE ==========
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
          const errorMessages = Object.values(errors).flat().join('\n');
          alert('Error:\n' + errorMessages || 'Terjadi kesalahan. Silakan cek kembali form Anda.');
        }
      });
    },

    // ========== EDIT ==========
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
          const errorMessages = Object.values(errors).flat().join('\n');
          alert('Error:\n' + errorMessages || 'Terjadi kesalahan. Silakan cek kembali form Anda.');
        }
      });
    },

    // ========== DELETE ==========
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
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2.5 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center justify-center;
}
</style>