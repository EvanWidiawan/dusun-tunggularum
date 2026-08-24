<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\KarangTaruna;
use App\Models\Galeri;
use App\Models\PageVisit;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Admin User
        User::updateOrCreate(
            ['email' => 'admin@desa.id'],
            [
                'name' => 'Administrator Desa',
                'password' => Hash::make('password123'),
            ]
        );

        // 2. Sample Data Karang Taruna
        KarangTaruna::truncate();
        KarangTaruna::create([
            'nama' => 'Budi Santoso',
            'jabatan' => 'Ketua Karang Taruna',
            'foto' => null,
            'deskripsi' => 'Bertanggung jawab atas koordinasi seluruh kegiatan pemuda dan pengembangan potensi generasi muda di desa.',
        ]);

        KarangTaruna::create([
            'nama' => 'Siti Nurhaliza',
            'jabatan' => 'Sekretaris',
            'foto' => null,
            'deskripsi' => 'Mengelola administrasi, keorganisasian, dan pendokumentasian surat-menyurat Karang Taruna.',
        ]);

        KarangTaruna::create([
            'nama' => 'Rian Pratama',
            'jabatan' => 'Bendahara',
            'foto' => null,
            'deskripsi' => 'Mengatur alokasi keuangan, anggaran kegiatan, dan pelaporan transparansi kas Karang Taruna.',
        ]);

        // 3. Sample Data Galeri Desa
        Galeri::truncate();
        Galeri::create([
            'judul' => 'Kegiatan Kerja Bakti Desa Merapi',
            'gambar' => 'galeri/sample-1.jpg',
            'kategori' => 'Kegiatan',
            'tanggal' => Carbon::now()->subDays(5)->format('Y-m-d'),
        ]);

        Galeri::create([
            'judul' => 'Pemandangan Panorama Lereng Gunung Merapi',
            'gambar' => 'galeri/sample-2.jpg',
            'kategori' => 'Wisata',
            'tanggal' => Carbon::now()->subDays(3)->format('Y-m-d'),
        ]);

        Galeri::create([
            'judul' => 'Pelatihan UMKM Kerajinan Bambu Desa',
            'gambar' => 'galeri/sample-3.jpg',
            'kategori' => 'Infrastruktur',
            'tanggal' => Carbon::now()->subDays(1)->format('Y-m-d'),
        ]);

        // 4. Sample Page Visits (7 hari terakhir)
        PageVisit::truncate();
        for ($i = 6; $i >= 0; $i--) {
            PageVisit::create([
                'tanggal' => Carbon::now()->subDays($i)->format('Y-m-d'),
                'jumlah_kunjungan' => rand(15, 65),
            ]);
        }
    }
}
