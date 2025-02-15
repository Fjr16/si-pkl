@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Data Guru</li>
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
                            <div class="ms-auto">
                                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#uploadExcel">
                                    <i class="bi bi-upload"></i>
                                    Excel
                                </button>
                                @can('admin')
                                    <a href="{{ route('guru.create') }}" class="btn btn-sm btn-primary"><i
                                            class="bi bi-plus-lg"></i> Tambah Guru</a>
                                @endcan
                            </div>
                        </div>

                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Nama</th>
                                    <th>JK</th>
                                    <th>No. HP</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user->username ?? '' }}</td>
                                        <td>{{ $item->user->email ?? '' }}</td>
                                        <td>{{ $item->user->name ?? '' }}</td>
                                        <td>{{ $item->jk ?? '' }}</td>
                                        <td>{{ $item->no_hp ?? '' }}</td>
                                        <td class="d-flex">
                                            <a href="{{ route('guru.edit', $item->id) }}" class="btn btn-sm btn-warning"><i
                                                    class="bi bi-pencil text-white"></i></a>
                                            @can('admin')
                                            <form action="{{ route('guru.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger ms-2"
                                                    onclick="return confirm('Yakin ingin menghapus data?')"><i
                                                        class="bi bi-trash"></i></button>
                                            </form>
                                            @endcan
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

    <!-- Modal -->
    <div class="modal fade" id="uploadExcel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('guru.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Guru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="col">
                            <label for="teacher_excel" class="form-label">Upload File Excel</label>
                            <input type="file" name="teacher_excel" id="teacher_excel" class="form-control" @required(true)>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endsection
