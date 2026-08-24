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
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('karang-taruna', 'public');
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
            'foto' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'deskripsi' => ['nullable', 'string'],
        ]);

        if ($request->hasFile('foto')) {
            if ($karangTaruna->foto && Storage::disk('public')->exists($karangTaruna->foto)) {
                Storage::disk('public')->delete($karangTaruna->foto);
            }
            $validated['foto'] = $request->file('foto')->store('karang-taruna', 'public');
        }

        $karangTaruna->update($validated);

        return redirect()->back()->with('success', 'Data pengurus Karang Taruna berhasil diperbarui.');
    }

    /**
     * Hapus data pengurus Karang Taruna.
     */
    public function destroy(KarangTaruna $karangTaruna)
    {
        if ($karangTaruna->foto && Storage::disk('public')->exists($karangTaruna->foto)) {
            Storage::disk('public')->delete($karangTaruna->foto);
        }

        $karangTaruna->delete();

        return redirect()->back()->with('success', 'Data pengurus Karang Taruna berhasil dihapus.');
    }
}
