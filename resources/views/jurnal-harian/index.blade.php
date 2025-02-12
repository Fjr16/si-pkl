@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Jurnal Harian</li>
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
                            @if (Auth::user()->role == 'Siswa')
                                <a href="{{ route('jurnal/harian.create') }}" class="btn btn-sm btn-primary ms-auto"><i
                                        class="bi bi-plus-lg"></i> Tambah Data</a>
                            @endif
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Jenis Laporan</th>
                                    <th>Keterangan</th>
                                    <th>Laporan</th>
                                    @can('siswa')
                                    <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d H:i') ?? '' }}</td>
                                        <td>{{ $item->student->user->name ?? '-' }}</td>
                                        <td>{{ $item->jenis_laporan ?? '-' }}</td>
                                        <td>{!! $item->keterangan ?? '-' !!}</td>
                                        <td>
                                            <a href="{{ route('jurnal/harian.download', $item->id) }}">
                                                {{ ($item->file_name ?? '-') . ' (' . ($item->file_size ?? '-') . ' MB)' }}
                                            </a>
                                        </td>
                                        @can('siswa')
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('jurnal/harian.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="bi bi-pencil text-white"></i></a>
                                                <form action="{{ route('jurnal/harian.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                        @endcan
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
