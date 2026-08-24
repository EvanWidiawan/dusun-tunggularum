<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\PageVisit;
use Carbon\Carbon;
use Symfony\Component\HttpFoundation\Response;

class TrackPageVisit
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Hanya catat untuk request HTTP GET non-AJAX / non-Inertia partial reload atau request utama halaman publik
        if ($request->isMethod('GET') && !$request->routeIs('admin.*')) {
            try {
                $today = Carbon::today()->toDateString();
                PageVisit::firstOrCreate(
                    ['tanggal' => $today],
                    ['jumlah_kunjungan' => 0]
                )->increment('jumlah_kunjungan');
            } catch (\Exception $e) {
                // Ignore DB logging failure to prevent blocking user request
            }
        }

        return $response;
    }
}
