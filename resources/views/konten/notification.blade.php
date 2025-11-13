@extends('layouts.main')

@section('title', $title)
@push('page-styles')
  <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
@endpush

@section('content')
    <div class="back-button">
      <a href="{{ route('home') }}" class="back-arrow"><img src="{{ asset('image/panah.svg') }}" alt="Kembali"></a>
    </div>
    
    <h1 class="title">Notifikasi</h1>
    
    <div class="notification-list">
      <div class="notification-item">
        <p>Penyiraman selesai! Tanaman telah mendapatkan air yang cukup</p>
        <span class="time">15:30</span>
      </div>
      <div class="notification-item">
        <p>Penyiraman selesai! Tanaman telah mendapatkan air yang cukup</p>
        <span class="time">15:30</span>
      </div>
      <div class="notification-item">
        <p>Penyiraman selesai! Tanaman telah mendapatkan air yang cukup</p>
        <span class="time">15:30</span>
      </div>
      <div class="notification-item">
        <p>Penyiraman selesai! Tanaman telah mendapatkan air yang cukup</p>
        <span class="time">15:30</span>
      </div>
      <div class="notification-item">
        <p>Penyiraman selesai! Tanaman telah mendapatkan air yang cukup</p>
        <span class="time">15:30</span>
      </div>
    </div>
  </div>
@endsection