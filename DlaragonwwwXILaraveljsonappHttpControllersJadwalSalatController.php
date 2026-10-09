<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class JadwalSalatController extends Controller
{
    public function index()
    {
        // Menggunakan API myquran untuk kota secara gratis tanpa perlu auth
        $response = Http::get('https://api.myquran.com/v2/sholat/kota/semua');
        $kotaData = [];
        if ($response->successful()) {
            $kotaData = $response->json()['data'] ?? [];
        }

        return view('QuranPesat.jadwal_salat', compact('kotaData'));
    }

    public function getJadwal(Request $request)
    {
        $idKota = $request->get('kota');
        $tahun = $request->get('tahun', date('Y'));
        $bulan = $request->get('bulan', date('m'));
        
        $response = Http::get("https://api.myquran.com/v2/sholat/jadwal/{$idKota}/{$tahun}/{$bulan}");
        
        if ($response->successful()) {
            return response()->json($response->json());
        }
        
        return response()->json(['status' => false]);
    }
}
