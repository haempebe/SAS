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

        Izin::create([
            'nama' => $request->nama,
            'role' => $request->role,
            'jenis_izin' => $request->jenis_izin,
            'jam_mulai' => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'keterangan' => $request->keterangan
        ]);

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

        Izin::findOrFail($id)->update([
            'nama' => $request->nama,
            'role' => $request->role,
            'jenis_izin' => $request->jenis_izin,
            'jam_mulai' => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->to('/izin')->with('update', 'Data Izin Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Izin::findOrFail($id)->delete();
        return redirect()->to('/izin')->with('delete', 'Data Izin Berhasil Dihapus');
    }
}
