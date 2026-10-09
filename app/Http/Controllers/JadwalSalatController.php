<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalSalatController extends Controller
{
    /**
     * Display prayer schedule page with province options.
     */
    public function index()
    {
        $response = Http::get('https://equran.id/api/v2/shalat/provinsi');
        $provinsiData = $response->successful() ? ($response->json('data') ?? []) : [];

        return view('QuranPesat.jadwal_salat', compact('provinsiData'));
    }

    /**
     * Get list of regencies/cities in a province via AJAX.
     */
    public function getKabupaten(Request $request)
    {
        $provinsi = $request->input('provinsi') ?? $request->query('provinsi');

        if (!$provinsi) {
            return response()->json([
                'code' => 400,
                'message' => 'Parameter provinsi wajib diisi',
                'data' => []
            ], 400);
        }

        $response = Http::post('https://equran.id/api/v2/shalat/kabkota', [
            'provinsi' => $provinsi,
        ]);

        return response()->json($response->json());
    }

    /**
     * Get monthly prayer times for a city via AJAX.
     */
    public function getSalat(Request $request)
    {
        $provinsi = $request->input('provinsi') ?? $request->query('provinsi');
        $kabkota = $request->input('kabkota') ?? $request->query('kabkota');
        $bulan = (int) ($request->input('bulan') ?? $request->query('bulan', date('n')));
        $tahun = (int) ($request->input('tahun') ?? $request->query('tahun', date('Y')));

        if (!$provinsi || !$kabkota) {
            return response()->json([
                'code' => 400,
                'message' => 'Parameter provinsi dan kabkota wajib diisi',
                'data' => null
            ], 400);
        }

        $response = Http::post('https://equran.id/api/v2/shalat', [
            'provinsi' => $provinsi,
            'kabkota' => $kabkota,
            'bulan' => $bulan,
            'tahun' => $tahun,
        ]);

        return response()->json($response->json());
    }
}
