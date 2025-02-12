@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Laporan Akhir</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                @if ($item)
                    {{-- download file --}}
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <h5 class="card-title">Download Laporan</h5>
                            </div>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Tanggal</th>
                                        <th>Nama File</th>
                                        <th>Ukuran (MB)</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $item->tanggal ?? '' }}</td>
                                        <td>{{ $item->file_name ?? '-' }}</td>
                                        <td>{{ $item->file_size ?? '-' }}</td>
                                        <td>
                                            <a href="{{ route('laporan/akhir.download', $item->id) }}" class="btn btn-sm btn-primary">Download</a>
                                        </td>
                                    </tr>
                                </tbody>

                            </table>
                        </div>
                    </div>
                    @can('siswa')
                        {{-- update laporan --}}
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title">{{ $title ?? '' }}</h5>
                                </div>

                                <form method="POST" action="{{ route('laporan/akhir.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="tanggal" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="laporan-akhir" class="form-label">File Laporan (PDF) (Max: 5 MB)</label>
                                        <input type="file" class="form-control" name="laporan_akhir" accept="application/pdf" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-primary">Perbarui</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    @endcan
                @else
                    @can('siswa')
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <h5 class="card-title">{{ $title ?? '' }}</h5>
                                </div>

                                <form method="POST" action="{{ route('laporan/akhir.store') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="tanggal" class="form-label">Tanggal</label>
                                        <input type="date" value="{{ date('Y-m-d') }}" class="form-control" name="tanggal" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="laporan-akhir" class="form-label">File Laporan (PDF) (Max: 5 MB)</label>
                                        <input type="file" class="form-control" name="laporan_akhir" accept="application/pdf" required>
                                    </div>
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                    </div>

                                </form>

                            </div>
                        </div>
                    @else
                    <div class="bg-primary">
                        <div class="p-3 fw-bold text-white text-center text-uppercase">Data Tidak Ditemukan</div>
                    </div>
                    @endcan
                @endif

            </div>
        </div>
    </section>
@endsection
