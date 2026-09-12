<template>
  <AdminLayout title="Ikhtisar Dashboard">
    <div class="space-y-6">

      <!-- Welcome Banner -->
      <div class="bg-gradient-to-r from-[#1F5C6B] via-[#246170] to-[#5FA8B5] rounded-3xl p-6 sm:p-8 text-white shadow-md relative overflow-hidden">
        <div class="max-w-2xl space-y-3 relative z-10">
          <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-white text-xs font-semibold uppercase tracking-wider">
            <span class="w-2 h-2 rounded-full bg-white animate-pulse"></span>
            Portal Administrasi Desa
          </div>
          <h2 class="font-display font-bold text-2xl sm:text-3xl tracking-tight leading-tight">
            Selamat Datang Kembali, Pengelola Desa!
          </h2>
          <p class="text-sm text-white/90 leading-relaxed font-body font-normal">
            Gunakan panel ini untuk memperbarui kepengurusan Karang Taruna, mengunggah dokumentasi foto kegiatan galeri desa, serta memantau trafik statistik pengunjung website Dusun Tunggularum.
          </p>
        </div>
      </div>

      <!-- 4 Stat Cards Grid -->
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Stat 1: Total Kunjungan -->
        <div class="bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs hover:shadow-md transition-all space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-[#5E6E6E]">Total Kunjungan</span>
            <div class="w-11 h-11 rounded-xl bg-[#1F5C6B]/10 text-[#1F5C6B] flex items-center justify-center shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
              </svg>
            </div>
          </div>
          <p class="font-display font-bold text-3xl text-[#1F5C6B] tracking-tight">{{ stats.totalVisits }}</p>
          <p class="text-xs text-[#5E6E6E] font-medium">Akumulasi pengunjung publik</p>
        </div>

        <!-- Stat 2: Kunjungan Hari Ini -->
        <div class="bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs hover:shadow-md transition-all space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-[#5E6E6E]">Hari Ini</span>
            <div class="w-11 h-11 rounded-xl bg-[#5FA8B5]/20 text-[#1F5C6B] flex items-center justify-center shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
              </svg>
            </div>
          </div>
          <p class="font-display font-bold text-3xl text-[#1F5C6B] tracking-tight">{{ stats.todayVisits }}</p>
          <p class="text-xs text-[#5E6E6E] font-medium">Kunjungan hari ini</p>
        </div>

        <!-- Stat 3: Karang Taruna -->
        <div class="bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs hover:shadow-md transition-all space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-[#5E6E6E]">Karang Taruna</span>
            <div class="w-11 h-11 rounded-xl bg-[#1F5C6B]/10 text-[#1F5C6B] flex items-center justify-center shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </div>
          </div>
          <p class="font-display font-bold text-3xl text-[#1F5C6B] tracking-tight">{{ stats.totalKarangTaruna }}</p>
          <p class="text-xs text-[#5E6E6E] font-medium">Pengurus aktif terdaftar</p>
        </div>

        <!-- Stat 4: Galeri Foto -->
        <div class="bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs hover:shadow-md transition-all space-y-3">
          <div class="flex items-center justify-between">
            <span class="text-xs font-bold uppercase tracking-wider text-[#5E6E6E]">Foto Galeri</span>
            <div class="w-11 h-11 rounded-xl bg-[#5FA8B5]/20 text-[#1F5C6B] flex items-center justify-center shrink-0">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
              </svg>
            </div>
          </div>
          <p class="font-display font-bold text-3xl text-[#1F5C6B] tracking-tight">{{ stats.totalGaleri }}</p>
          <p class="text-xs text-[#5E6E6E] font-medium">Foto terpublikasi</p>
        </div>
      </div>

      <!-- Quick Action Cards & Traffic Section -->
      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Quick Action Cards (1 Column) -->
        <div class="bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs space-y-5 flex flex-col justify-between">
          <div class="space-y-1">
            <h3 class="font-display font-bold text-lg text-[#1F5C6B]">Aksi Cepat Pengelola</h3>
            <p class="text-xs text-[#5E6E6E]">
              Pintasan cepat untuk mengelola data dan mengunggah dokumen publik desa.
            </p>
          </div>
          
          <div class="space-y-3">
            <Link
              href="/admin/karang-taruna"
              class="flex items-center justify-between p-4 rounded-xl bg-[#EEF3F3] hover:bg-[#1F5C6B] text-[#1F5C6B] hover:text-white transition-all group font-semibold text-sm shadow-2xs"
            >
              <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                </svg>
                <span>Kelola Karang Taruna</span>
              </div>
              <span class="text-xs group-hover:translate-x-1 transition-transform font-bold">&rarr;</span>
            </Link>

            <Link
              href="/admin/galeri"
              class="flex items-center justify-between p-4 rounded-xl bg-[#EEF3F3] hover:bg-[#1F5C6B] text-[#1F5C6B] hover:text-white transition-all group font-semibold text-sm shadow-2xs"
            >
              <div class="flex items-center gap-3">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                <span>Upload Foto Galeri</span>
              </div>
              <span class="text-xs group-hover:translate-x-1 transition-transform font-bold">&rarr;</span>
            </Link>
          </div>
        </div>

        <!-- Recent Visits Table (2 Columns) -->
        <div class="lg:col-span-2 bg-white rounded-2xl p-6 border border-[#3A4A4C]/10 shadow-xs space-y-4">
          <div class="flex items-center justify-between pb-2 border-b border-[#3A4A4C]/10">
            <h3 class="font-display font-bold text-lg text-[#1F5C6B]">Tren Kunjungan (7 Hari Terakhir)</h3>
            <span class="text-xs font-bold text-[#1F5C6B] bg-[#5FA8B5]/20 px-3 py-1 rounded-full">
              Statistik Otomatis
            </span>
          </div>

          <div v-if="recentVisits && recentVisits.length > 0" class="overflow-x-auto">
            <table class="w-full text-left text-sm">
              <thead class="bg-[#1F5C6B]/5 text-[#1F5C6B] uppercase text-xs font-bold">
                <tr>
                  <th class="px-4 py-3 rounded-l-xl">Tanggal Kunjungan</th>
                  <th class="px-4 py-3 text-right rounded-r-xl">Jumlah Kunjungan Halaman</th>
                </tr>
              </thead>
              <tbody class="divide-y divide-[#3A4A4C]/10">
                <tr v-for="visit in recentVisits" :key="visit.id" class="hover:bg-[#EEF3F3]/60 transition-colors">
                  <td class="px-4 py-3.5 font-semibold text-[#1F5C6B]">{{ formatDate(visit.tanggal) }}</td>
                  <td class="px-4 py-3.5 text-right font-bold text-[#1F5C6B]">
                    <span class="px-3 py-1 rounded-lg bg-[#EEF3F3] text-[#1F5C6B]">
                      {{ visit.jumlah_kunjungan }} kali
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div v-else class="text-center py-10 text-xs text-[#5E6E6E] bg-[#EEF3F3]/50 rounded-xl">
            Belum ada data kunjungan publik tercatat dalam 7 hari terakhir.
          </div>
        </div>
      </div>

    </div>
  </AdminLayout>
</template>

<script setup>
import { Link } from '@inertiajs/vue3';
import AdminLayout from '../../Layouts/AdminLayout.vue';

defineProps({
  stats: Object,
  recentVisits: Array,
});

function formatDate(dateStr) {
  if (!dateStr) return '';
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
}
</script>
