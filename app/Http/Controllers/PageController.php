<?php

namespace App\Http\Controllers;

use App\Models\KarangTaruna;
use App\Models\Galeri;
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

        return Inertia::render('Public/Home', [
            'karangTaruna' => KarangTaruna::all(),
            'galeri' => Galeri::orderBy('tanggal', 'desc')->get(),
            'umkmList' => $umkmList,
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
}
