<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tendik;
use File;

class TendikController extends Controller
{
    public function index()
    {
        $tendik = Tendik::get();
        return view('admin.tendik', compact('tendik'));
    }
    public function store(Request $request)
    {

        $request->validate([
            'nuptk'          => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg',
        ]);




        $fotoName = time() . '.' . $request->foto->extension();

        $request->foto->move(public_path('img/foto'), $fotoName);

        $tendik = new Tendik;

        $tendik->nuptk          = $request->nuptk;
        $tendik->nama           = $request->nama;
        $tendik->jenis_kelamin  = $request->jenis_kelamin;
        $tendik->tempat_lahir   = $request->tempat_lahir;
        $tendik->tanggal_lahir  = $request->tanggal_lahir;
        $tendik->role           = $request->role;
        $tendik->nomor_whatsapp = $request->nomor_whatsapp;
        $tendik->foto           = $request->foto;

        $tendik->save();

        return redirect('/tendik')->with('status', 'added data successfully');
    }
    public function edit($id)
    {
        $tendik = Tendik::findOrFail($id);
        return view('admin.tendik', compact('tendik'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'nuptk'          => 'required',
            'nama'           => 'required',
            'jenis_kelamin'  => 'required',
            'tempat_lahir'   => 'required',
            'tanggal_lahir'  => 'required',
            'role'           => 'required',
            'nomor_whatsapp' => 'required',
            'foto'           => 'required|image|mimes:jpg,png,jpeg'
        ]);


        if ($request->has('foto')) {
            $tendik = Tendik::find($id);

            $path = "img/foto/";
            File::delete($path . $tendik->foto);

            $fotoName = time() . '.' . $request->foto->extension();

            $request->foto->move(public_path('img/foto'), $fotoName);

            $tendik->nuptk          = $request->nuptk;
            $tendik->nama           = $request->nama;
            $tendik->jenis_kelamin  = $request->jenis_kelamin;
            $tendik->tempat_lahir   = $request->tempat_lahir;
            $tendik->tanggal_lahir  = $request->tanggal_lahir;
            $tendik->role           = $request->role;
            $tendik->nomor_whatsapp = $request->nomor_whatsapp;
            $tendik->foto           = $request->foto;

            $tendik->save();

            return redirect('/tendik');
        } else {
            $tendik = Tendik::find($id);

            $tendik->nuptk          = $request->nuptk;
            $tendik->nama           = $request->nama;
            $tendik->jenis_kelamin  = $request->jenis_kelamin;
            $tendik->tempat_lahir   = $request->tempat_lahir;
            $tendik->tanggal_lahir  = $request->tanggal_lahir;
            $tendik->role           = $request->role;
            $tendik->nomor_whatsapp = $request->nomor_whatsapp;
            $tendik->foto           = $request->foto;

            $tendik->save();

            return redirect('/tendik');
        }
    }
    public function destroy($id)
    {
        $tendik = Tendik::find($id);

        $path = "img/cover/";
        File::delete($path . $tendik->cover);
        $tendik->delete();

        return redirect('/tendik')->with('success', 'success, data deleted');
    }
}
