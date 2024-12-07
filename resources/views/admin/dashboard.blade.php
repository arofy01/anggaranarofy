@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Dashboard Admin</h1>
    <p>Selamat datang, {{ Auth::user()->name }}. Anda memiliki akses sebagai admin.</p>
</div>
@endsection
