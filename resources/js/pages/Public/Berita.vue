<template>
  <PublicLayout>
    <Head>
      <title>Berita Dusun</title>
      <meta
        name="description"
        content="Kabar terbaru, pengumuman, dan informasi kegiatan warga Dusun Tunggularum, Wonokerto, Turi, Sleman."
      />
    </Head>

    <!-- HEADER BANNER -->
    <section
      class="relative pt-32 pb-24 sm:pt-36 sm:pb-28 bg-cover bg-center overflow-hidden"
      style="background-image: url('/images/hero-tunggularum2.jpeg');"
    >
      <div class="absolute inset-0 bg-gradient-to-b from-black/75 via-[#1F5C6B]/80 to-[#1F5C6B]"></div>
      <!-- Decorative blobs -->
      <div class="absolute -top-24 -right-24 w-80 h-80 rounded-full bg-[#5FA8B5]/25 blur-3xl"></div>
      <div class="absolute -bottom-32 -left-20 w-96 h-96 rounded-full bg-[#5FA8B5]/15 blur-3xl"></div>

      <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl space-y-5 reveal-on-scroll">
          <!-- Breadcrumb -->
          <nav aria-label="Breadcrumb" class="flex items-center gap-2 text-xs sm:text-sm text-white/75 font-medium">
            <Link href="/" class="hover:text-white transition-colors">Beranda</Link>
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
            </svg>
            <span class="text-white font-semibold">Berita</span>
          </nav>

          <h1 class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white leading-tight tracking-tight drop-shadow-lg">
            Berita <span class="text-[#5FA8B5]">Dusun Tunggularum</span>
          </h1>
          <p class="text-base sm:text-lg text-white/90 leading-relaxed max-w-2xl">
            Kabar terbaru, pengumuman resmi, dan cerita kegiatan warga dari lereng Merapi, langsung dari pengurus dusun.
          </p>

          <!-- Quick stats -->
          <div class="flex flex-wrap items-center gap-3 pt-2">
            <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-white text-xs font-semibold">
              <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
              </svg>
              {{ allBerita.length }} Berita
            </span>
            <span
              v-if="latestDate"
              class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-md border border-white/25 text-white text-xs font-semibold"
            >
              <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
              Diperbarui {{ formatDate(latestDate) }}
            </span>
          </div>
        </div>
      </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
      <!-- TOOLBAR: FILTER KATEGORI + PENCARIAN -->
      <div
        class="relative z-20 -mt-10 bg-white rounded-2xl sm:rounded-3xl p-4 sm:p-5 border border-[#3A4A4C]/10 shadow-xl shadow-[#1F5C6B]/5 flex flex-col lg:flex-row lg:items-center gap-4 reveal-on-scroll delay-100"
      >
        <div class="flex-1 min-w-0">
          <div class="flex items-center gap-2 overflow-x-auto pb-1 -mb-1 scrollbar-none">
            <button
              v-for="kat in kategoriList"
              :key="kat.name"
              :id="`filter-kategori-${slugify(kat.name)}`"
              type="button"
              @click="setKategori(kat.name)"
              class="shrink-0 inline-flex items-center gap-2 px-4 py-2 rounded-full text-xs sm:text-sm font-semibold transition-all duration-200 cursor-pointer"
              :class="[
                activeKategori === kat.name
                  ? 'bg-[#1F5C6B] text-white shadow-md shadow-[#1F5C6B]/25'
                  : 'bg-[#EEF3F3] text-[#3A4A4C] hover:bg-[#5FA8B5]/20 hover:text-[#1F5C6B]'
              ]"
            >
              {{ kat.name }}
              <span
                class="text-[10px] font-bold px-1.5 py-0.5 rounded-full"
                :class="activeKategori === kat.name ? 'bg-white/20 text-white' : 'bg-white text-[#5E6E6E]'"
              >
                {{ kat.count }}
              </span>
            </button>
          </div>
        </div>

        <div class="relative w-full lg:w-80 shrink-0">
          <svg class="w-5 h-5 text-[#5E6E6E] absolute left-3.5 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          <input
            id="search-berita"
            v-model="searchQuery"
            type="search"
            placeholder="Cari judul atau isi berita..."
            class="w-full pl-11 pr-10 py-2.5 rounded-xl bg-[#EEF3F3]/70 border border-[#3A4A4C]/15 text-sm text-[#1F5C6B] placeholder-[#5E6E6E]/60 focus:outline-hidden focus:border-[#1F5C6B] focus:bg-white transition-colors"
          />
          <button
            v-if="searchQuery"
            type="button"
            @click="searchQuery = ''"
            class="absolute right-2.5 top-1/2 -translate-y-1/2 w-6 h-6 rounded-full bg-[#3A4A4C]/10 hover:bg-[#3A4A4C]/20 text-[#3A4A4C] flex items-center justify-center cursor-pointer"
            aria-label="Hapus pencarian"
          >
            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
      </div>

      <!-- EMPTY STATE: BELUM ADA BERITA -->
      <div
        v-if="allBerita.length === 0"
        class="mt-14 text-center py-20 px-6 bg-white/70 rounded-3xl border border-[#3A4A4C]/10 max-w-xl mx-auto"
      >
        <div class="w-16 h-16 rounded-2xl bg-[#1F5C6B]/10 text-[#1F5C6B] flex items-center justify-center mx-auto mb-4">
          <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
          </svg>
        </div>
        <h2 class="font-display font-bold text-2xl text-[#1F5C6B]">Belum ada berita</h2>
        <p class="text-sm text-[#5E6E6E] mt-2">Berita dan pengumuman dusun akan tampil di sini setelah dipublikasikan oleh pengurus.</p>
      </div>

      <template v-else>
        <!-- FEATURED: BERITA UTAMA + 3 TERBARU (hanya saat tanpa filter/pencarian) -->
        <section
          v-if="showFeatured && featured"
          class="mt-12 grid grid-cols-1 lg:grid-cols-5 gap-6 lg:gap-8"
          aria-label="Berita Utama"
        >
          <!-- Featured Big Card -->
          <article
            :id="`berita-featured-${featured.id}`"
            @click="openBerita(featured)"
            class="lg:col-span-3 group relative h-[380px] sm:h-[440px] lg:h-[500px] rounded-3xl overflow-hidden cursor-pointer shadow-lg hover:shadow-2xl transition-all duration-500 reveal-on-scroll delay-150"
          >
            <img
              :src="coverUrl(featured)"
              :alt="featured.judul"
              @error="handleImageFallback($event)"
              class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

            <div class="absolute top-5 left-5 flex items-center gap-2">
              <span class="px-3 py-1.5 rounded-full bg-[#5FA8B5] text-[#173f49] text-[11px] font-extrabold uppercase tracking-wider shadow-md">
                Terbaru
              </span>
              <span
                v-if="featured.kategori"
                class="px-3 py-1.5 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-white text-[11px] font-semibold"
              >
                {{ featured.kategori }}
              </span>
            </div>

            <div class="absolute bottom-0 left-0 right-0 p-6 sm:p-8 space-y-3">
              <div class="flex flex-wrap items-center gap-x-4 gap-y-1 text-xs text-white/80 font-medium">
                <span class="inline-flex items-center gap-1.5">
                  <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                  </svg>
                  {{ formatDate(featured.tanggal) }}
                </span>
                <span class="inline-flex items-center gap-1.5">
                  <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>
                  {{ readingTime(featured) }} menit baca
                </span>
              </div>
              <h2 class="font-display font-bold text-2xl sm:text-3xl lg:text-4xl text-white leading-tight drop-shadow-md group-hover:text-[#bfe3ea] transition-colors">
                {{ featured.judul }}
              </h2>
              <p class="text-sm sm:text-base text-white/85 line-clamp-2 max-w-2xl">
                {{ featured.ringkasan }}
              </p>
              <span class="inline-flex items-center gap-2 pt-1 text-sm font-bold text-white">
                Baca selengkapnya
                <span class="group-hover:translate-x-1.5 transition-transform">&rarr;</span>
              </span>
            </div>
          </article>

          <!-- Side list: 3 berita berikutnya -->
          <div class="lg:col-span-2 flex flex-col gap-4 lg:gap-5">
            <div class="flex items-center justify-between reveal-on-scroll delay-200">
              <h2 class="font-display font-bold text-xl text-[#1F5C6B]">Kabar Terkini</h2>
              <span class="h-px flex-1 ml-4 bg-gradient-to-r from-[#1F5C6B]/25 to-transparent"></span>
            </div>

            <article
              v-for="(item, idx) in sideList"
              :key="item.id"
              :id="`berita-side-${item.id}`"
              @click="openBerita(item)"
              class="group flex gap-4 p-3 sm:p-4 bg-white rounded-2xl border border-[#3A4A4C]/10 shadow-xs hover:shadow-lg hover:-translate-y-0.5 hover:border-[#5FA8B5]/40 transition-all duration-300 cursor-pointer flex-1 reveal-on-scroll"
              :class="['delay-200', 'delay-300', 'delay-400'][idx] || 'delay-200'"
            >
              <div class="w-28 sm:w-32 lg:w-28 xl:w-36 shrink-0 rounded-xl overflow-hidden bg-[#1F5C6B]/10 relative self-stretch min-h-[88px]">
                <img
                  :src="coverUrl(item)"
                  :alt="item.judul"
                  loading="lazy"
                  @error="handleImageFallback($event)"
                  class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                />
              </div>
              <div class="min-w-0 flex flex-col justify-center gap-1.5">
                <span v-if="item.kategori" class="text-[11px] font-bold uppercase tracking-wider text-[#5FA8B5]">
                  {{ item.kategori }}
                </span>
                <h3 class="font-display font-bold text-base sm:text-lg text-[#1F5C6B] leading-snug line-clamp-2 group-hover:text-[#5FA8B5] transition-colors">
                  {{ item.judul }}
                </h3>
                <span class="text-xs text-[#5E6E6E]">{{ formatDate(item.tanggal) }} · {{ readingTime(item) }} mnt baca</span>
              </div>
            </article>
          </div>
        </section>

        <!-- GRID BERITA -->
        <section class="mt-14" aria-label="Daftar Berita">
          <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-2 mb-7">
            <div>
              <h2 class="font-display font-bold text-2xl sm:text-3xl text-[#1F5C6B]">
                {{ gridTitle }}
              </h2>
              <p class="text-sm text-[#5E6E6E] mt-1">
                <template v-if="isFiltering">
                  Ditemukan <span class="font-bold text-[#1F5C6B]">{{ filteredList.length }}</span> berita
                  <template v-if="searchQuery"> untuk "<span class="font-semibold text-[#1F5C6B]">{{ searchQuery }}</span>"</template>
                </template>
                <template v-else>Arsip kabar dan informasi dusun lainnya.</template>
              </p>
            </div>
            <button
              v-if="isFiltering"
              type="button"
              @click="resetFilter"
              class="self-start sm:self-auto inline-flex items-center gap-1.5 text-xs font-bold text-[#1F5C6B] hover:text-[#5FA8B5] cursor-pointer"
            >
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              Reset filter
            </button>
          </div>

          <TransitionGroup
            v-if="visibleGridList.length > 0"
            tag="div"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8"
            enter-active-class="transition duration-500 ease-out"
            enter-from-class="opacity-0 translate-y-6"
            enter-to-class="opacity-100 translate-y-0"
            leave-active-class="hidden"
          >
            <div
              v-for="(item, idx) in visibleGridList"
              :key="item.id"
              :style="{ transitionDelay: `${(idx % PAGE_SIZE) * 60}ms` }"
            >
              <article
                :id="`berita-card-${item.id}`"
                @click="openBerita(item)"
                class="group h-full bg-white rounded-3xl overflow-hidden border border-[#3A4A4C]/10 shadow-xs hover:shadow-xl hover:-translate-y-1.5 hover:border-[#5FA8B5]/40 transition-all duration-300 cursor-pointer flex flex-col"
              >
                <div class="h-52 bg-[#1F5C6B]/10 overflow-hidden relative">
                  <img
                    :src="coverUrl(item)"
                    :alt="item.judul"
                    loading="lazy"
                    decoding="async"
                    @error="handleImageFallback($event)"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <span
                    v-if="item.kategori"
                    class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#1F5C6B]/85 backdrop-blur-xs text-white text-xs font-semibold shadow-sm"
                  >
                    {{ item.kategori }}
                  </span>
                </div>

                <div class="p-6 flex-1 flex flex-col">
                  <div class="flex items-center gap-3 text-xs text-[#5E6E6E] font-medium">
                    <span class="inline-flex items-center gap-1.5">
                      <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                      </svg>
                      {{ formatDate(item.tanggal) }}
                    </span>
                    <span class="w-1 h-1 rounded-full bg-[#5E6E6E]/40"></span>
                    <span>{{ readingTime(item) }} mnt baca</span>
                  </div>

                  <h3 class="font-display font-bold text-xl text-[#1F5C6B] leading-snug mt-3 line-clamp-2 group-hover:text-[#5FA8B5] transition-colors">
                    {{ item.judul }}
                  </h3>
                  <p class="text-sm text-[#5E6E6E] leading-relaxed mt-2 line-clamp-3 flex-1">
                    {{ item.ringkasan }}
                  </p>

                  <div class="mt-5 pt-4 border-t border-[#3A4A4C]/10 flex items-center justify-between">
                    <span class="inline-flex items-center gap-2 text-xs text-[#5E6E6E]">
                      <span class="w-7 h-7 rounded-full bg-[#1F5C6B]/10 text-[#1F5C6B] flex items-center justify-center text-[10px] font-bold">
                        {{ initials(item.penulis) }}
                      </span>
                      {{ item.penulis || 'Admin Dusun' }}
                    </span>
                    <span class="text-xs font-bold text-[#1F5C6B] group-hover:text-[#5FA8B5] inline-flex items-center gap-1">
                      Baca
                      <span class="group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </span>
                  </div>
                </div>
              </article>
            </div>
          </TransitionGroup>

          <!-- Empty state hasil filter / pencarian -->
          <div
            v-else-if="isFiltering"
            class="text-center py-16 px-6 bg-white/70 rounded-3xl border border-dashed border-[#3A4A4C]/20"
          >
            <div class="w-14 h-14 rounded-2xl bg-[#5FA8B5]/15 text-[#1F5C6B] flex items-center justify-center mx-auto mb-3">
              <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>
            </div>
            <p class="font-display font-bold text-lg text-[#1F5C6B]">Berita tidak ditemukan</p>
            <p class="text-sm text-[#5E6E6E] mt-1">Coba kata kunci lain atau pilih kategori berbeda.</p>
          </div>

          <!-- Semua berita sudah tampil di bagian utama -->
          <div
            v-else
            class="text-center py-10 text-sm text-[#5E6E6E] bg-white/60 rounded-2xl border border-[#3A4A4C]/10"
          >
            Semua berita sudah ditampilkan di atas.
          </div>

          <!-- Load more -->
          <div v-if="hasMore" class="flex justify-center mt-10">
            <button
              id="btn-muat-lebih-banyak"
              type="button"
              @click="loadMore"
              class="group inline-flex items-center gap-2.5 px-7 py-3.5 rounded-2xl bg-[#1F5C6B] hover:bg-[#174753] text-white text-sm font-bold shadow-lg shadow-[#1F5C6B]/25 hover:shadow-xl transition-all cursor-pointer"
            >
              Muat Lebih Banyak
              <span class="text-xs font-semibold px-2 py-0.5 rounded-full bg-white/15">
                +{{ Math.min(PAGE_SIZE, gridSource.length - visibleCount) }}
              </span>
              <svg class="w-4 h-4 group-hover:translate-y-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7" />
              </svg>
            </button>
          </div>
        </section>
      </template>
    </div>

    <!-- MODAL DETAIL BERITA (JUDUL DI ATAS FOTO, FOTO UTUH, TEKS JUSTIFY & MENJOROK) -->
    <transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0"
      enter-to-class="opacity-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100"
      leave-to-class="opacity-0"
    >
      <div
        v-if="selectedBerita"
        class="fixed inset-0 z-[60] flex items-start sm:items-center justify-center p-0 sm:p-4 md:p-6 lg:p-8 bg-black/80 backdrop-blur-sm overflow-y-auto"
        @click.self="closeBerita"
        role="dialog"
        aria-modal="true"
        :aria-label="selectedBerita.judul"
      >
        <div
          ref="modalPanel"
          class="bg-white sm:rounded-3xl overflow-hidden shadow-2xl max-w-4xl lg:max-w-5xl xl:max-w-6xl w-full min-h-screen sm:min-h-0 sm:my-6 relative flex flex-col sm:max-h-[94vh] modal-pop border border-[#3A4A4C]/15"
        >
          <!-- Tombol Tutup Silang di Kanan Atas -->
          <button
            id="btn-tutup-berita"
            @click="closeBerita"
            class="absolute top-4 right-4 z-30 w-11 h-11 rounded-full bg-[#EEF3F3] hover:bg-[#1F5C6B] text-[#1F5C6B] hover:text-white flex items-center justify-center transition-all focus:outline-hidden cursor-pointer shadow-md border border-[#3A4A4C]/15 hover:scale-105"
            aria-label="Tutup Berita"
            title="Tutup (Esc)"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <div ref="modalScroll" class="overflow-y-auto flex-1">
            <!-- 1. HEADER: KATEGORI, JUDUL, META & KONTROL FONT (DI ATAS FOTO) -->
            <div class="pt-8 sm:pt-10 px-6 sm:px-10 lg:px-14 pr-16 sm:pr-20 space-y-4">
              <!-- Badge Kategori -->
              <div>
                <span
                  v-if="selectedBerita.kategori"
                  class="inline-block px-3.5 py-1 rounded-full bg-[#1F5C6B] text-white text-xs sm:text-sm font-extrabold uppercase tracking-wider shadow-xs"
                >
                  {{ selectedBerita.kategori }}
                </span>
              </div>

              <!-- Judul Berita Utama di Atas Foto -->
              <h2 class="font-display font-extrabold text-2xl sm:text-3xl md:text-4xl lg:text-5xl text-[#1F5C6B] leading-tight tracking-tight">
                {{ selectedBerita.judul }}
              </h2>

              <!-- Meta Informasi & Tombol Pengatur Ukuran Font -->
              <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-4 pb-6 border-b border-[#3A4A4C]/15 text-sm sm:text-base text-[#5E6E6E]">
                <div class="flex flex-wrap items-center gap-x-6 gap-y-2">
                  <span class="inline-flex items-center gap-2.5">
                    <span class="w-9 h-9 rounded-full bg-[#1F5C6B] text-white flex items-center justify-center text-xs font-bold shadow-xs">
                      {{ initials(selectedBerita.penulis) }}
                    </span>
                    <span class="font-bold text-[#1F5C6B]">{{ selectedBerita.penulis || 'Admin Dusun' }}</span>
                  </span>
                  <span class="inline-flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    {{ formatDate(selectedBerita.tanggal, true) }}
                  </span>
                  <span class="inline-flex items-center gap-1.5 font-medium">
                    <svg class="w-4 h-4 text-[#5FA8B5]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    {{ readingTime(selectedBerita) }} menit baca
                  </span>
                </div>

                <!-- Kontrol Ukuran Teks untuk Kemudahan Membaca Warga/Lansia -->
                <div class="flex items-center gap-2 self-start sm:self-auto bg-[#EEF3F3] p-1.5 rounded-xl border border-[#3A4A4C]/10 text-xs font-bold text-[#1F5C6B]">
                  <span class="px-2 text-[#5E6E6E]">Ukuran Font:</span>
                  <button
                    type="button"
                    @click="isLargeFont = false"
                    class="px-3 py-1.5 rounded-lg transition-all cursor-pointer"
                    :class="!isLargeFont ? 'bg-white shadow-xs text-[#1F5C6B]' : 'text-[#5E6E6E] hover:text-[#1F5C6B]'"
                  >
                    Standar
                  </button>
                  <button
                    type="button"
                    @click="isLargeFont = true"
                    class="px-3 py-1.5 rounded-lg transition-all cursor-pointer"
                    :class="isLargeFont ? 'bg-[#1F5C6B] text-white shadow-xs' : 'text-[#5E6E6E] hover:text-[#1F5C6B]'"
                  >
                    Besar (Sangat Jelas)
                  </button>
                </div>
              </div>
            </div>

            <!-- 2. FOTO BERITA (UTUH & JELAS TERLIHAT, TANPA TERTUTUP GELAP) -->
            <div class="mt-6 mb-8 px-6 sm:px-10 lg:px-14">
              <div class="relative w-full rounded-2xl sm:rounded-3xl overflow-hidden shadow-md border border-[#3A4A4C]/10 bg-[#1F5C6B]/5 max-h-[520px] flex items-center justify-center">
                <img
                  :src="coverUrl(selectedBerita)"
                  :alt="selectedBerita.judul"
                  @error="handleImageFallback($event)"
                  class="w-full h-auto max-h-[520px] object-cover sm:object-contain"
                />
              </div>
              <p class="text-xs text-[#5E6E6E] mt-2.5 italic text-center">
                Foto: {{ selectedBerita.judul }}
              </p>
            </div>

            <!-- 3. ISI PARAGRAF (JUSTIFY & MENJOROK KE DALAM) -->
            <div class="px-6 sm:px-10 lg:px-14 pb-10 space-y-8">
              <div class="space-y-6 sm:space-y-7">
                <p
                  v-for="(para, pIdx) in paragraphs(selectedBerita.isi)"
                  :key="pIdx"
                  class="text-[#2C3E42] text-justify indent-8 sm:indent-12 leading-relaxed sm:leading-loose transition-all duration-200"
                  :class="[
                    isLargeFont ? 'text-lg sm:text-xl md:text-2xl' : 'text-base sm:text-lg md:text-xl'
                  ]"
                >
                  {{ para }}
                </p>
              </div>

              <!-- Share Bar & Tombol Selesai Membaca -->
              <div class="pt-8 border-t border-[#3A4A4C]/15 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                <div class="flex flex-wrap items-center gap-3">
                  <span class="text-xs font-bold uppercase tracking-wider text-[#5E6E6E] mr-2">Bagikan kabar:</span>
                  <a
                    id="btn-share-whatsapp"
                    :href="whatsappShareUrl(selectedBerita)"
                    target="_blank"
                    rel="noopener noreferrer"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-bold shadow-md transition-all hover:scale-105"
                  >
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                      <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.143 4.174 4.286-1.123z"/>
                    </svg>
                    WhatsApp
                  </a>
                  <button
                    id="btn-salin-link"
                    type="button"
                    @click="copyLink(selectedBerita)"
                    class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold transition-all cursor-pointer"
                    :class="copied ? 'bg-[#5FA8B5] text-white shadow-md' : 'bg-[#EEF3F3] text-[#1F5C6B] hover:bg-[#1F5C6B] hover:text-white'"
                  >
                    <svg v-if="!copied" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                    </svg>
                    <svg v-else class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7" />
                    </svg>
                    {{ copied ? 'Link Tersalin!' : 'Salin Link' }}
                  </button>
                </div>

                <!-- Tombol Selesai Membaca di Bawah -->
                <button
                  type="button"
                  @click="closeBerita"
                  class="inline-flex items-center justify-center gap-2 px-6 py-2.5 rounded-xl border border-[#3A4A4C]/25 hover:bg-[#1F5C6B] hover:text-white text-[#1F5C6B] text-sm font-bold transition-colors cursor-pointer"
                >
                  Selesai Membaca &times;
                </button>
              </div>

              <!-- Baca Berita Lainnya -->
              <div v-if="relatedList.length > 0" class="pt-8 border-t border-[#3A4A4C]/15 space-y-4">
                <h3 class="font-display font-bold text-xl text-[#1F5C6B]">Berita Terkait Lainnya</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                  <button
                    v-for="rel in relatedList"
                    :key="rel.id"
                    type="button"
                    @click="openBerita(rel)"
                    class="group text-left flex gap-4 p-4 rounded-2xl bg-[#EEF3F3]/60 hover:bg-[#EEF3F3] border border-transparent hover:border-[#5FA8B5]/40 transition-all cursor-pointer"
                  >
                    <div class="w-24 h-20 rounded-xl overflow-hidden shrink-0 bg-[#1F5C6B]/10">
                      <img
                        :src="coverUrl(rel)"
                        :alt="rel.judul"
                        loading="lazy"
                        @error="handleImageFallback($event)"
                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                      />
                    </div>
                    <div class="min-w-0 flex flex-col justify-center">
                      <p class="text-sm font-bold text-[#1F5C6B] leading-snug line-clamp-2 group-hover:text-[#5FA8B5] transition-colors">
                        {{ rel.judul }}
                      </p>
                      <p class="text-xs text-[#5E6E6E] mt-1">{{ formatDate(rel.tanggal) }}</p>
                    </div>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </PublicLayout>
</template>

<script setup>
import { ref, computed, watch, nextTick, onMounted, onUnmounted } from 'vue';
import { Head, Link } from '@inertiajs/vue3';
import PublicLayout from '../../Layouts/PublicLayout.vue';
import { getImageUrl, handleImageFallback } from '../../Utils/image';
import { initScrollReveal } from '../../Utils/useScrollReveal';

const props = defineProps({
  beritaList: {
    type: Array,
    default: () => [],
  },
});

const PAGE_SIZE = 6;
const ALL = 'Semua';
const FALLBACK_COVER = '/images/hero-tunggularum3.jpeg';

const allBerita = computed(() => props.beritaList || []);

// ---------- Filter & Pencarian ----------
const activeKategori = ref(ALL);
const searchQuery = ref('');
const visibleCount = ref(PAGE_SIZE);

const kategoriList = computed(() => {
  const counts = {};
  allBerita.value.forEach((b) => {
    const k = b.kategori || 'Umum';
    counts[k] = (counts[k] || 0) + 1;
  });
  return [
    { name: ALL, count: allBerita.value.length },
    ...Object.keys(counts)
      .sort((a, b) => counts[b] - counts[a] || a.localeCompare(b))
      .map((name) => ({ name, count: counts[name] })),
  ];
});

const isFiltering = computed(() => activeKategori.value !== ALL || searchQuery.value.trim() !== '');

const filteredList = computed(() => {
  const q = searchQuery.value.trim().toLowerCase();
  return allBerita.value.filter((b) => {
    const matchKategori = activeKategori.value === ALL || (b.kategori || 'Umum') === activeKategori.value;
    if (!matchKategori) return false;
    if (!q) return true;
    return (
      (b.judul || '').toLowerCase().includes(q) ||
      (b.ringkasan || '').toLowerCase().includes(q) ||
      (b.isi || '').toLowerCase().includes(q)
    );
  });
});

// ---------- Featured (tanpa filter) ----------
const showFeatured = computed(() => !isFiltering.value);
const featured = computed(() => allBerita.value[0] || null);
const sideList = computed(() => allBerita.value.slice(1, 4));

// Grid: saat tanpa filter, lewati 4 berita yang sudah tampil di bagian featured
const gridSource = computed(() => (isFiltering.value ? filteredList.value : allBerita.value.slice(4)));
const visibleGridList = computed(() => gridSource.value.slice(0, visibleCount.value));
const hasMore = computed(() => gridSource.value.length > visibleCount.value);

const gridTitle = computed(() => {
  if (searchQuery.value.trim()) return 'Hasil Pencarian';
  if (activeKategori.value !== ALL) return `Kategori: ${activeKategori.value}`;
  return 'Berita Lainnya';
});

const latestDate = computed(() => allBerita.value[0]?.tanggal || null);

function setKategori(name) {
  activeKategori.value = name;
}

function resetFilter() {
  activeKategori.value = ALL;
  searchQuery.value = '';
}

function loadMore() {
  visibleCount.value += PAGE_SIZE;
}

watch([activeKategori, searchQuery], () => {
  visibleCount.value = PAGE_SIZE;
  initScrollReveal();
});

// ---------- Helpers ----------
function coverUrl(item) {
  return item?.gambar ? getImageUrl(item.gambar) : FALLBACK_COVER;
}

function formatDate(dateStr, withWeekday = false) {
  if (!dateStr) return '';
  const [y, m, d] = String(dateStr).substring(0, 10).split('-').map(Number);
  const date = new Date(y, (m || 1) - 1, d || 1);
  return date.toLocaleDateString('id-ID', {
    ...(withWeekday ? { weekday: 'long' } : {}),
    year: 'numeric',
    month: 'long',
    day: 'numeric',
  });
}

function readingTime(item) {
  const words = (item?.isi || '').trim().split(/\s+/).filter(Boolean).length;
  return Math.max(1, Math.round(words / 200));
}

function paragraphs(text) {
  return (text || '')
    .split(/\r?\n\s*\r?\n|\r?\n/)
    .map((p) => p.trim())
    .filter(Boolean);
}

function initials(name) {
  const n = (name || 'Admin Dusun').trim().split(/\s+/);
  return ((n[0]?.[0] || '') + (n[1]?.[0] || '')).toUpperCase() || 'AD';
}

function slugify(text) {
  return String(text).toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
}

// ---------- Modal Detail ----------
const selectedBerita = ref(null);
const modalScroll = ref(null);
const isLargeFont = ref(false);
const copied = ref(false);
let copiedTimer = null;

const relatedList = computed(() => {
  if (!selectedBerita.value) return [];
  const current = selectedBerita.value;
  const others = allBerita.value.filter((b) => b.id !== current.id);
  const sameKategori = others.filter((b) => b.kategori && b.kategori === current.kategori);
  const rest = others.filter((b) => !sameKategori.includes(b));
  return [...sameKategori, ...rest].slice(0, 2);
});

function shareUrl(item) {
  return `${window.location.origin}/berita?baca=${encodeURIComponent(item.slug)}`;
}

function whatsappShareUrl(item) {
  return `https://wa.me/?text=${encodeURIComponent(`${item.judul}\n\nBaca selengkapnya: ${shareUrl(item)}`)}`;
}

function setUrlParam(slug) {
  const url = new URL(window.location.href);
  if (slug) url.searchParams.set('baca', slug);
  else url.searchParams.delete('baca');
  window.history.replaceState(window.history.state, '', url.pathname + url.search + url.hash);
}

function openBerita(item) {
  selectedBerita.value = item;
  copied.value = false;
  document.body.style.overflow = 'hidden';
  if (item.slug) setUrlParam(item.slug);
  nextTick(() => {
    if (modalScroll.value) modalScroll.value.scrollTop = 0;
  });
}

function closeBerita() {
  selectedBerita.value = null;
  document.body.style.overflow = '';
  setUrlParam(null);
}

async function copyLink(item) {
  const link = shareUrl(item);
  try {
    if (navigator.clipboard && window.isSecureContext) {
      await navigator.clipboard.writeText(link);
    } else {
      const ta = document.createElement('textarea');
      ta.value = link;
      ta.style.position = 'fixed';
      ta.style.opacity = '0';
      document.body.appendChild(ta);
      ta.select();
      document.execCommand('copy');
      document.body.removeChild(ta);
    }
    copied.value = true;
    clearTimeout(copiedTimer);
    copiedTimer = setTimeout(() => (copied.value = false), 2200);
  } catch (e) {
    window.prompt('Salin link berikut:', link);
  }
}

function handleKeydown(e) {
  if (e.key === 'Escape' && selectedBerita.value) closeBerita();
}

onMounted(() => {
  window.addEventListener('keydown', handleKeydown);
  initScrollReveal();

  // Buka otomatis jika URL berisi ?baca=slug (dari link yang dibagikan)
  const slug = new URLSearchParams(window.location.search).get('baca');
  if (slug) {
    const found = allBerita.value.find((b) => b.slug === slug);
    if (found) openBerita(found);
    else setUrlParam(null);
  }
});

onUnmounted(() => {
  window.removeEventListener('keydown', handleKeydown);
  document.body.style.overflow = '';
  clearTimeout(copiedTimer);
});
</script>

<style scoped>
.scrollbar-none {
  scrollbar-width: none;
}
.scrollbar-none::-webkit-scrollbar {
  display: none;
}

.modal-pop {
  animation: modal-pop 0.35s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes modal-pop {
  from {
    opacity: 0;
    transform: translateY(16px) scale(0.97);
  }
  to {
    opacity: 1;
    transform: translateY(0) scale(1);
  }
}
</style>
