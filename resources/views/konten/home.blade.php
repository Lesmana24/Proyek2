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
            <p>Suhu</p>
        </div>
        <div class="status-box">
            <h2>60%</h2>
            <p>Kelembaban</p>
        </div>
    </div>
    <button class="btn-setting" onclick="openScheduleModal()">Pengaturan</button>

    <div class="schedule">
        <hr>
        <h3>Jadwal Otomatis</h3>
        <div class="time-container">
            <input type="text" id="customTime" placeholder="10:30">
            <img class="time-icon" src="{{ asset('image/jam.svg') }}" alt="jam"/>
        </div>
        <button class="btn-set" onclick="openScheduleModal()">Set Jadwal</button>
    </div>

    <!-- Modal Popup -->
    <div id="scheduleModal" class="modal">
        <div class="modal-content">
            <span class="close-btn" onclick="closeScheduleModal()">&times;</span>
            <h2>Pengaturan Jadwal Penyiraman</h2>
            
            <div class="form-group">
                <label for="scheduleTime">Waktu Penyiraman:</label>
                <input type="time" id="scheduleTime" placeholder="Pilih waktu">
            </div>

            <div class="form-group">
                <label for="scheduleDays">Pilih Hari:</label>
                <div class="checkbox-group">
                    <label><input type="checkbox" value="Senin"> Senin</label>
                    <label><input type="checkbox" value="Selasa"> Selasa</label>
                    <label><input type="checkbox" value="Rabu"> Rabu</label>
                    <label><input type="checkbox" value="Kamis"> Kamis</label>
                    <label><input type="checkbox" value="Jumat"> Jumat</label>
                    <label><input type="checkbox" value="Sabtu"> Sabtu</label>
                    <label><input type="checkbox" value="Minggu"> Minggu</label>
                </div>
            </div>

            <div class="form-group">
                <label for="waterDuration">Durasi Penyiraman (menit):</label>
                <input type="number" id="waterDuration" min="1" max="60" placeholder="Contoh: 5" value="5">
            </div>

            <div class="form-group">
                <label for="waterFrequency">Frekuensi per hari:</label>
                <input type="number" id="waterFrequency" min="1" max="10" placeholder="Contoh: 1" value="1">
            </div>

            <div class="modal-buttons">
                <button class="btn-cancel" onclick="closeScheduleModal()">Batal</button>
                <button class="btn-save" onclick="saveSchedule()">Simpan Jadwal</button>
            </div>
        </div>
    </div>

    <img class="leaf left" src="{{ asset('image/daun.png') }}" alt="leaf" />
    <img class="leaf right" src="{{ asset('image/daun.png') }}" alt="leaf" />
</div>
@endsection

@push('page-scripts')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Initialize Flatpickr
    flatpickr("#customTime", {
        enableTime: true,
        dateFormat: "H:i",
        time_24hr: true,
        minuteIncrement: 1,
        defaultHour: 10,
        defaultMinute: 30,
    });
</script>

<!-- Modal Script - Terpisah untuk memastikan global scope -->
<script>
    // Modal Functions - Global Scope
    window.openScheduleModal = function() {
        console.log('openScheduleModal dipanggil');
        const modal = document.getElementById('scheduleModal');
        console.log('Modal element:', modal);
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            console.log('Modal ditampilkan');
        } else {
            console.error('Modal element tidak ditemukan!');
        }
    }

    window.closeScheduleModal = function() {
        console.log('closeScheduleModal dipanggil');
        const modal = document.getElementById('scheduleModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            console.log('Modal disembunyikan');
        }
    }

    window.saveSchedule = function() {
        const time = document.getElementById('scheduleTime').value;
        const duration = document.getElementById('waterDuration').value;
        const frequency = document.getElementById('waterFrequency').value;
        const checkboxes = document.querySelectorAll('.checkbox-group input[type="checkbox"]:checked');
        
        const days = Array.from(checkboxes).map(cb => cb.value);

        if (!time || days.length === 0 || !duration) {
            alert('Silakan lengkapi semua data jadwal!');
            return;
        }

        const schedule = {
            time: time,
            days: days,
            duration: duration,
            frequency: frequency
        };

        console.log('Jadwal Disimpan:', schedule);
        alert(`Jadwal penyiraman berhasil disimpan!\n\nWaktu: ${time}\nHari: ${days.join(', ')}\nDurasi: ${duration} menit\nFrekuensi: ${frequency}x per hari`);
        
        window.closeScheduleModal();
    }

    // Close modal if user clicks outside
    window.addEventListener('click', function(event) {
        const modal = document.getElementById('scheduleModal');
        if (event.target === modal) {
            window.closeScheduleModal();
        }
    });
</script>
@endpush