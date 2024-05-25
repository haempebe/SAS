<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatformMerdekaBelajarRequest;
use App\Models\PlatformMerdakaBelajar;
use App\Models\Tendik;
use Illuminate\Http\Request;

class PlatformMerdekaBelajarController extends Controller
{
    public function index()
    {
        $platform = PlatformMerdakaBelajar::paginate(10);
        $tendik = Tendik::get();
        return view('admin.platformMerdekaBelajar', compact('platform', 'tendik'));
    }
    public function store(PlatformMerdekaBelajarRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Dibuat');
    }
    public function edit($id)
    {
        $platform = PlatformMerdakaBelajar::findOrFail($id);
        return view('admin.platformMerdekaBelajar', compact('platform'));
    }
    public function update(PlatformMerdekaBelajarRequest $request, $id)
    {
        $request->validated();

        PlatformMerdakaBelajar::findOrFail($id)->update([
            'tendik_id'    => $request->tendik_id,
            'topik'        => $request->topik,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'hasil'        => $request->hasil
        ]);

        return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Diperbarui');
    }
    public function destroy($id)
    {
        PlatformMerdakaBelajar::findOrFail($id)->delete();
        return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Dihapus');
    }
    private function create($request)
    {
        $getTendik = Tendik::where('nik', $request->tendik_id)
            ->first();

        PlatformMerdakaBelajar::create([
            'tendik_id'    => $getTendik->id,
            'topik'        => $request->topik,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'hasil'        => $request->hasil
        ]);
    }
}
