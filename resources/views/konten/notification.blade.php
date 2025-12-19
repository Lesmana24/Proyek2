@extends('layouts.main')

@section('title', $title)

@push('page-styles')
  <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
  {{-- Tambahkan CDN FontAwesome untuk ikon sampah --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@section('content')
<div class="container">
    <div class="back-button">
      <a href="{{ route('home') }}" class="back-arrow">
        <img src="{{ asset('image/panah.svg') }}" alt="Kembali" width="24">
      </a>
    </div>

    {{-- HEADER BARU: Flexbox Judul & Tombol --}}
    <div class="header-row">
        <h1 class="title">Notifikasi</h1>

        {{-- Tampilkan tombol hapus HANYA jika ada datanya --}}
        @if($notifications->count() > 0)
            <form action="{{ route('notification.clear') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus SEMUA riwayat notifikasi?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-clear">
                    <i class="fas fa-trash-alt"></i> Reset
                </button>
            </form>
        @endif
    </div>

    <div class="notification-list">
      @forelse($notifications as $notif)
          <div class="notification-item">
            <p>{{ $notif->message }}</p>
            <span class="time">{{ $notif->created_at->translatedFormat('l, d F Y | H:i') }}</span>
          </div>
      @empty
          {{-- Tampilan jika kosong --}}
          <div class="notification-item empty-state">
            <p>Tidak ada riwayat notifikasi.</p>
          </div>
      @endforelse
    </div>
</div>
@endsection
