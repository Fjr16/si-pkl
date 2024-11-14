@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Monitoring Guru</li>
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
                            {{-- @if (Auth::user()->role == 'Siswa') --}}
                                <a href="{{ route('monitoring/guru.create') }}" class="btn btn-sm btn-primary ms-auto"><i
                                        class="bi bi-plus-lg"></i> Tambah Monitoring</a>
                            {{-- @endif --}}
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Guru</th>
                                    <th>Nama Siswa</th>
                                    <th>Jurusan</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Kejadian</th>
                                    <th>Keterangan</th>
                                    <th>Tindakan</th>
                                    <th>Dokumentasi</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->username ?? '' }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>{{ $item->jk ?? '' }}</td>
                                        <td>{{ $item->no_hp ?? '' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('siswa.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning"><i class="bi bi-pencil text-white"></i></a>
                                            <form action="{{ route('siswa.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach --}}
                            </tbody>
                        </table>

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
