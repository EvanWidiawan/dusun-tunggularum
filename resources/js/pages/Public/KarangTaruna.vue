<template>
  <PublicLayout>
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h1 class="font-display font-bold text-4xl text-[#1F5C6B]">Karang Taruna Desa Merapi</h1>
        <p class="text-[#5E6E6E] text-lg">Struktur kepengurusan dan penggerak pemuda-pemudi Desa Merapi.</p>
      </div>

      <div v-if="members && members.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="member in members"
          :key="member.id"
          class="bg-white/80 rounded-2xl p-6 border border-[#3A4A4C]/15 shadow-xs flex flex-col items-center text-center hover:shadow-md transition-all"
        >
          <div class="w-24 h-24 rounded-full bg-[#1F5C6B]/10 border-2 border-[#1F5C6B] overflow-hidden flex items-center justify-center mb-4">
            <img
              v-if="member.foto"
              :src="'/storage/' + member.foto"
              :alt="member.nama"
              class="w-full h-full object-cover"
            />
            <svg v-else class="w-12 h-12 text-[#1F5C6B]/40" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
            </svg>
          </div>
          <h3 class="font-display font-bold text-xl text-[#1F5C6B]">{{ member.nama }}</h3>
          <span class="px-3 py-1 rounded-full bg-[#5FA8B5]/20 text-[#1F5C6B] text-xs font-semibold mt-1">
            {{ member.jabatan }}
          </span>
          <p class="text-sm text-[#5E6E6E] mt-3 leading-relaxed">
            {{ member.deskripsi || 'Pengurus aktif Karang Taruna Desa Merapi.' }}
          </p>
        </div>
      </div>

      <div v-else class="text-center py-12 bg-white/60 rounded-2xl border border-[#3A4A4C]/15 max-w-md mx-auto">
        <p class="text-[#5E6E6E]">Belum ada data pengurus Karang Taruna.</p>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue';

defineProps({
  members: Array,
});
</script>
