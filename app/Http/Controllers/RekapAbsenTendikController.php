<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Izin;
use App\Models\Absensi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

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

        $absensi = Absensi::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->whereNull('siswa_id')->get();
        $izin    = Izin::whereDate('created_at', '=', $start_date)->whereDate('created_at', '<=', $end_date)->where('role', 'tendik')->get();

        return view('admin.rekapTendik', compact('absensi', 'izin', 'start_date', 'end_date'));
    }
    public function view_pdf()
    {
        return view('admin.tendikPdf');
    }
    public function pdf(Request $request)
    {
        $start_date = $request->start_date;
        $end_date   = $request->end_date ? $request->end_date : Carbon::today();

        $absensi = Absensi::whereDate('created_at', '>=', $start_date)->whereDate('created_at', '<=', $end_date)->whereNull('siswa_id')->get();
        $izin    = Izin::whereDate('created_at', '=', $start_date)->whereDate('created_at', '<=', $end_date)->where('role', 'tendik')->get();

        return view('admin.tendikPdf', compact('start_date', 'end_date', 'absensi', 'izin'));
    }
    // function export_pdf(Request $request)
    // {
    //     $start_date = $request->start_date;
    //     $end_date   = $request->end_date ? $request->end_date : Carbon::today();
    //     $absensi = Absensi::whereDate('created_at', '=', $start_date)->whereDate('created_at', '<=', $end_date)->whereNull('siswa_id')->get();
    //     $izin    = Izin::whereDate('created_at', '=', $start_date)->whereDate('created_at', '<=', $end_date)->where('role', 'tendik')->get();

    //     $data = [
    //         'title' => 'Rekap Absen Tendik',
    //         'Tanggal' => date('m/d/y'),
    //         'absensi' => $absensi,
    //         'izin' => $izin,
    //         'start_date' => $start_date,
    //         'end_date' => $end_date
    //     ];

    //     $pdf = PDF::loadView('admin.pdf', $data);
    //     return $pdf->download('absen.pdf');
    // }
}
