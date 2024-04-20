<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Izin;
use App\Models\Tendik;
use App\Models\Siswa;

class IzinController extends Controller
{
    public function index()
    {
        $izin = Izin::orderBy('created_at','desc')->paginate(10);
        $tendik = tendik::get();
        $siswa = siswa::get();
        return view('admin.izin', compact('izin', 'tendik', 'siswa'));
    }
    public function store(Request $request)
    {
        $request->validate(
            [
                'nama'           => 'required',
                'role'           => 'required',
                'jenis_izin'  => 'required',
                'keterangan'     => 'required',
            ]
        );

        $izin = new Izin;

        $izin->nama           = $request->nama;
        $izin->role           = $request->role;
        $izin->jenis_izin  = $request->jenis_izin;
        $izin->keterangan  = $request->keterangan;

        $izin->save();


        return redirect()->to('/izin')->with('status', 'Data Izin Berhasil Dibuat');
    }
    public function edit($id)
    {
        $izin = Izin::findOrFail($id);
        return view('admin.izin', compact('izin'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'         => 'required',
            'role'         => 'required',
            'jenis_izin'   => 'required',
            'keterangan'   => 'required',
        ]);

        $izin = Izin::findOrFail($id);

        $izin->nama        = $request->nama;
        $izin->role        = $request->role;
        $izin->jenis_izin  = $request->jenis_izin;
        $izin->keterangan  = $request->keterangan;

        $izin->save();

        return redirect()->to('/izin')->with('update', 'Data Izin Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        Izin::findOrFail($id)->delete();
        return redirect()->to('/izin')->with('delete', 'Data Izin Berhasil Dihapus');
    }
}
