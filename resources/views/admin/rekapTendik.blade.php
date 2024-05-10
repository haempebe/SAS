@extends('layouts.app')

@section('content')
<div class="page-wrapper">
    @if (strpos(url()->current(), 'filter') == false)
    <div class="page-header d-print-none mb-3">
        <div class="row g-2 align-items-center">
            <div class="col">
                <div class="page-pretitle">
                    Data
                </div>
                <h2 class="page-title">
                    Absen Tendik
                </h2>
            </div>
            {{-- <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <a href="/filter-tendik/pdf" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                            <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                            <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                            <path d="M17 18h2" />
                            <path d="M20 15h-3v6" />
                            <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                        </svg>
                        Export PDF
                    </a>
                    <a href="#" class="btn btn-primary d-sm-none btn-icon" data-bs-toggle="modal"
                        data-bs-target="#modal-report">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M12 5l0 14"></path>
                            <path d="M5 12l14 0"></path>
                        </svg>
                    </a>
                </div>
            </div> --}}
        </div>
    </div>
    <form action="/filter-tendik" id="filter" method="GET">
        <div class="row g-2">
            <div class="col-5">
                <div class="input-icon mb-3">
                    <input class="form-control" name="start_date" placeholder="{{ request('start_date') }}"
                        id="datepicker-icon-1" value="" fdprocessedid="m75zlq" autocomplete="off">
                    <span class="input-icon-addon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                            </path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M11 15h1"></path>
                            <path d="M12 15v3"></path>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="col-5">
                <div class="input-icon mb-3">
                    <input class="form-control" name="end_date" placeholder="{{ request('end_date') }}"
                        id="datepicker-icon-2" value="" fdprocessedid="m75zlq" autocomplete="off">
                    <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
                            </path>
                            <path d="M16 3v4"></path>
                            <path d="M8 3v4"></path>
                            <path d="M4 11h16"></path>
                            <path d="M11 15h1"></path>
                            <path d="M12 15v3"></path>
                        </svg>
                    </span>
                </div>
            </div>
            <div class="col">
                <button class="btn btn-primary w-100" type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-file-type-pdf">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                        <path d="M5 12v-7a2 2 0 0 1 2 -2h7l5 5v4" />
                        <path d="M5 18h1.5a1.5 1.5 0 0 0 0 -3h-1.5v6" />
                        <path d="M17 18h2" />
                        <path d="M20 15h-3v6" />
                        <path d="M11 15v6h1a2 2 0 0 0 2 -2v-2a2 2 0 0 0 -2 -2h-1z" />
                    </svg>
                    Export PDF
                </button>
            </div>
        </div>
    </form>
    @endif
</div>
@if (strpos(url()->current(), 'filter') == true)
<h1>Data Absensi Tendik</h1>
<p><b>Tanggal : </b>{{ now()->format('d F Y') }}</p>
<div class="row row-cards mb-3">
    <div class="col">
        <div class="card">
            <table class="table table-vcenter card-table">
                <thead class="border-1">
                    <tr>
                        <th>Nama</th>
                        @for ($i = $start_date; $i <= $end_date; $i++)
                            <th class="text-center">
                                {{ \Carbon\Carbon::parse($i)->format('d') }}
                            </th>
                        @endfor
                        <th><span class="badge bg-green text-green-fg">M</span></th>
                        <th><span class="badge bg-blue text-blue-fg">I</span></th>
                        <th><span class="badge bg-orange text-orange-fg">S</span></th>
                        <th><span class="badge bg-red text-red-fg">A</span></th>
                        <th><span class="badge bg-blue text-blue-fg">L</span></th>
                        <th><span class="badge bg-indigo text-indigo-fg">P</span></th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $totalM = 0;
                        $totalI = 0;
                        $totalS = 0;
                        $totalA = 0;
                        $totalL = 0;
                        $totalP = 0;
                    @endphp
                    @forelse ($rowTableAbsensi as $item)
                        <tr>
                            <td>
                                {{ $item->tendik->nama }}
                            </td>
                            @php
                                $absensiDates = [];
                                $izinDates = [];
                            @endphp
    
                            @foreach($absensi as $itemA)
                                @if ($itemA->tendik_id == $item->tendik_id)
                                    @php
                                        $absensiDates[] = \Carbon\Carbon::parse($itemA->jam_masuk)->format('Y-m-d');
                                    @endphp
                                @endif
                            @endforeach
    
                            @foreach($izin as $itemI)
                                @if ($itemI->nama == $item->tendik->nama)
                                    @php
                                        $izinDates[] = \Carbon\Carbon::parse($itemI->jam_masuk)->format('Y-m-d');
                                        $jenisIzin = $itemI->jenis_izin;
                                    @endphp
                                @endif
                            @endforeach
    
                            @php
                                $absensiDates = array_unique($absensiDates);
                            @endphp
    
                            @for ($i = $start_date; $i <= $end_date; $i++)
                                <td class="text-center">
                                    @if ($izinDates != null && in_array($i, $izinDates))
                                        @if ($jenisIzin == 'Izin')
                                            <span class="badge bg-azure text-azure-fg">I</span>
                                            @php $totalI++; @endphp
                                        @elseif ($jenisIzin == 'Sakit')
                                            <span class="badge bg-orange text-orange-fg">S</span>
                                            @php $totalS++; @endphp
                                        @elseif ($jenisIzin == 'Alpa')
                                            <span class="badge bg-red text-red-fg">A</span>
                                            @php $totalA++; @endphp
                                        @elseif ($jenisIzin == 'Lembur')
                                            <span class="badge bg-blue text-blue-fg">L</span>
                                            @php $totalL++; @endphp
                                        @else
                                            <span class="badge bg-indigo text-indigo-fg">P</span>
                                            @php $totalP++; @endphp
                                        @endif
                                    @else
                                        @if (in_array($i, $absensiDates))
                                            <span class="badge bg-green text-green-fg">M</span>
                                            @php $totalM++; @endphp
                                        @endif
                                    @endif
                                </td>
                            @endfor
    
                            {{-- Menampilkan total untuk setiap jenis absensi --}}
                            <td class="text-center">{{ $totalM }}</td>
                            <td class="text-center">{{ $totalI }}</td>
                            <td class="text-center">{{ $totalS }}</td>
                            <td class="text-center">{{ $totalA }}</td>
                            <td class="text-center">{{ $totalL }}</td>
                            <td class="text-center">{{ $totalP }}</td>
                        </tr>
                        {{-- Setel ulang total setiap kali selesai mengolah satu baris --}}
                        @php
                            $totalM = 0;
                            $totalI = 0;
                            $totalS = 0;
                            $totalA = 0;
                            $totalL = 0;
                            $totalP = 0;
                        @endphp
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                Tidak Ada Data
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    
</div>
<div class="row row-cards mb-3">
    <div class="col-8">
        <div class="card">
            <table class="table table-vcenter card-table">
                <thead class="border-1">
                    <tr>
                        <th>Nama</th>
                        <th>Jenis Izin</th>
                        <th>Tanggal</th>
                        <th>Waktu Mulai</th>
                        <th>Waktu Berakhir</th>
                        <th>Keterangan</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($izin as $item)
                    <tr>
                        <td>
                            {{ $item->nama }}
                        </td>
                        @if ($item->jenis_izin == 'Izin')
                        <td><span class="badge bg-azure text-azure-fg">{{ $item->jenis_izin }}</span></td>
                        @elseif ($item->jenis_izin == 'Sakit')
                        <td><span class="badge bg-orange text-orange-fg">{{ $item->jenis_izin }}</span></td>
                        @elseif ($item->jenis_izin == 'Alpa')
                        <td><span class="badge bg-red text-red-fg">{{ $item->jenis_izin }}</span></td>
                        @elseif ($item->jenis_izin == 'Lembur')
                        <td><span class="badge bg-blue text-blue-fg">{{ $item->jenis_izin }}</span></td>
                        @else
                        <td><span class="badge bg-indigo text-indigo-fg">{{ $item->jenis_izin }}</span></td>
                        @endif
                        <td>{{ $item->created_at->format('d F') }}</td>
                        <td>{{ $item->jam_mulai }}</td>
                        <td>{{ $item->jam_berakhir }}</td>
                        <td>{{ $item->keterangan }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak Ada Data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-4">
        <div class="card">
            <table class="table table-vcenter card-table">
                <thead class="border-1">
                    <tr>
                        <th>Nama</th>
                        <th class="text-center">Total Jam Lembur</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($izin as $item)
                    <tr>
                        <td>
                            {{ $item->nama }}
                        </td>
                        @php
                        $totalJam = isset($totalJamPerTendik[$item->id]) ? min($totalJamPerTendik[$item->id], 8 ) : 0 ;
                        @endphp
                        <td class="text-center">{{ $totalJam }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">
                            Tidak Ada Data
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<footer class="">
    <div>
        <p>Bogor, {{ now()->format('d F Y') }}</p>
        <b>Kepala Sekolah</b>
        <p>Ahmad Dahlan, S.Ag.</p>
    </div>
</footer>
<script>
    window.onload = function() {
        window.print();
    }
</script>
@endif
@endsection