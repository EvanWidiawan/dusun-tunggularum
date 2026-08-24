<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KarangTaruna;
use App\Models\Galeri;
use App\Models\PageVisit;
use Carbon\Carbon;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(): Response
    {
        $today = Carbon::today()->toDateString();

        $totalVisits = PageVisit::sum('jumlah_kunjungan');
        $todayVisitRecord = PageVisit::where('tanggal', $today)->first();
        $todayVisits = $todayVisitRecord ? $todayVisitRecord->jumlah_kunjungan : 0;

        $totalKarangTaruna = KarangTaruna::count();
        $totalGaleri = Galeri::count();

        // 7 Hari terakhir untuk chart/grafik ringkas
        $recentVisits = PageVisit::orderBy('tanggal', 'desc')
            ->take(7)
            ->get()
            ->reverse()
            ->values();

        return Inertia::render('Admin/Dashboard', [
            'stats' => [
                'totalVisits' => $totalVisits,
                'todayVisits' => $todayVisits,
                'totalKarangTaruna' => $totalKarangTaruna,
                'totalGaleri' => $totalGaleri,
            ],
            'recentVisits' => $recentVisits,
        ]);
    }
}
