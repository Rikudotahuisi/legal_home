<!-- resources/js/Pages/home/Artikel.vue -->
<template>
  <HomeLayout>
    <!-- ============================================================ -->
    <!-- HERO SECTION -->
    <!-- ============================================================ -->
    <section class="relative py-16 md:py-24 bg-gradient-to-r from-blue-950 via-blue-800 to-gray-900 text-white overflow-hidden">
      <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 right-0 w-96 h-96 bg-yellow-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-blue-400 rounded-full blur-3xl"></div>
      </div>
      <div class="container mx-auto px-4 relative z-10 text-center">
        <span class="inline-block bg-yellow-400/20 text-yellow-400 px-4 py-1 rounded-full text-sm font-semibold mb-4">
          <i class="fas fa-newspaper me-2"></i> 
          <span v-if="mode === 'index'">Artikel Hukum</span>
          <span v-else-if="mode === 'create'">Buat Artikel</span>
          <span v-else-if="mode === 'edit'">Edit Artikel</span>
          <span v-else-if="mode === 'trashed'">Sampah</span>
          <span v-else>Detail Artikel</span>
        </span>
        <h1 class="text-4xl md:text-5xl font-bold mb-4">
          <span v-if="mode === 'index'">Wawasan & Informasi Hukum</span>
          <span v-else-if="mode === 'create'">Buat Artikel Baru</span>
          <span v-else-if="mode === 'edit'">Edit Artikel</span>
          <span v-else-if="mode === 'trashed'">Artikel Terhapus</span>
          <span v-else>{{ artikel?.artikeltitle || 'Detail Artikel' }}</span>
        </h1>
        <p class="text-lg md:text-xl max-w-2xl mx-auto opacity-90">
          <span v-if="mode === 'index'">Artikel terbaru seputar hukum dan peraturan di Indonesia dari tim LegalHome</span>
          <span v-else-if="mode === 'create' || mode === 'edit'">Bagikan wawasan hukum Anda</span>
          <span v-else-if="mode === 'trashed'">Artikel yang telah dihapus sementara dapat dipulihkan kembali</span>
          <span v-else>Baca artikel lengkap dari tim LegalHome</span>
        </p>
      </div>
    </section>

    <!-- ============================================================ -->
    <!-- MODE INDEX -->
    <!-- ============================================================ -->
    <template v-if="mode === 'index'">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
          <!-- Header -->
          <div class="flex justify-between items-center flex-wrap gap-4 mb-8">
            <div>
              <Link :href="'/artikel/trashed'" 
                    class="text-sm text-gray-500 hover:text-red-600 transition inline-flex items-center">
                <i class="fas fa-trash me-1"></i> Sampah
              </Link>
            </div>
            <Link v-if="canCreate" :href="'/artikel/create'" 
                  class="btn-primary inline-flex items-center">
              <i class="fas fa-plus-circle me-2"></i> Buat Artikel
            </Link>
          </div>

          <!-- Grid Artikel -->
          <div v-if="artikels && artikels.data && artikels.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <div v-for="item in artikels.data" :key="item.id" 
                 class="group bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 hover:-translate-y-2 overflow-hidden">
              <!-- Thumbnail -->
              <div class="relative h-48 overflow-hidden">
                <img v-if="item.image" :src="item.image" class="w-full h-full object-cover" :alt="item.artikeltitle">
                <div v-else class="w-full h-full bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                  <i class="fas fa-gavel text-6xl text-blue-400/50 group-hover:scale-110 transition duration-500"></i>
                </div>
                <div class="absolute top-3 left-3 flex flex-wrap gap-1">
                  <span v-for="tag in item.tags.slice(0, 2)" :key="tag.id" 
                        class="text-xs bg-blue-700/90 text-white px-2 py-1 rounded-full">
                    {{ tag.name }}
                  </span>
                  <span v-if="item.tags.length > 2" 
                        class="text-xs bg-gray-700/90 text-white px-2 py-1 rounded-full">
                    +{{ item.tags.length - 2 }}
                  </span>
                </div>
              </div>
              <div class="p-6">
                <h5 class="text-xl font-bold mb-2 line-clamp-2 group-hover:text-blue-700 transition">
                  {{ item.artikeltitle }}
                </h5>
                <p class="text-gray-600 mb-4 line-clamp-3 text-sm leading-relaxed">
                  {{ stripHtml(item.artikelcontent) }}
                </p>
                <div class="flex items-center justify-between text-sm text-gray-500 border-t border-gray-100 pt-4">
                  <span><i class="fas fa-user me-1"></i> {{ item.creator?.name || 'Anonymous' }}</span>
                  <span><i class="fas fa-calendar me-1"></i> {{ formatDate(item.created_at) }}</span>
                </div>
                <div class="flex items-center justify-between mt-3">
                  <Link :href="`/artikel/${item.slug}`"
                        class="inline-flex items-center text-blue-700 font-semibold hover:text-blue-900 transition group-hover:translate-x-1 duration-300">
                    Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i>
                  </Link>
                  <Link v-if="canEdit(item)" :href="`/artikel/${item.slug}/edit`" 
                        class="text-blue-500 hover:text-blue-700 transition text-sm">
                    <i class="fas fa-edit"></i> Edit
                  </Link>
                </div>
              </div>
            </div>
          </div>

          <!-- Empty State -->
          <div v-else class="text-center py-20 bg-white rounded-2xl shadow-md">
            <i class="fas fa-file-alt text-7xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-600">Belum Ada Artikel</h3>
            <p class="text-gray-400 mt-2">Mulai tulis artikel hukum pertama Anda!</p>
            <Link v-if="canCreate" :href="'/artikel/create'" 
                  class="btn-primary inline-flex items-center mt-6">
              <i class="fas fa-plus-circle me-2"></i> Buat Artikel
            </Link>
          </div>

          <!-- Pagination -->
          <div v-if="artikels && artikels.links && artikels.links.length > 3" 
               class="mt-10 flex justify-center">
            <div class="flex gap-2 flex-wrap">
              <Link v-for="link in artikels.links" 
                    :key="link.label"
                    :href="link.url || '#'"
                    :class="[
                      'px-4 py-2 rounded-lg border transition min-w-[40px] text-center',
                      link.active ? 'bg-blue-700 text-white border-blue-700' : 'bg-white hover:bg-gray-50 border-gray-300 text-gray-700',
                      !link.url ? 'opacity-50 cursor-not-allowed' : ''
                    ]"
                    v-html="link.label">
              </Link>
            </div>
          </div>
        </div>
      </section>
    </template>

    <!-- ============================================================ -->
    <!-- MODE CREATE -->
    <!-- ============================================================ -->
    <template v-else-if="mode === 'create'">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-3xl">
          <Link href="/artikel" class="text-blue-700 hover:text-blue-900 transition inline-flex items-center mb-6">
            <i class="fas fa-arrow-left me-2"></i> Kembali
          </Link>

          <form @submit.prevent="submitCreate" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl shadow-md">
            <!-- Judul -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Judul Artikel <span class="text-red-500">*</span></label>
              <input type="text" v-model="createForm.artikeltitle" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                     placeholder="Masukkan judul artikel">
            </div>

            <!-- Slug -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Slug (URL)</label>
              <input type="text" v-model="createForm.slug" 
                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 transition"
                     placeholder="akan di-generate otomatis">
              <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle me-1"></i> Kosongkan untuk generate otomatis dari judul
              </p>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Gambar Artikel</label>
              <div class="relative">
                <input type="file" @change="handleImageUpload" accept="image/*"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="w-full px-4 py-6 border-2 border-dashed border-gray-300 rounded-xl text-center hover:border-blue-500 transition">
                  <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                  <p class="text-gray-500" v-if="!createForm.imagePreview">Klik untuk upload gambar</p>
                  <div v-else class="relative">
                    <img :src="createForm.imagePreview" class="max-h-40 mx-auto rounded-lg" alt="Preview">
                    <p class="text-sm text-green-600 mt-2">✓ Gambar siap diupload</p>
                  </div>
                  <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, GIF, WebP (Max 5MB)</p>
                </div>
              </div>
              <p v-if="createForm.errors.image" class="text-red-500 text-sm mt-1">{{ createForm.errors.image }}</p>
            </div>

            <!-- Konten -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Konten <span class="text-red-500">*</span></label>
              <textarea v-model="createForm.artikelcontent" rows="12" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                        placeholder="Tulis konten artikel di sini..."></textarea>
            </div>

            <!-- Tags -->
            <div class="mb-6">
              <div class="flex items-center justify-between mb-2">
                <label class="block text-sm font-medium">Tags</label>
                <a v-if="canManageTags" href="/tag/list" 
                   class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-full transition">
                  <i class="fas fa-cog me-1"></i> Kelola Tags
                </a>
              </div>
              <div v-if="tags && tags.length > 0" class="flex flex-wrap gap-3">
                <label v-for="tag in tags" :key="tag.id" 
                       class="flex items-center gap-2 cursor-pointer bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200 transition border-2"
                       :class="createForm.tags.includes(tag.id) ? 'border-blue-500 bg-blue-50' : 'border-transparent'">
                  <input type="checkbox" :value="tag.id" v-model="createForm.tags" class="hidden">
                  <span class="text-sm">{{ tag.name }}</span>
                  <span v-if="createForm.tags.includes(tag.id)" class="text-blue-600">
                    <i class="fas fa-check-circle"></i>
                  </span>
                </label>
              </div>
              <p v-else class="text-sm text-gray-400 bg-gray-50 p-3 rounded-xl">
                <i class="fas fa-info-circle me-1"></i> Belum ada tags. 
                <a v-if="canManageTags" href="/tag/list" class="text-blue-700 hover:underline">Tambahkan di sini</a>
                <span v-else>Hubungi admin untuk menambahkan tags.</span>
              </p>
            </div>

            <!-- Tombol -->
            <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200">
              <button type="submit" :disabled="loading" 
                      class="btn-primary flex-1 md:flex-none px-8 py-3">
                <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
                <i v-else class="fas fa-paper-plane me-2"></i>
                {{ loading ? 'Menyimpan...' : 'Publikasikan Artikel' }}
              </button>
              <Link href="/artikel" 
                    class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition text-center flex-1 md:flex-none">
                Batal
              </Link>
            </div>
          </form>
        </div>
      </section>
    </template>

    <!-- ============================================================ -->
    <!-- MODE SHOW -->
    <!-- ============================================================ -->
    <template v-else-if="mode === 'show' && artikel">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-3xl">
          <Link href="/artikel" class="text-blue-700 hover:text-blue-900 transition inline-flex items-center mb-6">
            <i class="fas fa-arrow-left me-2"></i> Kembali ke Daftar Artikel
          </Link>

          <article class="bg-white p-6 md:p-8 rounded-2xl shadow-md">
            <!-- Gambar Artikel -->
            <div v-if="artikel.image" class="mb-6 rounded-xl overflow-hidden">
              <img :src="artikel.image" class="w-full max-h-96 object-cover" :alt="artikel.artikeltitle">
            </div>

            <!-- Tags -->
            <div class="flex flex-wrap gap-2 mb-4">
              <span v-for="tag in artikel.tags" :key="tag.id" 
                    class="text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
                {{ tag.name }}
              </span>
            </div>

            <!-- Judul -->
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight">
              {{ artikel.artikeltitle }}
            </h1>

            <!-- Meta Info -->
            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 border-b border-gray-200 pb-4 mb-6">
              <span>
                <i class="fas fa-user me-2 text-blue-700"></i> 
                <span class="font-medium text-gray-700">{{ artikel.creator?.name || 'Anonymous' }}</span>
              </span>
              <span>
                <i class="fas fa-calendar me-2 text-blue-700"></i> 
                {{ formatDate(artikel.created_at) }}
              </span>
              <span v-if="artikel.updated_at !== artikel.created_at">
                <i class="fas fa-edit me-2 text-blue-700"></i> 
                Diperbarui: {{ formatDate(artikel.updated_at) }}
              </span>
            </div>

            <!-- Konten -->
            <div class="prose prose-lg max-w-none" v-html="artikel.artikelcontent"></div>

            <!-- Action Buttons -->
            <div v-if="isCreator" class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap gap-4">
              <Link :href="`/artikel/${artikel.slug}/edit`" 
                    class="btn-edit inline-flex items-center">
                <i class="fas fa-edit me-2"></i> Edit Artikel
              </Link>
              <button @click="deleteArtikel(artikel.slug)" 
                      class="btn-delete inline-flex items-center">
                <i class="fas fa-trash me-2"></i> Hapus
              </button>
            </div>
          </article>

          <!-- Share -->
          <div class="mt-8 bg-white p-6 rounded-2xl shadow-md text-center">
            <p class="text-gray-600 mb-4">Bagikan artikel ini</p>
            <div class="flex justify-center gap-4 text-2xl">
              <a :href="`https://www.facebook.com/sharer/sharer.php?u=${currentUrl}`" 
                 target="_blank" class="text-blue-600 hover:scale-110 transition">
                <i class="fab fa-facebook"></i>
              </a>
              <a :href="`https://twitter.com/intent/tweet?url=${currentUrl}`" 
                 target="_blank" class="text-blue-400 hover:scale-110 transition">
                <i class="fab fa-twitter"></i>
              </a>
              <a :href="`https://wa.me/?text=${currentUrl}`" 
                 target="_blank" class="text-green-600 hover:scale-110 transition">
                <i class="fab fa-whatsapp"></i>
              </a>
              <a :href="`https://www.linkedin.com/sharing/share-offsite/?url=${currentUrl}`" 
                 target="_blank" class="text-blue-700 hover:scale-110 transition">
                <i class="fab fa-linkedin"></i>
              </a>
            </div>
          </div>
        </div>
      </section>
    </template>

    <!-- ============================================================ -->
    <!-- MODE EDIT -->
    <!-- ============================================================ -->
    <template v-else-if="mode === 'edit' && artikel">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4 max-w-3xl">
          <Link href="/artikel" class="text-blue-700 hover:text-blue-900 transition inline-flex items-center mb-6">
            <i class="fas fa-arrow-left me-2"></i> Kembali
          </Link>

          <form @submit.prevent="submitEdit" enctype="multipart/form-data" class="bg-white p-6 md:p-8 rounded-2xl shadow-md">
            <!-- Judul -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Judul Artikel <span class="text-red-500">*</span></label>
              <input type="text" v-model="editForm.artikeltitle" required
                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
            </div>

            <!-- Slug -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Slug (URL)</label>
              <input type="text" v-model="editForm.slug" 
                     class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 transition">
              <p class="text-xs text-gray-400 mt-1">
                <i class="fas fa-info-circle me-1"></i> Kosongkan untuk generate otomatis dari judul
              </p>
            </div>

            <!-- Upload Gambar -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Gambar Artikel</label>
              <div v-if="editForm.existingImage && !editForm.imagePreview" class="mb-3">
                <p class="text-sm text-gray-500 mb-1">Gambar saat ini:</p>
                <img :src="editForm.existingImage" class="max-h-32 rounded-lg border" alt="Current image">
              </div>
              <div class="relative">
                <input type="file" @change="handleEditImageUpload" accept="image/*"
                       class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                <div class="w-full px-4 py-6 border-2 border-dashed border-gray-300 rounded-xl text-center hover:border-blue-500 transition">
                  <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                  <p class="text-gray-500" v-if="!editForm.imagePreview">Klik untuk upload gambar baru</p>
                  <div v-else class="relative">
                    <img :src="editForm.imagePreview" class="max-h-40 mx-auto rounded-lg" alt="Preview">
                    <p class="text-sm text-green-600 mt-2">✓ Gambar baru siap diupload</p>
                  </div>
                  <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG, GIF, WebP (Max 5MB)</p>
                </div>
              </div>
              <p v-if="editForm.errors.image" class="text-red-500 text-sm mt-1">{{ editForm.errors.image }}</p>
            </div>

            <!-- Konten -->
            <div class="mb-5">
              <label class="block text-sm font-medium mb-1">Konten <span class="text-red-500">*</span></label>
              <textarea v-model="editForm.artikelcontent" rows="12" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"></textarea>
            </div>

            <!-- ===== TAGS SECTION ===== -->
            <div class="mb-6">
            <div class="flex items-center justify-between mb-2">
           <label class="block text-sm font-medium">Tags</label>
    
           <!-- ===== TOMBOL KELOLA TAGS (ADMIN ONLY) ===== -->
          <a v-if="canManageTags" href="/tag/list" 
           class="text-xs bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-full transition inline-flex items-center">
           <i class="fas fa-cog me-1"></i> Kelola Tags
          </a>
          </div>
  
          <!-- Daftar Tags (Checkbox) -->
          <div v-if="tags && tags.length > 0" class="flex flex-wrap gap-3">
          <label v-for="tag in tags" :key="tag.id" 
           class="flex items-center gap-2 cursor-pointer bg-gray-100 px-4 py-2 rounded-full hover:bg-gray-200 transition border-2"
           :class="createForm.tags.includes(tag.id) ? 'border-blue-500 bg-blue-50' : 'border-transparent'">
          <input type="checkbox" :value="tag.id" v-model="createForm.tags" class="hidden">
          <span class="text-sm">{{ tag.name }}</span>
          <span v-if="createForm.tags.includes(tag.id)" class="text-blue-600">
          <i class="fas fa-check-circle"></i>
       </span>
      </label>
    </div>
  
          <p v-else class="text-sm text-gray-400 bg-gray-50 p-3 rounded-xl">
          <i class="fas fa-info-circle me-1"></i> Belum ada tags. 
          <a v-if="canManageTags" href="/tag/create" class="text-blue-700 hover:underline">Tambahkan di sini</a>
         <span v-else>Hubungi admin untuk menambahkan tags.</span>
        </p>
      </div>

            <!-- Tombol -->
            <div class="flex flex-wrap gap-4 pt-4 border-t border-gray-200">
              <button type="submit" :disabled="loading" 
                      class="btn-primary flex-1 md:flex-none px-8 py-3">
                <i v-if="loading" class="fas fa-spinner fa-spin me-2"></i>
                <i v-else class="fas fa-save me-2"></i>
                {{ loading ? 'Menyimpan...' : 'Perbarui Artikel' }}
              </button>
              <Link href="/artikel" 
                    class="px-6 py-3 border border-gray-300 rounded-full hover:bg-gray-50 transition text-center flex-1 md:flex-none">
                Batal
              </Link>
            </div>
          </form>
        </div>
      </section>
    </template>

    <!-- ============================================================ -->
    <!-- MODE TRASHED -->
    <!-- ============================================================ -->
    <template v-else-if="mode === 'trashed'">
      <section class="py-16 md:py-20 bg-gray-50">
        <div class="container mx-auto px-4">
          <div class="flex justify-between items-center flex-wrap gap-4 mb-8">
            <Link href="/artikel" class="text-blue-700 hover:text-blue-900 transition inline-flex items-center">
              <i class="fas fa-arrow-left me-2"></i> Kembali
            </Link>
            <span class="text-sm text-gray-500">
              <i class="fas fa-trash me-1"></i> {{ artikels?.total || 0 }} artikel terhapus
            </span>
          </div>

          <div v-if="artikels && artikels.data && artikels.data.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div v-for="item in artikels.data" :key="item.id" 
                 class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-xl transition border-l-4 border-red-500">
              <div class="p-6">
                <div class="flex flex-wrap gap-2 mb-2">
                  <span v-for="tag in item.tags.slice(0, 2)" :key="tag.id" 
                        class="text-xs bg-red-100 text-red-800 px-2 py-1 rounded-full">
                    {{ tag.name }}
                  </span>
                </div>
                <h5 class="text-lg font-bold mb-2 line-clamp-2">{{ item.artikeltitle }}</h5>
                <p class="text-sm text-gray-500 mb-3">
                  <i class="fas fa-trash me-1"></i> Dihapus: {{ formatDate(item.deleted_at) }}
                </p>
                <div class="flex flex-wrap gap-2">
                  <button @click="restoreArtikel(item.id)" 
                          class="btn-restore text-sm inline-flex items-center px-4 py-1.5 rounded-full">
                    <i class="fas fa-undo me-1"></i> Pulihkan
                  </button>
                  <button @click="forceDelete(item.id)" 
                          class="btn-force-delete text-sm inline-flex items-center px-4 py-1.5 rounded-full">
                    <i class="fas fa-times-circle me-1"></i> Hapus Permanen
                  </button>
                </div>
              </div>
            </div>
          </div>

          <div v-else class="text-center py-20 bg-white rounded-2xl shadow-md">
            <i class="fas fa-trash-alt text-7xl text-gray-300 mb-4"></i>
            <h3 class="text-2xl font-semibold text-gray-600">Tidak Ada Artikel Terhapus</h3>
            <p class="text-gray-400 mt-2">Sampah kosong</p>
          </div>

          <div v-if="artikels && artikels.links && artikels.links.length > 3" 
               class="mt-10 flex justify-center">
            <div class="flex gap-2 flex-wrap">
              <Link v-for="link in artikels.links" 
                    :key="link.label"
                    :href="link.url || '#'"
                    :class="[
                      'px-4 py-2 rounded-lg border transition min-w-[40px] text-center',
                      link.active ? 'bg-red-700 text-white border-red-700' : 'bg-white hover:bg-gray-50 border-gray-300 text-gray-700',
                      !link.url ? 'opacity-50 cursor-not-allowed' : ''
                    ]"
                    v-html="link.label">
              </Link>
            </div>
          </div>
        </div>
      </section>
    </template>

    <!-- ============================================================ -->
    <!-- CTA -->
    <!-- ============================================================ -->
    <template v-if="mode === 'index'">
      <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container mx-auto px-4 text-center">
          <h3 class="text-2xl font-bold mb-2">Butuh Konsultasi Hukum?</h3>
          <p class="text-lg mb-6 opacity-90">Tim advokat kami siap membantu Anda</p>
          <a href="/contact" class="btn-hero inline-flex items-center">
            <i class="fas fa-handshake me-2"></i> Konsultasi Sekarang
          </a>
        </div>
      </section>
    </template>
  </HomeLayout>
</template>

<script>
import { Link, useForm, usePage } from '@inertiajs/vue3';
import HomeLayout from '@/Layouts/HomeLayout.vue';

export default {
  name: 'Artikel',
  components: { HomeLayout, Link },
  props: {
    mode: { type: String, default: 'index' },
    artikels: { type: Object, default: null },
    canCreate: { type: Boolean, default: false },
    canManageTags: { type: Boolean, default: false },
    tags: { type: Array, default: () => [] },
    artikel: { type: Object, default: null },
    selectedTags: { type: Array, default: () => [] }
  },
  data() {
    return {
      loading: false,
      createForm: useForm({
        artikeltitle: '',
        slug: '',
        artikelcontent: '',
        image: null,
        imagePreview: null,
        tags: []
      }),
      editForm: useForm({
        artikeltitle: this.artikel?.artikeltitle || '',
        slug: this.artikel?.slug || '',
        artikelcontent: this.artikel?.artikelcontent || '',
        image: null,
        imagePreview: null,
        existingImage: this.artikel?.image || null,
        tags: this.selectedTags || []
      })
    }
  },
  computed: {
    user() {
      return usePage().props.auth?.user || null;
    },
    isCreator() {
      return this.artikel?.created_by === this.user?.id;
    },
    currentUrl() {
      return window.location.href;
    }
  },
  methods: {
    // ========== IMAGE HANDLING ==========
    handleImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.createForm.image = file;
        this.createForm.imagePreview = URL.createObjectURL(file);
      }
    },
    handleEditImageUpload(event) {
      const file = event.target.files[0];
      if (file) {
        this.editForm.image = file;
        this.editForm.imagePreview = URL.createObjectURL(file);
      }
    },

    // ========== FORMAT DATE ==========
    formatDate(date) {
      if (!date) return '-';
      return new Date(date).toLocaleDateString('id-ID', {
        day: 'numeric',
        month: 'long',
        year: 'numeric'
      });
    },

    // ========== STRIP HTML ==========
    stripHtml(html) {
      if (!html) return '';
      const tmp = document.createElement('DIV');
      tmp.innerHTML = html;
      return tmp.textContent || tmp.innerText || '';
    },

    // ========== CAN EDIT ==========
    canEdit(item) {
      return item.created_by === this.user?.id;
    },

    // ========== CREATE ==========
    submitCreate() {
      this.loading = true;
      this.createForm.post('/artikel', {
        onSuccess: () => {
          this.loading = false;
          window.location.href = '/artikel';
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
      this.editForm.put(`/artikel/${this.artikel.slug}`, {
        onSuccess: () => {
          this.loading = false;
          window.location.href = `/artikel/${this.artikel.slug}`;
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
    deleteArtikel(slug) {
      if (confirm('Apakah Anda yakin ingin menghapus artikel ini?')) {
        this.$inertia.delete(`/artikel/${slug}`, {
          onSuccess: () => {
            window.location.href = '/artikel';
          }
        });
      }
    },

    // ========== RESTORE ==========
    restoreArtikel(id) {
      if (confirm('Pulihkan artikel ini?')) {
        this.$inertia.post(`/artikel/restore/${id}`, {}, {
          onSuccess: () => {
            window.location.reload();
          }
        });
      }
    },

    // ========== FORCE DELETE ==========
    forceDelete(id) {
      if (confirm('Hapus permanen artikel ini? Tindakan ini tidak bisa dibatalkan!')) {
        this.$inertia.delete(`/artikel/force-delete/${id}`, {
          onSuccess: () => {
            window.location.reload();
          }
        });
      }
    }
  },
  beforeUnmount() {
    if (this.createForm.imagePreview) {
      URL.revokeObjectURL(this.createForm.imagePreview);
    }
    if (this.editForm.imagePreview) {
      URL.revokeObjectURL(this.editForm.imagePreview);
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
.btn-edit {
  @apply bg-blue-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-blue-700 transition inline-flex items-center;
}
.btn-delete {
  @apply bg-red-600 text-white px-6 py-2 rounded-full font-semibold hover:bg-red-700 transition inline-flex items-center;
}
.btn-restore {
  @apply bg-green-600 text-white hover:bg-green-700 transition px-4 py-1.5 rounded-full;
}
.btn-force-delete {
  @apply bg-red-600 text-white hover:bg-red-700 transition px-4 py-1.5 rounded-full;
}
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.line-clamp-3 {
  display: -webkit-box;
  -webkit-line-clamp: 3;
  -webkit-box-orient: vertical;
  overflow: hidden;
}
.prose {
  @apply text-gray-800 leading-relaxed;
}
.prose h1, .prose h2, .prose h3, .prose h4 {
  @apply font-bold text-gray-900 mt-8 mb-4;
}
.prose h1 { @apply text-3xl; }
.prose h2 { @apply text-2xl; }
.prose h3 { @apply text-xl; }
.prose p { @apply mb-4 leading-relaxed; }
.prose ul, .prose ol { @apply ml-6 mb-4; }
.prose ul { @apply list-disc; }
.prose ol { @apply list-decimal; }
.prose a { @apply text-blue-700 hover:underline; }
.prose blockquote { @apply border-l-4 border-blue-700 pl-4 italic text-gray-600 my-4; }
.prose img { @apply rounded-xl my-4 max-w-full; }
</style>