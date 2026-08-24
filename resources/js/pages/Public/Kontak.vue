<template>
  <PublicLayout>
    <section class="py-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="max-w-3xl mx-auto text-center space-y-4 mb-12">
        <h1 class="font-display font-bold text-4xl text-[#1F5C6B]">Kontak & Lokasi Kantor Desa</h1>
        <p class="text-[#5E6E6E] text-lg">Hubungi perangkat desa atau kunjungi kantor pelayanan kami.</p>
      </div>

      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 max-w-5xl mx-auto">
        <div class="bg-white/80 rounded-2xl p-8 border border-[#3A4A4C]/15 shadow-xs space-y-6">
          <h2 class="font-display font-bold text-2xl text-[#1F5C6B]">Informasi Pelayanan</h2>
          <div class="space-y-4 text-sm text-[#5E6E6E]">
            <div>
              <p class="font-semibold text-[#1F5C6B]">Alamat Kantor Desa:</p>
              <p>Jl. Merapi Utama No. 1, Kabupaten Sleman, D.I. Yogyakarta</p>
            </div>
            <div>
              <p class="font-semibold text-[#1F5C6B]">Telepon / WhatsApp Pelayanan:</p>
              <p>+62 812-3456-7890</p>
            </div>
            <div>
              <p class="font-semibold text-[#1F5C6B]">Email Resmi:</p>
              <p>info@desamerapi.id</p>
            </div>
            <div>
              <p class="font-semibold text-[#1F5C6B]">Jam Operasional:</p>
              <p>Senin - Jumat: 08:00 - 15:00 WIB</p>
            </div>
          </div>
        </div>

        <div class="bg-white/80 rounded-2xl p-4 border border-[#3A4A4C]/15 shadow-xs overflow-hidden h-80 lg:h-auto">
          <!-- Embed Google Maps -->
          <iframe
            title="Peta Lokasi Kantor Desa Merapi"
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
  </PublicLayout>
</template>

<script setup>
import PublicLayout from '../../Layouts/PublicLayout.vue';
</script>
