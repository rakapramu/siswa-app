@extends('layout.aplikasi')

@section('content')
    <div class="container mb-3">
        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Kembali</a>
    </div>
    <div class="card text-bg-info mb-3" style="max-width: 18rem;">
        <div class="card-header">Profile Mahasiswa</div>
        <div class="card-body">
            <h5 class="card-title">Nama : {{ $data->nama }}</h5>
            <p class="card-text">Nim : {{ $data->nim }}</p>
            <p class="card-text">Jenis Kelamin : {{ $data->gender }}</p>
            <p class="card-text">Alamat : {{ $data->alamat }}</p>
        </div>
    </div>
@endsection
