{{-- edit jam --}}
<div class="modal modal-blur fade" id="modal-edit-jam" tabindex="-1" aria-modal="false" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ubah Jam Siswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('waktu.update', $waktu->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="jam_masuk">Jam Masuk</label>
                                <input autocomplete="off" type="text" name="jam_masuk" class="form-control"
                                    data-mask="00:00" data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                    value="{{ $waktu->jam_masuk }}">
                            </div>
                            @error('jam_masuk')
                                <p class="text-red">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label" for="jam_Pulang">Jam Pulang</label>
                                <input autocomplete="off" type="text" name="jam_pulang" class="form-control"
                                    data-mask="00:00" data-mask-visible="true" placeholder="00:00" autocomplete="off"
                                    value="{{ $waktu->jam_pulang }}">
                            </div>
                            @error('jam_pulang')
                                <p class="text-red">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
            </form>
        </div>
    </div>
</div>

@foreach ($absensi as $item)
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAbsensi-{{ $item->id }}"
        aria-labelledby="offcanvasEndLabel">
        <div class="offcanvas-header">
            <h2 class="offcanvas-title" id="offcanvasEndLabel">Data Peserta Absensi</h2>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <div class="container-fluid">
                @if ($item->tendik_id == null)
                    <div class="page-header m-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    Role
                                </div>
                                <h2 class="page-title">
                                    {{ $item->siswa->role }}
                                </h2>
                            </div>
                            <div class="col-auto ms-auto">
                                <h3 class="m-0">Tanggal Masuk:</h3>
                                <p>
                                    {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') ?? null }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-5">
                            <div class="rounded-4">
                                <img src="{{ asset('img/foto/' . $item->siswa->foto) ?? asset('static/avatars/000f.jpg') }}"
                                    style="min-height: 300px;object-fit:cover;" class="rounded-4" alt="">
                            </div>
                        </div>
                        <div class="col-7 ps-3">
                            <h2>Data : </h2>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <td class="align-top"><strong>Nama</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Kelas</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->siswa->kelas }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>NISN</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->siswa->nisn }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Jenis Kelamin</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->siswa->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>TTL</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->siswa->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($item->siswa->tanggal_lahir)->format('d-m-Y') ?? null }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>No. WA</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->siswa->nomor_whatsapp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Jam Masuk</strong> </td>
                                        <td class="ps-2 align-top">:
                                            {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H : i') ?? null }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Tanggal Masuk</strong> </td>
                                        <td class="ps-2 align-top">:
                                            <span class="badge bg-yellow text-dark">
                                                {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') ?? null }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Status</strong> </td>
                                        <td class="ps-2 align-top">:
                                            @if ($item->status == 'Terlambat')
                                                <span class="badge bg-red text-red-fg">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-green text-green-fg">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                @elseif ($item->siswa_id == null)
                    <div class="page-header m-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="page-pretitle">
                                    Role
                                </div>
                                <h2 class="page-title">
                                    {{ $item->tendik->role }}
                                </h2>
                            </div>
                            <div class="col-auto ms-auto">
                                <h3 class="m-0">Tanggal Masuk:</h3>
                                <p>
                                    {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') ?? null }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-5">
                            <div class="rounded-4">
                                <img src="{{ asset('img/foto/' . $item->tendik->foto) ?? asset('static/avatars/000f.jpg') }}"
                                    style="min-height: 300px;object-fit:cover;" class="rounded-4" alt="">
                            </div>
                        </div>
                        <div class="col-7 ps-3">
                            <h2>Data : </h2>
                            <div class="table-responsive">
                                <table>
                                    <tr>
                                        <td class="align-top"><strong>Nama</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->tendik->nama }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>NIK</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->tendik->nik }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Jenis Kelamin</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->tendik->jenis_kelamin }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>TTL</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->tendik->tempat_lahir }},
                                            {{ \Carbon\Carbon::parse($item->tendik->tanggal_lahir)->format('d-m-Y') ?? null }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>No. WA</strong> </td>
                                        <td class="ps-2 align-top">: {{ $item->tendik->nomor_whatsapp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Jam Masuk</strong> </td>
                                        <td class="ps-2 align-top">:
                                            {{ \Carbon\Carbon::parse($item->jam_masuk)->format('H : i') ?? null }}</td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Tanggal Masuk</strong> </td>
                                        <td class="ps-2 align-top">:
                                            <span class="badge bg-yellow text-dark">
                                                {{ \Carbon\Carbon::parse($item->jam_masuk)->isoFormat('dddd, D MMMM Y') ?? null }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="align-top"><strong>Status</strong> </td>
                                        <td class="ps-2 align-top">:
                                            @if ($item->status == 'Terlambat')
                                                <span class="badge bg-red text-red-fg">{{ $item->status }}</span>
                                            @else
                                                <span class="badge bg-green text-green-fg">{{ $item->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>

                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach
