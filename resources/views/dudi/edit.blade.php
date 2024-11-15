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

                        <form method="POST" action="{{ route('dudi.update', $dudi->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="inputUsername" class="col-sm-2 col-form-label">Username</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="username"
                                        value="{{ $dudi->user->username ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control" name="email"
                                        value="{{ $dudi->user->email ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNama" class="col-sm-2 col-form-label">Nama</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="nama"
                                        value="{{ $dudi->user->name ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputPimpinan" class="col-sm-2 col-form-label">Pimpinan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="pimpinan"
                                        value="{{ $dudi->pimpinan ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNIPPimpinan" class="col-sm-2 col-form-label">NIP Pimpinan</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="nip"
                                        value="{{ $dudi->nip ?? '' }}">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputAlamat" class="col-sm-2 col-form-label">Alamat</label>
                                <div class="col-sm-10">
                                    <textarea name="alamat" class="form-control" required>{{ $dudi->alamat ?? '' }}</textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputKota" class="col-sm-2 col-form-label">Kota</label>
                                <div class="col-sm-10">
                                    <input type="text" name="kota" class="form-control"
                                        value="{{ $dudi->kota ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNoHP" class="col-sm-2 col-form-label">No. HP</label>
                                <div class="col-sm-10">
                                    <input type="number" name="no_hp" class="form-control"
                                        value="{{ $dudi->no_hp ?? '' }}" required>
                                </div>
                            </div>
                            <div class="row pb-2 mb-0 border-bottom">
                                <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                                <div class="col-sm-10">
                                    <input type="password" name="password" class="form-control">
                                </div>
                            </div>

                             {{--  --}}
                             <h5 class="card-title"> Jurusan Yang Diterima</h5>
                             <div class="row mb-3 border-bottom pb-2">
                                 @foreach ($data as $item)
                                 <div class="col-md-4">
                                     <div class="form-check form-check-inline">
                                       <input class="form-check-input" type="checkbox" id="jurusan_{{ $loop->iteration }}" value="{{ $item->id }}" name="major_id[]" {{ in_array($item->id, $dudi->majors()->pluck('major_id')->toArray()) ? 'checked' : '' }}/>
                                       <label class="form-check-label" for="jurusan_{{ $loop->iteration }}">{{ $item->nama ?? '-' }}</label>
                                     </div>
                                 </div>
                                 @endforeach
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
