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

        return response()->json([
            'success' => true,
            'message' => 'Data pengurus Karang Taruna berhasil diperbarui.',
            'data' => $karangTaruna,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $karangTaruna = KarangTaruna::findOrFail($id);

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

        return response()->json([
            'success' => true,
            'message' => 'Data pengurus Karang Taruna berhasil dihapus.',
        ]);
    }
}
