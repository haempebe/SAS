@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="page-header d-print-none mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Data
                        </div>
                        <h2 class="page-title">
                            Absen Siswa
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-create">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
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
                    </div>
                </div>
            </div>
            <form action="/filter-siswa" method="GET">
                <div class="row g-2">
                    <div class="col-4">
                        <div class="input-icon mb-3">
                            <input class="form-control" name="start_date"
                                placeholder="{{ str_contains(request()->url(), 'filter-siswa') == true ? $start_date : '' }}"
                                id="datepicker-icon-1" value="" fdprocessedid="m75zlq" autocomplete="off">
                            <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
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
                    <div class="col-4">
                        <div class="input-icon mb-3">
                            <input class="form-control" name="end_date"
                                placeholder="{{ str_contains(request()->url(), 'filter-siswa') == true ? Str::limit($end_date, 10, '') : '' }}"
                                id="datepicker-icon-2" value="" fdprocessedid="m75zlq" autocomplete="off">
                            <span class="input-icon-addon"><!-- Download SVG icon from http://tabler-icons.io/i/calendar -->
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
                    <div class="col-2">
                        <div class="mb-3">
                            <select class="form-select" name="kelas">
                                <option value="Kelas 10">Kelas 10</option>
                                <option value="Kelas 11">Kelas 11</option>
                                <option value="Kelas 12">Kelas 12</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary w-100" type="submit">Filter</button>
                    </div>
                </div>
            </form>
            <div class="row row-cards">
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
                                                {{ $item->siswa->nama }}
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
                {{-- <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Top Pages</h3>
                            <table class="table table-sm table-borderless">
                                <thead>
                                    <tr>
                                        <th>Page</th>
                                        <th class="text-end">Visitors</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 82.54%"
                                                        role="progressbar" aria-valuenow="82.54" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="82.54% Complete">
                                                        <span class="visually-hidden">82.54% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">4896</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 76.29%"
                                                        role="progressbar" aria-valuenow="76.29" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="76.29% Complete">
                                                        <span class="visually-hidden">76.29% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/form-elements.html</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">3652</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 72.65%"
                                                        role="progressbar" aria-valuenow="72.65" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="72.65% Complete">
                                                        <span class="visually-hidden">72.65% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/index.html</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">3256</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 44.89%"
                                                        role="progressbar" aria-valuenow="44.89" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="44.89% Complete">
                                                        <span class="visually-hidden">44.89% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/icons.html</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">986</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 41.12%"
                                                        role="progressbar" aria-valuenow="41.12" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="41.12% Complete">
                                                        <span class="visually-hidden">41.12% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/docs/</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">912</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 32.65%"
                                                        role="progressbar" aria-valuenow="32.65" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="32.65% Complete">
                                                        <span class="visually-hidden">32.65% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/accordion.html</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">855</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 16.22%"
                                                        role="progressbar" aria-valuenow="16.22" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="16.22% Complete">
                                                        <span class="visually-hidden">16.22% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/datagrid.html</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">764</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="progressbg">
                                                <div class="progress progressbg-progress">
                                                    <div class="progress-bar bg-primary-lt" style="width: 8.69%"
                                                        role="progressbar" aria-valuenow="8.69" aria-valuemin="0"
                                                        aria-valuemax="100" aria-label="8.69% Complete">
                                                        <span class="visually-hidden">8.69% Complete</span>
                                                    </div>
                                                </div>
                                                <div class="progressbg-text">/datatables.html</div>
                                            </div>
                                        </td>
                                        <td class="w-1 fw-bold text-end">686</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection
