@extends('layouts.backend.main')
@section('content')
    <div class="pagetitle d-flex">
        <div class="">
            <h1>{{ $title ?? '' }}</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Monitoring Guru</li>
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

                        <form method="POST" action="{{ route('monitoring/guru.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-sm-2 col-form-label">Nama Guru</label>
                                <div class="col-sm-10">
                                    <input type="hidden" name="teacher_id" id="teacher_id" value="{{ auth()->user()->teacher->id ?? '-' }}">
                                    <input type="text" class="form-control" value="{{ auth()->user()->name ?? '-' }}" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <select name="student_id" id="student_id" class="form-select">
                                        <option selected disabled>Pilih Siswa</option>
                                        @foreach ($data as $item)
                                            <option value="{{ $item->id }}">{{ $item->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="jurusan" value="" placeholder="Jurusan" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dudi_name" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="dudi_name" value="" placeholder="Nama Perusahaan" disabled>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="kejadian" class="col-sm-2 col-form-label">Kejadian</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="kejadian" id="kejadian" cols="30" rows="2" placeholder="Kejadian"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" name="keterangan" id="keterangan" cols="30" rows="4" placeholder="Keterangan"></textarea>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="tindakan" class="col-sm-2 col-form-label">Tindakan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="tindakan">
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dokumentasi" class="col-sm-2 col-form-label">Foto Dokumentasi</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="dokumentasi" required>
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

@push('scripts')
    <script>

        async function fetchDataDudis(student_id){
            const url = "{{ route('monitoring/get/pkl.data', ':id') }}".replace(':id', student_id);

            try {
                const response = await fetch(url, {
                    method : 'GET',
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'something went wrong');
                }

                const result = await response.json();
                return result.data;
            } catch (error) {
                console.log('Error', error.message);
                return null;
            }
        }

        document.getElementById('student_id').addEventListener('change', async function() {
            const majorInput = document.getElementById('jurusan');
            const dudiInput = document.getElementById('dudi_name');
            const student_id = this.value;

            // set value to null
            majorInput.value = null;
            dudiInput.value = null;
            if (student_id) {
                const res = await fetchDataDudis(student_id);
                if (res) {
                    majorInput.value = res.jurusan;
                    dudiInput.value = res.nama_perusahaan;
                    console.log(res);
                }else{
                    alert('Terjadi Kesalahan Atau Data PKL Tidak Ditemukan');
                }
            }else{
                alert('Mohon Pilih Siswa terlebih dahulu');
            }
        });
    </script>
@endpush