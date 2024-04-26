<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Tendik;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $siswaCount = Siswa::count();
        $tendikCount = Tendik::count();
        $absensi = Absensi::whereDate('jam_masuk', Carbon::today())->get();
        return view('home', compact('tendikCount', 'siswaCount', 'absensi'));
    }
    public function masuk(Request $request)
    {
        $request->validate([
            'noid' => 'required_without_all:nama,kelas',
            'nama' => 'required_without_all:noid,kelas',
        ], [
            'required_without_all' => 'Isi setidaknya salah satu input agar data dapat dicari'
        ]);

        $getSiswa = Siswa::where('nisn', $request->noid)
            ->orWhere('nama', $request->nama)
            ->first();

        $getTendik = Tendik::where('nik', $request->noid)
            ->orWhere('nama', $request->nama)
            ->first();

        if (is_null($getSiswa) && is_null($getTendik)) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $currentDateTime = Carbon::now();

        if (is_null($getSiswa)) {
            Absensi::create([
                'tendik_id' => $request->noid,
                'jam_masuk' => $currentDateTime,
            ]);
        } elseif (is_null($getTendik)) {
            Absensi::create([
                'siswa_id' => $request->noid,
                'jam_masuk' => $currentDateTime,
            ]);
        }

        return redirect()->back()->with('success', 'Siswa masuk');
    }

    public function pulang(Request $request)
    {
        $request->validate([
            'noid' => 'required_without_all:nama,kelas',
            'nama' => 'required_without_all:noid,kelas',
        ], [
            'required_without_all' => 'Isi setidaknya salah satu input agar data dapat dicari'
        ]);

        $getSiswa = Siswa::where('nisn', $request->noid)
            ->orWhere('nama', $request->nama)
            ->first();

        $getTendik = Tendik::where('nik', $request->noid)
            ->orWhere('nama', $request->nama)
            ->first();

        if (is_null($getSiswa) && is_null($getTendik)) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $currentDateTime = Carbon::now();

        if (is_null($getSiswa)) {
            $absensi = Absensi::where('tendik_id', $request->noid)
                ->whereNull('jam_pulang')
                ->whereDate('jam_masuk', Carbon::today())
                ->first();

            if ($absensi) {
                $absensi->update(['jam_pulang' => $currentDateTime]);
            } else {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk.');
            }
        } elseif (is_null($getTendik)) {
            $absensi = Absensi::where('siswa_id', $request->noid)
                ->whereNull('jam_pulang')
                ->whereDate('jam_masuk', Carbon::today())
                ->first();

            if ($absensi) {
                $absensi->update(['jam_pulang' => $currentDateTime]);
            } else {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk.');
            }
        }

        return redirect()->back()->with('success', 'Siswa pulang');
    }
}
