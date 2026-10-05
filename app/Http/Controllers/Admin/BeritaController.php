<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Concerns\ManagesBerita;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BeritaController extends Controller
{
    use ManagesBerita;

    /**
     * Tampilkan daftar berita di Dashboard Admin.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Berita/Index', [
            'beritas' => Berita::latestFirst()->get(),
            'kategoriOptions' => Berita::KATEGORI,
        ]);
    }

    /**
     * Simpan berita baru.
     */
    public function store(Request $request)
    {
        $this->createBeritaFromRequest($request);

        return redirect()->back()->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Perbarui berita.
     */
    public function update(Request $request, Berita $berita)
    {
        $this->updateBeritaFromRequest($request, $berita);

        return redirect()->back()->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Hapus berita.
     */
    public function destroy(Berita $berita)
    {
        $this->destroyBerita($berita);

        return redirect()->back()->with('success', 'Berita berhasil dihapus.');
    }
}
