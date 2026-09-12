<template>
  <div class="relative w-full h-80 sm:h-[420px] rounded-2xl overflow-hidden border border-[#3A4A4C]/15 shadow-md">
    <!-- Map Container -->
    <div ref="mapContainer" class="w-full h-full z-10"></div>
  </div>
</template>

<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import L from 'leaflet';

const mapContainer = ref(null);
let map = null;

// Coordinates for Dusun Tunggularum, Wonokerto, Turi, Sleman, D.I. Yogyakarta
const latitude = -7.587843;
const longitude = 110.384712;

onMounted(() => {
  if (!mapContainer.value) return;

  // Initialize Leaflet Map centered at Dusun Tunggularum
  map = L.map(mapContainer.value, {
    center: [latitude, longitude],
    zoom: 14,
    zoomControl: true,
  });

  // OpenStreetMap Tile Layer
  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    maxZoom: 19,
    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
  }).addTo(map);

  // Custom SVG Marker Pin Icon
  const customMarkerIcon = L.divIcon({
    className: 'custom-leaflet-marker',
    html: `
      <div class="relative flex items-center justify-center">
        <div class="w-10 h-10 rounded-2xl bg-[#1F5C6B] text-white flex items-center justify-center shadow-xl border-2 border-white transform hover:scale-110 transition-transform">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
          </svg>
        </div>
      </div>
    `,
    iconSize: [40, 40],
    iconAnchor: [20, 40],
    popupAnchor: [0, -40],
  });

  // Add Marker & Popup
  const marker = L.marker([latitude, longitude], { icon: customMarkerIcon }).addTo(map);

  const popupContent = `
    <div style="font-family: 'Inter', sans-serif; text-align: center; padding: 4px;">
      <h4 style="font-family: 'Lora', serif; font-weight: 700; color: #1F5C6B; font-size: 16px; margin: 0 0 4px 0;">
        Dusun Tunggularum
      </h4>
      <p style="font-size: 12px; color: #5E6E6E; margin: 0 0 8px 0; font-weight: 500;">
        Kalurahan Wonokerto, Kapanewon Turi, Sleman, D.I. Yogyakarta
      </p>
      <div style="display: inline-block; padding: 4px 10px; background-color: #1F5C6B; color: #ffffff; border-radius: 8px; font-size: 11px; font-weight: 700; margin-bottom: 8px;">
        📍 Kaki Gunung Merapi (±700 mdpl)
      </div>
      <div style="padding-top: 6px; border-top: 1px solid #e5e7eb;">
        <a
          href="https://www.google.com/maps/search/?api=1&query=${latitude},${longitude}"
          target="_blank"
          rel="noopener noreferrer"
          style="color: #5FA8B5; font-weight: 700; font-size: 12px; text-decoration: none;"
        >
          Buka di Google Maps &rarr;
        </a>
      </div>
    </div>
  `;

  marker.bindPopup(popupContent).openPopup();
});

onUnmounted(() => {
  if (map) {
    map.remove();
    map = null;
  }
});
</script>
