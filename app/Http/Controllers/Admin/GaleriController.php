<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class GaleriController extends Controller
{
    /**
     * Tampilkan daftar galeri di Dashboard Admin.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/Galeri/Index', [
            'galleries' => Galeri::orderBy('tanggal', 'desc')->get(),
        ]);
    }

    /**
     * Simpan data foto galeri baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['required', 'date'],
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        Galeri::create($validated);

        return redirect()->back()->with('success', 'Foto Galeri Desa berhasil ditambahkan.');
    }

    /**
     * Perbarui data galeri.
     */
    public function update(Request $request, Galeri $galeri)
    {
        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:3072'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['required', 'date'],
        ]);

        if ($request->hasFile('gambar')) {
            if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('galeri', 'public');
        }

        $galeri->update($validated);

        return redirect()->back()->with('success', 'Foto Galeri Desa berhasil diperbarui.');
    }

    /**
     * Hapus data foto galeri.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar && Storage::disk('public')->exists($galeri->gambar)) {
            Storage::disk('public')->delete($galeri->gambar);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto Galeri Desa berhasil dihapus.');
    }
}
