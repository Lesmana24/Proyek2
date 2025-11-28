@extends('layouts.main')

@section('title', $title)
@push('page-styles')
    {{-- flatpickr --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endpush

@section('content')
{{-- ================= KONTEN HTML ================= --}}
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
    <div class="realtime-header">
        <div class="rt-box left">
            <h3><span id="live-suhu">--</span>°</h3> 
            <p>Suhu Saat Ini</p>
        </div>

        <div class="rt-box right">
            <h3><span id="live-lembab">--</span>%</h3> 
            <p>Kelembapan Saat Ini</p>
        </div>
    </div>
    
    <div class="mqtt-status-container">
        Status MQTT: <span id="mqtt-status" style="font-weight: bold; color: orange;">Menghubungkan...</span>
    </div>
    <div class="status">
        <div class="status-box">
            <div class="icon-action" role="button" onclick="window.openThresholdModal('Suhu', 24, '°')">
                <svg class="settings-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.49l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                </svg>
            </div>
            
            <h2 id="display-suhu">{{ $batasSuhu }}°</h2>
            <p>Batas Ambang Suhu</p>
        </div>

        <div class="status-box">
             <div class="icon-action" role="button" onclick="window.openThresholdModal('Kelembapan', 60, '%')">
                <svg class="settings-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.73,8.87 C2.62,9.08,2.66,9.34,2.86,9.49l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.43-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/>
                </svg>
            </div>

            <h2 id="display-kelembapan">{{ $batasLembab }}%</h2>
            <p>Batas Ambang Kelembapan</p>
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

<div id="thresholdModal" class="modal-overlay" style="display: none;">
    <div class="modal-card">
        <div class="modal-header">
            <h3 id="modalTitle">Suhu</h3>
            <span class="close-btn" onclick="window.closeModal()">&times;</span>
        </div>
        
        <hr class="modal-line">

        <div class="modal-body">
            <div class="counter-container">
                <button class="btn-counter" onclick="window.updateValue(-1)">—</button>
                <div class="value-display">
                    <span id="modalValue">24</span>
                    <span id="modalUnit" class="unit-dot"></span>
                </div>
                <button class="btn-counter" onclick="window.updateValue(1)">+</button>
            </div>
        </div>

        <form id="thresholdForm" action="#" method="POST">
            @csrf
            <input type="hidden" name="type" id="inputType">
            <input type="hidden" name="value" id="inputValue">
            <button type="button" class="btn-set modal-btn" onclick="window.saveThreshold()">Set Batas</button>
        </form>
    </div>
</div>

{{-- ================= SCRIPT MQTT (PAHO) ================= --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.1/mqttws31.min.js" type="text/javascript"></script>

<script>
    // --- 1. Konfigurasi Koneksi ---
    const mqtt_broker = "broker.emqx.io";
    const mqtt_port   = 8084; // Port WSS (WebSocket Secure)
    const client_id   = "Web_PakJondol_" + Math.random().toString(16).substr(2, 8);

    // Topik (Harus SAMA PERSIS dengan kode ESP32)
    const topic_suhu   = "Proyek2/monitoring/suhu";
    const topic_lembab = "Proyek2/monitoring/lembab";

    // --- 2. Inisialisasi Client ---
    const client = new Paho.MQTT.Client(mqtt_broker, mqtt_port, client_id);

    // Setup Handler
    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    // --- 3. Mulai Koneksi ---
    console.log("Menghubungkan ke MQTT...");
    client.connect({
        useSSL: true, // Wajib true untuk port 8084
        onSuccess: onConnect,
        onFailure: onFailure
    });

    // --- Fungsi Callback ---

    // Jika Berhasil Konek
    function onConnect() {
        console.log("MQTT Terhubung!");
        document.getElementById("mqtt-status").innerText = "Terhubung";
        document.getElementById("mqtt-status").style.color = "green";

        // Subscribe ke topik
        client.subscribe(topic_suhu);
        client.subscribe(topic_lembab);

        // --- BARU: Pancing ESP32 dengan nilai terakhir ---
        let savedSuhu = localStorage.getItem('saved_batas_suhu');
        let savedLembab = localStorage.getItem('saved_batas_lembab');

        if(savedSuhu) {
            let msg = new Paho.MQTT.Message(savedSuhu);
            msg.destinationName = "Proyek2/kontrol/batas_suhu";
            client.send(msg);
        }
        if(savedLembab) {
            let msg = new Paho.MQTT.Message(savedLembab);
            msg.destinationName = "Proyek2/kontrol/batas_lembab";
            client.send(msg);
        }
    }

    // Jika Gagal Konek
    function onFailure(responseObject) {
        console.log("Gagal Konek: " + responseObject.errorMessage);
        document.getElementById("mqtt-status").innerText = "Gagal (Coba Refresh)";
        document.getElementById("mqtt-status").style.color = "red";
    }

    // Jika Koneksi Putus Tiba-tiba
    function onConnectionLost(responseObject) {
        if (responseObject.errorCode !== 0) {
            console.log("Koneksi Putus: " + responseObject.errorMessage);
            document.getElementById("mqtt-status").innerText = "Terputus";
            document.getElementById("mqtt-status").style.color = "red";
        }
    }

    // --- INI BAGIAN PENTING: Saat Data Masuk ---
    function onMessageArrived(message) {
        console.log("Topik: " + message.destinationName + " | Pesan: " + message.payloadString);

        // Cek topik mana yang masuk, lalu update HTML
        if (message.destinationName === topic_suhu) {
            // Update angka suhu
            document.getElementById("live-suhu").innerText = message.payloadString;
        } 
        else if (message.destinationName === topic_lembab) {
            // Update angka kelembaban
            document.getElementById("live-lembab").innerText = message.payloadString;
        }
    }
    
</script>
{{-- ================= SCRIPT LANGSUNG DI SINI ================= --}}
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    // Definisi Fungsi SECARA GLOBAL (window.)
    // Definisi Fungsi SECARA GLOBAL (window.)
    window.openThresholdModal = function(type, value, unit) { // 'value' disini sudah tidak kita pakai
        console.log('Klik terdeteksi:', type);
        
        var modal = document.getElementById('thresholdModal');
        var title = document.getElementById('modalTitle');
        var valSpan = document.getElementById('modalValue');
        
        // Update data global
        window.currentType = type;

        // === BAGIAN INI YANG BERUBAH ===
        // Ambil angka aktual dari teks di layar (yang sudah dimuat dari database)
        if (type === 'Suhu') {
             // Ambil teks dari id="display-suhu" (misal "35°")
             let valText = document.getElementById('display-suhu').innerText;
             // parseInt otomatis membuang karakter non-angka seperti "°"
             window.currentValue = parseInt(valText); 
        } else {
             // Ambil teks dari id="display-kelembapan" (misal "60%")
             let valText = document.getElementById('display-kelembapan').innerText;
             window.currentValue = parseInt(valText);
        }
        // ===============================
        
        title.innerText = type;
        valSpan.innerText = window.currentValue;
        
        // Tampilkan
        modal.style.display = 'flex';
    };

    window.closeModal = function() {
        document.getElementById('thresholdModal').style.display = 'none';
    };

    window.updateValue = function(change) {
        window.currentValue += change;
        document.getElementById('modalValue').innerText = window.currentValue;
    };

    window.saveThreshold = function() {
        // 1. Validasi Koneksi MQTT
        if (!client.isConnected()) {
            alert("MQTT belum terhubung! Tunggu sebentar...");
            return;
        }

        let topic = "";
        let dbKey = ""; // Key untuk database
        let messagePayload = String(window.currentValue);

        if(window.currentType === 'Suhu') {
            document.getElementById('display-suhu').innerText = window.currentValue + '°';
            topic = "Proyek2/kontrol/batas_suhu";
            dbKey = "batas_suhu"; // Sesuai database
        } else {
            document.getElementById('display-kelembapan').innerText = window.currentValue + '%';
            topic = "Proyek2/kontrol/batas_lembab";
            dbKey = "batas_lembab"; // Sesuai database
        }

        // 2. KIRIM KE MQTT (Untuk Alat)
        var message = new Paho.MQTT.Message(messagePayload);
        message.destinationName = topic;
        message.qos = 2;       // Pastikan terkirim (Exactly Once)
        message.retained = true; // Simpan pesan terakhir di broker
        client.send(message);

        // 3. KIRIM KE DATABASE (Untuk Server Laravel) -- BARU!!
        fetch('/update-setting', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                // Ambil token CSRF dari head
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                key: dbKey,
                value: window.currentValue
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log("Sukses update database:", data);
        })
        .catch((error) => {
            console.error('Error update database:', error);
        });
        
        console.log("Mengirim batas baru: " + messagePayload + " ke " + topic);
        window.closeModal();
    };

    // Event Listener tutup modal
    window.onclick = function(event) {
        var modal = document.getElementById('thresholdModal');
        if (event.target == modal) {
            window.closeModal();
        }
    };

    // Flatpickr
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#customTime", {
            enableTime: true,
            dateFormat: "H:i",
            time_24hr: true,
            defaultHour: 10,
            defaultMinute: 30,
        });
    });
</script>

@endsection