<template>
  <PublicLayout>
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h1 class="font-display font-bold text-4xl text-[#1F5C6B]">Profil & Sejarah Desa Merapi</h1>
        <p class="text-[#5E6E6E] text-lg">Mengenal sejarah, visi & misi, serta struktur organisasi pemerintahan desa.</p>
      </div>

      <div class="bg-white/80 rounded-2xl p-8 border border-[#3A4A4C]/15 shadow-xs space-y-8 max-w-4xl mx-auto">
        <div>
          <h2 class="font-display font-bold text-2xl text-[#1F5C6B] mb-3">Sejarah Desa</h2>
          <p class="text-[#5E6E6E] leading-relaxed">
            Desa Merapi berlokasi di wilayah mata air lereng Gunung Merapi, Sleman, D.I. Yogyakarta. Desa ini terkenal dengan sumber mata air alami yang jernih, tradisi pertanian yang subur, dan semangat gotong royong warga yang diwariskan secara turun-temurun.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-[#3A4A4C]/15">
          <div class="bg-[#EEF3F3]/80 p-6 rounded-xl border border-[#3A4A4C]/10">
            <h3 class="font-display font-bold text-xl text-[#1F5C6B] mb-2">Visi Desa</h3>
            <p class="text-sm text-[#5E6E6E] leading-relaxed">
              Terwujudnya Desa Merapi yang Mandiri, Sejahtera, Berdaya Saing, dan Berkelanjutan Berbasis Ekonomi Kerakyatan dan Pelestarian Sumber Daya Alam.
            </p>
          </div>

          <div class="bg-[#EEF3F3]/80 p-6 rounded-xl border border-[#3A4A4C]/10">
            <h3 class="font-display font-bold text-xl text-[#1F5C6B] mb-2">Misi Desa</h3>
            <ul class="text-sm text-[#5E6E6E] space-y-2 list-disc list-inside">
              <li>Meningkatkan tata kelola pemerintahan yang terbuka.</li>
              <li>Pengembangan potensi lokal, UMKM, dan pariwisata.</li>
              <li>Pemberdayaan generasi muda Karang Taruna.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue';
</script>
