@extends('layout.aplikasi')

@section('content')
    <div class="mb-3">
        @if ($errors->any())
            <div class="mb-5">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nama" class="form-label">Nama</label>
            <input type="text" class="form-control" name="nama" value="{{ old('nama') ?? $siswa->nama }}">
        </div>
        <div class="mb-3">
            <label for="nim" class="form-label">Nim</label>
            <input type="number" class="form-control" name="nim" value="{{ old('nim') ?? $siswa->nim }}">
        </div>
        <div class="mb-3">
            <label for="gender" class="form-label">Gender</label>
            <select name="gender" class="form-control" aria-label="Default select example">
                <option selected value="{{ $siswa->gender }}">{{ $siswa->gender }}</option>
                <option value="L">L</option>
                <option value="P">P</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea name="alamat" class="form-control">{!! old('alamat') ?? $siswa->alamat !!}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
