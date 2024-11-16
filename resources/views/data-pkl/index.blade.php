@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data PKL</li>
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
                            @if (Auth::user()->role == 'Admin')
                                <a href="{{ route('data/pkl/siswa.create') }}" class="btn btn-sm btn-primary ms-auto"><i
                                        class="bi bi-plus-lg"></i> Tambah Data</a>
                            @endif
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Jurusan</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Nama Pembimbing</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->student->user->name ?? '-' }}</td>
                                        <td>{{ $item->student->major->nama ?? '-' }}</td>
                                        <td>{{ $item->student->jk ?? '-' }}</td>
                                        <td>{{ $item->dudi->user->name ?? '-' }}</td>
                                        <td>{{ $item->teacher->user->name ?? '-' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('data/pkl/siswa.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning"><i class="bi bi-pencil text-white"></i></a>
                                            <form action="{{ route('data/pkl/siswa.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
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
