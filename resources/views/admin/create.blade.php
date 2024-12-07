@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Tambah Admin</h1>
    <form action="{{ route('admin.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" name="nama" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jabatan">Jabatan</label>
            <input type="text" name="jabatan" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="alamat">Alamat</label>
            <textarea name="alamat" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
