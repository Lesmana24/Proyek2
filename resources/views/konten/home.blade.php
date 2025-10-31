@extends('layouts.main')

@section('title', $title)
@push('page-styles')
    {{-- flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
{{-- KONTEN MULAI --}}
<div class="navbar">
    <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="logout">Log Out</button>
    </form>
    <div class="notif">
        <a href="{{ url('/notification') }}"><img src="{{ asset('image/notif.svg') }}" alt="Notifikasi"/></a>
    </div>
</div>

<h1>Halo,<br>Pak Jondol</h1>

<div class="card">
    <div class="logo-circle">
        <img src="{{ asset('image/logo.png') }}" alt="Logo" />
    </div>

    <div class="status">
        <div class="status-box">
            <h2>24°</h2>
            <p>Pengaturan Suhu</p>
        </div>
        <div class="status-box">
            <h2>60%</h2>
            <p>Kelembaban</p>
        </div>
    </div>

    <div class="schedule">
        <h3>Jadwal Otomatis</h3>
        <div class="time-container">
            <input type="text" id="customTime" placeholder="10:30">
            <img class="time-icon" src="{{ asset('image/jam.svg') }}" alt="jam"/>
        </div>
        <button class="btn-set">Set Jadwal</button>
    </div>

    <img class="leaf left" src="{{ asset('image/daun.png') }}" alt="leaf" />
    <img class="leaf right" src="{{ asset('image/daun.png') }}" alt="leaf" />
</div>
@endsection

@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#customTime", {
        enableTime: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 1,
        defaultHour: 10,
        defaultMinute: 30,
    });
</script>
@endpush