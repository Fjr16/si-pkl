@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Jurusan</li>
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
                                <a href="{{ route('jurusan.create') }}" class="btn btn-sm btn-primary ms-auto"><i
                                        class="bi bi-plus-lg"></i> Tambah Jurusan</a>
                            @endif
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    {{-- <th>No</th> --}}
                                    @can('admin')
                                    <th>Id</th>
                                    @endcan
                                    <th>Kode</th>
                                    <th>Nama Jurusan</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        {{-- <td>{{ $loop->iteration }}</td> --}}
                                        @can('admin')                                            
                                        <td>{{ $item->id ?? '' }}</td>
                                        @endcan
                                        <td>{{ $item->kode ?? '' }}</td>
                                        <td>{{ $item->nama ?? '' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('jurusan.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning"><i class="bi bi-pencil text-white"></i></a>
                                            <form action="{{ route('jurusan.destroy', $item->id) }}" method="POST">
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
