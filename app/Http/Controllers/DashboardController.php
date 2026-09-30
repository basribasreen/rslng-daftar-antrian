<?php

namespace App\Http\Controllers;

use App\Models\dashboard;
use App\Models\Dokter;
use App\Models\Pasien;
use App\Models\Pendaftaran;
use App\Models\Poli;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        try{
            $statusHariIni = Pendaftaran::query()
            ->whereDate('tanggal', today())
            ->selectRaw('status, count(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

            $data = [
                'total_pasien' => Pasien::count(),
                'total_dokter' => Dokter::count(),
                'total_poli'   => Poli::count(),
                'hari_ini'     => $statusHariIni->sum(),
                'menunggu'     => $statusHariIni['menunggu'] ?? 0,
                'dipanggil'    => $statusHariIni['dipanggil'] ?? 0,
                'selesai'      => $statusHariIni['selesai'] ?? 0,
                'bulan_ini'    => Pendaftaran::whereBetween('tanggal', [
                                    now()->startOfMonth()->toDateString(),
                                    now()->endOfMonth()->toDateString(),
                                ])->count(),
            ];
            return view('dashboard', compact('data'));
        } catch (QueryException $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus data. Silakan coba lagi.');
        }
    }

}
