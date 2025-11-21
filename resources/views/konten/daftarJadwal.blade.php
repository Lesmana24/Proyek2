@extends('layouts.main')

@push('page-styles')
<link rel="stylesheet" href="{{ asset('css/daftarJadwal.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
@endpush

@section('content')

<div class="navbar">
    <form action="{{ route('logout') }}" method="POST" style="display:inline">
        @csrf
        <button type="submit" class="logout">Log Out</button>
    </form>

    <div class="notif">
        <a href="{{ url('/notification') }}">
            <img src="{{ asset('image/notif.svg') }}" alt="Notifikasi"/>
        </a>
    </div>
</div>

<h1>Halo,<br>Pak Jondol</h1>

<div class="logo">

    {{-- BACK BUTTON --}}
    <div class="back-button">
        <a href="{{ route('home') }}" class="back-arrow">
            <img src="{{ asset('image/panah.svg') }}" alt="Kembali">
        </a>
    </div>

    {{-- LOGO --}}
    <div class="logo-circle">
        <img src="{{ asset('image/logo copy.png') }}" alt="Logo" />
    </div>

    {{-- CARD --}}
    <div class="card animate-card">

        <div class="card-header">
            <h3>Daftar Jadwal</h3>

            <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                <i class="fa-solid fa-bars menu-icon" id="menuIcon"></i>
            </button>
        </div>
        <hr>

        {{-- LIST JADWAL --}}
        <div class="schedule-list" id="scheduleList">

            @foreach ([['15:30'], ['18:30'], ['11:00'], ['15:00']] as $item)
            <div class="schedule-item" data-id="{{ $loop->index }}">

                <button class="action-btn"></button>

                <div class="schedule-info">
                    <img src="{{ asset('image/jadwall.png') }}" alt="icon" />
                    <div>
                        <h4>Jadwal Penyiraman</h4>
                        <p>{{ $item[0] }}</p>
                    </div>
                </div>

                <div class="schedule-actions">
                    <button class="set-btn">Set</button>
                </div>
            </div>
            @endforeach

        </div>

    </div>

    <img class="leaf left" src="{{ asset('image/daun.png') }}" alt="leaf" />
    <img class="leaf right" src="{{ asset('image/daun.png') }}" alt="leaf" />

    <!-- POPUP KONFIRMASI -->
<div id="confirmPopup" class="popup-overlay">
    <div class="popup-box">
        <h2>Konfirmasi</h2>
        <p>Apakah Anda yakin ingin menghapus jadwal yang dipilih?</p>

        <div class="popup-actions">
            <button id="cancelDelete" class="popup-btn cancel">Batal</button>
            <button id="confirmDelete" class="popup-btn delete">Ya, Hapus</button>
        </div>
    </div>
</div>


</div>

@endsection


@push('page-scripts')
<script>
document.addEventListener("DOMContentLoaded", () => {

    const menuToggle = document.getElementById("menuToggle");
    const menuIcon = document.getElementById("menuIcon");
    const scheduleList = document.getElementById("scheduleList");

    const popup = document.getElementById("confirmPopup");
    const cancelDelete = document.getElementById("cancelDelete");
    const confirmDelete = document.getElementById("confirmDelete");

    let deleteMode = false;

    // === TOGGLE MODE DELETE ===
    menuToggle.addEventListener("click", () => {

        // Jika sedang delete mode & klik lagi → cek sudah pilih item atau belum
        if (deleteMode) {
            const selected = document.querySelectorAll(".schedule-item.selected");
            if (selected.length > 0) {
                popup.style.display = "flex";
                return;
            }
        }

        // Toggle mode
        deleteMode = !deleteMode;

        menuIcon.classList.toggle("fa-bars", !deleteMode);
        menuIcon.classList.toggle("fa-trash", deleteMode);

        document.querySelectorAll(".schedule-item").forEach(item => {
            const actionBtn = item.querySelector(".action-btn");
            const setBtn = item.querySelector(".set-btn");

            if (deleteMode) {
                item.classList.add("delete-mode");
                actionBtn.style.display = "flex";
                setBtn.style.display = "none";
            } else {
                item.classList.remove("delete-mode", "selected");
                actionBtn.style.display = "none";
                setBtn.style.display = "block";
            }
        });
    });

    // === SELECT ITEM ===
    scheduleList.addEventListener("click", e => {
        if (!e.target.classList.contains("action-btn")) return;

        const item = e.target.closest(".schedule-item");
        item.classList.toggle("selected");
    });

    // === BATAL ===
    cancelDelete.addEventListener("click", () => {
        popup.style.display = "none";
    });

    // === KONFIRMASI HAPUS ===
    confirmDelete.addEventListener("click", () => {
        const selectedItems = document.querySelectorAll(".schedule-item.selected");

        selectedItems.forEach(item => {
            item.style.animation = "slideOut 0.4s forwards";
            setTimeout(() => item.remove(), 400);
        });

        popup.style.display = "none";
        deleteMode = false;

        menuIcon.classList.remove("fa-trash");
        menuIcon.classList.add("fa-bars");

        document.querySelectorAll(".schedule-item").forEach(item => {
            item.classList.remove("delete-mode", "selected");
            item.querySelector(".action-btn").style.display = "none";
            item.querySelector(".set-btn").style.display = "block";
        });
    });

});
</script>
@endpush