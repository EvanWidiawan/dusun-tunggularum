<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KarangTaruna;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiKarangTarunaController extends Controller
{
    public function index(): JsonResponse
    {
        $members = KarangTaruna::orderBy('id', 'desc')->get();

        return response()->json([
            'success' => true,
            'data' => $members,
        ]);
    }

    public function store(Request $request): JsonResponse
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

        $member = KarangTaruna::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pengurus Karang Taruna berhasil ditambahkan.',
            'data' => $member,
        ], 201);
    }

    public function show(KarangTaruna $karangTaruna): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $karangTaruna,
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $karangTaruna = KarangTaruna::findOrFail($id);

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

        return response()->json([
            'success' => true,
            'message' => 'Data pengurus Karang Taruna berhasil diperbarui.',
            'data' => $karangTaruna,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $karangTaruna = KarangTaruna::findOrFail($id);

        if ($karangTaruna->foto && Storage::disk('public')->exists($karangTaruna->foto)) {
            Storage::disk('public')->delete($karangTaruna->foto);
        }

        $karangTaruna->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pengurus Karang Taruna berhasil dihapus.',
        ]);
    }
}
