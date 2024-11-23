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
                            <h5 class="card-title">Validasi Pembimbing</h5>
                        </div>
                        <form action="{{ route('sertifikat/signature.store', $item->id) }}" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="signature" id="dataImage"></input>
                            <canvas id="signatureCanvas" width="500" height="200" style="border: 1px solid black;"></canvas>
                            <div class="">
                                <button type="button" id="clearSignature" class="btn btn-sm btn-danger">Clear</button>
                                <button type="submit" id="saveSignature" class="btn btn-sm btn-primary">Save</button>
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
        const canvas = document.getElementById('signatureCanvas');
        const ctx = canvas.getContext('2d');
        const dataImage = document.getElementById('dataImage');
        let isDrawing = false;

        canvas.addEventListener('mousedown', (e) => {
            isDrawing = true;
            ctx.beginPath();
            ctx.moveTo(e.offsetX, e.offsetY);
        });

        canvas.addEventListener('mousemove', (e) => {
            if (isDrawing) {
                ctx.lineTo(e.offsetX, e.offsetY);
                ctx.stroke();
            }
        });

        canvas.addEventListener('mouseup', () => {
            isDrawing = false;
        });

        document.getElementById('clearSignature').addEventListener('click', () => {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            dataImage.value = null;
        });

        document.getElementById('saveSignature').addEventListener('click', () => {
            const signatureImage = canvas.toDataURL('image/png');
            dataImage.value = signatureImage;
        });
    </script>
@endpush
