<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KarangTaruna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class KarangTarunaController extends Controller
{
    /**
     * Tampilkan daftar pengurus Karang Taruna di Dashboard Admin.
     */
    public function index(): Response
    {
        return Inertia::render('Admin/KarangTaruna/Index', [
            'members' => KarangTaruna::orderBy('id', 'desc')->get(),
        ]);
    }

    /**
     * Simpan data pengurus Karang Taruna baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:10240'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/karang-taruna');
            
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
                @chmod($destinationPath, 0777);
            }
            
            $file->move($destinationPath, $fileName);
            $validated['foto'] = 'uploads/karang-taruna/' . $fileName;
        }

        KarangTaruna::create($validated);

        return redirect()->back()->with('success', 'Data pengurus Karang Taruna berhasil ditambahkan.');
    }

    /**
     * Perbarui data pengurus Karang Taruna.
     */
    public function update(Request $request, KarangTaruna $karangTaruna)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'jabatan' => ['required', 'string', 'max:255'],
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,gif', 'max:10240'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            if ($karangTaruna->foto) {
                $oldPath = public_path($karangTaruna->foto);
                if (file_exists($oldPath) && !is_dir($oldPath)) {
                    @unlink($oldPath);
                }
                if (Storage::disk('public')->exists($karangTaruna->foto)) {
                    Storage::disk('public')->delete($karangTaruna->foto);
                }
            }

            $file = $request->file('foto');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path('uploads/karang-taruna');
            
            if (!file_exists($destinationPath)) {
                @mkdir($destinationPath, 0777, true);
                @chmod($destinationPath, 0777);
            }
            
            $file->move($destinationPath, $fileName);
            $validated['foto'] = 'uploads/karang-taruna/' . $fileName;
        }

        $karangTaruna->update($validated);

        return redirect()->back()->with('success', 'Data pengurus Karang Taruna berhasil diperbarui.');
    }

    /**
     * Hapus data pengurus Karang Taruna.
     */
    public function destroy(KarangTaruna $karangTaruna)
    {
        if ($karangTaruna->foto) {
            $oldPath = public_path($karangTaruna->foto);
            if (file_exists($oldPath) && !is_dir($oldPath)) {
                @unlink($oldPath);
            }
            if (Storage::disk('public')->exists($karangTaruna->foto)) {
                Storage::disk('public')->delete($karangTaruna->foto);
            }
        }

        $karangTaruna->delete();

        return redirect()->back()->with('success', 'Data pengurus Karang Taruna berhasil dihapus.');
    }
}
