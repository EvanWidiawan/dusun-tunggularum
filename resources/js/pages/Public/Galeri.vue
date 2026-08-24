<template>
  <PublicLayout>
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h1 class="font-display font-bold text-4xl text-[#1F5C6B]">Galeri Dokumentasi Desa</h1>
        <p class="text-[#5E6E6E] text-lg">Koleksi foto kegiatan, infrastruktur, dan keindahan panorama mata air Desa Merapi.</p>
      </div>

      <div v-if="galleries && galleries.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="item in galleries"
          :key="item.id"
          class="bg-white/80 rounded-2xl overflow-hidden border border-[#3A4A4C]/15 shadow-xs group hover:shadow-md transition-all"
        >
          <div class="h-48 bg-[#1F5C6B]/10 overflow-hidden relative">
            <img
              v-if="item.gambar"
              :src="'/storage/' + item.gambar"
              :alt="item.judul"
              class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
            />
            <div v-else class="w-full h-full flex items-center justify-center text-[#1F5C6B]/40">
              <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
            <span
              v-if="item.kategori"
              class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#1F5C6B]/85 backdrop-blur-xs text-white text-xs font-semibold"
            >
              {{ item.kategori }}
            </span>
          </div>
          <div class="p-5">
            <h3 class="font-display font-bold text-lg text-[#1F5C6B] leading-snug">{{ item.judul }}</h3>
            <p class="text-xs text-[#5E6E6E] mt-2 flex items-center gap-1">
              <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
              {{ formatDate(item.tanggal) }}
            </p>
          </div>
        </div>
      </div>

      <div v-else class="text-center py-12 bg-white/60 rounded-2xl border border-[#3A4A4C]/15 max-w-md mx-auto">
        <p class="text-[#5E6E6E]">Belum ada foto galeri yang diunggah.</p>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue';

defineProps({
  galleries: Array,
});

function formatDate(dateStr) {
  if (!dateStr) return '';
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
}
</script>
