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

                        <form method="POST" action="{{ route('sertifikat.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="dudi_id" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <select name="dudi_id" id="dudi_id" class="form-select">
                                        <option value="perusahaan 1" selected disabled>perusahaan 1</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <select name="student_id" id="student_id" class="form-select">
                                        <option value="siswa 1">siswa 1</option>
                                        <option value="siswa 2">siswa 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-sm-2 col-form-label">Guru Pembimbing</label>
                                <div class="col-sm-10">
                                    <select name="teacher_id" id="teacher_id" class="form-select">
                                        <option value="guru 1">guru 1</option>
                                        <option value="guru 2">guru 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="file-sertifikat" class="col-sm-2 col-form-label">Upload Sertifikat</label>
                                <div class="col-sm-10">
                                    <input type="file" name="file_sertifikat" class="form-control" required>
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
