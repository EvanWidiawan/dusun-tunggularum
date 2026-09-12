/**
 * Helper untuk format URL gambar agar dapat dimuat secara konsisten
 * di localhost, cPanel, Apache, Nginx, dan Linux VPS.
 */
export function getImageUrl(path) {
  if (!path) return '';
  
  // URL eksternal atau Blob
  if (path.startsWith('http://') || path.startsWith('https://') || path.startsWith('blob:') || path.startsWith('data:')) {
    return path;
  }
  
  // Sudah memiliki prefix slash
  if (path.startsWith('/uploads/') || path.startsWith('/images/')) {
    return path;
  }

  // Jika memiliki prefix /storage/, sesuaikan jika perlu
  if (path.startsWith('/storage/')) {
    const cleanPath = path.replace('/storage/', '');
    return '/uploads/' + cleanPath;
  }

  if (path.startsWith('/')) {
    return path;
  }

  // Jika berformat 'uploads/...' atau 'images/...'
  if (path.startsWith('uploads/') || path.startsWith('images/')) {
    return '/' + path;
  }

  // Jika legacy 'galeri/...' atau 'karang-taruna/...'
  return '/uploads/' + path;
}

/**
 * Fallback jika gambar gagal dimuat (misal jika file belum dipindah / broken link)
 */
export function handleImageFallback(event, fallback = '/images/hero-tunggularum.png') {
  const target = event.target;
  const currentSrc = target.getAttribute('src') || '';
  
  // Jika pertama kali coba /uploads/, coba fallback ke /storage/
  if (currentSrc.startsWith('/uploads/')) {
    target.setAttribute('src', currentSrc.replace('/uploads/', '/storage/'));
    return;
  }
  
  // Jika tetap gagal, gunakan placeholder default
  if (!currentSrc.includes('hero-tunggularum')) {
    target.setAttribute('src', fallback);
  }
}
