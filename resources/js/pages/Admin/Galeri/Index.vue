<template>
  <AdminLayout title="Kelola Galeri Desa">
    <div class="space-y-6">

      <!-- Header Action Bar -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs">
        <div class="space-y-1">
          <h2 class="font-display font-bold text-xl text-[#1F5C6B]">Dokumentasi Galeri Desa</h2>
          <p class="text-xs text-[#5E6E6E]">Unggah dan kelola koleksi foto dokumentasi dusun.</p>
        </div>

        <button
          @click="openCreateModal"
          type="button"
          class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#1F5C6B] hover:bg-[#5FA8B5] text-white font-bold text-sm shadow-md transition-all shrink-0 cursor-pointer"
        >
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
          </svg>
          Upload Foto Galeri
        </button>
      </div>

      <!-- Search Bar -->
      <div class="bg-white rounded-2xl p-4 border border-[#3A4A4C]/10 shadow-xs">
        <div class="relative">
          <svg class="w-5 h-5 text-[#5E6E6E] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Cari berdasarkan judul foto..."
            class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-[#EEF3F3]/60 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] placeholder-[#5E6E6E]/60 focus:outline-hidden focus:border-[#1F5C6B]"
          />
        </div>
      </div>

      <!-- Galleries Grid Cards -->
      <div v-if="filteredGalleries.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        <div
          v-for="item in filteredGalleries"
          :key="item.id"
          class="bg-white rounded-2xl overflow-hidden border border-[#3A4A4C]/10 shadow-xs group hover:shadow-md transition-all flex flex-col justify-between"
        >
          <div>
            <!-- Image Container -->
            <div class="h-48 bg-[#1F5C6B]/10 overflow-hidden relative">
              <img
                v-if="item.gambar"
                :src="'/storage/' + item.gambar"
                :alt="item.judul"
                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
              />
              <div v-else class="w-full h-full flex items-center justify-center text-[#1F5C6B]/40">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
              </div>
            </div>

            <!-- Content -->
            <div class="p-5 space-y-1">
              <h3 class="font-display font-bold text-base text-[#1F5C6B] leading-snug line-clamp-2">
                {{ item.judul }}
              </h3>
            </div>
          </div>

          <!-- Card Actions Footer -->
          <div class="p-4 bg-[#EEF3F3]/50 border-t border-[#3A4A4C]/10 flex items-center justify-end gap-2">
            <button
              @click="openEditModal(item)"
              type="button"
              class="px-3.5 py-1.5 rounded-xl bg-[#5FA8B5]/20 text-[#1F5C6B] hover:bg-[#5FA8B5] hover:text-white transition-colors text-xs font-bold flex items-center gap-1.5 cursor-pointer"
            >
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
              </svg>
              Edit
            </button>

            <button
              @click="deleteGallery(item)"
              type="button"
              class="px-3.5 py-1.5 rounded-xl bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition-colors text-xs font-bold flex items-center gap-1.5 cursor-pointer"
            >
              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
              Hapus
            </button>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="bg-white rounded-2xl p-12 text-center border border-[#3A4A4C]/10 shadow-xs space-y-3">
        <svg class="w-12 h-12 text-[#5E6E6E]/40 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <p class="text-sm font-bold text-[#1F5C6B]">Belum ada foto galeri ditemukan.</p>
        <p class="text-xs text-[#5E6E6E]">Klik tombol "Upload Foto Galeri" di atas untuk menambahkan foto pertama.</p>
      </div>

    </div>

    <!-- Modal Form (Tambah / Edit) -->
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-xs">
        <div class="bg-white rounded-3xl p-6 sm:p-8 max-w-lg w-full shadow-2xl space-y-5 border border-[#3A4A4C]/10 relative overflow-hidden">
          <div class="flex items-center justify-between border-b border-[#3A4A4C]/10 pb-4">
            <h3 class="font-display font-bold text-xl text-[#1F5C6B]">
              {{ isEditing ? 'Edit Foto Galeri' : 'Upload Foto Galeri Baru' }}
            </h3>
            <button @click="closeModal" class="p-1.5 rounded-xl text-[#5E6E6E] hover:bg-[#EEF3F3] transition-colors cursor-pointer">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <form @submit.prevent="submitForm" class="space-y-4">
            <!-- Judul Input -->
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Judul Foto Dokumentasi</label>
              <input
                v-model="form.judul"
                type="text"
                required
                placeholder="Contoh: Suasana Mata Air Lereng Merapi"
                class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
              />
              <p v-if="form.errors.judul" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.judul }}</p>
            </div>

            <!-- Gambar Upload Input -->
            <div>
              <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">
                Berkas Foto / Gambar {{ isEditing ? '(Opsional jika tidak diubah)' : '(Wajib)' }}
              </label>
              <input
                @change="handleFileChange"
                type="file"
                accept="image/*"
                :required="!isEditing"
                class="w-full text-xs text-[#5E6E6E] file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#1F5C6B] file:text-white hover:file:bg-[#5FA8B5] cursor-pointer"
              />
              <p v-if="form.errors.gambar" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.gambar }}</p>
            </div>

            <!-- Form Actions Footer -->
            <div class="flex items-center justify-end gap-3 pt-4 border-t border-[#3A4A4C]/10">
              <button
                @click="closeModal"
                type="button"
                class="px-5 py-2.5 rounded-xl border border-[#3A4A4C]/20 text-xs font-bold text-[#5E6E6E] hover:bg-[#EEF3F3] transition-colors cursor-pointer"
              >
                Batal
              </button>

              <button
                type="submit"
                :disabled="form.processing"
                class="px-6 py-2.5 rounded-xl bg-[#1F5C6B] text-white text-xs font-bold hover:bg-[#5FA8B5] shadow-md transition-all disabled:opacity-50 cursor-pointer"
              >
                {{ form.processing ? 'Menyimpan...' : 'Simpan Foto' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </AdminLayout>
</template>

<script setup>
import { ref, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';

const props = defineProps({
  galleries: Array,
});

const searchQuery = ref('');
const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);

const form = useForm({
  judul: '',
  gambar: null,
});

const filteredGalleries = computed(() => {
  let list = props.galleries || [];

  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase();
    list = list.filter((g) => g.judul.toLowerCase().includes(q));
  }

  return list;
});

function openCreateModal() {
  isEditing.value = false;
  editingId.value = null;
  form.reset();
  form.clearErrors();
  showModal.value = true;
}

function openEditModal(item) {
  isEditing.value = true;
  editingId.value = item.id;
  form.judul = item.judul;
  form.gambar = null;
  form.clearErrors();
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
  form.reset();
}

function handleFileChange(event) {
  form.gambar = event.target.files[0] || null;
}

function submitForm() {
  if (isEditing.value) {
    form.post(`/admin/galeri/${editingId.value}`, {
      preserveScroll: true,
      onSuccess: () => closeModal(),
    });
  } else {
    form.post('/admin/galeri', {
      preserveScroll: true,
      onSuccess: () => closeModal(),
    });
  }
}

function deleteGallery(item) {
  if (confirm(`Apakah Anda yakin ingin menghapus foto "${item.judul}" dari galeri?`)) {
    router.delete(`/admin/galeri/${item.id}`, {
      preserveScroll: true,
    });
  }
}
</script>
