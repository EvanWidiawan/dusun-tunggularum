<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Galeri;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiGaleriController extends Controller
{
    public function index(): JsonResponse
    {
        $galleries = Galeri::orderBy('tanggal', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $galleries,
        ]);
    }

    public function store(Request $request): JsonResponse
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
                @mkdir($destinationPath, 0777, true);
                @chmod($destinationPath, 0777);
            }
            
            $file->move($destinationPath, $fileName);
            $validated['gambar'] = 'uploads/galeri/' . $fileName;
        }

        $galeri = Galeri::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Foto Galeri Desa berhasil ditambahkan.',
            'data' => $galeri,
        ], 201);
    }

    public function show(Galeri $galeri): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $galeri,
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $galeri = Galeri::findOrFail($id);

        $validated = $request->validate([
            'judul' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:10240'],
            'kategori' => ['nullable', 'string', 'max:100'],
            'tanggal' => ['nullable', 'date'],
        ]);

        $validated['tanggal'] = $validated['tanggal'] ?? $galeri->tanggal ?? now()->toDateString();

        if ($request->hasFile('gambar')) {
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
                @mkdir($destinationPath, 0777, true);
                @chmod($destinationPath, 0777);
            }
            
            $file->move($destinationPath, $fileName);
            $validated['gambar'] = 'uploads/galeri/' . $fileName;
        }

        $galeri->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Foto Galeri Desa berhasil diperbarui.',
            'data' => $galeri,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $galeri = Galeri::findOrFail($id);

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

        return response()->json([
            'success' => true,
            'message' => 'Foto Galeri Desa berhasil dihapus.',
        ]);
    }
}
