@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Dokumen</li>
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
                            @can ('guru')
                            <a href="{{ route('dokumen.create') }}" class="btn btn-sm btn-primary ms-auto"><i class="bi bi-upload me-1"></i> upload</a>
                            @endcan
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Diupload Oleh</th>
                                    <th>Tanggal Upload</th>
                                    <th>Nama File</th>
                                    <th>Ukuran (MB)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->teacher->user->name ?? '-' }}</td>
                                        <td>{{ $item->tanggal ?? '-' }}</td>
                                        <td>{{ $item->file_name ?? '-' }}</td>
                                        <td>{{ $item->file_size ?? '-' }} </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('dokumen.download', $item->id) }}" class="btn btn-sm btn-primary me-1">Unduh</a>
                                                @can('guru')
                                                <form action="{{ route('dokumen.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus data ?')">hapus</button>
                                                </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
