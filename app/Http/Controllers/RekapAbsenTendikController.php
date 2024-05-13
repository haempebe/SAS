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
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $rowTableAbsensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('siswa_id')->distinct('tendik_id')->get(['tendik_id']);
        $absensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('siswa_id')->with('tendik')->get();
        $izin = Izin::whereBetween('created_at', [$start_date, $end_date])->where('role', 'tendik')->get();
        $loopTanggal = [];
        $currentDate = $start_date->copy();
        while ($currentDate <= $end_date) {
            $loopTanggal[] = [
                'date' => $currentDate->copy()->toDateString(),
                'day' => $currentDate->copy()->format('d'),
                'name_tendik' => $absensi->pluck('tendik.nama')->unique()->toArray()
            ];
            $currentDate->addDay();
        }

        // dd($loopTanggal);



        $totalJamPerTendik = [];

        foreach ($izin as $izinTotal) {
            // Hitung selisih jam_mulai dan jam_berakhir dalam format jam
            $jam_mulai = Carbon::parse($izinTotal->jam_mulai);
            $jam_berakhir = Carbon::parse($izinTotal->jam_berakhir);
            $selisihJam = $jam_mulai->diffInHours($jam_berakhir);

            // Tambahkan total jam ke dalam array totalJamPerTendik berdasarkan tendik_id
            if (!isset($totalJamPerTendik[$izinTotal->id])) {
                $totalJamPerTendik[$izinTotal->id] = 0;
            }

            $totalJamPerTendik[$izinTotal->id] += $selisihJam;
        }

        return view('admin.rekapTendik', compact('absensi', 'izin', 'start_date', 'end_date', 'rowTableAbsensi', 'totalJamPerTendik', 'loopTanggal'));
    }
}
