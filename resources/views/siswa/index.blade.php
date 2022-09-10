@extends('layout.aplikasi')

@section('content')
    @if (Session::get('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if (Session::get('update'))
        <div class="alert alert-success">{{ Session::get('update') }}</div>
    @endif
    <a href="{{ route('siswa.create') }}" class="btn btn-primary">Tambah Data</a>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Photo</th>
                <th scope="col">Jenis Kelamin</th>
                <th scope="col">Nim</th>
                <th scope="col">Alamat</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($datas as $data)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>
                        {{-- menampilkan foto caranya begini ya --}}
                        <img src="{{ asset('fotomahasiswa/' . $data->foto) }}" alt="fotomahasiswa" width="50">
                    </td>
                    <td>{{ $data->gender }}</td>
                    <td>{{ $data->nim }}</td>
                    <td>{{ $data->alamat }}</td>
                    <td>

                        <form action="{{ route('siswa.destroy', $data->id) }}" method="POST">

                            <a href="{{ route('siswa.show', $data->id) }}" class="btn btn-secondary btn-sm">View</a>

                            <a class="btn btn-primary btn-sm" href="{{ route('siswa.edit', $data->id) }}">Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $datas->links() }}
@endsection
