@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="container">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
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
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
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
                                <span
                                    class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path
                                            d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z">
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
                            <button class="btn btn-primary w-100" type="submit">Filter</button>
                        </div>
                    </div>
                </form>
                {{-- <div class="row row-cards">
                    <div class="col">
                        <div class="card">
                            <div class="table-responsive">
                                <table class="table table-vcenter card-table">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            @for ($i = $start_date; $i <= $end_date; $i++)
                                                <th>{{ \Carbon\Carbon::parse($i)->format('d') }}</th>
                                            @endfor

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($absensi as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->tendik->nama }}
                                                </td>
                                                @for ($i = $start_date; $i <= $end_date; $i++)
                                                    <?php
                                                    $tanggal_masuk = \Carbon\Carbon::parse($item->jam_masuk)->format('Y-m-d');
                                                    ?>
                                                    <td>
                                                        @if ($tanggal_masuk == $i)
                                                            <span
                                                                class="badge bg-green text-green-fg">{{ $item->status }}</span>
                                                        @endif
                                                    </td>
                                                @endfor
                                            </tr>
                                        @empty
                                        @endforelse
                                        @foreach ($izin as $item)
                                            <tr>
                                                <td>
                                                    {{ $item->nama }}
                                                </td>
                                                <td>
                                                    <span class="badge bg-green text-green-fg">{{ $item->role }}</span>
                                                </td>
                                                <td>
                                                    {{ $item->keterangan }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> --}}
            @endif
        </div>
    </div>
    @if (strpos(url()->current(), 'filter') == true)
        <div class="row row-cards">
            <div class="col">
                <div class="card">
                    <table class="table table-vcenter card-table">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                @for ($i = $start_date; $i <= $end_date; $i++)
                                    <th>{{ \Carbon\Carbon::parse($i)->format('d') }}</th>
                                @endfor
                                {{-- @foreach ($dates as $date)
                                        <th>{{ $date->format('d') }}</th>
                                    @endforeach --}}
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($absensi as $item)
                                <tr>
                                    <td>
                                        {{ $item->tendik->nama }}
                                    </td>
                                    @for ($i = $start_date; $i <= $end_date; $i++)
                                        <?php
                                        $tanggal_masuk = \Carbon\Carbon::parse($item->jam_masuk)->format('Y-m-d');
                                        ?>
                                        <td>
                                            @if ($tanggal_masuk == $i)
                                                <span class="badge bg-green text-green-fg">M</span>
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @empty
                            @endforelse
                            @foreach ($izin as $item)
                                <tr>
                                    <td>
                                        {{ $item->nama }}
                                    </td>
                                    @for ($i = $start_date; $i <= $end_date; $i++)
                                        <?php
                                        $updated_at = \Carbon\Carbon::parse($item->updated_at)->format('Y-m-d');
                                        ?>
                                        <td>
                                            @if ($updated_at == $i)
                                                <span class="badge bg-green text-green-fg">{{ $item->keterangan }}</span>
                                            @endif
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script>
            window.onload = function() {
                window.print();
            }
        </script>
    @endif
@endsection
