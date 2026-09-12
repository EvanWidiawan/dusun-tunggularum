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
            'gambar' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:10240'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
        ]);

        $validated['tanggal'] = $validated['tanggal'] ?? now()->toDateString();

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/galeri');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $fileName);
            $validated['gambar'] = 'uploads/galeri/' . $fileName;
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
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:10240'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
        ]);

        $validated['tanggal'] = $validated['tanggal'] ?? $galeri->tanggal ?? now()->toDateString();

        if ($request->hasFile('gambar')) {
            // Hapus file lama jika ada
            if ($galeri->gambar) {
                $oldPath = public_path($galeri->gambar);
                if (file_exists($oldPath) && !is_dir($oldPath)) {
                    @unlink($oldPath);
                }
                if (Storage::disk('public')->exists($galeri->gambar)) {
                    Storage::disk('public')->delete($galeri->gambar);
                }
            }

            $file = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/galeri');
            
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }
            
            $file->move($destinationPath, $fileName);
            $validated['gambar'] = 'uploads/galeri/' . $fileName;
        }

        $galeri->update($validated);

        return redirect()->back()->with('success', 'Foto Galeri Desa berhasil diperbarui.');
    }

    /**
     * Hapus data foto galeri.
     */
    public function destroy(Galeri $galeri)
    {
        if ($galeri->gambar) {
            $oldPath = public_path($galeri->gambar);
            if (file_exists($oldPath) && !is_dir($oldPath)) {
                @unlink($oldPath);
            }
            if (Storage::disk('public')->exists($galeri->gambar)) {
                Storage::disk('public')->delete($galeri->gambar);
            }
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Foto Galeri Desa berhasil dihapus.');
    }
}
