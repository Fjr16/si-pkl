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
                        </div>

                        <form method="POST" action="{{ route('data/pkl/siswa.store') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <select name="student_id" id="student_id" class="form-select">
                                        <option value="siswa 1" selected>siswa 1</option>
                                        <option value="siswa 2" selected>siswa 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jurusan" id="jurusan" value="TKJ" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="Laki-Laki" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dudi_id" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <select name="dudi_id" id="dudi_id" class="form-select">
                                        <option value="perusahaan 1" selected>perusahaan 1</option>
                                        <option value="perusahaan 2" selected>perusahaan 2</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-sm-2 col-form-label">Nama Pembimbing</label>
                                <div class="col-sm-10">
                                    <select name="teacher_id" id="teacher_id" class="form-select">
                                        <option value="guru 1" selected>guru 1</option>
                                        <option value="guru 2" selected>guru 2</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row mb-3">
                                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="alamat" id="alamat" cols="30" rows="3" placeholder="Alamat" required></textarea>
                                </div>
                            </div> --}}
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
