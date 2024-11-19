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
                        </div>

                        <form method="POST" action="{{ route('absensi/siswa.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="datetime" class="form-control" name="tanggal" value="{{ date('Y-m-d H:i') }}" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <input type="hidden" class="form-control" name="student_id" value="{{ auth()->user()->student->id }}">
                                    <input type="text" class="form-control" value="{{ auth()->user()->name ?? '' }}" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="absen-masuk" class="col-sm-2 col-form-label">Absen Masuk</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control inputTime" name="jam_masuk" placeholder="HH:MM" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="absen-pulang" class="col-sm-2 col-form-label">Absen Pulang</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control inputTime" name="jam_pulang" placeholder="HH:MM" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status_absensi" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status_absensi" class="form-select">
                                        <option value="Hadir" selected>Hadir</option>
                                        <option value="Sakit">Sakit</option>
                                        <option value="Izin">Izin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="3" placeholder="Keterangan" required></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="foto" class="col-sm-2 col-form-label">Upload Foto (Max: 1 MB)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="foto" id="foto" required></input>
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
