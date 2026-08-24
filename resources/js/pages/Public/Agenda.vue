<template>
  <PublicLayout>
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h1 class="font-display font-bold text-4xl text-[#1F5C6B]">Agenda & Kegiatan Desa</h1>
        <p class="text-[#5E6E6E] text-lg">Jadwal kegiatan masyarakat, kerja bakti, serta program kerja ke depan.</p>
      </div>

      <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white/80 rounded-2xl p-6 border border-[#3A4A4C]/15 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
          <div>
            <span class="text-xs font-semibold text-[#5FA8B5] uppercase tracking-wider">01 September 2026</span>
            <h3 class="font-display font-bold text-xl text-[#1F5C6B] mt-1">Kerja Bakti Masal & Pembersihan Mata Air Desa</h3>
            <p class="text-sm text-[#5E6E6E] mt-1">Lokasi: Area Sumber Mata Air Dusun 3</p>
          </div>
          <span class="px-4 py-2 rounded-xl bg-[#1F5C6B] text-white text-xs font-medium shrink-0">Mendatang</span>
        </div>

        <div class="bg-white/80 rounded-2xl p-6 border border-[#3A4A4C]/15 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
          <div>
            <span class="text-xs font-semibold text-[#5FA8B5] uppercase tracking-wider">10 September 2026</span>
            <h3 class="font-display font-bold text-xl text-[#1F5C6B] mt-1">Pelatihan Digital Marketing UMKM Desa</h3>
            <p class="text-sm text-[#5E6E6E] mt-1">Lokasi: Balai Desa Merapi</p>
          </div>
          <span class="px-4 py-2 rounded-xl bg-[#1F5C6B] text-white text-xs font-medium shrink-0">Mendatang</span>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue';
</script>
