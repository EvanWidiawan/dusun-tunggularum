<template>
  <AdminLayout title="Kelola Berita Dusun">
    <div class="space-y-6">

      <!-- Header Action Bar -->
      <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4 bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs">
        <div class="space-y-1">
          <h2 class="font-display font-bold text-xl text-[#1F5C6B]">Berita & Pengumuman Dusun</h2>
          <p class="text-xs text-[#5E6E6E]">Tulis, sunting, dan publikasikan kabar terbaru untuk warga dan pengunjung website.</p>
        </div>

        <div class="flex items-center gap-2 shrink-0">
          <a
            href="/berita"
            target="_blank"
            class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl border border-[#3A4A4C]/15 text-[#1F5C6B] hover:bg-[#EEF3F3] font-bold text-sm transition-all"
          >
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
            </svg>
            Lihat Halaman
          </a>
          <button
            id="btn-tulis-berita"
            @click="openCreateModal"
            type="button"
            class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl bg-[#1F5C6B] hover:bg-[#5FA8B5] text-white font-bold text-sm shadow-md transition-all cursor-pointer"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tulis Berita
          </button>
        </div>
      </div>

      <!-- Stat mini + Filter -->
      <div class="bg-white rounded-2xl p-4 border border-[#3A4A4C]/10 shadow-xs flex flex-col md:flex-row md:items-center gap-4">
        <div class="flex items-center gap-1 p-1 rounded-xl bg-[#EEF3F3] shrink-0">
          <button
            v-for="tab in statusTabs"
            :key="tab.value"
            type="button"
            @click="statusFilter = tab.value"
            class="px-4 py-2 rounded-lg text-xs font-bold transition-all cursor-pointer"
            :class="statusFilter === tab.value ? 'bg-white text-[#1F5C6B] shadow-xs' : 'text-[#5E6E6E] hover:text-[#1F5C6B]'"
          >
            {{ tab.label }}
            <span class="ml-1 text-[10px] font-bold opacity-70">{{ tab.count }}</span>
          </button>
        </div>

        <div class="relative flex-1">
          <svg class="w-5 h-5 text-[#5E6E6E] absolute left-3.5 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          <input
            v-model="searchQuery"
            type="text"
            placeholder="Cari judul atau kategori berita..."
            class="w-full pl-11 pr-4 py-2.5 rounded-xl bg-[#EEF3F3]/60 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] placeholder-[#5E6E6E]/60 focus:outline-hidden focus:border-[#1F5C6B]"
          />
        </div>
      </div>

      <!-- List Berita -->
      <div v-if="filteredBeritas.length > 0" class="space-y-4">
        <div
          v-for="item in filteredBeritas"
          :key="item.id"
          class="bg-white rounded-2xl overflow-hidden border border-[#3A4A4C]/10 shadow-xs hover:shadow-md transition-all flex flex-col sm:flex-row"
        >
          <!-- Thumbnail -->
          <div class="sm:w-56 h-44 sm:h-auto bg-[#1F5C6B]/10 overflow-hidden relative shrink-0">
            <img
              v-if="item.gambar"
              :src="getImageUrl(item.gambar)"
              :alt="item.judul"
              @error="handleImageFallback($event)"
              class="absolute inset-0 w-full h-full object-cover"
            />
            <div v-else class="absolute inset-0 flex items-center justify-center text-[#1F5C6B]/40">
              <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <span
              class="absolute top-3 left-3 px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider shadow-sm"
              :class="item.is_published ? 'bg-emerald-500 text-white' : 'bg-amber-400 text-amber-950'"
            >
              {{ item.is_published ? 'Terbit' : 'Draft' }}
            </span>
          </div>

          <!-- Content -->
          <div class="flex-1 p-5 flex flex-col gap-3 min-w-0">
            <div class="flex flex-wrap items-center gap-2 text-xs text-[#5E6E6E]">
              <span v-if="item.kategori" class="px-2.5 py-0.5 rounded-md bg-[#5FA8B5]/20 text-[#1F5C6B] font-semibold">{{ item.kategori }}</span>
              <span>{{ formatDate(item.tanggal) }}</span>
              <span class="w-1 h-1 rounded-full bg-[#5E6E6E]/40"></span>
              <span>{{ item.penulis || 'Admin Dusun' }}</span>
            </div>
            <h3 class="font-display font-bold text-lg text-[#1F5C6B] leading-snug line-clamp-2">{{ item.judul }}</h3>
            <p class="text-sm text-[#5E6E6E] line-clamp-2">{{ item.ringkasan }}</p>

            <div class="mt-auto pt-3 border-t border-[#3A4A4C]/10 flex flex-wrap items-center justify-end gap-2">
              <a
                v-if="item.is_published"
                :href="`/berita?baca=${item.slug}`"
                target="_blank"
                class="px-3.5 py-1.5 rounded-xl bg-[#EEF3F3] text-[#1F5C6B] hover:bg-[#1F5C6B] hover:text-white transition-colors text-xs font-bold flex items-center gap-1.5"
              >
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                Lihat
              </a>
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
                @click="deleteBerita(item)"
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
      </div>

      <!-- Empty State -->
      <div v-else class="bg-white rounded-2xl p-12 text-center border border-[#3A4A4C]/10 shadow-xs space-y-3">
        <svg class="w-12 h-12 text-[#5E6E6E]/40 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
        </svg>
        <p class="text-sm font-bold text-[#1F5C6B]">Belum ada berita ditemukan.</p>
        <p class="text-xs text-[#5E6E6E]">Klik tombol "Tulis Berita" di atas untuk mempublikasikan berita pertama.</p>
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
      <div v-if="showModal" class="fixed inset-0 z-50 flex items-start sm:items-center justify-center p-4 bg-black/60 backdrop-blur-xs overflow-y-auto">
        <div class="bg-white rounded-3xl max-w-3xl w-full shadow-2xl border border-[#3A4A4C]/10 relative my-6 flex flex-col max-h-[calc(100vh-3rem)]">
          <div class="flex items-center justify-between border-b border-[#3A4A4C]/10 px-6 sm:px-8 py-5 shrink-0">
            <h3 class="font-display font-bold text-xl text-[#1F5C6B]">
              {{ isEditing ? 'Edit Berita' : 'Tulis Berita Baru' }}
            </h3>
            <button @click="closeModal" type="button" class="p-1.5 rounded-xl text-[#5E6E6E] hover:bg-[#EEF3F3] transition-colors cursor-pointer" aria-label="Tutup">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <form @submit.prevent="submitForm" class="flex flex-col min-h-0 flex-1">
            <div class="px-6 sm:px-8 py-6 space-y-5 overflow-y-auto">
              <!-- Judul -->
              <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Judul Berita</label>
                <input
                  v-model="form.judul"
                  type="text"
                  required
                  maxlength="255"
                  placeholder="Contoh: Kerja Bakti Bersih Saluran Mata Air"
                  class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
                />
                <p v-if="form.errors.judul" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.judul }}</p>
              </div>

              <!-- Kategori, Tanggal, Penulis -->
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Kategori</label>
                  <input
                    v-model="form.kategori"
                    type="text"
                    list="kategori-berita-options"
                    maxlength="100"
                    placeholder="Pilih / ketik"
                    class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
                  />
                  <datalist id="kategori-berita-options">
                    <option v-for="k in allKategoriOptions" :key="k" :value="k" />
                  </datalist>
                  <p v-if="form.errors.kategori" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.kategori }}</p>
                </div>
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Tanggal Terbit</label>
                  <input
                    v-model="form.tanggal"
                    type="date"
                    class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
                  />
                  <p v-if="form.errors.tanggal" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.tanggal }}</p>
                </div>
                <div>
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Penulis</label>
                  <input
                    v-model="form.penulis"
                    type="text"
                    maxlength="100"
                    placeholder="Admin Dusun"
                    class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B]"
                  />
                  <p v-if="form.errors.penulis" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.penulis }}</p>
                </div>
              </div>

              <!-- Ringkasan -->
              <div>
                <div class="flex items-center justify-between mb-1.5">
                  <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B]">Ringkasan <span class="normal-case font-medium text-[#5E6E6E]">(opsional)</span></label>
                  <span class="text-[11px] font-medium" :class="(form.ringkasan || '').length > 280 ? 'text-amber-600' : 'text-[#5E6E6E]'">
                    {{ (form.ringkasan || '').length }}/300
                  </span>
                </div>
                <textarea
                  v-model="form.ringkasan"
                  rows="2"
                  maxlength="300"
                  placeholder="Kosongkan untuk dibuat otomatis dari isi berita."
                  class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] focus:outline-hidden focus:border-[#1F5C6B] resize-none"
                ></textarea>
                <p v-if="form.errors.ringkasan" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.ringkasan }}</p>
              </div>

              <!-- Isi -->
              <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">Isi Berita</label>
                <textarea
                  v-model="form.isi"
                  rows="10"
                  required
                  placeholder="Tulis isi berita di sini. Pisahkan paragraf dengan baris baru (Enter)."
                  class="w-full px-4 py-3 rounded-xl bg-[#EEF3F3]/50 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] leading-relaxed focus:outline-hidden focus:border-[#1F5C6B]"
                ></textarea>
                <p class="text-[11px] text-[#5E6E6E] mt-1">{{ wordCount }} kata · ± {{ Math.max(1, Math.round(wordCount / 200)) }} menit baca</p>
                <p v-if="form.errors.isi" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.isi }}</p>
              </div>

              <!-- Gambar -->
              <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-[#1F5C6B] mb-1.5">
                  Gambar Sampul <span class="normal-case font-medium text-[#5E6E6E]">(opsional, maks. 10MB)</span>
                </label>
                <div class="flex flex-col sm:flex-row gap-4 items-start">
                  <div class="w-full sm:w-48 h-32 rounded-xl overflow-hidden bg-[#EEF3F3] border border-dashed border-[#3A4A4C]/25 flex items-center justify-center shrink-0 relative">
                    <img v-if="previewUrl" :src="previewUrl" alt="Preview gambar sampul" class="absolute inset-0 w-full h-full object-cover" @error="handleImageFallback($event)" />
                    <span v-else class="text-xs text-[#5E6E6E]/70">Belum ada gambar</span>
                  </div>
                  <div class="space-y-2 flex-1">
                    <input
                      ref="fileInput"
                      @change="handleFileChange"
                      type="file"
                      accept="image/*"
                      class="w-full text-xs text-[#5E6E6E] file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#1F5C6B] file:text-white hover:file:bg-[#5FA8B5] cursor-pointer"
                    />
                    <button
                      v-if="previewUrl"
                      type="button"
                      @click="removeImage"
                      class="text-xs font-bold text-red-600 hover:text-red-700 cursor-pointer"
                    >
                      Hapus gambar
                    </button>
                    <p class="text-[11px] text-[#5E6E6E]">Jika kosong, halaman berita memakai foto dusun sebagai sampul.</p>
                  </div>
                </div>
                <p v-if="form.errors.gambar" class="text-xs text-red-600 mt-1 font-medium">{{ form.errors.gambar }}</p>
              </div>

              <!-- Status Terbit -->
              <label class="flex items-center justify-between gap-4 p-4 rounded-2xl bg-[#EEF3F3]/70 border border-[#3A4A4C]/10 cursor-pointer select-none">
                <div>
                  <p class="text-sm font-bold text-[#1F5C6B]">Terbitkan Berita</p>
                  <p class="text-xs text-[#5E6E6E]">Jika dinonaktifkan, berita disimpan sebagai draft dan tidak tampil di halaman publik.</p>
                </div>
                <span class="relative inline-flex shrink-0">
                  <input v-model="form.is_published" type="checkbox" class="sr-only peer" />
                  <span class="w-11 h-6 rounded-full bg-[#3A4A4C]/25 peer-checked:bg-emerald-500 transition-colors"></span>
                  <span class="absolute top-0.5 left-0.5 w-5 h-5 rounded-full bg-white shadow transition-transform peer-checked:translate-x-5"></span>
                </span>
              </label>
            </div>

            <!-- Footer -->
            <div class="flex items-center justify-end gap-3 px-6 sm:px-8 py-4 border-t border-[#3A4A4C]/10 shrink-0 bg-white rounded-b-3xl">
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
                {{ form.processing ? 'Menyimpan...' : (form.is_published ? 'Simpan & Terbitkan' : 'Simpan Draft') }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </transition>
  </AdminLayout>
</template>

<script setup>
import { ref, computed, onUnmounted } from 'vue';
import { useForm, router } from '@inertiajs/vue3';
import AdminLayout from '../../../Layouts/AdminLayout.vue';
import { getImageUrl, handleImageFallback } from '../../../Utils/image';

const props = defineProps({
  beritas: { type: Array, default: () => [] },
  kategoriOptions: { type: Array, default: () => [] },
});

const searchQuery = ref('');
const statusFilter = ref('all');
const showModal = ref(false);
const isEditing = ref(false);
const editingId = ref(null);
const previewUrl = ref('');
const fileInput = ref(null);
let objectUrl = null;

function today() {
  const d = new Date();
  const pad = (n) => String(n).padStart(2, '0');
  return `${d.getFullYear()}-${pad(d.getMonth() + 1)}-${pad(d.getDate())}`;
}

const form = useForm({
  judul: '',
  kategori: '',
  tanggal: today(),
  penulis: '',
  ringkasan: '',
  isi: '',
  gambar: null,
  hapus_gambar: false,
  is_published: true,
});

const statusTabs = computed(() => {
  const list = props.beritas || [];
  return [
    { value: 'all', label: 'Semua', count: list.length },
    { value: 'published', label: 'Terbit', count: list.filter((b) => b.is_published).length },
    { value: 'draft', label: 'Draft', count: list.filter((b) => !b.is_published).length },
  ];
});

const allKategoriOptions = computed(() => {
  const set = new Set(props.kategoriOptions || []);
  (props.beritas || []).forEach((b) => b.kategori && set.add(b.kategori));
  return [...set];
});

const filteredBeritas = computed(() => {
  let list = props.beritas || [];

  if (statusFilter.value === 'published') list = list.filter((b) => b.is_published);
  if (statusFilter.value === 'draft') list = list.filter((b) => !b.is_published);

  if (searchQuery.value) {
    const q = searchQuery.value.toLowerCase();
    list = list.filter(
      (b) => b.judul.toLowerCase().includes(q) || (b.kategori || '').toLowerCase().includes(q)
    );
  }

  return list;
});

const wordCount = computed(() => (form.isi || '').trim().split(/\s+/).filter(Boolean).length);

function formatDate(dateStr) {
  if (!dateStr) return '';
  const [y, m, d] = String(dateStr).substring(0, 10).split('-').map(Number);
  return new Date(y, (m || 1) - 1, d || 1).toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
}

function revokePreview() {
  if (objectUrl) {
    URL.revokeObjectURL(objectUrl);
    objectUrl = null;
  }
}

function resetFileInput() {
  if (fileInput.value) fileInput.value.value = '';
}

function openCreateModal() {
  isEditing.value = false;
  editingId.value = null;
  form.reset();
  form.clearErrors();
  form.tanggal = today();
  revokePreview();
  previewUrl.value = '';
  resetFileInput();
  showModal.value = true;
}

function openEditModal(item) {
  isEditing.value = true;
  editingId.value = item.id;
  form.clearErrors();
  form.judul = item.judul || '';
  form.kategori = item.kategori || '';
  form.tanggal = item.tanggal ? String(item.tanggal).substring(0, 10) : today();
  form.penulis = item.penulis || '';
  form.ringkasan = item.ringkasan || '';
  form.isi = item.isi || '';
  form.gambar = null;
  form.hapus_gambar = false;
  form.is_published = !!item.is_published;
  revokePreview();
  previewUrl.value = item.gambar ? getImageUrl(item.gambar) : '';
  resetFileInput();
  showModal.value = true;
}

function closeModal() {
  showModal.value = false;
  form.reset();
  revokePreview();
  previewUrl.value = '';
  resetFileInput();
}

function handleFileChange(event) {
  const file = event.target.files[0] || null;
  form.gambar = file;
  form.hapus_gambar = false;
  revokePreview();
  if (file) {
    objectUrl = URL.createObjectURL(file);
    previewUrl.value = objectUrl;
  }
}

function removeImage() {
  form.gambar = null;
  form.hapus_gambar = isEditing.value;
  revokePreview();
  previewUrl.value = '';
  resetFileInput();
}

function submitForm() {
  const url = isEditing.value ? `/admin/berita/${editingId.value}` : '/admin/berita';
  form.post(url, {
    preserveScroll: true,
    onSuccess: () => closeModal(),
  });
}

function deleteBerita(item) {
  if (confirm(`Apakah Anda yakin ingin menghapus berita "${item.judul}"?`)) {
    router.delete(`/admin/berita/${item.id}`, {
      preserveScroll: true,
    });
  }
}

onUnmounted(revokePreview);
</script>
