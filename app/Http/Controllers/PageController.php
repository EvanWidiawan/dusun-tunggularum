<?php

namespace App\Http\Controllers;

use App\Models\KarangTaruna;
use App\Models\Galeri;
use App\Models\Berita;
use Inertia\Inertia;
use Inertia\Response;

class PageController extends Controller
{
    public function home(): Response
    {
        $umkmJsonPath = resource_path('data/umkm.json');
        $umkmList = file_exists($umkmJsonPath)
            ? json_decode(file_get_contents($umkmJsonPath), true)
            : [];

        $kegiatanJsonPath = resource_path('data/kegiatan.json');
        $kegiatanList = file_exists($kegiatanJsonPath)
            ? json_decode(file_get_contents($kegiatanJsonPath), true)
            : [];

        return Inertia::render('Public/Home', [
            'karangTaruna' => KarangTaruna::all(),
            'galeri' => Galeri::orderBy('tanggal', 'desc')->get(),
            'umkmList' => $umkmList,
            'kegiatanList' => $kegiatanList,
        ]);
    }

    public function profil(): Response
    {
        return Inertia::render('Public/Profil');
    }

    public function potensi(): Response
    {
        return Inertia::render('Public/Potensi');
    }

    public function agenda(): Response
    {
        return Inertia::render('Public/Agenda');
    }

    public function kontak(): Response
    {
        return Inertia::render('Public/Kontak');
    }

    public function karangTaruna(): Response
    {
        return Inertia::render('Public/KarangTaruna', [
            'members' => KarangTaruna::all(),
        ]);
    }

    public function galeri(): Response
    {
        return Inertia::render('Public/Galeri', [
            'galleries' => Galeri::orderBy('tanggal', 'desc')->get(),
        ]);
    }

    public function berita(): Response
    {
        return Inertia::render('Public/Berita', [
            'beritaList' => Berita::published()->latestFirst()->get(),
        ]);
    }
}
