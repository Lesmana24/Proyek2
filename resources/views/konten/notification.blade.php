@extends('layouts.main')

@section('title', $title)
@push('page-styles')
  {{-- Pastikan file CSS kamu ada di public/css/notification.css --}}
  <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
@endpush

@section('content')
<div class="container">
    <div class="back-button">
      <a href="{{ route('home') }}" class="back-arrow">
        {{-- Ganti gambar panah sesuai aset kamu --}}
        <img src="{{ asset('image/panah.svg') }}" alt="Kembali" width="24">
      </a>
    </div>

    <h1 class="title">Notifikasi</h1>

    <div class="notification-list">
      {{-- === MULAI LOOPING DATA DATABASE === --}}
      @forelse($notifications as $notif)
          <div class="notification-item">
            <p>{{ $notif->message }}</p>
            {{-- Format jam: 15:30 --}}
            <span class="time">{{ $notif->created_at->format('H:i') }}</span>
          </div>
      @empty
          {{-- Jika database kosong --}}
          <div class="notification-item" style="justify-content: center; background: #ddd; color: #555;">
            <p>Belum ada riwayat minggu ini.</p>
          </div>
      @endforelse
      {{-- === SELESAI LOOPING === --}}
    </div>
</div>
@endsection