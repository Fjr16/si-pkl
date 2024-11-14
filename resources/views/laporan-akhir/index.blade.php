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
                                <label for="laporan-akhir" class="form-label">File Laporan (PDF)</label>
                                <input type="file" class="form-control" name="laporan_akhir" required>
                            </div>
                            <div class="mb-3">
                                <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
