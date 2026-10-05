<?php

namespace Database\Seeders;

use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeritaSeeder extends Seeder
{
    /**
     * Data contoh Berita Dusun Tunggularum.
     * Aman dijalankan berulang (updateOrCreate berdasarkan slug), tidak menghapus data lain.
     */
    public function run(): void
    {
        $items = [
            [
                'judul' => 'Kerja Bakti Bersih Saluran Mata Air Menjelang Musim Hujan',
                'kategori' => 'Kegiatan',
                'gambar' => 'images/kegiatan/merti-dusun.jpg',
                'hari_lalu' => 1,
                'isi' => "Warga Dusun Tunggularum bergotong royong membersihkan saluran irigasi dan jalur mata air pada Minggu pagi. Kegiatan ini diikuti oleh warga dari keempat RT, pemuda Karang Taruna, serta ibu-ibu PKK yang menyiapkan konsumsi.\n\nPembersihan difokuskan pada saluran utama yang mengalirkan air dari sumber mata air menuju lahan pertanian salak dan permukiman warga. Sampah daun, sedimen lumpur, serta ranting yang menyumbat aliran berhasil diangkat sehingga aliran air kembali lancar.\n\nKepala Dusun menyampaikan terima kasih atas partisipasi warga dan mengajak masyarakat untuk terus menjaga kebersihan lingkungan, terutama menjelang musim hujan agar tidak terjadi luapan air di jalan dusun.",
            ],
            [
                'judul' => 'Jadwal Posyandu Balita dan Lansia Bulan Oktober',
                'kategori' => 'Kesehatan',
                'gambar' => 'images/kegiatan/foto/senam.jpg',
                'hari_lalu' => 3,
                'isi' => "Diberitahukan kepada seluruh warga Dusun Tunggularum bahwa kegiatan Posyandu Balita dan Posyandu Lansia bulan ini akan dilaksanakan di Balai Dusun mulai pukul 08.00 WIB.\n\nLayanan yang tersedia meliputi penimbangan dan pengukuran tinggi badan balita, pemberian vitamin, imunisasi sesuai jadwal, serta pemeriksaan tekanan darah dan gula darah bagi lansia. Kegiatan juga akan diawali dengan senam sehat bersama.\n\nWarga diharapkan membawa buku KIA atau KMS masing-masing. Untuk informasi lebih lanjut silakan menghubungi kader posyandu di RT masing-masing.",
            ],
            [
                'judul' => 'Semarak Lomba Tujuh Belasan Meriahkan HUT RI di Tunggularum',
                'kategori' => 'Kegiatan',
                'gambar' => 'images/kegiatan/lomba17an.jpeg',
                'hari_lalu' => 9,
                'isi' => "Peringatan Hari Ulang Tahun Kemerdekaan Republik Indonesia di Dusun Tunggularum berlangsung meriah. Berbagai lomba tradisional seperti balap karung, makan kerupuk, tarik tambang, dan panjat pinang diikuti oleh anak-anak hingga orang dewasa.\n\nKarang Taruna selaku panitia menyampaikan bahwa kegiatan ini bertujuan mempererat kebersamaan antarwarga sekaligus menanamkan semangat nasionalisme kepada generasi muda.\n\nAcara ditutup dengan pembagian hadiah bagi para pemenang dan doa bersama untuk kemajuan dusun serta bangsa Indonesia.",
            ],
            [
                'judul' => 'Pengumuman Rapat Warga Pembahasan Rencana Perbaikan Jalan Dusun',
                'kategori' => 'Pengumuman',
                'gambar' => 'images/hero-tunggularum2.jpeg',
                'hari_lalu' => 12,
                'isi' => "Dengan hormat, seluruh kepala keluarga Dusun Tunggularum diundang untuk menghadiri rapat warga yang akan membahas rencana perbaikan dan pengaspalan jalan dusun ruas utama.\n\nRapat akan dilaksanakan di Balai Dusun pada malam hari setelah Isya. Agenda rapat meliputi pemaparan rencana anggaran, jadwal pelaksanaan, serta pembagian tugas gotong royong warga.\n\nKehadiran dan masukan dari seluruh warga sangat diharapkan demi kelancaran pembangunan bersama.",
            ],
            [
                'judul' => 'Panen Raya Salak Pondoh, Petani Tunggularum Optimis Harga Stabil',
                'kategori' => 'Pertanian',
                'gambar' => 'images/hero-tunggularum3.jpeg',
                'hari_lalu' => 18,
                'isi' => "Musim panen raya salak pondoh tahun ini disambut gembira oleh para petani Dusun Tunggularum. Hasil panen dinilai cukup baik berkat curah hujan yang mendukung dan perawatan kebun yang lebih intensif.\n\nKelompok tani setempat juga mulai memasarkan hasil panen melalui media sosial dan kerja sama dengan pelaku UMKM olahan salak, sehingga petani tidak sepenuhnya bergantung pada tengkulak.\n\nPara petani berharap harga salak tetap stabil hingga akhir musim panen dan pemasaran digital dapat terus dikembangkan bersama pemuda dusun.",
            ],
            [
                'judul' => 'Tradisi Tirakatan Malam Kemerdekaan Perkuat Kebersamaan Warga',
                'kategori' => 'Umum',
                'gambar' => 'images/kegiatan/tirakatan.jpg',
                'hari_lalu' => 25,
                'isi' => "Warga Dusun Tunggularum kembali menggelar tradisi tirakatan pada malam menjelang peringatan kemerdekaan. Kegiatan diisi dengan doa bersama, renungan perjuangan para pahlawan, serta makan bersama dengan hidangan yang dibawa oleh setiap rumah tangga.\n\nTokoh masyarakat menyampaikan bahwa tradisi ini merupakan warisan budaya yang perlu terus dilestarikan karena menjadi sarana silaturahmi dan memperkuat rasa persaudaraan antarwarga.\n\nSuasana hangat dan penuh kekeluargaan terasa hingga larut malam.",
            ],
        ];

        foreach ($items as $item) {
            $slug = Str::slug($item['judul']);

            Berita::updateOrCreate(
                ['slug' => $slug],
                [
                    'judul' => $item['judul'],
                    'kategori' => $item['kategori'],
                    'gambar' => $item['gambar'],
                    'isi' => $item['isi'],
                    'ringkasan' => null,
                    'penulis' => 'Admin Dusun',
                    'tanggal' => Carbon::now()->subDays($item['hari_lalu'])->toDateString(),
                    'is_published' => true,
                ]
            );
        }
    }
}
