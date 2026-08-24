<template>
  <div class="min-h-screen flex flex-col bg-[#EEF3F3] text-[#5E6E6E] font-body selection:bg-[#1F5C6B] selection:text-white">
    <!-- Navbar Component -->
    <Navbar />

    <!-- Main Page Content -->
    <main class="flex-grow">
      <slot />
    </main>

    <!-- Footer Component -->
    <Footer />
  </div>
</template>

<script setup>
import Navbar from '../Components/Navbar.vue';
import Footer from '../Components/Footer.vue';
</script>
