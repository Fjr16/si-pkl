@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Sertifikat</li>
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

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Siswa</th>
                                    <th>Dudi</th>
                                    <th>Guru Pembimbing</th>
                                    <th>Sertifikat</th>
                                    <th>Status</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->student->user->name ?? '-' }}</td>
                                        <td>{{ $item->dudi->user->name ?? '-' }}</td>
                                        <td>{{ $item->teacher->user->name ?? '-' }}</td>
                                        <td>
                                            @if ($item->certificate)
                                            <div class="d-flex">
                                                <a href="{{ route('sertifikat.download', $item->certificate->id) }}" class="btn btn-sm btn-primary me-1"><i class="bi bi-download"></i> Unduh</a>
                                                @if ($item->certificate->status === 'pending')
                                                    <a href="{{ route('sertifikat/signature.add', $item->certificate->id) }}" class="btn btn-sm btn-success"><i class="bi bi-vector-pen"></i> Validasi</a>
                                                @endif
                                            </div>
                                            @else
                                                <a href="{{ route('sertifikat.create', $item->id) }}" class="btn btn-sm btn-primary">Upload</a>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="badge bg-{{ $item->certificate ? ($item->certificate->status === 'approved' ? 'success' : 'warning') : 'warning' }}">
                                                {{ $item->certificate ? $item->certificate->status : 'pending' }}
                                            </span>
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('sertifikat.edit', $item->id) }}"
                                                class="btn btn-sm btn-warning"><i class="bi bi-pencil text-white"></i></a>
                                        </td> --}}
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
