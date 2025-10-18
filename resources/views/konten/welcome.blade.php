@extends('layouts.main')
@section('title', $title)
@push('page-styles')
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
@endpush
@section('content')
<img src="{{ asset('image/daun.png') }}" alt="Daun Kiri" class="leaf kiri">

    <div class="main-content">
        <div class="judul">
            <h1>
                Kebun Pintar <br>
                Jondol Tani <br>
                Lelea
            </h1>
        </div>
    </div>

    <div class="button-group">
        <a href="login" class="masuk">Login</a>
        <a href="daftar" class="daftar">Daftar</a>
    </div>
    
    <img src="{{ asset('image/daun.png') }}" alt="Daun Kanan" class="leaf kanan">
@endsection