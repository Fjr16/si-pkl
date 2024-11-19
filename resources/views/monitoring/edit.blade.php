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

                        <form method="POST" action="{{ route('monitoring/guru.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-sm-2 col-form-label">Nama Guru</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $item->teacher->user->name ?? auth()->user()->name }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <select name="student_id" id="student_id" class="form-select">
                                        <option selected disabled>Pilih Siswa</option>
                                        @foreach ($data as $student)
                                            <option value="{{ $student->id }}" {{ $item->student_id == $student->id ? 'selected' : '' }}>{{ $student->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jurusan" value="{{ $item->student->major->nama ?? '' }}" placeholder="Jurusan" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dudi_name" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="dudi_name" value="{{ $item->student->pklData->dudi->user->name ?? '' }}" placeholder="Nama Perusahaan" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kejadian" class="col-sm-2 col-form-label">Kejadian</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="kejadian" id="kejadian" cols="30" rows="2" placeholder="Kejadian">{!! $item->kejadian ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="4" placeholder="Keterangan">{!! $item->keterangan ?? '' !!}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tindakan" value="{{ $item->tindakan ?? '' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dokumentasi" class="col-sm-2 col-form-label">Foto Sebelumnya</label>
                                <div class="col-sm-10">
                                    <img src="{{ Storage::url($item->dokumentasi) }}" alt="" width="100" height="100" class="img-fluid">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dokumentasi" class="col-sm-2 col-form-label">Foto Dokumentasi</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="dokumentasi">
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
