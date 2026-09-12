<template>
  <div class="min-h-screen flex bg-[#EEF3F3] text-[#5E6E6E] font-body selection:bg-[#1F5C6B] selection:text-white">
    <!-- Mobile Sidebar Backdrop -->
    <transition
      enter-active-class="transition-opacity ease-linear duration-200"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition-opacity ease-linear duration-150"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="sidebarOpen"
        @click="sidebarOpen = false"
        class="fixed inset-0 z-40 bg-black/60 backdrop-blur-xs lg:hidden"
      ></div>
    </transition>

    <!-- Sidebar Navigation -->
    <aside
      class="fixed top-0 bottom-0 left-0 z-50 w-64 bg-[#1F5C6B] text-white flex flex-col transition-transform duration-300 ease-in-out lg:translate-x-0 shadow-2xl"
      :class="[sidebarOpen ? 'translate-x-0' : '-translate-x-full']"
    >
      <!-- Sidebar Branding Header -->
      <div class="h-20 flex items-center gap-3.5 px-6 border-b border-white/10 shrink-0">
        <div class="w-10 h-10 rounded-xl bg-[#5FA8B5] text-[#1F5C6B] flex items-center justify-center shadow-md font-bold text-xl overflow-hidden">
          <img
            v-if="hasCustomLogo"
            :src="logoUrl"
            alt="Logo Dusun Tunggularum"
            class="w-full h-full object-contain p-1"
            @error="hasCustomLogo = false"
          />
          <svg v-else class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 20l7-14 4 8 2-4 5 10H3z" />
          </svg>
        </div>
        <div class="flex flex-col">
          <span class="font-display font-bold text-lg tracking-tight text-white leading-tight">
            Admin Panel
          </span>
          <span class="text-xs text-[#EEF3F3]/75 font-medium tracking-wide">
            Dusun Tunggularum
          </span>
        </div>
      </div>

      <!-- Navigation Links Menu -->
      <nav class="flex-1 px-4 py-6 space-y-1.5 overflow-y-auto">
        <p class="px-3 text-[10px] font-bold uppercase tracking-widest text-white/50 mb-2">
          Menu Utama
        </p>
        <Link
          v-for="item in menuItems"
          :key="item.name"
          :href="item.href"
          @click="sidebarOpen = false"
          class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all duration-200"
          :class="[
            isUrlActive(item.href)
              ? 'bg-[#5FA8B5] text-[#1F5C6B] font-bold shadow-md'
              : 'text-[#EEF3F3]/85 hover:bg-white/10 hover:text-white'
          ]"
        >
          <component :is="item.icon" class="w-5 h-5 shrink-0" />
          <span>{{ item.name }}</span>
        </Link>
      </nav>

      <!-- View Main Website & Logout Section -->
      <div class="p-4 border-t border-white/10 space-y-2 shrink-0 bg-[#174753]">
        <Link
          href="/"
          target="_blank"
          class="flex items-center justify-center gap-2.5 w-full px-4 py-2.5 rounded-xl bg-white/10 hover:bg-white/20 text-white text-xs font-semibold transition-all border border-white/10"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
          </svg>
          Lihat Web Utama
        </Link>

        <button
          @click="logout"
          type="button"
          class="flex items-center justify-center gap-2.5 w-full px-4 py-2.5 rounded-xl bg-red-500/15 hover:bg-red-600 text-red-200 hover:text-white text-xs font-bold transition-all border border-red-500/20"
        >
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
          </svg>
          Keluar (Logout)
        </button>
      </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 flex flex-col min-w-0 lg:pl-64">
      <!-- Topbar Header -->
      <header class="h-20 bg-white/90 backdrop-blur-md border-b border-[#3A4A4C]/15 px-4 sm:px-8 flex items-center justify-between sticky top-0 z-30 shadow-xs">
        <div class="flex items-center gap-4">
          <button
            @click="sidebarOpen = !sidebarOpen"
            class="lg:hidden p-2 rounded-xl text-[#3A4A4C] hover:bg-[#EEF3F3] focus:outline-hidden transition-colors"
            aria-label="Toggle Navigation Sidebar"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
          </button>
          <h1 class="font-display font-bold text-xl sm:text-2xl text-[#1F5C6B] tracking-tight">
            {{ title }}
          </h1>
        </div>

        <!-- Admin Profile Badge -->
        <div class="flex items-center gap-3">
          <div class="hidden sm:flex flex-col text-right">
            <span class="text-sm font-bold text-[#1F5C6B] leading-tight">{{ userName }}</span>
            <span class="text-xs text-[#5E6E6E] font-medium">@{{ userUsername }}</span>
          </div>
          <div class="w-10 h-10 rounded-xl bg-[#1F5C6B] text-white flex items-center justify-center font-bold text-sm shadow-md">
            AD
          </div>
        </div>
      </header>

      <!-- Main Container with Balanced Padding -->
      <main class="flex-1 p-4 sm:p-6 lg:p-8 max-w-7xl w-full mx-auto space-y-6">
        <!-- Flash Success Toast Banner -->
        <transition
          enter-active-class="transition duration-300 ease-out"
          enter-from-class="opacity-0 -translate-y-2"
          enter-to-class="opacity-100 translate-y-0"
          leave-active-class="transition duration-200 ease-in"
          leave-from-class="opacity-100 translate-y-0"
          leave-to-class="opacity-0 -translate-y-2"
        >
          <div v-if="$page.props.flash && $page.props.flash.success" class="p-4 rounded-2xl bg-emerald-50 border border-emerald-200 text-emerald-800 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
              <div class="w-8 h-8 rounded-lg bg-emerald-500 text-white flex items-center justify-center shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
              </div>
              <span class="text-sm font-bold">{{ $page.props.flash.success }}</span>
            </div>
          </div>
        </transition>

        <slot />
      </main>
    </div>
  </div>
</template>

<script setup>
import { ref, computed, h } from 'vue';
import { Link, usePage, router } from '@inertiajs/vue3';

defineProps({
  title: {
    type: String,
    default: 'Dashboard Admin',
  },
});

const sidebarOpen = ref(false);
const logoUrl = '/images/logo.png';
const hasCustomLogo = ref(true);
const page = usePage();

const userName = computed(() => {
  return page.props.auth?.user?.name || 'Administrator Desa';
});

const userUsername = computed(() => {
  return page.props.auth?.user?.username || 'admin';
});

// Navigation Icons
const IconDashboard = {
  render: () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 00-1 1m-6 0h6' })
  ])
};

const IconUsers = {
  render: () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z' })
  ])
};

const IconGallery = {
  render: () => h('svg', { fill: 'none', stroke: 'currentColor', viewBox: '0 0 24 24' }, [
    h('path', { 'stroke-linecap': 'round', 'stroke-linejoin': 'round', 'stroke-width': '2', d: 'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z' })
  ])
};

const menuItems = [
  { name: 'Dashboard', href: '/admin/dashboard', icon: IconDashboard },
  { name: 'Karang Taruna', href: '/admin/karang-taruna', icon: IconUsers },
  { name: 'Galeri Desa', href: '/admin/galeri', icon: IconGallery },
];

function isUrlActive(href) {
  return page.url.startsWith(href);
}

function logout() {
  if (confirm('Apakah Anda yakin ingin keluar dari panel admin?')) {
    router.post('/logout');
  }
}
</script>
