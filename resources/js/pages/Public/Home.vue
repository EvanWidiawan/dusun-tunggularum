<template>
  <PublicLayout>
    <!-- SECTION 1: BERANDA (HERO DENGAN BACKGROUND FOTO & OVERLAY KONTRAS TINGGI) -->
    <section
      id="beranda"
      class="relative min-h-[90vh] flex items-center justify-center bg-cover bg-center bg-no-repeat overflow-hidden"
      style="background-image: url('/images/hero-tunggularum.png');"
    >
      <!-- Dark Gradient Overlay for Maximum Text Contrast -->
      <div class="absolute inset-0 bg-gradient-to-b from-black/75 via-[#1F5C6B]/70 to-[#1F5C6B] z-0"></div>

      <!-- Hero Content -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 relative z-10 text-center">
        <div class="max-w-3xl mx-auto space-y-6">
          
          <!-- Badge -->
          <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/15 backdrop-blur-md border border-white/30 text-white text-xs font-semibold uppercase tracking-wider shadow-lg">
            Dusun Tunggularum, Turi, Sleman
          </div>

          <!-- Main Heading (White Text with High Contrast) -->
          <h1 class="font-display font-extrabold text-4xl sm:text-5xl lg:text-6xl text-white leading-tight tracking-tight drop-shadow-lg">
            Selamat Datang di <br />
            <span class="text-[#5FA8B5] drop-shadow-md">Dusun Tunggularum</span>
          </h1>

          <!-- Tagline & Description -->
          <p class="text-lg sm:text-xl text-white/95 leading-relaxed font-body font-normal drop-shadow-md">
            Keindahan Mata Air Pegunungan & Kemajuan Masyarakat Lereng Merapi. Pusat pelayanan informasi digital resmi dusun bagi warga dan publik.
          </p>
        </div>
      </div>
    </section>

    <!-- Strip Statistik Dusun -->
    <div class="bg-[#1F5C6B] text-[#EEF3F3] py-10 border-y border-[#5FA8B5]/30">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 text-center divide-y md:divide-y-0 md:divide-x divide-[#EEF3F3]/15">
          <div class="pt-4 md:pt-0">
            <p class="font-display font-bold text-4xl text-[#5FA8B5]">1.450+</p>
            <p class="text-sm text-[#EEF3F3]/80 mt-1 font-medium">Jumlah Warga Dusun</p>
          </div>
          <div class="pt-4 md:pt-0">
            <p class="font-display font-bold text-4xl text-[#5FA8B5]">350 Ha</p>
            <p class="text-sm text-[#EEF3F3]/80 mt-1 font-medium">Luas Wilayah Dusun</p>
          </div>
          <div class="pt-4 md:pt-0">
            <p class="font-display font-bold text-4xl text-[#5FA8B5]">4 RT</p>
            <p class="text-sm text-[#EEF3F3]/80 mt-1 font-medium">Rukun Tetangga Aktif</p>
          </div>
        </div>
      </div>
    </div>

    <!-- SECTION 2: PROFIL & SEJARAH DUSUN -->
    <section id="profil" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-b border-[#3A4A4C]/15">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h2 class="font-display font-bold text-4xl text-[#1F5C6B]">Profil & Sejarah Dusun Tunggularum</h2>
        <p class="text-[#5E6E6E] text-lg">Sejarah panjang, keasrian alam, serta visi & misi pembangunan dusun.</p>
      </div>

      <div class="bg-white/80 rounded-2xl p-8 border border-[#3A4A4C]/15 shadow-xs space-y-8 max-w-4xl mx-auto">
        <div>
          <h3 class="font-display font-bold text-2xl text-[#1F5C6B] mb-3">Sejarah Dusun</h3>
          <p class="text-[#5E6E6E] leading-relaxed">
            Dusun Tunggularum terletak di Kalurahan Wonokerto, Kapanewon Turi, Kabupaten Sleman, D.I. Yogyakarta. Berada tepat di kaki Gunung Merapi, dusun ini dikaruniai keasrian alam, tanah yang subur untuk perkebunan Salak Pondoh dan Kopi, serta sumber mata air alami yang melimpah. Warga Dusun Tunggularum hidup dalam semangat gotong royong dan kelestarian lingkungan Budaya Jawa.
          </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-[#3A4A4C]/15">
          <div class="bg-[#EEF3F3]/80 p-6 rounded-xl border border-[#3A4A4C]/10">
            <h4 class="font-display font-bold text-xl text-[#1F5C6B] mb-2">Visi Dusun</h4>
            <p class="text-sm text-[#5E6E6E] leading-relaxed">
              Terwujudnya Dusun Tunggularum yang Mandiri, Sejahtera, Berdaya Saing, Berbasis Agrowisata dan Pelestarian Sumber Daya Alam Pegunungan.
            </p>
          </div>

          <div class="bg-[#EEF3F3]/80 p-6 rounded-xl border border-[#3A4A4C]/10">
            <h4 class="font-display font-bold text-xl text-[#1F5C6B] mb-2">Misi Dusun</h4>
            <ul class="text-sm text-[#5E6E6E] space-y-2 list-disc list-inside">
              <li>Meningkatkan tata kelola kemasyarakatan yang transparan.</li>
              <li>Pengembangan potensi UMKM Salak, Kopi, dan Agrowisata.</li>
              <li>Pemberdayaan kepemudaan melalui Karang Taruna.</li>
            </ul>
          </div>
        </div>
      </div>
    </section>

    <!-- SECTION 3: UMKM DESA (CAROUSEL RESPONSIVE HP, TABLET, DESKTOP + SWIPE MOBILE) -->
    <section id="umkm" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-b border-[#3A4A4C]/15">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h2 class="font-display font-bold text-3xl sm:text-4xl text-[#1F5C6B]">UMKM Dusun Tunggularum</h2>
        <p class="text-[#5E6E6E] text-base sm:text-lg">Produk olahan pangan lokal, hasil tani unggulan, dan usaha kreatif warga. Klik kartu untuk detail & katalog lengkap.</p>
      </div>

      <!-- Carousel Outer Container -->
      <div
        class="relative px-2 sm:px-12"
        @mouseenter="pauseAutoSlide"
        @mouseleave="startAutoSlide"
        @touchstart="handleTouchStart"
        @touchend="handleTouchEnd"
      >
        <!-- Navigation Arrow Buttons (Visible Desktop & Tablet) -->
        <button
          @click="prevSlide"
          class="hidden sm:flex absolute left-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-white shadow-lg text-[#1F5C6B] hover:bg-[#1F5C6B] hover:text-white items-center justify-center transition-all focus:outline-hidden"
          aria-label="Previous Slide"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
          </svg>
        </button>

        <button
          @click="nextSlide"
          class="hidden sm:flex absolute right-0 top-1/2 -translate-y-1/2 z-20 w-10 h-10 lg:w-12 lg:h-12 rounded-full bg-white shadow-lg text-[#1F5C6B] hover:bg-[#1F5C6B] hover:text-white items-center justify-center transition-all focus:outline-hidden"
          aria-label="Next Slide"
        >
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
          </svg>
        </button>

        <!-- Carousel Track Overflow Window -->
        <div class="overflow-hidden py-4">
          <div
            class="flex transition-transform duration-500 ease-out"
            :style="{ transform: `translateX(-${slideTranslatePercentage}%)` }"
          >
            <!-- UMKM Item Cards (Responsive Width: 100% Mobile HP, 50% Tablet, 33.333% Desktop) -->
            <div
              v-for="item in activeUmkmList"
              :key="item.id"
              class="w-full sm:w-1/2 lg:w-1/3 shrink-0 px-2 sm:px-3"
            >
              <div
                @click="openUmkmDetail(item)"
                class="bg-white rounded-2xl overflow-hidden border border-[#3A4A4C]/15 shadow-xs hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer group flex flex-col h-full"
              >
                <!-- Card Preview Image -->
                <div class="h-48 sm:h-52 bg-[#1F5C6B]/10 overflow-hidden relative">
                  <img
                    :src="item.gambar || '/images/hero-tunggularum.png'"
                    :alt="item.nama"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                  />
                  <span class="absolute top-3 left-3 px-3 py-1 rounded-full bg-[#1F5C6B]/85 backdrop-blur-xs text-white text-xs font-semibold shadow-sm">
                    {{ item.kategori }}
                  </span>
                  <div class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                    <span class="px-4 py-2 rounded-xl bg-white/90 text-[#1F5C6B] text-xs font-bold shadow-md">
                      Lihat Detail & Katalog &rarr;
                    </span>
                  </div>
                </div>

                <!-- Card Content -->
                <div class="p-5 sm:p-6 flex-1 flex flex-col justify-between space-y-4">
                  <div>
                    <h3 class="font-display font-bold text-lg sm:text-xl text-[#1F5C6B] group-hover:text-[#5FA8B5] transition-colors leading-snug">
                      {{ item.nama }}
                    </h3>
                    <p class="text-sm text-[#5E6E6E] mt-2 line-clamp-2 leading-relaxed">
                      {{ item.deskripsi }}
                    </p>
                  </div>

                  <div class="pt-3 border-t border-[#3A4A4C]/10 flex items-center justify-between text-xs text-[#5E6E6E]">
                    <div class="flex items-center gap-1.5 truncate">
                      <svg class="w-4 h-4 text-[#5FA8B5] shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      <span class="font-medium text-[#1F5C6B] truncate">{{ item.pemilik }}</span>
                    </div>
                    <span class="text-xs px-2.5 py-0.5 rounded-md bg-[#EEF3F3] text-[#3A4A4C] shrink-0">
                      {{ item.lokasi }}
                    </span>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Mobile Navigation Controls (Buttons & Dots below slider on Mobile HP) -->
        <div class="flex items-center justify-between sm:justify-center gap-3 mt-4 sm:mt-6 px-2">
          <!-- Mobile Prev Button -->
          <button
            @click="prevSlide"
            class="sm:hidden p-2 rounded-xl bg-white border border-[#3A4A4C]/15 shadow-xs text-[#1F5C6B] active:bg-[#1F5C6B] active:text-white transition-colors"
            aria-label="Previous Slide Mobile"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
            </svg>
          </button>

          <!-- Dots Indicator -->
          <div class="flex items-center gap-2">
            <button
              v-for="index in maxSlideSteps"
              :key="index"
              @click="slideIndex = index - 1"
              class="h-2.5 rounded-full transition-all duration-300 focus:outline-hidden"
              :class="[
                slideIndex === index - 1
                  ? 'w-7 sm:w-8 bg-[#1F5C6B]'
                  : 'w-2.5 bg-[#1F5C6B]/25 hover:bg-[#1F5C6B]/50'
              ]"
              :aria-label="`Go to slide ${index}`"
            ></button>
          </div>

          <!-- Mobile Next Button -->
          <button
            @click="nextSlide"
            class="sm:hidden p-2 rounded-xl bg-white border border-[#3A4A4C]/15 shadow-xs text-[#1F5C6B] active:bg-[#1F5C6B] active:text-white transition-colors"
            aria-label="Next Slide Mobile"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7" />
            </svg>
          </button>
        </div>
      </div>
    </section>

    <!-- SECTION 4: AGENDA & KEGIATAN -->
    <section id="agenda" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-b border-[#3A4A4C]/15">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h2 class="font-display font-bold text-4xl text-[#1F5C6B]">Agenda & Kegiatan Dusun</h2>
        <p class="text-[#5E6E6E] text-lg">Informasi agenda kegiatan kemasyarakatan dan gotong royong warga.</p>
      </div>

      <div class="max-w-4xl mx-auto space-y-6">
        <div class="bg-white/80 rounded-2xl p-6 border border-[#3A4A4C]/15 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
          <div>
            <span class="text-xs font-semibold text-[#5FA8B5] uppercase tracking-wider">01 September 2026</span>
            <h3 class="font-display font-bold text-xl text-[#1F5C6B] mt-1">Kerja Bakti Masal & Pembersihan Irigasi Kebun</h3>
            <p class="text-sm text-[#5E6E6E] mt-1">Lokasi: Seluruh Wilayah RT Dusun Tunggularum</p>
          </div>
          <span class="px-4 py-2 rounded-xl bg-[#1F5C6B] text-white text-xs font-medium shrink-0">Mendatang</span>
        </div>

        <div class="bg-white/80 rounded-2xl p-6 border border-[#3A4A4C]/15 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
          <div>
            <span class="text-xs font-semibold text-[#5FA8B5] uppercase tracking-wider">10 September 2026</span>
            <h3 class="font-display font-bold text-xl text-[#1F5C6B] mt-1">Pelatihan Digital Marketing & Pengemasan UMKM</h3>
            <p class="text-sm text-[#5E6E6E] mt-1">Lokasi: Posko KKN / Rumah Warga RT 02</p>
          </div>
          <span class="px-4 py-2 rounded-xl bg-[#1F5C6B] text-white text-xs font-medium shrink-0">Mendatang</span>
        </div>
      </div>
    </section>

    <!-- SECTION 5: GALERI FOTO DUSUN -->
    <section id="galeri" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-b border-[#3A4A4C]/15">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h2 class="font-display font-bold text-4xl text-[#1F5C6B]">Galeri Foto Dusun</h2>
        <p class="text-[#5E6E6E] text-lg">Koleksi foto kegiatan warga, infrastruktur, dan suasana asri Tunggularum.</p>
      </div>

      <div v-if="galeri && galeri.length > 0" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="item in galeri"
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

    <!-- SECTION 6: KARANG TARUNA -->
    <section id="karang-taruna" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 border-b border-[#3A4A4C]/15">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h2 class="font-display font-bold text-4xl text-[#1F5C6B]">Karang Taruna Dusun Tunggularum</h2>
        <p class="text-[#5E6E6E] text-lg">Struktur kepengurusan dan penggerak generasi muda Dusun Tunggularum.</p>
      </div>

      <div v-if="karangTaruna && karangTaruna.length > 0" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div
          v-for="member in karangTaruna"
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
            {{ member.deskripsi || 'Pengurus aktif Karang Taruna Dusun Tunggularum.' }}
          </p>
        </div>
      </div>

      <div v-else class="text-center py-12 bg-white/60 rounded-2xl border border-[#3A4A4C]/15 max-w-md mx-auto">
        <p class="text-[#5E6E6E]">Belum ada data pengurus Karang Taruna.</p>
      </div>
    </section>

    <!-- SECTION 7: KONTAK & LOKASI -->
    <section id="kontak" class="py-20 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h2 class="font-display font-bold text-4xl text-[#1F5C6B]">Kontak & Peta Dusun</h2>
        <p class="text-[#5E6E6E] text-lg">Hubungi pengurus dusun atau kunjungi lokasi Dusun Tunggularum.</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <div class="bg-white/80 rounded-2xl p-8 border border-[#3A4A4C]/15 shadow-xs space-y-6">
          <h3 class="font-display font-bold text-2xl text-[#1F5C6B]">Informasi Pelayanan Dusun</h3>
          <div class="space-y-4 text-sm text-[#5E6E6E]">
            <div>
              <p class="font-semibold text-[#1F5C6B]">Alamat Dusun:</p>
              <p>Dusun Tunggularum, Kalurahan Wonokerto, Kapanewon Turi, Kabupaten Sleman, D.I. Yogyakarta</p>
            </div>
            <div>
              <p class="font-semibold text-[#1F5C6B]">Telepon / WhatsApp Dukuh / Pengurus:</p>
              <p>+62 812-3456-7890</p>
            </div>
            <div>
              <p class="font-semibold text-[#1F5C6B]">Email Resmi Dusun:</p>
              <p>info@tunggularum.id</p>
            </div>
          </div>
        </div>

        <div class="bg-white/80 rounded-2xl p-4 border border-[#3A4A4C]/15 shadow-xs overflow-hidden h-80 lg:h-auto">
          <!-- Embed Google Maps -->
          <iframe
            title="Peta Lokasi Dusun Tunggularum Turi Sleman"
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d126564.21856715694!2d110.36015525000001!3d-7.540192500000001!2m3!1f0!2f0!3f0!2m3!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a5e305e55e5b3%3A0x4027a76e352e850!2sGunung%20Merapi!5e0!3m2!1sid!2sid!4v1650000000000!5m2!1sid!2sid"
            width="100%"
            height="100%"
            style="border:0; border-radius: 12px;"
            allowfullscreen=""
            loading="lazy"
          ></iframe>
        </div>
      </div>
    </section>

    <!-- MODAL DIALOG DETAIL UMKM -->
    <transition
      enter-active-class="transition duration-300 ease-out"
      enter-from-class="opacity-0 scale-95"
      enter-to-class="opacity-100 scale-100"
      leave-active-class="transition duration-200 ease-in"
      leave-from-class="opacity-100 scale-100"
      leave-to-class="opacity-0 scale-95"
    >
      <div
        v-if="isModalOpen && selectedUmkm"
        class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/70 backdrop-blur-xs overflow-y-auto"
        @click.self="closeUmkmDetail"
      >
        <div class="bg-white rounded-3xl overflow-hidden shadow-2xl max-w-2xl w-full my-8 relative flex flex-col max-h-[90vh]">
          <!-- Close Button -->
          <button
            @click="closeUmkmDetail"
            class="absolute top-4 right-4 z-20 w-10 h-10 rounded-full bg-black/50 hover:bg-black text-white flex items-center justify-center transition-colors focus:outline-hidden"
            aria-label="Close Modal"
          >
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>

          <!-- Banner Catalog Image -->
          <div class="h-56 sm:h-72 bg-[#1F5C6B]/10 overflow-hidden relative shrink-0">
            <img
              :src="selectedUmkm.gambar || '/images/hero-tunggularum.png'"
              :alt="selectedUmkm.nama"
              class="w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
            <div class="absolute bottom-4 left-6 right-6 text-white">
              <span class="px-3 py-1 rounded-full bg-[#5FA8B5] text-[#1F5C6B] text-xs font-bold uppercase">
                {{ selectedUmkm.kategori }}
              </span>
              <h3 class="font-display font-bold text-2xl sm:text-3xl mt-2 drop-shadow-md">
                {{ selectedUmkm.nama }}
              </h3>
            </div>
          </div>

          <!-- Modal Body Content -->
          <div class="p-6 sm:p-8 space-y-6 overflow-y-auto flex-1 text-[#5E6E6E]">
            <!-- Owner & Location Metadata Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div class="p-4 rounded-2xl bg-[#EEF3F3] border border-[#3A4A4C]/10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#1F5C6B]/10 text-[#1F5C6B] flex items-center justify-center shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-[#5E6E6E] font-medium">Pemilik Usaha</p>
                  <p class="font-semibold text-[#1F5C6B] text-sm">{{ selectedUmkm.pemilik }}</p>
                </div>
              </div>

              <div class="p-4 rounded-2xl bg-[#EEF3F3] border border-[#3A4A4C]/10 flex items-center gap-3">
                <div class="w-10 h-10 rounded-xl bg-[#1F5C6B]/10 text-[#1F5C6B] flex items-center justify-center shrink-0">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  </svg>
                </div>
                <div>
                  <p class="text-xs text-[#5E6E6E] font-medium">Lokasi Wilayah</p>
                  <p class="font-semibold text-[#1F5C6B] text-sm">{{ selectedUmkm.lokasi }}</p>
                </div>
              </div>
            </div>

            <!-- Description -->
            <div>
              <h4 class="font-display font-bold text-lg text-[#1F5C6B] mb-2">Deskripsi Usaha & Produk</h4>
              <p class="text-sm leading-relaxed text-[#5E6E6E]">
                {{ selectedUmkm.deskripsi }}
              </p>
            </div>

            <!-- Action Buttons: WhatsApp & Google Drive Link -->
            <div class="pt-4 border-t border-[#3A4A4C]/15 flex flex-col sm:flex-row gap-3">
              <!-- WhatsApp Direct Chat Button -->
              <a
                v-if="selectedUmkm.waLink"
                :href="selectedUmkm.waLink"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-1 flex items-center justify-center gap-2.5 px-5 py-3.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-bold text-sm shadow-md transition-all"
              >
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-1.143 4.174 4.286-1.123z"/>
                </svg>
                Hubungi via WhatsApp
              </a>

              <!-- Google Drive Catalog Link Button -->
              <a
                v-if="selectedUmkm.driveLink"
                :href="selectedUmkm.driveLink"
                target="_blank"
                rel="noopener noreferrer"
                class="flex-1 flex items-center justify-center gap-2.5 px-5 py-3.5 rounded-xl bg-sky-600 hover:bg-sky-700 text-white font-bold text-sm shadow-md transition-all"
              >
                <!-- Google Drive Icon -->
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                  <path d="M12.01 1.485c-6.19 0-11.205 5.015-11.205 11.205 0 6.19 5.015 11.205 11.205 11.205 6.19 0 11.205-5.015 11.205-11.205 0-6.19-5.015-11.205-11.205-11.205zm-1.892 5.867h3.784l4.908 8.5h-3.784l-4.908-8.5zm-5.011 8.5l2.454-4.25 4.908 8.5h-4.908l-2.454-4.25zm7.365 4.25l2.454-4.25h9.816l-2.454 4.25h-9.816z"/>
                </svg>
                Katalog di Google Drive
              </a>
            </div>
          </div>
        </div>
      </div>
    </transition>
  </PublicLayout>
</template>

<script setup>
import { ref, computed, onMounted, onUnmounted } from 'vue';
import PublicLayout from '../../Layouts/PublicLayout.vue';

const props = defineProps({
  karangTaruna: Array,
  galeri: Array,
  umkmList: Array,
});

// Default fallback list if prop is empty
const defaultUmkm = [
  {
    id: 1,
    nama: "Salak Pondoh Organik Tunggularum",
    kategori: "Pertanian & Buah",
    pemilik: "Pak Sugeng (Kelompok Tani Manunggal)",
    kontak: "+62 812-3456-7891",
    waLink: "https://wa.me/6281234567891?text=Halo%20Pak%20Sugeng,%20saya%20tertarik%20dengan%20produk%20Salak%20Pondoh%20Tunggularum",
    lokasi: "RT 01 / Dusun Tunggularum",
    deskripsi: "Salak Pondoh super hasil panen perkebunan warga Dusun Tunggularum di kaki Gunung Merapi. Manis, renyah, dan ditanam secara organik tanpa pestisida kimia.",
    gambar: "/images/umkm/salak-pondoh.jpg",
    driveLink: "https://drive.google.com/drive/folders/1SampleSalakFolderDriveTunggularum"
  },
  {
    id: 2,
    nama: "Kopi Merapi Arabika Tunggularum",
    kategori: "Minuman & Olahan Kopi",
    pemilik: "Ibu Rahma",
    kontak: "+62 812-3456-7892",
    waLink: "https://wa.me/6281234567892?text=Halo%20Ibu%20Rahma,%20saya%20tertarik%20pesan%20Kopi%20Merapi%20Arabika",
    lokasi: "RT 02 / Dusun Tunggularum",
    deskripsi: "Kopi racikan arabika lereng Gunung Merapi dipetik langsung dari kebun ketinggian 700 mdpl. Diproses dengan pemanggangan medium-dark untuk menciptakan rasa khas pegunungan.",
    gambar: "/images/umkm/kopi-merapi.jpg",
    driveLink: "https://drive.google.com/drive/folders/1SampleKopiFolderDriveTunggularum"
  },
  {
    id: 3,
    nama: "Kerajinan Anyaman Bambu Tradisional",
    kategori: "Kerajinan Tangan & Souvenir",
    pemilik: "Pak Maryono",
    kontak: "+62 812-3456-7893",
    waLink: "https://wa.me/6281234567893?text=Halo%20Pak%20Maryono,%20saya%20ingin%20tanya%20kerajinan%20anyaman%20bambu",
    lokasi: "RT 03 / Dusun Tunggularum",
    deskripsi: "Kerajinan tangan dari bambu lokal kualitas pilihan. Menerima pesanan besek hantaran, tampah, tudung saji, wadah souvenir, dan dekorasi rumah bernuansa etnik.",
    gambar: "/images/umkm/kerajinan-bambu.jpg",
    driveLink: "https://drive.google.com/drive/folders/1SampleBambuFolderDriveTunggularum"
  },
  {
    id: 4,
    nama: "Keripik & Dodol Salak Olahan KWT",
    kategori: "Olahan Pangan & Oleh-Oleh",
    pemilik: "Ibu Hastuti (Kelompok Wanita Tani)",
    kontak: "+62 812-3456-7894",
    waLink: "https://wa.me/6281234567894?text=Halo%20Ibu%20Hastuti,%20saya%20ingin%20pesan%20oleh-oleh%20Keripik%20Salak",
    lokasi: "RT 02 / Dusun Tunggularum",
    deskripsi: "Produk olahan buah salak buatan Kelompok Wanita Tani (KWT) Tunggularum. Diolah menggunakan teknologi penggorengan vakum (vacuum frying) tanpa bahan pengawet sintetis.",
    gambar: "/images/umkm/salak-pondoh.jpg",
    driveLink: "https://drive.google.com/drive/folders/1SampleKeripikFolderDriveTunggularum"
  },
  {
    id: 5,
    nama: "Agrowisata & Tour Kebun Salak",
    kategori: "Jasa & Eduwisata Alam",
    pemilik: "Pokdarwis Tunggularum (Pak Joko)",
    kontak: "+62 812-3456-7895",
    waLink: "https://wa.me/6281234567895?text=Halo%20Pokdarwis,%20saya%20ingin%20reservasi%20paket%20Tour%20Kebun%20Salak",
    lokasi: "RT 04 / Dusun Tunggularum",
    deskripsi: "Paket wisata edukasi petik buah salak langsung di kebun, jalan santai menyusuri mata air lereng Merapi, dan mencicipi hidangan kuliner tradisional dusun.",
    gambar: "/images/umkm/kopi-merapi.jpg",
    driveLink: "https://drive.google.com/drive/folders/1SampleWisataFolderDriveTunggularum"
  }
];

const activeUmkmList = computed(() => {
  return (props.umkmList && props.umkmList.length > 0) ? props.umkmList : defaultUmkm;
});

// Responsive Window Width Tracker
const windowWidth = ref(typeof window !== 'undefined' ? window.innerWidth : 1024);

function handleResize() {
  windowWidth.value = window.innerWidth;
}

// Compute number of cards visible based on device screen size
const cardsPerView = computed(() => {
  if (windowWidth.value < 640) return 1;   // Mobile HP: 1 card visible
  if (windowWidth.value < 1024) return 2;  // Tablet: 2 cards visible
  return 3;                                // Desktop: 3 cards visible
});

// Carousel Slider State
const slideIndex = ref(0);
const autoSlideTimer = ref(null);

const maxSlideSteps = computed(() => {
  const total = activeUmkmList.value.length;
  return Math.max(1, total - cardsPerView.value + 1);
});

const slideTranslatePercentage = computed(() => {
  // Translate percentage according to current slide index and cardsPerView ratio
  return slideIndex.value * (100 / cardsPerView.value);
});

function nextSlide() {
  if (slideIndex.value < maxSlideSteps.value - 1) {
    slideIndex.value++;
  } else {
    slideIndex.value = 0;
  }
}

function prevSlide() {
  if (slideIndex.value > 0) {
    slideIndex.value--;
  } else {
    slideIndex.value = maxSlideSteps.value - 1;
  }
}

function startAutoSlide() {
  stopAutoSlide();
  autoSlideTimer.value = setInterval(() => {
    nextSlide();
  }, 4000);
}

function pauseAutoSlide() {
  stopAutoSlide();
}

function stopAutoSlide() {
  if (autoSlideTimer.value) {
    clearInterval(autoSlideTimer.value);
    autoSlideTimer.value = null;
  }
}

// Touch Swipe Gesture for Mobile HP
const touchStartX = ref(0);
const touchEndX = ref(0);

function handleTouchStart(e) {
  touchStartX.value = e.touches[0].clientX;
}

function handleTouchEnd(e) {
  touchEndX.value = e.changedTouches[0].clientX;
  const diff = touchStartX.value - touchEndX.value;
  if (Math.abs(diff) > 40) {
    if (diff > 0) {
      nextSlide();
    } else {
      prevSlide();
    }
  }
}

// Modal Detail State
const selectedUmkm = ref(null);
const isModalOpen = ref(false);

function openUmkmDetail(item) {
  selectedUmkm.value = item;
  isModalOpen.value = true;
  pauseAutoSlide();
}

function closeUmkmDetail() {
  isModalOpen.value = false;
  selectedUmkm.value = null;
  startAutoSlide();
}

function formatDate(dateStr) {
  if (!dateStr) return '';
  const date = new Date(dateStr);
  return date.toLocaleDateString('id-ID', { year: 'numeric', month: 'long', day: 'numeric' });
}

onMounted(() => {
  if (typeof window !== 'undefined') {
    window.addEventListener('resize', handleResize, { passive: true });
    handleResize();
  }
  startAutoSlide();
});

onUnmounted(() => {
  if (typeof window !== 'undefined') {
    window.removeEventListener('resize', handleResize);
  }
  stopAutoSlide();
});
</script>
