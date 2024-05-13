<?php

namespace App\Http\Controllers;

use App\Models\Tendik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class TendikController extends Controller
{
    public function index()
    {
        $tendik = Tendik::orderBy('nama')->paginate(10);
        return view('admin.tendik', compact('tendik'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'nik'            => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg',
        ]);

        $fotoName = time() . '.' . $request->foto->extension();

        $request->foto->move(public_path('img/foto'), $fotoName);

        $tendik = new Tendik;

        $tendik->nik          = $request->nik;
        $tendik->nama           = $request->nama;
        $tendik->jenis_kelamin  = $request->jenis_kelamin;
        $tendik->tempat_lahir   = $request->tempat_lahir;
        $tendik->tanggal_lahir  = $request->tanggal_lahir;
        $tendik->role           = $request->role;
        $tendik->jam_masuk      = $request->jam_masuk;
        $tendik->jam_pulang     = $request->jam_pulang;
        $tendik->nomor_whatsapp = $request->nomor_whatsapp;
        $tendik->foto           = $fotoName;

        dd($tendik);

        $tendik->save();

        return redirect('/tendik')->with('create', 'Data Tendik Berhasil Dibuat');
    }
    public function edit($id)
    {
        $tendik = Tendik::findOrFail($id);
        return view('admin.tendik', compact('tendik'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik'            => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'jam_masuk'      => 'required',
            'jam_pulang'     => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'image|mimes:jpg,png,jpeg'
        ]);


        if ($request->has('foto')) {
            $tendik = Tendik::find($id);

            $path = "img/foto/";
            File::delete($path . $tendik->foto);

            $fotoName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img/foto'), $fotoName);

            $tendik->nik          = $request->nik;
            $tendik->nama           = $request->nama;
            $tendik->jenis_kelamin  = $request->jenis_kelamin;
            $tendik->tempat_lahir   = $request->tempat_lahir;
            $tendik->tanggal_lahir  = $request->tanggal_lahir;
            $tendik->role           = $request->role;
            $tendik->jam_masuk      = $request->jam_masuk;
            $tendik->jam_pulang     = $request->jam_pulang;
            $tendik->nomor_whatsapp = $request->nomor_whatsapp;
            $tendik->foto           = $fotoName;

            $tendik->save();

            return redirect('/tendik')->with('update', 'Data Tendik Berhasil Diperbarui');
        } else {
            $tendik = Tendik::find($id);

            $tendik->nik          = $request->nik;
            $tendik->nama           = $request->nama;
            $tendik->jenis_kelamin  = $request->jenis_kelamin;
            $tendik->tempat_lahir   = $request->tempat_lahir;
            $tendik->tanggal_lahir  = $request->tanggal_lahir;
            $tendik->role           = $request->role;
            $tendik->jam_masuk      = $request->jam_masuk;
            $tendik->jam_pulang     = $request->jam_pulang;
            $tendik->nomor_whatsapp = $request->nomor_whatsapp;

            $tendik->save();

            return redirect('/tendik')->with('update', 'Data Tendik Berhasil Diperbarui');
        }
    }
    public function destroy($id)
    {
        $tendik = Tendik::find($id);

        $path = "img/cover/";
        File::delete($path . $tendik->cover);
        $tendik->delete();

        return redirect('/tendik')->with('delete', 'Data Tendik Berhasil Dihapus');
    }
    public function show($id)
    {
        $tendik = Tendik::find($id);
        return view('admin.izin', ['tendik' => $tendik]);
    }
}
