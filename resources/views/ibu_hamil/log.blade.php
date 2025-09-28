@extends('layouts.ibu_hamil')

@section('content')
    <div class="pb-5">`">
        <!-- Header -->
        <div class="log-header rounded-3 p-4 text-white mb-4">
            <h1 class="h2 fw-bold mb-2">Log Kehamilan</h1>
            <p class="header-subtitle">Catat perjalanan kehamilan dan perasaan harian Anda</p>
        </div>

        <!-- Add New Log -->
        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header bg-white border-bottom">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="card-title d-flex align-items-center mb-0">
                        <i class="fas fa-plus text-teal me-2"></i>
                        Tambah Catatan Baru
                    </h5>
                    <button class="btn btn-teal" id="toggleAddForm">
                        <i class="fas fa-plus me-1"></i>
                        Tambah Log
                    </button>
                </div>
            </div>

            <div class="card-body border-top d-none" id="addLogForm">
                <form id="pregnancyLogForm" action="{{ route('ibu_hamil.log.store') }}" method="POST">
                    @csrf
                    <!-- Symptoms -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">Gejala yang Dialami</h6>
                        <div class="row g-2">
                            @php
                                $symptoms = [
                                    'Mual',
                                    'Muntah',
                                    'Pusing',
                                    'Kram kaki',
                                    'Sakit punggung',
                                    'Heartburn',
                                    'Sering buang air kecil',
                                    'Susah tidur',
                                    'Kembung',
                                    'Sembelit',
                                ];
                            @endphp
                            @foreach ($symptoms as $symptom)
                                <div class="col-6 col-md-4 col-lg-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm w-100 symptom-btn"
                                        data-symptom="{{ $symptom }}">
                                        {{ $symptom }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Mood -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">Suasana Hati</h6>
                        <div class="row g-2">
                            @php
                                $moods = [
                                    'Sangat baik' => '😊',
                                    'Baik' => '🙂',
                                    'Biasa' => '😐',
                                    'Kurang baik' => '🙁',
                                    'Buruk' => '😢',
                                ];
                            @endphp
                            @foreach ($moods as $mood => $icon)
                                <div class="col-6 col-md-4 col-lg-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm w-100 mood-btn"
                                        data-mood="{{ $mood }}">
                                        <span class="me-1">{{ $icon }}</span> {{ $mood }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Appetite -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">Nafsu Makan</h6>
                        <div class="row g-2">
                            @php
                                $appetites = ['Sangat baik', 'Baik', 'Normal', 'Kurang', 'Buruk'];
                            @endphp
                            @foreach ($appetites as $appetite)
                                <div class="col-6 col-md-4 col-lg-2">
                                    <button type="button" class="btn btn-outline-secondary btn-sm w-100 appetite-btn"
                                        data-appetite="{{ $appetite }}">
                                        {{ $appetite }}
                                    </button>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Notes -->
                    <div class="mb-4">
                        <h6 class="fw-semibold mb-3">Catatan Tambahan</h6>
                        <textarea class="form-control" id="notes" name="notes" rows="4"
                            placeholder="Tuliskan perasaan, aktivitas, atau hal penting lainnya hari ini..."></textarea>
                    </div>

                    <div class="d-flex justify-content-end gap-3">
                        <button type="button" class="btn btn-outline-secondary" id="cancelLog">Batal</button>
                        <button type="submit" class="btn btn-teal" id="saveLog">
                            <i class="fas fa-save me-1"></i>
                            Simpan Log
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Log History -->
        <div class="log-history" id="logHistory">
            @foreach ($logs as $log)
                @php
                    $symptoms = is_array($log->symptoms) ? $log->symptoms : json_decode($log->symptoms, true) ?? [];
                @endphp
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <i class="fas fa-calendar text-teal"></i>
                                    <span class="fw-semibold">{{ $log->tanggal->translatedFormat('l, d F Y') }}</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-info">{{ $log->mood }}</span>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6 class="fw-medium mb-2 d-flex align-items-center">
                                    <i class="fas fa-heart text-danger me-2"></i>Gejala
                                </h6>
                                <div class="d-flex flex-wrap gap-1">
                                    @foreach ($symptoms as $symptom)
                                        <span class="badge bg-light text-dark">{{ $symptom }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-medium mb-2">Nafsu Makan</h6>
                                <span class="badge bg-warning text-dark">{{ $log->appetite }}</span>
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-medium mb-2 d-flex align-items-center">
                                    <i class="fas fa-comment text-primary me-2"></i>Catatan
                                </h6>
                                <p class="small text-muted mb-0">{{ $log->notes }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <!-- Tips -->
        <div class="card border-0 shadow-lg tips-card">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title d-flex align-items-center mb-0">
                    <i class="fas fa-lightbulb text-warning me-2"></i>
                    Tips Mencatat Log Kehamilan
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="tip-dot"></div>
                            <div>
                                <p class="fw-medium small mb-1">Catat Secara Rutin</p>
                                <p class="text-muted" style="font-size: 0.8rem;">Tulis minimal 3-4 kali seminggu untuk
                                    pola yang lebih jelas</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="tip-dot"></div>
                            <div>
                                <p class="fw-medium small mb-1">Jujur pada Perasaan</p>
                                <p class="text-muted" style="font-size: 0.8rem;">Catat perasaan apa adanya untuk membantu
                                    pemantauan kesehatan</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="tip-dot"></div>
                            <div>
                                <p class="fw-medium small mb-1">Catat Hal Penting</p>
                                <p class="text-muted" style="font-size: 0.8rem;">Tulis perubahan signifikan atau hal yang
                                    mengkhawatirkan</p>
                            </div>
                        </div>
                        <div class="d-flex align-items-start gap-3 mb-3">
                            <div class="tip-dot"></div>
                            <div>
                                <p class="fw-medium small mb-1">Bagikan dengan Dokter</p>
                                <p class="text-muted" style="font-size: 0.8rem;">Gunakan log ini saat konsultasi untuk
                                    diskusi yang lebih efektif</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom Colors */
        :root {
            --teal-color: #14b8a6;
            --cyan-color: #06b6d4;
        }

        .text-teal {
            color: var(--teal-color) !important;
        }

        .btn-teal {
            background-color: var(--teal-color);
            border-color: var(--teal-color);
            color: white;
        }

        .btn-teal:hover {
            background-color: #0d9488;
            border-color: #0d9488;
            color: white;
        }

        /* Header Gradient */
        .log-header {
            background: linear-gradient(135deg, var(--teal-color) 0%, var(--cyan-color) 100%);
            box-shadow: 0 10px 25px rgba(20, 184, 166, 0.15);
        }

        .header-subtitle {
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 0;
        }

        /* Cards */
        .card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            animation: slideUp 0.6s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Interactive Buttons */
        .symptom-btn.active,
        .mood-btn.active,
        .appetite-btn.active {
            background-color: var(--teal-color) !important;
            border-color: var(--teal-color) !important;
            color: white !important;
        }

        .symptom-btn:hover,
        .mood-btn:hover,
        .appetite-btn:hover {
            background-color: rgba(20, 184, 166, 0.1);
            border-color: var(--teal-color);
            color: var(--teal-color);
        }

        /* Mood Badges */
        .mood-excellent {
            background-color: rgba(34, 197, 94, 0.2);
            color: #166534;
        }

        .mood-good {
            background-color: rgba(59, 130, 246, 0.2);
            color: #1e40af;
        }

        .mood-neutral {
            background-color: rgba(234, 179, 8, 0.2);
            color: #a16207;
        }

        .mood-poor {
            background-color: rgba(249, 115, 22, 0.2);
            color: #c2410c;
        }

        .mood-bad {
            background-color: rgba(239, 68, 68, 0.2);
            color: #dc2626;
        }

        /* Appetite Badges */
        .appetite-excellent {
            background-color: rgba(34, 197, 94, 0.2);
            color: #166534;
        }

        .appetite-good {
            background-color: rgba(59, 130, 246, 0.2);
            color: #1e40af;
        }

        .appetite-normal {
            background-color: rgba(234, 179, 8, 0.2);
            color: #a16207;
        }

        .appetite-poor {
            background-color: rgba(249, 115, 22, 0.2);
            color: #c2410c;
        }

        .appetite-bad {
            background-color: rgba(239, 68, 68, 0.2);
            color: #dc2626;
        }

        /* Tips Card */
        .tips-card {
            background: linear-gradient(135deg, rgba(20, 184, 166, 0.05) 0%, rgba(6, 182, 212, 0.05) 100%);
        }

        .tip-dot {
            width: 8px;
            height: 8px;
            background-color: var(--teal-color);
            border-radius: 50%;
            margin-top: 6px;
            flex-shrink: 0;
        }

        /* Form Controls */
        .form-control:focus {
            border-color: var(--teal-color);
            box-shadow: 0 0 0 0.2rem rgba(20, 184, 166, 0.25);
        }

        /* Responsive */
        @media (max-width: 576px) {
            .log-header {
                text-align: center;
            }

            .card-body {
                padding: 1rem !important;
            }

            .symptom-btn,
            .mood-btn,
            .appetite-btn {
                font-size: 0.8rem;
                padding: 0.375rem 0.5rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let selectedSymptoms = [];
            let selectedMood = '';
            let selectedAppetite = '';

            const toggleBtn = document.getElementById('toggleAddForm');
            const addForm = document.getElementById('addLogForm');
            const form = document.getElementById('pregnancyLogForm');
            const logHistory = document.getElementById('logHistory');

            // Toggle form
            toggleBtn.addEventListener('click', () => {
                addForm.classList.toggle('d-none');
            });

            // Cancel button
            document.getElementById('cancelLog').addEventListener('click', () => {
                form.reset();
                selectedSymptoms = [];
                selectedMood = '';
                selectedAppetite = '';
                addForm.classList.add('d-none');
                document.querySelectorAll('.symptom-btn, .mood-btn, .appetite-btn').forEach(btn => {
                    btn.classList.remove('btn-teal');
                    btn.classList.add('btn-outline-secondary');
                });
            });

            // Symptom buttons
            document.querySelectorAll('.symptom-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    const symptom = btn.dataset.symptom;
                    if (selectedSymptoms.includes(symptom)) {
                        selectedSymptoms = selectedSymptoms.filter(s => s !== symptom);
                        btn.classList.remove('btn-teal');
                        btn.classList.add('btn-outline-secondary');
                    } else {
                        selectedSymptoms.push(symptom);
                        btn.classList.add('btn-teal');
                        btn.classList.remove('btn-outline-secondary');
                    }
                });
            });

            // Mood buttons
            document.querySelectorAll('.mood-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    selectedMood = btn.dataset.mood;
                    document.querySelectorAll('.mood-btn').forEach(b => {
                        b.classList.remove('btn-teal');
                        b.classList.add('btn-outline-secondary');
                    });
                    btn.classList.add('btn-teal');
                    btn.classList.remove('btn-outline-secondary');
                });
            });

            // Appetite buttons
            document.querySelectorAll('.appetite-btn').forEach(btn => {
                btn.addEventListener('click', () => {
                    selectedAppetite = btn.dataset.appetite;
                    document.querySelectorAll('.appetite-btn').forEach(b => {
                        b.classList.remove('btn-teal');
                        b.classList.add('btn-outline-secondary');
                    });
                    btn.classList.add('btn-teal');
                    btn.classList.remove('btn-outline-secondary');
                });
            });

            // Submit form
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(form);
                formData.append('symptoms', JSON.stringify(selectedSymptoms));
                formData.append('mood', selectedMood);
                formData.append('appetite', selectedAppetite);

                fetch("{{ route('ibu_hamil.log.store') }}", {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            addForm.classList.add('d-none');
                            form.reset();
                            selectedSymptoms = [];
                            selectedMood = '';
                            selectedAppetite = '';

                            // Reset button styles
                            document.querySelectorAll('.symptom-btn, .mood-btn, .appetite-btn').forEach(
                                btn => {
                                    btn.classList.remove('btn-teal');
                                    btn.classList.add('btn-outline-secondary');
                                });

                            // Tambahkan log baru ke logHistory
                            const log = data.log;
                            const symptomsHTML = JSON.parse(log.symptoms).map(s =>
                                `<span class="badge bg-light text-dark">${s}</span>`).join(' ');

                            const html = `
                <div class="card border-0 shadow-lg mb-4">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between align-items-start mb-4">
                            <div>
                                <div class="d-flex align-items-center gap-3 mb-2">
                                    <i class="fas fa-calendar text-teal"></i>
                                    <span class="fw-semibold">${new Date(log.tanggal).toLocaleDateString('id-ID', { weekday:'long', year:'numeric', month:'long', day:'numeric'})}</span>
                                </div>
                            </div>
                            <div class="text-end">
                                <span class="badge bg-info">${log.mood}</span>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <h6 class="fw-medium mb-2 d-flex align-items-center">
                                    <i class="fas fa-heart text-danger me-2"></i>Gejala
                                </h6>
                                <div class="d-flex flex-wrap gap-1">${symptomsHTML}</div>
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-medium mb-2">Nafsu Makan</h6>
                                <span class="badge bg-warning text-dark">${log.appetite}</span>
                            </div>
                            <div class="col-md-4">
                                <h6 class="fw-medium mb-2 d-flex align-items-center">
                                    <i class="fas fa-comment text-primary me-2"></i>Catatan
                                </h6>
                                <p class="small text-muted mb-0">${log.notes}</p>
                            </div>
                        </div>
                    </div>
                </div>
                `;

                            logHistory.insertAdjacentHTML('afterbegin', html);
                        }
                    });
            });
        });
    </script>

    <!-- Font Awesome untuk icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
