@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Daftar Admin</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Jabatan</th>
                    <th>Alamat</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($admins as $admin)
                    <tr>
                        <td>{{ $admin->id }}</td>
                        <td>{{ $admin->nama }}</td>
                        <td>{{ $admin->username }}</td>
                        <td>{{ $admin->jabatan }}</td>
                        <td>{{ $admin->alamat }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.destroy', $admin->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
