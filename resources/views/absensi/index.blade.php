@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Presensi Siswa</li>
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
                                <a href="{{ route('absensi/siswa.create') }}" class="btn btn-sm btn-primary ms-auto"><i
                                        class="bi bi-plus-lg"></i> Tambah Data</a>
                            @endif
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Siswa</th>
                                    <th>Absen Masuk (WIB)</th>
                                    <th>Absen Pulang (WIB)</th>
                                    <th>Status</th>
                                    <th>Keterangan</th>
                                    <th>Foto</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->created_at->format('Y-m-d H:i') ?? '' }}</td>
                                        <td>{{ $item->student->user->name ?? '' }}</td>
                                        <td>{{ $item->jam_masuk ?? '' }}</td>
                                        <td>{{ $item->jam_pulang ?? '' }}</td>
                                        <td>{{ $item->status ?? '' }}</td>
                                        <td>{{ $item->keterangan ?? '' }}</td>
                                        <td>
                                            <a href="{{ Storage::url($item->foto ?? '') }}" target="_blank">
                                                <img src="{{ Storage::url($item->foto ?? '') }}" alt="" class="img-fluid" width="60" height="60">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('absensi/siswa.edit', $item->id) }}"
                                                    class="btn btn-sm btn-warning"><i class="bi bi-pencil text-white"></i></a>
                                                <form action="{{ route('absensi/siswa.destroy', $item->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                        onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                            class="bi bi-trash"></i></button>
                                                </form>
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
