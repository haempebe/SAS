<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlatformMerdekaMengajarRequest;
use App\Models\PlatformMerdekaMengajar;
use App\Models\Tendik;
use Illuminate\Http\Request;

class PlatformMerdekaMengajarController extends Controller
{
    public function index()
    {
        $platform = PlatformMerdekaMengajar::paginate(10);
        $tendik = Tendik::get();
        return view('admin.platformMerdekaMengajar', compact('platform', 'tendik'));
    }
    public function store(PlatformMerdekaMengajarRequest $request)
    {
        $request->validated();
        $this->create($request);

        return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Dibuat');
    }
    public function edit($id)
    {
        $platform = PlatformMerdekaMengajar::findOrFail($id);
        return view('admin.platformMerdekaMengajar', compact('platform'));
    }
    public function update(PlatformMerdekaMengajarRequest $request, $id)
    {
        $request->validated();

        PlatformMerdekaMengajar::findOrFail($id)->update([
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
        PlatformMerdekaMengajar::findOrFail($id)->delete();
        return redirect()->to('/platform')->with('success', 'Data Platform Berhasil Dihapus');
    }
    private function create($request)
    {
        $getTendik = Tendik::where('nik', $request->tendik_id)
            ->first();

        PlatformMerdekaMengajar::create([
            'tendik_id'    => $getTendik->id,
            'topik'        => $request->topik,
            'tanggal'      => $request->tanggal,
            'jam_mulai'    => $request->jam_mulai,
            'jam_berakhir' => $request->jam_berakhir,
            'hasil'        => $request->hasil
        ]);
    }
}
