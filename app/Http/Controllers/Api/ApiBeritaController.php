<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Concerns\ManagesBerita;
use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApiBeritaController extends Controller
{
    use ManagesBerita;

    public function index(): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Berita::latestFirst()->get(),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $berita = $this->createBeritaFromRequest($request);

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil ditambahkan.',
            'data' => $berita,
        ], 201);
    }

    public function show($id): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => Berita::findOrFail($id),
        ]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $berita = $this->updateBeritaFromRequest($request, Berita::findOrFail($id));

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil diperbarui.',
            'data' => $berita,
        ]);
    }

    public function destroy($id): JsonResponse
    {
        $this->destroyBerita(Berita::findOrFail($id));

        return response()->json([
            'success' => true,
            'message' => 'Berita berhasil dihapus.',
        ]);
    }
}
