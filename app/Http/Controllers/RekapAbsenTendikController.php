<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Absensi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RekapAbsenTendikController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $absensi = Absensi::whereDate('jam_masuk', Carbon::today())->whereNull('siswa_id')->get();
        $izin = Izin::whereDate('updated_at', Carbon::today())->where('role', 'tendik')->get();
        return view('admin.rekapTendik', compact('absensi', 'izin', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date   = $request->end_date ? $request->end_date : Carbon::today();
        $carbonStart = Carbon::parse($start_date)->startOfMonth();
        $carbonEnd = Carbon::parse($end_date)->endOfMonth();

        $rowTableAbsensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('siswa_id')->distinct('tendik_id')->get(['tendik_id']);

        $absensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('siswa_id')->get();
        $izin = Izin::whereBetween('created_at', [$start_date, $end_date])->where('role', 'tendik')->get();

        $totalJamPerTendik = [];

        // Loop melalui setiap entri izin
        foreach ($izin as $izinTotal) {
            // Hitung selisih jam_mulai dan jam_berakhir dalam format jam
            $jam_mulai = Carbon::parse($izinTotal->jam_mulai);
            $jam_berakhir = Carbon::parse($izinTotal->jam_berakhir);
            $selisihJam = $jam_berakhir->diffInHours($jam_mulai);

            // Tambahkan total jam ke dalam array totalJamPerTendik berdasarkan tendik_id
            if (!isset($totalJamPerTendik[$izinTotal->tendik_id])) {
                $totalJamPerTendik[$izinTotal->tendik_id] = 0;
            }
            $totalJamPerTendik[$izinTotal->tendik_id] += $selisihJam;
        }

        return view('admin.rekapTendik', compact('absensi', 'izin', 'start_date', 'end_date', 'rowTableAbsensi', 'totalJamPerTendik'));
    }
}
