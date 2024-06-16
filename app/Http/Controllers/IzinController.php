<?php

namespace App\Http\Controllers;

use App\Http\Requests\IzinRequest;
use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Tendik;
use App\Models\Siswa;

class IzinController extends Controller
{
    public function index()
    {
        $izin = Izin::orderBy('created_at', 'desc')->paginate(10);
        $tendik = tendik::get();
        $siswa = siswa::get();
        return view('admin.izin', compact('izin', 'tendik', 'siswa'));
    }
    public function store(IzinRequest $request)
    {
        $request->validated();
        $this->cari($request);

        return redirect()->to('/izin')->with('create', 'Data Izin Berhasil Dibuat');
    }
    public function edit($id)
    {
        $izin = Izin::findOrFail($id);
        return view('admin.izin', compact('izin'));
    }
    public function update(IzinRequest $request, $id)
    {
        $request->validated();

        $getSiswa = Siswa::where('nisn', $request->nama)
            ->first();

        $getTendik = Tendik::where('nik', $request->nama)
            ->first();

        if (is_null($getSiswa)) {
            Izin::findOrFail($id)->update([
                'tendik_id'    => $getTendik->id,
                'jenis_izin'   => $request->jenis_izin,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'keterangan'   => $request->keterangan
            ]);
        }

        if (is_null($getTendik)) {
            Izin::findOrFail($id)->update([
                'siswa_id'     => $getSiswa->id,
                'jenis_izin'   => $request->jenis_izin,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'keterangan'   => $request->keterangan
            ]);
        }

        return redirect()->to('/izin')->with('update', 'Data Izin Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Izin::findOrFail($id)->delete();
        return redirect()->to('/izin')->with('delete', 'Data Izin Berhasil Dihapus');
    }
    private function cari($request)
    {
        $getSiswa = Siswa::where('nisn', $request->nama)
            ->first();

        $getTendik = Tendik::where('nik', $request->nama)
            ->first();

        if (is_null($getSiswa)) {
            Izin::create([
                'tendik_id'    => $getTendik->id,
                'jenis_izin'   => $request->jenis_izin,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'keterangan'   => $request->keterangan
            ]);
        }

        if (is_null($getTendik)) {
            Izin::create([
                'siswa_id'     => $getSiswa->id,
                'jenis_izin'   => $request->jenis_izin,
                'jam_mulai'    => $request->jam_mulai,
                'jam_berakhir' => $request->jam_berakhir,
                'keterangan'   => $request->keterangan
            ]);
        }
    }
}
