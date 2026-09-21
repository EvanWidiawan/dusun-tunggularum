import { nextTick } from 'vue';

/**
 * Composable Scroll Reveal menggunakan IntersectionObserver native.
 * Sangat ringan, tanpa dependensi eksternal, dan 60fps GPU-accelerated.
 */
export function initScrollReveal() {
  nextTick(() => {
    if (typeof window === 'undefined' || !('IntersectionObserver' in window)) {
      // Fallback untuk browser sangat lama tanpa observer
      document.querySelectorAll('.reveal-on-scroll').forEach((el) => {
        el.classList.add('reveal-visible');
      });
      return;
    }

    const observerOptions = {
      root: null,
      rootMargin: '0px 0px -40px 0px',
      threshold: 0.08,
    };

    const observer = new IntersectionObserver((entries, obs) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('reveal-visible');
          obs.unobserve(entry.target); // Hanya animasikan sekali
        }
      });
    }, observerOptions);

    const elements = document.querySelectorAll('.reveal-on-scroll:not(.reveal-visible)');
    elements.forEach((el) => observer.observe(el));
  });
}
