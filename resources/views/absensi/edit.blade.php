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

                        <form method="POST" action="{{ route('absensi/siswa.update', $item->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Tanggal</label>
                                <div class="col-sm-10">
                                    <input type="datetime" class="form-control" name="tanggal" value="{{ $item->created_at->format('Y-m-d H:i') ?? date('Y-m-d H:i') }}" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" value="{{ $item->student->user->name ?? '' }}" required disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="absen-masuk" class="col-sm-2 col-form-label">Absen Masuk</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control inputTime" name="jam_masuk" value="{{ old('jam_masuk', $item->jam_masuk) }}" placeholder="HH:MM" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="absen-pulang" class="col-sm-2 col-form-label">Absen Pulang</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control inputTime" name="jam_pulang" value="{{ old('jam_pulang', $item->jam_pulang) }}" placeholder="HH:MM" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="status_absensi" class="col-sm-2 col-form-label">Status</label>
                                <div class="col-sm-10">
                                    <select name="status" id="status_absensi" class="form-select">
                                        <option value="Hadir" {{ $item->status == 'Hadir' ? 'selected' : '' }}>Hadir</option>
                                        <option value="Sakit" {{ $item->status == 'Sakit' ? 'selected' : '' }}>Sakit</option>
                                        <option value="Izin" {{ $item->status == 'Izin' ? 'selected' : '' }}>Izin</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="3" placeholder="Keterangan" required>{{ $item->keterangan ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="foto" class="col-sm-2 col-form-label">Foto Sebelumnya</label>
                                <div class="col-sm-10">
                                    <img src="{{ Storage::url($item->foto ?? '') }}" alt="" class="img-fluid" width="100" height="100">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="foto" class="col-sm-2 col-form-label">Ubah Foto (Max: 1 MB)</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="foto" id="foto"></input>
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
