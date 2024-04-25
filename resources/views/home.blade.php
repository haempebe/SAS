@extends('layouts.app')
@section('styles')
    <style>
        .glass {
            background: rgba(255, 255, 255, 0.17);
            border-radius: 16px;
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .bg-gradient-orange {
            background: rgb(255, 114, 0);
            background: linear-gradient(335deg, rgba(255, 114, 0, 1) 0%, rgba(255, 172, 4, 1) 90%, rgba(252, 179, 88, 1) 100%);
        }
    </style>
@endsection
@section('content')
    @php
        date_default_timezone_set('Asia/jakarta');
    @endphp
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card rounded-4 mt-4 mb-3">
                        <div class="card-body">
                            <div class="page-header d-print-none mt-0">
                                <div class="row g-2 align-items-center">
                                    <div class="col">
                                        <div class="page-pretitle">
                                            Sistem Absensi Sekolah
                                        </div>
                                        <h2 class="page-title">
                                            SMK TI Bazma
                                        </h2>
                                    </div>
                                    <div class="col-auto ms-auto d-print-none">
                                        <h2 class="page-title">
                                            <div id="jam"></div>
                                        </h2>
                                        <p class="mb-0 page-pretitle">{{ $time = now()->isoFormat('dddd, D MMMM Y') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 mb-3">
                        <div class="card-body py-5">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="align-items-center">
                                        <div class="text-center">
                                            <img src="{{ asset('img/gif/6.gif') }}" alt=""
                                                style="max-height: 250px;">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card rounded-3 border-0">
                                        <div class="card-header">
                                            <ul class="nav nav-tabs card-header-tabs nav-fill" data-bs-toggle="tabs">
                                                <li class="nav-item">
                                                    <a href="#tabs-masuk-form" class="nav-link active" data-bs-toggle="tab">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-login-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M9 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                            <path d="M3 12h13l-3 -3" />
                                                            <path d="M13 15l3 -3" />
                                                        </svg>
                                                        <span class="ms-1"></span>Masuk
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a href="#tabs-pulang-form" class="nav-link" data-bs-toggle="tab">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                            <path d="M15 12h-12l3 -3" />
                                                            <path d="M6 15l-3 -3" />
                                                        </svg>
                                                        <span class="ms-1"></span>Pulang
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="card-body">
                                            <div class="tab-content">
                                                <div class="tab-pane active show" id="tabs-masuk-form">
                                                    <form action="{{ route('home.masuk') }}">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nomor induk</label>
                                                            <input type="text" class="form-control rounded-4"
                                                                name="noid" placeholder="Masukan NISN/NUPTK"
                                                                value="{{ old('noid') }}" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Peserta</label>
                                                            <input type="text" class="form-control rounded-4"
                                                                name="nama" placeholder="Input placeholder"
                                                                value="{{ old('nama') }}" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kelas</label>
                                                            <input type="text" class="form-control rounded-4"
                                                                name="kelas" placeholder="Input placeholder"
                                                                value="{{ old('kelas') }}" />
                                                        </div>
                                                        @if ($errors->any())
                                                            <div class="text-danger mb-3">
                                                                {{ $errors->first() }}
                                                            </div>
                                                        @endif
                                                        @if (session('message'))
                                                            <div class="text-danger mb-3" role="alert">
                                                                {{ session('message') }}
                                                            </div>
                                                        @endif
                                                        <button type="submit" id="masukButton"
                                                            class="btn btn-primary rounded-4 w-100">Masuk</button>
                                                    </form>
                                                </div>
                                                <div class="tab-pane" id="tabs-pulang-form">
                                                    <form action="">
                                                        <div class="mb-3">
                                                            <label class="form-label">Nomor induk</label>
                                                            <input type="text" class="form-control rounded-4"
                                                                name="noid" placeholder="Masukan NISN/NUPTK" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Nama Peserta</label>
                                                            <input type="text" class="form-control rounded-4"
                                                                name="nama" placeholder="Input placeholder" />
                                                        </div>
                                                        <div class="mb-3">
                                                            <label class="form-label">Kelas</label>
                                                            <input type="text" class="form-control rounded-4"
                                                                name="kelas" placeholder="Input placeholder" />
                                                        </div>
                                                        <button type="submit" id="pulangButton"
                                                            class="btn btn-primary rounded-4 w-100">Pulang</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gx-2">
                        <div class="col-lg-4">
                            <div class="card bg-twitter rounded-4">
                                <div class="p-2 text-white">
                                    <strong>On Time</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-pink rounded-4">
                                <div class="p-2 text-white">
                                    <strong>Terlambat</strong>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card bg-gradient-orange border-0 rounded-4">
                                <div class="p-2">
                                    <div class="row gx-2 ">
                                        <div class="col-6">
                                            <div class="card glass">
                                                <div class="p-2 text-white mx-auto text-center">
                                                    <strong>Belum Masuk</strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="card glass">
                                                <div class="p-2 text-white  mx-auto text-center">
                                                    <strong>Belum Pulang</strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-4 mt-4">
                    <div class="card rounded-4 p-2 mb-3">
                        <div class="row gx-2">
                            <div class="col-4">
                                <div class="card rounded-3 border border-primary">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-blue text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-users">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" />
                                                        <path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                                                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                                                        <path d="M21 21v-2a4 4 0 0 0 -3 -3.85" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="page-pretitle">Total Siswa</div>
                                                <div class="page-title">{{ $siswaCount }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card rounded-3 border border-orange">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-orange text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-school">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M22 9l-10 -4l-10 4l10 4l10 -4v6" />
                                                        <path d="M6 10.6v5.4a6 3 0 0 0 12 0v-5.4" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="page-pretitle">Total Tendik</div>
                                                <div class="page-title">{{ $tendikCount }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card rounded-3 border border-purple">
                                    <div class="card-body p-2">
                                        <div class="row align-items-center">
                                            <div class="col-auto">
                                                <span class="bg-purple text-white avatar">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                        class="icon icon-tabler icons-tabler-outline icon-tabler-door">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                        <path d="M14 12v.01" />
                                                        <path d="M3 21h18" />
                                                        <path d="M6 21v-16a2 2 0 0 1 2 -2h8a2 2 0 0 1 2 2v16" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col">
                                                <div class="page-pretitle">Total Kelas</div>
                                                <div class="page-title">2 </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-3 gx-2">
                        <div class="col-6">
                            <div class="card rounded-4 p-2">
                                <div class="card border-twitter p-2">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <div class="page-pretitle">Jam Masuk</div>
                                            <div class="page-title">06:00</div>
                                        </div>
                                        <div class="col-auto">
                                            <span class="bg-twitter text-white avatar">
                                                <img src="{{ asset('img/svg/1.svg') }}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="card rounded-4 p-2">
                                <div class="card border-twitter p-2">
                                    <div class="row">
                                        <div class="col">
                                            <div class="page-pretitle">Jam Pulang</div>
                                            <div class="page-title">16:00</div>
                                        </div>
                                        <div class="col-auto">
                                            <span class="bg-twitter text-white avatar">
                                                <img src="{{ asset('img/svg/2.svg') }}" alt="">
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card rounded-4 mb-3" style="min-height: 20rem; max-height:20rem;">
                        <div class="table-responsive rounded-4">
                            <table class="table card-table rounded-4 table-vcenter text-nowrap datatable">
                                <thead class="sticky-top">
                                    <tr>
                                        <th class="w-1">No. Induk</th>
                                        <th>Nama</th>
                                        <th>Kelas</th>
                                        <th>In</th>
                                        <th>Out</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody style="min-height: 16.5rem; max-heigth:16.5rem;overflow-y: auto;">
                                    <tr>
                                        <td>001401</td>
                                        <td>Design Work</td>
                                        <td>XII</td>
                                        <td>87956621</td>
                                        <td>7777</td>
                                        <td><span class="badge bg-success me-1"></span>tepat
                                            waktu</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modal-masuk" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('izin.perform') }}" method="POST">
            @csrf
            @method('POST')
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <label class="form-label required">Nama</label>
                        <div class="mb-3">
                            <select class="form-select" name="nama">
                                <optgroup label="Tendik">
                                    @foreach ($tendik as $itemT)
                                        <option value="{{ $itemT->id }}">{{ $itemT->nama }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Siswa">
                                    @foreach ($siswa as $itemS)
                                        <option value="{{ $itemS->id }}">{{ $itemS->nama }}</option>
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('nama')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <label class="form-label required">Role</label>
                        <div class="form-selectgroup-boxes row mb-3">
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="role" value="Tendik" class="form-selectgroup-input"
                                        checked>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Tendik</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-lg-6">
                                <label class="form-selectgroup-item">
                                    <input type="radio" name="role" value="Siswa" class="form-selectgroup-input"
                                        checked>
                                    <span class="form-selectgroup-label d-flex align-items-center p-3">
                                        <span class="me-3">
                                            <span class="form-selectgroup-check"></span>
                                        </span>
                                        <span class="form-selectgroup-label-content">
                                            <span class="form-selectgroup-title strong mb-1">Siswa</span>
                                        </span>
                                    </span>
                                </label>
                            </div>
                            @error('role')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <label class="form-label required">Jenis Izin</label>
                        <div class="mb-3">
                            <select class="form-select" name="jenis_izin">
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpa">Alpa</option>
                                <option value="Lembur">Lembur</option>
                            </select>
                            @error('jenis_izin')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                        <label class="form-label required">Keterangan</label>
                        <div class="mb-3">
                            <textarea rows="5" class="form-control" name="keterangan"></textarea>
                            @error('keterangan')
                                <p class='text-danger mb-0 text-xs pt-1'> {{ $message }} </p>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="#" class="btn btn-link link-secondary" data-bs-dismiss="modal">
                            Cancel
                        </a>
                        <button href="#" type="submit" class="btn btn-primary ms-auto" data-bs-dismiss="modal">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M12 5l0 14"></path>
                                <path d="M5 12l14 0"></path>
                            </svg>
                            Simpan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        window.onload = function() {
            jam();
        }

        function jam() {
            var e = document.getElementById('jam'),
                d = new Date(),
                h, m, s;
            h = d.getHours();
            m = set(d.getMinutes());
            s = set(d.getSeconds());

            e.innerHTML = h + ' : ' + m + ' : ' + s + ' WIB';

            setTimeout('jam()', 1000);
        }

        function set(e) {
            e = e < 10 ? '0' + e : e;
            return e;
        }
    </script>
@endsection
