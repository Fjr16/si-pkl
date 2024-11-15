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

                        <form method="POST" action="{{ route('siswa.update', $siswa->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $siswa->user->username ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $siswa->user->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $siswa->user->name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="nis" class="col-sm-2 col-form-label">NIS</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nis" value="{{ $siswa->nis ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jk" aria-label="Default select example" required>
                                        <option selected disabled value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki"{{ $siswa->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="Perempuan"{{ $siswa->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tmp_lhr"
                                        value="{{ $siswa->tmp_lhr ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_lhr"
                                        value="{{ $siswa->tgl_lhr ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" class="form-control" required>{{ $siswa->alamat ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNoHP" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="number" name="no_hp" class="form-control"
                                        value="{{ $siswa->no_hp ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputJurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="major_id" aria-label="Default select example"
                                        required>
                                        <option selected disabled value="">Pilih Jurusan</option>
                                        @foreach ($majors as $major)
                                            <option
                                                value="{{ $major->id }}"{{ $siswa->major_id == $major->id ? 'selected' : '' }}>
                                                {{ $major->kode ?? '' }} | {{ $major->nama ?? '' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control">
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
