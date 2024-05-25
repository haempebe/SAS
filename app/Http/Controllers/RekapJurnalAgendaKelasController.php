<?php

namespace App\Http\Controllers;

use App\Models\JurnalAgendaKelas;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RekapJurnalAgendaKelasController extends Controller
{
    public function index()
    {
        $start_date = '';
        $end_date = '';
        $jurnal = JurnalAgendaKelas::whereDate('tanggal', Carbon::today())->get();
        return view('admin.rekapJurnal', compact('jurnal', 'start_date', 'end_date'));
    }
    public function filter(Request $request)
    {
        $start_date = Carbon::parse($request->input('start_date'));
        $end_date = Carbon::parse($request->input('end_date'));
        $jurnal = JurnalAgendaKelas::whereBetween('tanggal', [$start_date, $end_date])->get();
        return view('admin.rekapJurnal', compact('jurnal', 'start_date', 'end_date'));
    }
}
