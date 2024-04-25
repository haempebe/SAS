@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="container">
            @if (session('create'))
                <div class="alert alert-success alert-dismissible mt-3" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            {{ session('create') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @if (session('update'))
                <div class="alert alert-info alert-dismissible mt-3" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            {{ session('update') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            @if (session('delete'))
                <div class="alert alert-danger alert-dismissible mt-3" role="alert">
                    <div class="d-flex">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <path d="M5 12l5 5l10 -10"></path>
                            </svg>
                        </div>
                        <div>
                            {{ session('delete') }}
                        </div>
                    </div>
                    <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                </div>
            @endif
            <div class="page-header d-print-none mb-3">
                <div class="row g-2 align-items-center">
                    <div class="col">
                        <div class="page-pretitle">
                            Data
                        </div>
                        <h2 class="page-title">
                            Izin Peserta
                        </h2>
                    </div>
                    <div class="col-auto ms-auto d-print-none">
                        <div class="btn-list">
                            <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                                data-bs-target="#modal-create">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                    <path d="M12 5l0 14"></path>
                                    <path d="M5 12l14 0"></path>
                                </svg>
                                Tambah Data
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
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>role</th>
                                    <th>Jenis Izin</th>
                                    <th>Keterangan</th>
                                    <th class="w-8"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($izin as $item)
                                    <tr>
                                        <td>
                                            <div>{{ $item->nama }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->role }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->jenis_izin }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $item->keterangan }}</div>
                                        </td>
                                        <td class="text-end">
                                            <div class="row g-0">
                                                <div class="col">
                                                    <button href="#" class="btn btn-success btn-icon"
                                                        data-bs-toggle="modal" data-bs-target="#modal-update">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path
                                                                d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                            <path
                                                                d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                            <path d="M16 5l3 3" />
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="col">
                                                    <button href="#" class="btn btn-danger btn-icon"
                                                        data-bs-toggle="modal" data-bs-target="#modal-delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M4 7l16 0" />
                                                            <path d="M10 11l0 6" />
                                                            <path d="M14 11l0 6" />
                                                            <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                            <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                        </svg>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- Form Create --}}
                                    <div class="modal modal-blur fade" id="modal-delete" tabindex="-1" role="dialog"
                                        aria-hidden="true">
                                        <form action="{{ route('izin.delete', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body text-center py-5">
                                                        <h1>Yakin Ingin<br>Menghapus Data Ini</h1>
                                                        <div class="row justify-content-center mt-5">
                                                            <div class="col-3">
                                                                <button href="#" type="submit"
                                                                    class="btn btn-danger w-100">
                                                                    YA
                                                                </button>
                                                            </div>
                                                            <div class="col-3">
                                                                <a href="#" class="btn btn-outline-primary w-100">
                                                                    TIDAK
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                @empty
                                    <tr>
                                        <td>
                                            <p>Tidak Ada Data</p>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer d-flex align-items-center">
                        <p class="m-0 text-secondary">
                            Showing {{ $izin->firstItem() }}
                            to {{ $izin->lastItem() }}
                            of {{ $izin->total() }}
                            entries
                        </p>
                        <ul class="pagination m-0 ms-auto">
                            {{ $izin->links() }}
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Form Create --}}
    <div class="modal modal-blur fade" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <form action="{{ route('izin.perform') }}" method="POST">
            @csrf
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
                                        <option value="{{ $itemT->nama }}">{{ $itemT->nama }}</option>
                                    @endforeach
                                </optgroup>
                                <optgroup label="Siswa">
                                    @foreach ($siswa as $itemS)
                                        <option value="{{ $itemS->nama }}">{{ $itemS->nama }}</option>
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

    {{-- Form Edit --}}
    @foreach ($izin as $item)
        <div class="modal modal-blur fade" id="modal-update" tabindex="-1" role="dialog" aria-hidden="true">
            <form action="{{ route('izin.update', $item->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <label class="form-label required">Nama</label>
                            <div class="mb-3">
                                <select class="form-select" name="nama"
                                    value="{{ $item->nama }}>
                                    <option value="{{ $itemT->id }}">{{ $itemT->nama }}
                                    </option>
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
                                        <input type="radio" name="role" value="Tendik"
                                            class="form-selectgroup-input" checked>
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
                                        <input type="radio" name="role" value="Siswa"
                                            class="form-selectgroup-input" checked>
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
                            <button href="#" type="submit" class="btn btn-primary ms-auto"
                                data-bs-dismiss="modal">
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
    @endforeach
@endsection
