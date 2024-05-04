<?php

namespace App\Http\Controllers;

use App\Http\Requests\AbsenRequest;
use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Waktu;
use App\Models\Tendik;
use App\Models\Absensi;

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
        $waktu = Waktu::find(1);
        return view('home', compact('tendikCount', 'siswaCount', 'absensi', 'waktu'));
    }
    public function masuk(AbsenRequest $request)
    {
        $request->validated();

        $getSiswa = Siswa::where('nisn', $request->noid)
            ->first();

        $getTendik = Tendik::where('nik', $request->noid)
            ->first();

        if (is_null($getSiswa) && is_null($getTendik)) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $absenExist = Absensi::whereDate('jam_masuk', '=', Carbon::today())
            ->where(function ($query) use ($getSiswa, $getTendik) {
                if ($getSiswa) {
                    $query->where('siswa_id', $getSiswa->nisn);
                } else {
                    $query->where('tendik_id', $getTendik->nik);
                }
            })
            ->first();

        if ($absenExist) {
            return redirect()->back()->with('message', 'Anda sudah absen masuk hari ini.');
        }

        $waktu = Waktu::find(1);

        $waktuTerkini = Carbon::now();

        if (is_null($getSiswa)) {
            $status = '';

            $jamMasukTendik =  $getTendik->jam_masuk;

            if ($waktuTerkini->greaterThan($jamMasukTendik)) {
                $status = 'Terlambat';
            } else {
                $status = 'Tepat Waktu';
            }
            Absensi::create([
                'tendik_id' => $getTendik->nik,
                'jam_masuk' => $waktuTerkini,
                'status'    => $status
            ]);
        } elseif (is_null($getTendik)) {
            $status = '';

            $jamMasuk = $waktu->jam_masuk;

            if ($waktuTerkini->greaterThan($jamMasuk)) {
                $status = 'Terlambat';
            } else {
                $status = 'Tepat Waktu';
            }

            Absensi::create([
                'siswa_id'  => $getSiswa->nisn,
                'jam_masuk' => $waktuTerkini,
                'status'    => $status
            ]);
        }

        return redirect()->back()->with('success', 'Berhasil melakukan absensi masuk');
    }

    public function pulang(AbsenRequest $request)
    {
        $request->validated();

        $getSiswa = Siswa::where('nisn', $request->noid)
            ->first();

        $getTendik = Tendik::where('nik', $request->noid)
            ->first();

        if (is_null($getSiswa) && is_null($getTendik)) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $waktu = Waktu::find(1);
        $waktuTerkini = Carbon::now();

        if (is_null($getSiswa)) {
            $absensi = Absensi::where('tendik_id', $getTendik->nik)
                ->whereNull('jam_pulang')
                ->whereDate('jam_masuk', Carbon::today())
                ->first();

            $jamPulangTendik =  '';
            $jamMasukTendik = strtotime($getTendik->jam_masuk);
            $newJamPulangTendik = strtotime($getTendik->jam_pulang);
            if ($newJamPulangTendik < $jamMasukTendik) {
                $jamMasukDate = Carbon::parse($absensi->jam_masuk)->format('Y-m-d');
                $jamPulangTendik = Carbon::parse($jamMasukDate . ' ' . $jamPulangTendik)->addDay();
            } else {
                $jamPulangTendik =  $getTendik->jam_pulang;
            }

            if ($absensi) {
                if ($waktuTerkini->lessThan($jamPulangTendik)) {
                    return redirect()->back()->with('error', 'Belum Jam Pulang');
                } else {
                    $absensi->update(['jam_pulang' => $waktuTerkini]);
                }
            } else {
                return redirect()->back()->with('error', 'Belum melakukan absen masuk.');
            }
        } elseif (is_null($getTendik)) {
            $absensi = Absensi::where('siswa_id', $getSiswa->nisn)
                ->whereNull('jam_pulang')
                ->whereDate('jam_masuk', Carbon::today())
                ->first();

            $jamPulang =  $waktu->jam_pulang;
            if ($absensi) {
                if ($waktuTerkini->lessThan($jamPulang)) {
                    return redirect()->back()->with('error', 'Belum Jam Pulang');
                } else {
                    $absensi->update(['jam_pulang' => $waktuTerkini]);
                }
            } else {
                return redirect()->back()->with('error', 'Anda belum melakukan absen masuk.');
            }
        }

        return redirect()->back()->with('success', 'Berhasil melakukan absensi pulang');
    }
}
