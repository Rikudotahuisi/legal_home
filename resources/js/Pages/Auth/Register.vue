<!-- resources/js/Pages/Auth/Register.vue -->
<template>
  <GuestLayout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
      <div class="max-w-md w-full">
        <!-- Card Register -->
        <div class="bg-white p-8 rounded-2xl shadow-lg">
          <!-- Logo -->
          <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-blue-100 rounded-full mb-4">
              <i class="fas fa-user-plus text-3xl text-blue-700"></i>
            </div>
            <h2 class="text-3xl font-bold text-gray-900">Daftar Akun</h2>
            <p class="mt-2 text-sm text-gray-600">Buat akun LegalHome baru</p>
          </div>

          <!-- Form Register -->
          <form @submit.prevent="submit" class="space-y-5">
            <!-- Name -->
            <div>
              <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-user me-2 text-gray-400"></i> Nama Lengkap
              </label>
              <input 
                id="name" 
                type="text" 
                v-model="form.name" 
                required
                autofocus
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                placeholder="Nama lengkap Anda"
              >
              <p v-if="form.errors.name" class="text-red-500 text-sm mt-1">
                <i class="fas fa-exclamation-circle me-1"></i> {{ form.errors.name }}
              </p>
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-envelope me-2 text-gray-400"></i> Alamat Email
              </label>
              <input 
                id="email" 
                type="email" 
                v-model="form.email" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                placeholder="nama@email.com"
              >
              <p v-if="form.errors.email" class="text-red-500 text-sm mt-1">
                <i class="fas fa-exclamation-circle me-1"></i> {{ form.errors.email }}
              </p>
            </div>

            <!-- Password -->
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-lock me-2 text-gray-400"></i> Password
              </label>
              <div class="relative">
                <input 
                  id="password" 
                  :type="showPassword ? 'text' : 'password'" 
                  v-model="form.password" 
                  required
                  class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                  placeholder="Minimal 8 karakter"
                >
                <button 
                  type="button"
                  @click="showPassword = !showPassword"
                  class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600 transition"
                >
                  <i :class="showPassword ? 'fas fa-eye-slash' : 'fas fa-eye'"></i>
                </button>
              </div>
              <p v-if="form.errors.password" class="text-red-500 text-sm mt-1">
                <i class="fas fa-exclamation-circle me-1"></i> {{ form.errors.password }}
              </p>
            </div>

            <!-- Confirm Password -->
            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                <i class="fas fa-check-circle me-2 text-gray-400"></i> Konfirmasi Password
              </label>
              <input 
                id="password_confirmation" 
                :type="showPassword ? 'text' : 'password'" 
                v-model="form.password_confirmation" 
                required
                class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                placeholder="Ulangi password"
              >
            </div>

            <!-- Button Register -->
            <button 
              type="submit" 
              :disabled="form.processing" 
              class="btn-primary w-full py-3 text-lg group"
            >
              <span v-if="form.processing" class="flex items-center justify-center">
                <i class="fas fa-spinner fa-spin me-2"></i> Memproses...
              </span>
              <span v-else class="flex items-center justify-center">
                <i class="fas fa-user-plus me-2 group-hover:translate-x-1 transition"></i> 
                Daftar Sekarang
              </span>
            </button>

            <!-- Login Link -->
            <div class="text-center pt-4 border-t border-gray-200">
              <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <Link :href="route('login')" class="text-blue-700 hover:text-blue-900 font-semibold transition">
                  Masuk Sekarang
                </Link>
              </p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<script>
import { Link, useForm } from '@inertiajs/vue3';
import GuestLayout from '@/Layouts/GuestLayout.vue';

export default {
  name: 'Register',
  components: { Link, GuestLayout },
  data() {
    return {
      showPassword: false,
      form: useForm({
        name: '',
        email: '',
        password: '',
        password_confirmation: ''
      })
    }
  },
  methods: {
    submit() {
      this.form.post('/register', {
        onSuccess: () => {
          // Redirect ke home setelah register
          window.location.href = '/';
        },
        onError: (errors) => {
          console.error('Register gagal:', errors);
          if (Object.keys(errors).length === 0) {
            alert('Terjadi kesalahan. Silakan coba lagi.');
          }
        }
      });
    }
  }
}
</script>

<style scoped>
.btn-primary {
  @apply bg-gradient-to-r from-blue-700 to-blue-900 text-white px-6 py-2 rounded-full font-semibold hover:scale-105 transition transform inline-flex items-center justify-center;
}
</style>