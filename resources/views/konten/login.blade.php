@extends('layouts.main')

@section('title', $title)
@push('page-styles')
  <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<div class="main-container">
  <a href="/" class="back-arrow"><img src="{{ asset('image/panah.svg') }}"></a>

  <div class="form-card-wrapper">
    <div class="form-card">
      <h2>Masuk</h2>

      <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="input-group">
          <input type="text" name="nama" value="{{ old('nama') }}" class="input-field" required placeholder=" ">
          <label class="input-label">
            <img src="{{ asset('image/person.svg') }}"><span>Nama</span>
          </label>
        </div>

        <div class="input-group">
          <input type="password" name="password" class="input-field" required placeholder=" ">
          <label class="input-label">
            <img src="{{ asset('image/lock.svg') }}"><span>Password</span>
          </label>
        </div>

        @if($errors->any())
          <div style="color:red;font-size:14px;margin-bottom:15px">
            @foreach($errors->all() as $e) {{ $e }}<br> @endforeach
          </div>
        @endif
        <div class="form-actions">
        <button type="submit" class="btn-login">Masuk</button>
        <p class="redirect-daftar">
        Belum punya akun? <a href="daftar">Daftar</a>
      </p>
        </div>
      </form>
    </div>
  </div>

  <div class="image-side">
    <img src="{{ asset('image/pohon.png') }}" alt="Tanaman" class="image-plant">
  </div>
</div>
@endsection