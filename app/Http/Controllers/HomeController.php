<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use App\Models\Tendik;
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
        $siswa = Siswa::get();
        $siswaCount = Siswa::count();
        $tendik = Tendik::get();
        $tendikCount = Tendik::count();
        return view('home', compact('tendik', 'siswa', 'tendikCount', 'siswaCount'));
    }
    public function masuk(Request $request)
    {
        $request->validate([
            'noid' => 'required_without_all:nama,kelas',
            'nama' => 'required_without_all:noid,kelas',
            'kelas' => 'required_without_all:noid,nama',
        ], [
            'required_without_all' => 'Isi setidaknya salah satu input agar data dapat dicari'
        ]);
        $siswaCount = Siswa::count();
        $tendikCount = Tendik::count();

        $noid = $request->noid;
        $nama = $request->nama;
        $kelas = $request->kelas;

        $getSiswa = Siswa::where('nisn', $noid)
            ->orWhere('nama', $nama)
            ->orWhere('kelas', $kelas)
            ->get();

        $getTendik = Tendik::where('nuptk', $noid)
            ->orWhere('nama', $nama)
            ->orWhere('role', $kelas)
            ->get();

        if ($getSiswa->isEmpty() && $getTendik->isEmpty()) {
            return redirect()->back()->with('message', 'Data tidak ditemukan.');
        }

        $masuk = 'modal-masuk';
        return view('home', compact('getSiswa', 'getTendik', 'siswaCount', 'tendikCount','masuk'));
    }
}
