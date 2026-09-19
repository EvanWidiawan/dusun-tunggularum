<template>
  <footer class="bg-[#1F5C6B] text-[#EEF3F3] border-t-4 border-[#5FA8B5]">
    <!-- Main Footer Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 lg:py-16">
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 lg:gap-8">
        
        <!-- Column 1: Branding & Description -->
        <div class="space-y-4">
          <div class="flex items-center gap-3">
            <div class="w-11 h-11 rounded-full bg-white text-[#1F5C6B] flex items-center justify-center shadow-md overflow-hidden p-0.5 border border-white/30 shrink-0">
              <img
                v-if="hasCustomLogo"
                :src="currentLogoUrl"
                alt="Logo Dusun Tunggularum"
                class="w-full h-full object-contain rounded-full"
                @error="handleLogoError"
              />
              <svg v-else class="w-6 h-6 text-[#1F5C6B]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20l7-14 4 8 2-4 5 10H3z" />
              </svg>
            </div>
            <span class="font-display font-bold text-2xl tracking-tight text-white">
              Dusun Tunggularum
            </span>
          </div>
          <p class="text-sm text-[#EEF3F3]/80 leading-relaxed font-body">
            Media Informasi Resmi & Pusat Digitalisasi Dusun Tunggularum, Turi, Sleman. Menyajikan potensi UMKM warga, kegiatan desa, dan keterbukaan informasi publik.
          </p>
          <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-lg bg-[#5FA8B5]/20 border border-[#5FA8B5]/40 text-xs text-[#EEF3F3] font-medium">
            Program Kerja KKN UNY 2026
          </div>
        </div>

        <!-- Column 2: Quick Links (Smooth Scroll Anchor Links) -->
        <div>
          <h3 class="font-display font-semibold text-lg text-white mb-4 border-b border-[#EEF3F3]/15 pb-2">
            Navigasi Cepat
          </h3>
          <ul class="space-y-2.5 text-sm">
            <li>
              <a href="#beranda" @click.prevent="scrollToSection('#beranda')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                Beranda
              </a>
            </li>
            <li>
              <a href="#profil" @click.prevent="scrollToSection('#profil')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                Profil & Sejarah Dusun
              </a>
            </li>
            <li>
              <a href="#umkm" @click.prevent="scrollToSection('#umkm')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                UMKM & Usaha Warga
              </a>
            </li>
            <li>
              <a href="#kegiatan" @click.prevent="scrollToSection('#kegiatan')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                Kegiatan & Tradisi
              </a>
            </li>
            <li>
              <a href="#galeri" @click.prevent="scrollToSection('#galeri')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                Galeri Foto
              </a>
            </li>
            <li>
              <a href="#karang-taruna" @click.prevent="scrollToSection('#karang-taruna')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                Karang Taruna
              </a>
            </li>
            <li>
              <a href="#kontak" @click.prevent="scrollToSection('#kontak')" class="text-[#EEF3F3]/80 hover:text-[#5FA8B5] hover:translate-x-1 transition-all inline-block cursor-pointer">
                Kontak & Lokasi
              </a>
            </li>
          </ul>
        </div>

        <!-- Column 3: Contact & Working Hours -->
        <div class="space-y-4 md:col-span-2 lg:col-span-2">
          <h3 class="font-display font-semibold text-lg text-white mb-4 border-b border-[#EEF3F3]/15 pb-2">
            Kontak & Pelayanan
          </h3>
          <ul class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm text-[#EEF3F3]/80">
            <li class="flex items-start gap-3">
              <svg class="w-5 h-5 text-[#5FA8B5] shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
              <span>Dusun Tunggularum, Kalurahan Wonokerto, Kapanewon Turi, Kabupaten Sleman, D.I. Yogyakarta</span>
            </li>
            <li class="flex items-center gap-3">
              <svg class="w-5 h-5 text-[#5FA8B5] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              <span>+62 812-3456-7890</span>
            </li>
          </ul>
        </div>

      </div>
    </div>

    <!-- Bottom Copyright Bar with Subtle Lock Icon Link -->
    <div class="bg-[#153E48] border-t border-[#EEF3F3]/10 py-5 text-center text-xs text-[#EEF3F3]/60">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col sm:flex-row items-center justify-between gap-3">
        <div class="flex items-center gap-2">
          <p>© 2026 Pemerintah Dusun Tunggularum. Seluruh Hak Cipta Dilindungi.</p>
          <!-- Subtle Hidden Lock Icon Link for Admin Access -->
          <Link
            :href="$page.props.auth?.user ? '/admin/dashboard' : '/login'"
            title="Akses Pengelola Admin"
            class="text-[#EEF3F3]/40 hover:text-[#5FA8B5] transition-colors p-1 rounded-md"
          >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
            </svg>
          </Link>
        </div>
        <p class="text-[#EEF3F3]/40">Dikembangkan oleh Tim Program Kerja KKN Universitas Negeri Yogyakarta 2026</p>
      </div>
    </div>
  </footer>
</template>

<script setup>
import { ref } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';

const currentLogoUrl = ref('/images/logo.png');
const hasCustomLogo = ref(true);

function handleLogoError() {
  if (currentLogoUrl.value === '/images/logo.png') {
    currentLogoUrl.value = '/images/logo.webp';
  } else if (currentLogoUrl.value === '/images/logo.webp') {
    currentLogoUrl.value = '/images/logo.jpeg';
  } else {
    hasCustomLogo.value = false;
  }
}
const page = usePage();

function scrollToSection(hash) {
  if (page.url !== '/' && !page.url.startsWith('/#')) {
    router.visit('/' + hash);
    return;
  }

  const targetId = hash.replace('#', '');
  const el = document.getElementById(targetId);
  if (el) {
    const yOffset = -80;
    const y = el.getBoundingClientRect().top + window.pageYOffset + yOffset;
    window.scrollTo({ top: y, behavior: 'smooth' });
  }
}
</script>
