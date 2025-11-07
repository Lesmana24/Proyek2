@extends('layouts.main')

@push('page-styles')
    {{-- flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/suhu.css') }}">
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

<div class="logo">
  <div class="back-button">
      <a href="{{ route('home') }}" class="back-arrow"><img src="{{ asset('image/panah.svg') }}" alt="Kembali"></a>
    </div>
    <div class="logo-circle">
        <img src="{{ asset('image/logo copy.png') }}" alt="Logo" />
    </div>

    <div class="card">
      <h3>Suhu</h3>
      <hr>
      <div class="temperature">
        <button id="minus">−</button>
        <span id="temp-value">24°</span>
        <button id="plus">+</button>
      </div>
      <button class="set-btn">Set Jadwal</button>
    </div>
    <img class="leaf left" src="{{ asset('image/daun.png') }}" alt="leaf" />
    <img class="leaf right" src="{{ asset('image/daun.png') }}" alt="leaf" />
</div>
@endsection

@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
  // JS untuk interaksi suhu — dijalankan setelah DOM siap
  document.addEventListener('DOMContentLoaded', function() {
    const minusBtn = document.getElementById('minus');
    const plusBtn = document.getElementById('plus');
    const tempDisplay = document.getElementById('temp-value');

    if (!tempDisplay) return; // safety

    let temperature = parseInt(String(tempDisplay.textContent).replace(/[^0-9-]/g, '')) || 24;

    function updateTemp() {
      tempDisplay.textContent = temperature + "°";
      tempDisplay.classList.add('pop');
      setTimeout(() => tempDisplay.classList.remove('pop'), 200);
    }

    if (minusBtn) {
      minusBtn.addEventListener('click', () => {
        if (temperature > 10) {
          temperature--;
          updateTemp();
        }
      });
    }

    if (plusBtn) {
      plusBtn.addEventListener('click', () => {
        if (temperature < 40) {
          temperature++;
          updateTemp();
        }
      });
    }
  });
</script>
@endpush