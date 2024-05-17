<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Absensi;
use Illuminate\Http\Request;

class RekapAbsenTendikController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $role = 'Tendik';
        $absensi = Absensi::whereDate('jam_masuk', Carbon::today())->isNullSiswa()->get();
        $izin = Izin::whereDate('updated_at', Carbon::today())->whereHas('tendik', function ($query) use ($role) {
            $query->where('role', $role);
        })->get();
        return view('admin.rekapTendik', compact('absensi', 'izin', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $role = 'Tendik';
        $rowTableAbsensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('siswa_id')->distinct('tendik_id')->get(['tendik_id']);
        $absensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('siswa_id')->with('tendik')->get();
        $izin = Izin::whereBetween('created_at', [$start_date, $end_date])->whereHas('tendik', function ($query) use ($role) {
            $query->where('role', $role);
        })->get();
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

        $totalJamPerTendik = [];

        foreach ($izin as $izinTotal) {
            $jam_mulai = Carbon::parse($izinTotal->jam_mulai);
            $jam_berakhir = Carbon::parse($izinTotal->jam_berakhir);
            $selisihJam = $jam_mulai->floatDiffInHours($jam_berakhir);

            if (!isset($totalJamPerTendik[$izinTotal->id])) {
                $totalJamPerTendik[$izinTotal->id] = 0;
            }

            $totalJamPerTendik[$izinTotal->id] += $selisihJam;
        }

        foreach ($totalJamPerTendik as $key => $value) {
            $hours = floor($value);
            $minutes = ($value - $hours) * 60;

            if ($hours > 8) {
                $hours = 8;
                $minutes = 0;
            }

            if ($hours > 0 && $minutes > 0) {
                $totalJamPerTendik[$key] = "$hours jam $minutes menit";
            } elseif ($hours > 0) {
                $totalJamPerTendik[$key] = "$hours jam";
            } else {
                $totalJamPerTendik[$key] = "$minutes menit";
            }
        }

        return view('admin.rekapTendik', compact('absensi', 'izin', 'start_date', 'end_date', 'rowTableAbsensi', 'totalJamPerTendik', 'loopTanggal'));
    }
}
