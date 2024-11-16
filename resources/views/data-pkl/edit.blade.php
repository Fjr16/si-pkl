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

                        <form method="POST" action="{{ route('data/pkl/siswa.update', $item->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="row mb-3">
                                <label for="student_id" class="col-sm-2 col-form-label">Nama Siswa</label>
                                <div class="col-sm-10">
                                    <select name="student_id" id="student_id" class="form-select" required>
                                        <option selected disabled>Pilih Siswa</option>
                                        @foreach ($data as $siswa)
                                            <option value="{{ $siswa->id }}" {{ old('student_id', $item->student_id == $siswa->id) ? 'selected' : '' }}>{{ $siswa->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jurusan" id="jurusan" value="{{ $item->student->major->nama ?? '-' }}" placeholder="Jurusan" @disabled(true)>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="jenis-kelamin" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" value="{{ $item->student->jk ?? '-' }}" placeholder="Jenis Kelamin" @disabled(true)>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="dudi_id" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                                <div class="col-sm-10">
                                    <select name="dudi_id" id="dudi_id" class="form-select" required>
                                        <option selected disabled>Pilih Perusahaan</option>
                                        @foreach ($dataDudis as $dudi)
                                            <option value="{{ $dudi->id }}" {{ $dudi->id == $item->dudi_id ? 'selected' : '' }}>{{ $dudi->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="teacher_id" class="col-sm-2 col-form-label">Nama Pembimbing</label>
                                <div class="col-sm-10">
                                    <select name="teacher_id" id="teacher_id" class="form-select" required>
                                        <option selected disabled>Pilih Pembimbing</option>
                                        @foreach ($teachers as $teacher)
                                            <option value="{{ $teacher->id }}" {{ $teacher->id == $item->teacher_id ? 'selected' : '' }}>{{ $teacher->user->name ?? '-' }}</option>
                                        @endforeach
                                    </select>
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

        async function fetchDataDudis(major_id){
            const url = "{{ route('get/data.dudi', ':id') }}".replace(':id', major_id);

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

        const students = @json($data);
        document.getElementById('student_id').addEventListener('change', async function() {
            const majorInput = document.getElementById('jurusan');
            const jkInput = document.getElementById('jenis_kelamin');
            const dudiSelect = document.getElementById('dudi_id');

            // set value to null
            majorInput.value = null;
            jkInput.value = null;

            const selectedStudentId = parseInt(this.value);
            const itemSelectedStudent = students.find(function(item){
                return item.id === selectedStudentId;
            });

            if (itemSelectedStudent) {
                majorInput.value = itemSelectedStudent.major.nama; 
                jkInput.value = itemSelectedStudent.jk; 
            }else{
                alert('Tidak Ditemukan Data Siswa Yang Sesuai Pilihan Anda');
            }
            if (itemSelectedStudent.major_id) {
                const res = await fetchDataDudis(itemSelectedStudent.major_id);
                if (res) {
                    dataDudiToFormSelect(res, dudiSelect);
                    // console.log(res);
                }else{
                    alert('Terjadi Kesalahan Atau Data Tidak Ditemukan');
                }
            }else{
                alert('Data Jurusan Siswa Tidak Ditemukan, Mohon Lengkapi Data');
            }
        });


        function dataDudiToFormSelect(data, element) {
            let dudis = `<option selected disabled>Pilih Perusahaan</option>`;
            data.forEach(item => {
                dudis += `<option value="${item.id}">${item.user.name ?? '-'}</option>`;
            });
            element.innerHTML = dudis;
            element.disabled = false;
        }
    </script>
@endpush
