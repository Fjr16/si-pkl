@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Siswa</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <h5 class="card-title">{{ $title ?? '' }}</h5>
                        </div>

                        <form method="POST" action="{{ route('jurnal/harian.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ auth()->user()->name ?? '' }}" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" value="{{ $item->created_at->format('Y-m-d') ?? date('Y-m-d') }}" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis_laporan" class="col-sm-2 col-form-label">Jenis Laporan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis_laporan" id="jenis_laporan" value="{{ $item->jenis_laporan ?? '' }}" placeholder="Jenis Laporan" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="10" placeholder="Keterangan">{!! $item->keterangan ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file-sebelumnya" class="col-sm-2 col-form-label">File Sebelumnya</label>
                                <div class="col-sm-10">
                                    @if ($item->file_name)
                                    <a href="{{ route('jurnal/harian.download', $item->id) }}">
                                        {{ ($item->file_name ?? '-') . ' (' . ($item->file_size ?? '-') . ' MB)' }}
                                    </a>
                                    @else
                                    <p class="text-danger">---- File Not Found ----</p>
                                    @endif
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file-laporan" class="col-sm-2 col-form-label">Upload File (PDF) (Max : 2 MB)</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file_laporan" class="form-control" id="file-laporan">
                                    <div class="text-danger">
                                        <small>* Kosongkan bila tidak ingin mengupdate file laporan</small>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                                </div>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
