<template>
  <header
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 ease-in-out"
    :class="[
      isHeroState
        ? 'bg-transparent border-b border-white/10 py-2 text-white'
        : 'bg-[#EEF3F3]/95 backdrop-blur-md border-b border-[#3A4A4C]/15 shadow-md py-0 text-[#1F5C6B]'
    ]"
  >
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-20">
        <!-- Logo & Nama Dusun -->
        <a
          href="#beranda"
          @click.prevent="navigateTo('#beranda')"
          class="flex items-center gap-3 group focus:outline-hidden cursor-pointer"
        >
          <div
            class="w-11 h-11 rounded-full flex items-center justify-center shadow-md transition-all duration-300 overflow-hidden bg-white p-0.5 border border-white/40 shrink-0"
          >
            <!-- Logo Image -->
            <img
              v-if="hasCustomLogo"
              :src="logoUrl"
              alt="Logo Dusun Tunggularum"
              class="w-full h-full object-contain rounded-full"
              @error="hasCustomLogo = false"
            />
            <!-- SVG Mountain Icon Fallback -->
            <svg
              v-else
              class="w-6 h-6 text-[#1F5C6B]"
              fill="none"
              stroke="currentColor"
              viewBox="0 0 24 24"
              xmlns="http://www.w3.org/2000/svg"
            >
              <path
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M3 20l7-14 4 8 2-4 5 10H3z"
              />
            </svg>
          </div>
          <div class="flex flex-col">
            <span
              class="font-display font-bold text-xl tracking-tight leading-tight transition-colors duration-300"
              :class="[
                isHeroState
                  ? 'text-white group-hover:text-[#5FA8B5]'
                  : 'text-[#1F5C6B] group-hover:text-[#5FA8B5]'
              ]"
            >
              Dusun Tunggularum
            </span>
            <span
              class="text-xs font-medium tracking-wide transition-colors duration-300"
              :class="[isHeroState ? 'text-white/80' : 'text-[#5E6E6E]']"
            >
              Turi, Sleman, D.I. Yogyakarta
            </span>
          </div>
        </a>

        <!-- Desktop Navigation (Smooth Scroll Links) -->
        <nav class="hidden lg:flex items-center gap-1">
          <a
            v-for="item in navItems"
            :key="item.name"
            :href="item.href"
            @click.prevent="navigateTo(item.href)"
            class="px-3.5 py-2 rounded-lg text-sm font-medium transition-all duration-200 cursor-pointer"
            :class="[
              activeSection === item.id
                ? isHeroState
                  ? 'bg-white/25 text-white font-semibold backdrop-blur-md shadow-xs'
                  : 'bg-[#1F5C6B] text-white font-semibold shadow-xs'
                : isHeroState
                  ? 'text-white/90 hover:text-white hover:bg-white/15'
                  : 'text-[#3A4A4C] hover:text-[#1F5C6B] hover:bg-[#1F5C6B]/10'
            ]"
          >
            {{ item.name }}
          </a>
        </nav>

        <!-- Right Side: Mobile Drawer Menu Toggle -->
        <div class="flex items-center lg:hidden">
          <button
            @click="mobileMenuOpen = !mobileMenuOpen"
            type="button"
            class="p-2.5 rounded-xl focus:outline-hidden transition-colors"
            :class="[
              isHeroState
                ? 'text-white hover:bg-white/20'
                : 'text-[#3A4A4C] hover:text-[#1F5C6B] hover:bg-[#1F5C6B]/10'
            ]"
            aria-label="Toggle Navigation Menu"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path
                v-if="!mobileMenuOpen"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M4 6h16M4 12h16M4 18h16"
              />
              <path
                v-else
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-width="2"
                d="M6 18L18 6M6 6l12 12"
              />
            </svg>
          </button>
        </div>
      </div>
    </div>

    <!-- Mobile Drawer Menu -->
    <transition
      enter-active-class="transition duration-200 ease-out"
      enter-from-class="opacity-0 -translate-y-2"
      enter-to-class="opacity-100 translate-y-0"
      leave-active-class="transition duration-150 ease-in"
      leave-from-class="opacity-100 translate-y-0"
      leave-to-class="opacity-0 -translate-y-2"
    >
      <div
        v-if="mobileMenuOpen"
        class="lg:hidden px-4 pt-3 pb-6 space-y-2 shadow-lg"
        :class="[isHeroState ? 'bg-[#1F5C6B]/95 backdrop-blur-md border-b border-white/20' : 'bg-[#EEF3F3] border-b border-[#3A4A4C]/20']"
      >
        <a
          v-for="item in navItems"
          :key="item.name"
          :href="item.href"
          @click.prevent="navigateTo(item.href); mobileMenuOpen = false;"
          class="block px-4 py-2.5 rounded-xl text-base font-medium transition-colors cursor-pointer"
          :class="[
            activeSection === item.id
              ? 'bg-[#5FA8B5] text-[#1F5C6B] font-semibold'
              : isHeroState
                ? 'text-white hover:bg-white/10'
                : 'text-[#3A4A4C] hover:bg-[#1F5C6B]/10 hover:text-[#1F5C6B]'
          ]"
        >
          {{ item.name }}
        </a>
      </div>
    </transition>
  </header>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import { usePage, router } from '@inertiajs/vue3';

const mobileMenuOpen = ref(false);
const isHeroState = ref(true);
const activeSection = ref('beranda');
const logoUrl = '/images/logo.png';
const hasCustomLogo = ref(true);
const page = usePage();

const navItems = [
  { name: 'Beranda', href: '#beranda', id: 'beranda' },
  { name: 'Profil', href: '#profil', id: 'profil' },
  { name: 'UMKM Desa', href: '#umkm', id: 'umkm' },
  { name: 'Kegiatan & Tradisi', href: '#kegiatan', id: 'kegiatan' },
  { name: 'Galeri', href: '#galeri', id: 'galeri' },
  { name: 'Karang Taruna', href: '#karang-taruna', id: 'karang-taruna' },
  { name: 'Kontak', href: '#kontak', id: 'kontak' },
];

function navigateTo(hash) {
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
    activeSection.value = targetId;
  }
}

function handleScroll() {
  const scrollY = window.scrollY;

  // Find profil section offset
  const profilEl = document.getElementById('profil');
  const profilThreshold = profilEl ? profilEl.offsetTop - 100 : 500;

  // Navbar is transparent in Hero state (scrollY < profilThreshold)
  if (scrollY < profilThreshold && (page.url === '/' || page.url.startsWith('/#'))) {
    isHeroState.value = true;
  } else {
    isHeroState.value = false;
  }

  // Scroll Spy Logic
  const sectionIds = navItems.map((item) => item.id);
  const scrollPosition = scrollY + 120;

  for (let i = sectionIds.length - 1; i >= 0; i--) {
    const section = document.getElementById(sectionIds[i]);
    if (section && section.offsetTop <= scrollPosition) {
      activeSection.value = sectionIds[i];
      break;
    }
  }
}

onMounted(() => {
  window.addEventListener('scroll', handleScroll, { passive: true });
  handleScroll();

  if (window.location.hash) {
    setTimeout(() => {
      navigateTo(window.location.hash);
    }, 200);
  }
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});
</script>
