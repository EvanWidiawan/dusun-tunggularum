# Product Requirements Document (PRD)
## Website Profil Desa — Program Kerja KKN

| Atribut | Keterangan |
|---|---|
| Nama Proyek | Website Profil Desa (profil_desa) |
| Jenis Dokumen | Product Requirements Document |
| Versi | 1.0 |
| Status | Draft |
| Stack | Laravel (Backend) + Inertia.js + Vue 3 (Frontend) |

---

## 1. Latar Belakang

Desa memerlukan media informasi digital yang dapat diakses oleh warga maupun pihak luar (calon investor, wisatawan, instansi pemerintah, dsb.) untuk mengetahui profil, potensi, dan kegiatan desa. Selama ini informasi desa mungkin belum terdokumentasi secara digital atau tersebar di berbagai platform yang tidak terpusat.

Proyek ini dibuat sebagai bagian dari program kerja (proker) KKN, dengan target penyelesaian dalam waktu terbatas, sehingga kompleksitas sistem sengaja dibatasi hanya pada modul yang benar-benar membutuhkan pembaruan berkala oleh admin desa.

## 2. Tujuan Produk

1. Menyediakan media informasi resmi desa yang mudah diakses secara online.
2. Memberikan kemudahan bagi perangkat desa (admin) untuk memperbarui konten yang sifatnya dinamis (Karang Taruna & Galeri) tanpa perlu keahlian teknis/coding.
3. Menjaga kompleksitas sistem tetap rendah agar mudah diserahterimakan (handover) ke perangkat desa setelah program KKN selesai.
4. Meningkatkan citra dan transparansi informasi desa kepada masyarakat luas.

## 3. Target Pengguna

| Role | Deskripsi | Hak Akses |
|---|---|---|
| **Pengunjung (Guest)** | Warga, wisatawan, umum | Melihat seluruh halaman publik (read-only) |
| **Admin** | Perangkat desa / operator yang ditunjuk | Login ke dashboard, kelola data Karang Taruna & Galeri |

> Catatan: Tidak direkomendasikan ada role tambahan (Super Admin, Editor, dll.) mengingat skala proyek KKN. Cukup 1 role admin agar maintenance pasca-KKN lebih sederhana.

## 4. Ruang Lingkup (Scope)

### 4.1 Termasuk dalam Scope (In-Scope)

**A. Halaman Statis (Blade/Vue, tanpa database)**
- Beranda (landing page profil desa)
- Profil & Sejarah Desa
- UMKM Desa
- Agenda/Kegiatan Desa
- Kontak & Lokasi (bisa embed Google Maps)

**B. Modul Dinamis (CRUD via Admin, tersimpan di database)**
- Karang Taruna
- Galeri Desa

**C. Autentikasi**
- Login admin (single role)
- Manajemen sesi dasar (logout, lupa password opsional)

**D. Statistik Pengunjung (Sederhana)**
- Penghitung jumlah kunjungan halaman publik
- Ditampilkan sebagai ringkasan angka di Beranda Dashboard Admin (bukan modul CRUD, bukan analytics mendalam)

### 4.2 Di Luar Scope (Out of Scope)

- Multi-role/multi-level admin
- Sistem komentar/interaksi publik
- Notifikasi email/SMS
- Multi-bahasa (i18n)
- Analytics pengunjung mendalam (grafik tren, sumber trafik, perilaku pengguna, integrasi Google Analytics) — cukup penghitung kunjungan sederhana (lihat 4.1.D)
- Pembayaran/donasi online
- API publik untuk konsumsi pihak ketiga

> Bagian ini penting dicantumkan di PRD agar saat presentasi ke DPL (Dosen Pembimbing Lapangan) atau perangkat desa, scope proyek jelas batasnya dan tidak terjadi *scope creep* di tengah masa KKN yang singkat.

## 5. Rincian Fitur per Halaman

### 5.1 Beranda (Statis)
- Hero section (nama desa, tagline, foto utama)
- Ringkasan singkat desa
- Highlight/shortcut ke: UMKM, Agenda terbaru, Galeri
- Statistik singkat desa (jumlah penduduk, luas wilayah, dsb — data statis)

### 5.2 Profil & Sejarah Desa (Statis)
- Sejarah singkat desa
- Visi & Misi
- Struktur pemerintahan desa (opsional: foto perangkat desa)
- Peta wilayah administratif

### 5.3 UMKM Desa (Statis)
- Daftar UMKM/usaha warga (nama usaha, jenis produk, lokasi)
- Deskripsi singkat dan foto pendukung tiap UMKM

> Karena bersifat statis, penambahan atau perubahan data UMKM dilakukan langsung di kode/konten oleh developer, bukan lewat dashboard admin — sesuai keputusan untuk membatasi modul dinamis hanya pada Karang Taruna & Galeri. Kalau jumlah UMKM diperkirakan terus bertambah dan sering berubah, ini kandidat kuat untuk dijadikan modul dinamis di versi berikutnya (lihat bagian 13).

### 5.4 Agenda/Kegiatan Desa (Statis)
- Daftar kegiatan desa (bisa ditampilkan per periode)
- Deskripsi dan dokumentasi kegiatan (foto)

> Jika di kemudian hari ternyata frekuensi update agenda tinggi, ini kandidat kuat untuk dijadikan dinamis di versi berikutnya — cantumkan sebagai catatan "future enhancement".

### 5.5 Kontak & Lokasi (Statis)
- Alamat kantor desa
- Nomor telepon/WhatsApp perangkat desa
- Embed Google Maps
- Jam operasional pelayanan

### 5.6 Karang Taruna (Dinamis — CRUD Admin)
**Data yang dikelola:**
- Nama anggota/struktur kepengurusan
- Jabatan
- Foto (opsional)
- Deskripsi kegiatan Karang Taruna
- Program kerja Karang Taruna

**Operasi Admin:** Create, Read, Update, Delete

### 5.7 Galeri Desa (Dinamis — CRUD Admin)
**Data yang dikelola:**
- Upload foto/gambar
- Judul/caption
- Kategori (opsional: kegiatan, wisata, infrastruktur, dll.)
- Tanggal upload

**Operasi Admin:** Create, Read, Update, Delete

### 5.8 Dashboard Admin
- Login page
- Sidebar navigasi (Beranda, Karang Taruna, Galeri)
- **Beranda Dashboard**: ringkasan statistik pengunjung + jumlah data Karang Taruna & Galeri
- List view + form tambah/edit untuk masing-masing modul
- Konfirmasi sebelum delete

### 5.9 Statistik Pengunjung (Beranda Admin)

Fitur sederhana untuk memberi gambaran seberapa banyak halaman publik dikunjungi, tanpa perlu tool analytics eksternal.

**Data yang ditampilkan di Beranda Admin:**
- Total kunjungan sepanjang waktu (all-time)
- Total kunjungan hari ini
- (Opsional, jika waktu memungkinkan) daftar/grafik ringkas 7 hari terakhir

**Cara kerja:**
- Setiap kali halaman publik (Beranda, Profil, UMKM, Agenda, Kontak, Galeri, Karang Taruna) diakses, sistem mencatat satu kunjungan
- Pencatatan dilakukan via middleware Laravel, cukup increment counter per tanggal — tidak menyimpan data pribadi pengunjung (tanpa IP/user-agent) agar tetap sederhana dan tidak menyentuh isu privasi data
- Ditampilkan sebagai metric card di Beranda Dashboard Admin (bukan halaman publik)

## 6. Rancangan Model Data (Database)

Karena hanya 2 modul dinamis, struktur database bisa tetap ringkas:

**users**
- id, name, email, password, timestamps

**karang_tarunas**
- id, nama, jabatan, foto (path), deskripsi, timestamps

**galeris**
- id, judul, gambar (path), kategori (nullable), tanggal, timestamps

**page_visits**
- id, tanggal (date, unique per hari), jumlah_kunjungan (integer, default 0), timestamps

> Rekomendasi: gunakan Laravel migration + model + policy sederhana (cukup middleware `auth` untuk proteksi route `/admin/*`), tanpa perlu package permission kompleks seperti Spatie Permission — kecuali Anda ingin scope role lebih dari satu di masa depan.
>
> Untuk `page_visits`: gunakan pendekatan `firstOrCreate` + `increment('jumlah_kunjungan')` berdasarkan tanggal hari ini di dalam middleware, agar 1 baris mewakili 1 hari — jauh lebih ringan daripada menyimpan 1 baris per kunjungan.

## 7. Alur Pengguna (User Flow) Singkat

**Pengunjung:**
1. Akses halaman beranda → 2. Navigasi ke halaman statis (Profil, UMKM, Agenda, Kontak) → 3. Lihat Karang Taruna / Galeri (data dari DB, read-only)

**Admin:**
1. Login → 2. Masuk dashboard (lihat ringkasan statistik pengunjung & data) → 3. Pilih modul (Karang Taruna/Galeri) → 4. Tambah/Edit/Hapus data → 5. Perubahan otomatis tampil di halaman publik

## 8. Kebutuhan Non-Fungsional

| Aspek | Kebutuhan |
|---|---|
| Performa | Halaman statis idealnya load < 2 detik |
| Responsif | Wajib mobile-friendly (mayoritas warga akses via HP) |
| Keamanan | Route admin diproteksi middleware `auth`; validasi input form; sanitasi upload gambar |
| Kompatibilitas Browser | Chrome, Firefox, Edge versi terbaru |
| Hosting | Sesuaikan dengan ketersediaan shared hosting desa/kampus (cek dukungan PHP versi Laravel yang dipakai) |
| Maintainability | Kode terdokumentasi dasar agar mudah diserahkan ke operator desa pasca-KKN |

## 9. Struktur Teknis (Berdasarkan Setup Anda)

Sesuai struktur folder yang sudah dibuat:

```
resources/js/
├── pages/       → komponen halaman Inertia (Home.vue, dst.)
├── views/       → app.blade.php (root template Inertia)
app.js           → entry point Inertia + Vue
routes/          → web.php untuk routing publik & admin
```

**Rekomendasi penambahan struktur saat development:**
- `resources/js/pages/Admin/` → khusus halaman dashboard admin (KarangTaruna/Index.vue, Galeri/Index.vue, dll.)
- `resources/js/components/` → komponen reusable (Navbar, Footer, Card, dll.)
- `resources/js/layouts/` → `PublicLayout.vue` dan `AdminLayout.vue` terpisah
- `app/Http/Controllers/Admin/` → controller khusus modul dinamis
- `app/Http/Controllers/PageController.php` → untuk render halaman statis via Inertia

## 10. Milestone / Timeline (Rekomendasi untuk Konteks KKN)

| Minggu | Kegiatan |
|---|---|
| 1 | Setup project, autentikasi admin, layout dasar (Navbar/Footer) |
| 2 | Pembuatan halaman statis (Beranda, Profil, UMKM, Agenda, Kontak) |
| 3 | Modul dinamis Karang Taruna + Galeri (migration, CRUD, dashboard admin) |
| 4 | Testing, revisi konten bersama perangkat desa, deployment, dokumentasi serah terima |

## 11. Kriteria Keberhasilan (Success Metrics)

- Seluruh halaman statis dapat diakses tanpa error di perangkat mobile & desktop
- Admin dapat melakukan CRUD Karang Taruna & Galeri tanpa bantuan developer
- Website berhasil di-deploy dan dapat diakses publik sebelum masa KKN berakhir
- Serah terima akun admin & dokumentasi penggunaan ke perangkat desa selesai

## 12. Desain & Identitas Visual

### 12.1 Konsep Tema: "Mata Air Merapi"

Tema desain tetap digali dari lokasi geografis desa di kaki Gunung Merapi, kali ini dari sisi mata air pegunungan dan kabut pagi — memberi nuansa biru yang segar dan sejuk, sebagai alternatif dari tema hijau-bara sebelumnya. Cocok dipakai jika Anda ingin kesan lebih bersih/tenang, misalnya untuk menonjolkan potensi wisata air atau sekadar variasi mood yang lebih adem.

### 12.2 Palet Warna

| Peran | Nama | Kode Hex | Penggunaan |
|---|---|---|---|
| Latar utama | Kabut pagi | `#EEF3F3` | Background halaman |
| Warna primer | Biru mata air | `#1F5C6B` | Navbar, heading, tombol utama, footer |
| Aksen | Biru langit tipis | `#5FA8B5` | Highlight, badge, CTA sekunder, data statistik |
| Netral gelap | Batu basah | `#3A4A4C` | Border, tombol outline, elemen struktural |
| Teks sekunder | Abu kehijauan sejuk | `#5E6E6E` | Paragraf, deskripsi, teks pendukung |

**Aturan pemakaian:**
- Biru mata air (`#1F5C6B`) dominan untuk elemen navigasi & CTA utama — konsisten di semua halaman.
- Aksen biru langit tipis (`#5FA8B5`) dipakai secukupnya: badge lokasi, angka statistik, hover state — jangan mendominasi layout.
- Latar kabut pagi sebagai base, hindari putih polos agar nuansa tetap sejuk dan tidak steril.

### 12.3 Tipografi

| Peran | Font | Keterangan |
|---|---|---|
| Display/Judul | Lora (serif) | Untuk H1/H2 di halaman publik, memberi kesan cerita & tradisi |
| Body/UI | Inter (sans-serif) | Untuk paragraf, navigasi, dan seluruh dashboard admin |

Import via Google Fonts di `resources/views/app.blade.php`, definisikan sebagai CSS variable di `resources/css/app.css`:

```css
:root {
  --font-display: 'Lora', serif;
  --font-body: 'Inter', sans-serif;

  --color-primary: #1F5C6B;
  --color-accent: #5FA8B5;
  --color-bg: #EEF3F3;
  --color-stone: #3A4A4C;
  --color-text: #5E6E6E;
}
```

### 12.4 Prinsip Layout

- **Hero section beranda**: badge lokasi ("Kaki Gunung Merapi") + headline serif + deskripsi singkat + 2 CTA (primer solid, sekunder outline)
- **Strip statistik**: 3 kolom (jumlah warga, luas wilayah, jumlah dusun) dengan latar warna dari palet di atas, ditempatkan langsung di bawah hero sebagai elemen khas yang berulang di beberapa halaman
- **Navbar**: logo/nama desa + ikon gunung di kiri, menu horizontal di kanan, latar transparan/kabut pagi dengan border tipis
- **Kartu (galeri, karang taruna, UMKM)**: radius 12px, border tipis warna `--color-stone` dengan opacity rendah, hindari shadow berlebihan

### 12.5 Prioritas Visual (untuk menjaga desain tidak berlebihan)

1. Foto asli desa (pemandangan Merapi, kegiatan warga, produk UMKM) — lebih diutamakan daripada ilustrasi/ikon dekoratif
2. Whitespace cukup lega antar-section, hindari elemen dekoratif berlebihan
3. Maksimal 1 warna aksen (`#5FA8B5`) per section agar tidak ramai
4. Konsisten gunakan token warna & font di atas untuk semua halaman statis maupun dinamis, termasuk dashboard admin (versi lebih netral/fungsional)

> Catatan: tema "Lereng Merapi" (hijau + bara) sebelumnya masih bisa dipakai sebagai alternatif jika dirasa lebih pas saat presentasi ke perangkat desa — kedua opsi sama-sama valid, tinggal pilih salah satu sebelum development dimulai agar tidak ganti-ganti token di tengah jalan.

## 13. Catatan Pengembangan Lanjutan (Future Enhancement — Opsional)

Dicantumkan agar terlihat ada roadmap, meski tidak dikerjakan saat KKN:
- Modul Agenda/Kegiatan dijadikan dinamis jika update sering terjadi
- Multi-role admin (misal: admin per dusun)
- Analytics pengunjung lanjutan (grafik tren bulanan, halaman terpopuler, filter rentang tanggal)
