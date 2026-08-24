<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KarangTaruna;
use App\Models\Galeri;
use App\Models\PageVisit;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class ApiDashboardController extends Controller
{
    public function index(): JsonResponse
    {
        $today = Carbon::today()->toDateString();

        $totalVisits = PageVisit::sum('jumlah_kunjungan');
        $todayVisitRecord = PageVisit::where('tanggal', $today)->first();
        $todayVisits = $todayVisitRecord ? $todayVisitRecord->jumlah_kunjungan : 0;

        $totalKarangTaruna = KarangTaruna::count();
        $totalGaleri = Galeri::count();

        $recentVisits = PageVisit::orderBy('tanggal', 'desc')
            ->take(7)
            ->get()
            ->reverse()
            ->values();

        return response()->json([
            'success' => true,
            'stats' => [
                'totalVisits' => (int) $totalVisits,
                'todayVisits' => (int) $todayVisits,
                'totalKarangTaruna' => $totalKarangTaruna,
                'totalGaleri' => $totalGaleri,
            ],
            'recentVisits' => $recentVisits,
        ]);
    }
}
