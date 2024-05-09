<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Izin;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapAbsenSiswaController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $kelas = '';
        $absensi = Absensi::whereDate('jam_masuk', Carbon::today())->whereNull('tendik_id')->get();
        $izin = Izin::whereDate('updated_at', Carbon::today())->where('role', 'siswa')->get();
        return view('admin.rekapSiswa', compact('absensi', 'izin', 'start_date', 'end_date', 'kelas'));
    }
    public function filter(Request $request)
    {
        $start_date = $request->start_date;
        $end_date   = $request->end_date ? $request->end_date : Carbon::today();
        $kelas      = $request->kelas;

        $rowTableAbsensi = Absensi::whereBetween('created_at', [$start_date, $end_date])->whereNull('tendik_id')->whereHas('siswa', function ($query) use ($kelas) {
            $query->where('kelas', $kelas);
        })->distinct('siswa_id')->get(['siswa_id']);

        $absensi = Absensi::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->whereNull('tendik_id')
            ->whereHas('siswa', function ($query) use ($kelas) {
                $query->where('kelas', $kelas);
        })->get();

        $izin    = Izin::whereDate('created_at', '=', $start_date)->whereDate('created_at', '<=', $end_date)->where('role', 'siswa')->get();

        return view('admin.rekapSiswa', compact('absensi', 'izin', 'start_date', 'end_date', 'rowTableAbsensi', 'total_jam_lembur'));
    }
}
