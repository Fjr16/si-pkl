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
                        </div>

                        <form method="POST" action="{{ route('guru.update', $guru->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $guru->user->username ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $guru->user->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $guru->user->name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputJK" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jk" aria-label="Default select example" required>
                                        <option selected disabled value="">Pilih Jenis Kelamin</option>
                                        <option value="Laki-Laki"{{ $guru->jk == 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki
                                        </option>
                                        <option value="Perempuan"{{ $guru->jk == 'Perempuan' ? 'selected' : '' }}>Perempuan
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTempatLahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tmp_lhr"
                                        value="{{ $guru->tmp_lhr ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTanggalLahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tgl_lhr"
                                        value="{{ $guru->tgl_lhr ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" class="form-control" required>{{ $guru->alamat ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNoHP" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="number" name="no_hp" class="form-control"
                                        value="{{ $guru->no_hp ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputGolongan" class="col-sm-2 col-form-label">Golongan</label>
                                <div class="col-sm-10">
                                    <input type="text" name="golongan" class="form-control"
                                        value="{{ $guru->golongan ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputBidangStudi" class="col-sm-2 col-form-label">Bidang Studi</label>
                                <div class="col-sm-10">
                                    <input type="text" name="bidang_studi" class="form-control"
                                        value="{{ $guru->bidang_studi ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPendidikanTerakhir" class="col-sm-2 col-form-label">Pend.
                                    Terakhir</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="pend_terakhir" aria-label="Default select example"
                                        required>
                                        <option selected disabled value="">Pilih Pendidikan Terakhir</option>
                                        <option
                                            value="SLTA Sederajat"{{ $guru->pend_terakhir == 'SLTA Sederajat' ? 'selected' : '' }}>
                                            SLTA Sederajat</option>
                                        <option value="DIII"{{ $guru->pend_terakhir == 'DIII' ? 'selected' : '' }}>DIII
                                        </option>
                                        <option value="DIV/S1"{{ $guru->pend_terakhir == 'DIV/S1' ? 'selected' : '' }}>
                                            DIV/S1</option>
                                        <option value="S2"{{ $guru->pend_terakhir == 'S2' ? 'selected' : '' }}>S2
                                        </option>
                                        <option value="S3"{{ $guru->pend_terakhir == 'S3' ? 'selected' : '' }}>S3
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputGolonganDarah" class="col-sm-2 col-form-label">Golongan Darah</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="gol_darah" aria-label="Default select example"
                                        required>
                                        <option selected disabled value="">Pilih Golongan Darah</option>
                                        <option value="A"{{ $guru->gol_darah == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B"{{ $guru->gol_darah == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="AB"{{ $guru->gol_darah == 'AB' ? 'selected' : '' }}>AB</option>
                                        <option value="O"{{ $guru->gol_darah == 'O' ? 'selected' : '' }}>O</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputJabatan" class="col-sm-2 col-form-label">Jabatan</label>
                                <div class="col-sm-10">
                                    <select class="form-select" name="jabatan" aria-label="Default select example"
                                        required>
                                        <option selected disabled value="">Pilih Jabatan</option>
                                        <option value="ASN"{{ $guru->jabatan == 'ASN' ? 'selected' : '' }}>ASN</option>
                                        <option value="Honorer"{{ $guru->jabatan == 'Honorer' ? 'selected' : '' }}>Honorer
                                        </option>
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
