<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use File;

class SiswaController extends Controller
{
    public function index()
    {
        $siswa = Siswa::get();
        return view('admin.siswa', compact('siswa'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'nisn'           => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'kelas'          => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg',
        ]);


        $fotoName = time() . '.' . $request->foto->extension();

        $request->foto->move(public_path('img/foto'), $fotoName);

        $siswa = new Siswa;

        $siswa->nisn           = $request->nisn;
        $siswa->nama           = $request->nama;
        $siswa->jenis_kelamin  = $request->jenis_kelamin;
        $siswa->kelas          = $request->kelas;
        $siswa->tempat_lahir   = $request->tempat_lahir;
        $siswa->tanggal_lahir  = $request->tanggal_lahir;
        $siswa->role           = $request->role;
        $siswa->nomor_whatsapp = $request->nomor_whatsapp;
        $siswa->foto           = $request->foto;

        $siswa->save();

        return redirect('/siswa')->with('status', 'Data Siswa Berhasil Dibuat');
    }
    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('admin.siswa', compact('siswa'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn'           => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'kelas'          => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg',
        ]);


        if ($request->has('foto')) {
            $siswa = Siswa::find($id);

            $path = "img/foto/";
            File::delete($path . $siswa->foto);

            $fotoName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img/foto'), $fotoName);

            $siswa->nisn           = $request->nisn;
            $siswa->nama           = $request->nama;
            $siswa->jenis_kelamin  = $request->jenis_kelamin;
            $siswa->kelas          = $request->kelas;
            $siswa->tempat_lahir   = $request->tempat_lahir;
            $siswa->tanggal_lahir  = $request->tanggal_lahir;
            $siswa->role           = $request->role;
            $siswa->nomor_whatsapp = $request->nomor_whatsapp;
            $siswa->foto           = $request->foto;

            $siswa->save();

            return redirect('/siswa');
        } else {
            $siswa = Siswa::find($id);

            $siswa->nisn           = $request->nisn;
            $siswa->nama           = $request->nama;
            $siswa->jenis_kelamin  = $request->jenis_kelamin;
            $siswa->kelas          = $request->kelas;
            $siswa->tempat_lahir   = $request->tempat_lahir;
            $siswa->tanggal_lahir  = $request->tanggal_lahir;
            $siswa->role           = $request->role;
            $siswa->nomor_whatsapp = $request->nomor_whatsapp;
            $siswa->foto           = $request->foto;

            $siswa->save();

            return redirect('/siswa');
        }
    }
    public function destroy($id)
    {
        $siswa = Siswa::find($id);

        $path = "img/cover/";
        File::delete($path . $siswa->cover);
        $siswa->delete();

        return redirect('/siswa')->with('delete', 'Data Siswa Berhasil Dihapus');
    }
}