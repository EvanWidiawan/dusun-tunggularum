<?php

namespace App\Http\Controllers\Concerns;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Logika bersama (validasi + upload gambar) untuk CRUD Berita
 * yang dipakai oleh controller Admin (Inertia) dan API (Sanctum).
 */
trait ManagesBerita
{
    protected function validateBerita(Request $request): array
    {
        $rules = [
            'judul' => ['required', 'string', 'max:255'],
            'ringkasan' => ['nullable', 'string', 'max:300'],
            'isi' => ['required', 'string'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'penulis' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
            'is_published' => ['nullable'],
        ];

        if ($request->hasFile('gambar')) {
            $rules['gambar'] = ['image', 'mimes:jpeg,png,jpg,webp,gif', 'max:10240'];
        }

        $validated = $request->validate($rules);
        $validated['is_published'] = $request->boolean('is_published', true);
        unset($validated['gambar']);

        return $validated;
    }

    protected function storeBeritaImage(UploadedFile $file): string
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        $destinationPath = public_path('uploads/berita');

        if (!file_exists($destinationPath)) {
            @mkdir($destinationPath, 0777, true);
            @chmod($destinationPath, 0777);
        }

        $file->move($destinationPath, $fileName);

        return 'uploads/berita/' . $fileName;
    }

    protected function deleteBeritaImage(?string $path): void
    {
        // Jangan hapus aset bawaan (mis. images/kegiatan/...) yang dipakai data contoh
        if (!$path || !str_starts_with(ltrim($path, '/'), 'uploads/berita/')) {
            return;
        }

        $oldPath = public_path(ltrim($path, '/'));
        if (file_exists($oldPath) && !is_dir($oldPath)) {
            @unlink($oldPath);
        }
        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    protected function createBeritaFromRequest(Request $request): Berita
    {
        $data = $this->validateBerita($request);
        $data['tanggal'] = $data['tanggal'] ?? now()->toDateString();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $this->storeBeritaImage($request->file('gambar'));
        }

        return Berita::create($data);
    }

    protected function updateBeritaFromRequest(Request $request, Berita $berita): Berita
    {
        $data = $this->validateBerita($request);
        $data['tanggal'] = $data['tanggal'] ?? $berita->tanggal ?? now()->toDateString();

        if ($request->hasFile('gambar')) {
            $this->deleteBeritaImage($berita->gambar);
            $data['gambar'] = $this->storeBeritaImage($request->file('gambar'));
        } elseif ($request->boolean('hapus_gambar')) {
            $this->deleteBeritaImage($berita->gambar);
            $data['gambar'] = null;
        }

        $berita->update($data);

        return $berita;
    }

    protected function destroyBerita(Berita $berita): void
    {
        $this->deleteBeritaImage($berita->gambar);
        $berita->delete();
    }
}
