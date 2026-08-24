<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KarangTaruna;
use App\Models\Galeri;
use Illuminate\Http\JsonResponse;

class ApiPublicController extends Controller
{
    public function home(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'desa' => [
                    'nama' => 'Desa Merapi',
                    'tagline' => 'Harmoni Alam & Kemajuan Masyarakat Lereng Merapi',
                    'luas_wilayah' => '1.250 Ha',
                    'jumlah_penduduk' => 4850,
                    'jumlah_dusun' => 8,
                ],
                'karangTaruna' => KarangTaruna::all(),
                'galeri' => Galeri::orderBy('tanggal', 'desc')->take(6)->get(),
            ],
        ]);
    }

    public function profil(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'sejarah' => 'Desa Merapi berdiri sejak abad ke-19 di kaki Gunung Merapi...',
                'visi' => 'Terwujudnya Desa Merapi yang Mandiri, Sejahtera, Berdaya Saing, dan Berkelanjutan.',
                'misi' => [
                    'Meningkatkan tata kelola pemerintahan desa yang transparan.',
                    'Pengembangan ekonomi kerakyatan berbasis potensi lokal dan pariwisata.',
                    'Pemberdayaan generasi muda melalui Karang Taruna.',
                ],
            ],
        ]);
    }

    public function potensi(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                ['kategori' => 'Pertanian', 'nama' => 'Salak Pondoh & Kopi Merapi', 'deskripsi' => 'Komoditas utama warga desa.'],
                ['kategori' => 'Wisata', 'nama' => 'Jeep Tour & Outbound Lereng Merapi', 'deskripsi' => 'Destinasi wisata unggulan.'],
                ['kategori' => 'UMKM', 'nama' => 'Kerajinan Bambu & Olahan Pangan', 'deskripsi' => 'Produk kreatif warga desa.'],
            ],
        ]);
    }

    public function agenda(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                ['judul' => 'Kerja Bakti Masal Bersama Warga', 'tanggal' => '2026-09-01', 'lokasi' => 'Balai Desa'],
                ['judul' => 'Pelatihan Digital Marketing UMKM', 'tanggal' => '2026-09-10', 'lokasi' => 'Ruang Rapat'],
            ],
        ]);
    }

    public function kontak(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => [
                'alamat' => 'Jl. Merapi Utama No. 1, Kabupaten Sleman, D.I. Yogyakarta',
                'telepon' => '+62 812-3456-7890',
                'email' => 'info@desamerapi.id',
                'jam_layanan' => 'Senin - Jumat, 08:00 - 15:00 WIB',
            ],
        ]);
    }

    public function karangTaruna(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => KarangTaruna::all(),
        ]);
    }

    public function galeri(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Galeri::orderBy('tanggal', 'desc')->get(),
        ]);
    }
}
