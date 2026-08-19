<!-- resources/js/Pages/admin/Dashboard.vue -->
<template>
  <HomeLayout>
    <section class="py-16 md:py-20 bg-gray-50">
      <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Dashboard Admin</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center gap-4">
              <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-file-alt text-2xl text-blue-700"></i>
              </div>
              <div>
                <p class="text-sm text-gray-500">Total Artikel</p>
                <p class="text-2xl font-bold">{{ totalArticles }}</p>
              </div>
            </div>
          </div>
          
          <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center gap-4">
              <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-users text-2xl text-green-700"></i>
              </div>
              <div>
                <p class="text-sm text-gray-500">Total User</p>
                <p class="text-2xl font-bold">{{ totalUsers }}</p>
              </div>
            </div>
          </div>
          
          <div class="bg-white p-6 rounded-2xl shadow-md">
            <div class="flex items-center gap-4">
              <div class="bg-red-100 p-3 rounded-full">
                <i class="fas fa-trash text-2xl text-red-700"></i>
              </div>
              <div>
                <p class="text-sm text-gray-500">Artikel Terhapus</p>
                <p class="text-2xl font-bold">{{ trashedArticles }}</p>
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
  name: 'AdminDashboard',
  components: { HomeLayout },
  props: {
    totalArticles: Number,
    totalUsers: Number,
    trashedArticles: Number
  }
}
</script>