@extends('layouts.ibu_hamil')

@section('content')
    <div class="">
        <!-- Welcome Section -->
        <div class="welcome-card rounded-3 p-4 text-white mb-4">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="h2 fw-bold mb-3">Selamat Datang, {{ $user->name }}!</h1>

                    @if ($monitoring)
                        <p class="welcome-subtitle mb-3">Usia kehamilan: {{ $monitoring->usia_kehamilan }} minggu</p>
                        <div class="d-flex flex-wrap align-items-center gap-3">
                            @if ($monitoring)
                                <span class="badge bg-{{ $badgeColor }}">{{ $status }}</span>
                            @endif
                            <span class="small welcome-subtitle">{{ 40 - $monitoring->usia_kehamilan }} minggu lagi</span>
                        </div>

                        <div class="mt-4">
                            <div class="d-flex justify-content-between small mb-2">
                                <span>Progress Kehamilan</span>
                                <span>{{ $monitoring->usia_kehamilan }}/40 minggu</span>
                            </div>
                            <div class="progress pregnancy-progress">
                                <div class="progress-bar bg-white" role="progressbar"
                                    style="width: {{ ($monitoring->usia_kehamilan / 40) * 100 }}%"
                                    aria-valuenow="{{ $monitoring->usia_kehamilan }}" aria-valuemin="0" aria-valuemax="40">
                                </div>
                            </div>
                        </div>
                    @else
                        <p class="text-white">Belum ada data monitoring.</p>
                    @endif
                </div>

                <div class="col-md-4 text-center d-none d-md-block">
                    <i class="fas fa-baby baby-icon"></i>
                </div>
            </div>
        </div>


        <!-- Key Metrics -->
        <div class="row g-3 mb-4">
            <div class="col-6 col-md-3">
                <div class="card metric-card h-100 border-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon bg-primary bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-weight text-primary fs-4"></i>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Berat Badan</p>
                                <h5 class="fw-bold mb-0">{{ $monitoring->berat_badan ?? '-' }} kg</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card metric-card h-100 border-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon bg-success bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-ruler text-success fs-4"></i>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">LILA</p>
                                <h5 class="fw-bold mb-0">{{ $monitoring->lila ?? '-' }} cm</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card metric-card h-100 border-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon bg-danger bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-tint text-danger fs-4"></i>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Hemoglobin</p>
                                <h5 class="fw-bold mb-0">{{ $monitoring->hb ?? '-' }} g/dL</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card metric-card h-100 border-0">
                    <div class="card-body p-3">
                        <div class="d-flex align-items-center">
                            <div class="metric-icon bg-pink bg-opacity-10 rounded-3 p-2 me-3">
                                <i class="fas fa-heartbeat text-pink fs-4"></i>
                            </div>
                            <div>
                                <p class="small text-muted mb-1">Tekanan Darah</p>
                                <h5 class="fw-bold mb-0">
                                    {{ $monitoring->tekanan_darah_sistolik ?? '-' }}/{{ $monitoring->tekanan_darah_diastolik ?? '-' }}
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- MRJ Progress -->
        <div class="col-md-6">
            <div class="card border-0 h-100">
                <div class="card-header bg-white border-bottom">
                    <h5 class="card-title d-flex align-items-center mb-0">
                        <i class="fas fa-chart-line text-purple me-2"></i>
                        Konsumsi MRJ Hari Ini
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-6">
                            <span class="text-muted">Target Harian</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="fw-semibold">{{ $targetHarian ?? 2 }} sachet</span>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-6">
                            <span class="text-muted">Sudah Dikonsumsi</span>
                        </div>
                        <div class="col-6 text-end">
                            <span class="fw-semibold text-success">{{ $konsumsiHarian ?? 0 }} sachet</span>
                        </div>
                    </div>
                    <div class="progress mb-3" style="height: 12px;">
                        @php
                            $persen =
                                isset($targetHarian) && $targetHarian > 0 ? ($konsumsiHarian / $targetHarian) * 100 : 0;
                        @endphp
                        <div class="progress-bar bg-purple" role="progressbar" style="width: {{ $persen }}%"
                            aria-valuenow="{{ $persen }}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                    <div class="text-center">
                        <p class="small text-muted mb-3">
                            Sisa: {{ max(($targetHarian ?? 2) - ($konsumsiHarian ?? 0), 0) }} sachet
                        </p>
                        <button type="button" class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#mrjModal">
                            <i class="fas fa-plus me-1"></i>
                            Catat Konsumsi MRJ
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="card border-0">
            <div class="card-header bg-white border-bottom">
                <h5 class="card-title d-flex align-items-center mb-0">
                    <i class="fas fa-calendar text-primary me-2"></i>
                    Aksi Cepat
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-6 col-md-3">
                        <button
                            class="btn btn-outline-secondary quick-action-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-chart-bar fs-4 mb-2"></i>
                            <span class="small">Catat Monitoring</span>
                        </button>
                    </div>
                    <div class="col-6 col-md-3">
                        <button
                            class="btn btn-outline-secondary quick-action-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-book-open fs-4 mb-2"></i>
                            <span class="small">Pelajari Nutrisi</span>
                        </button>
                    </div>
                    <div class="col-6 col-md-3">
                        <button
                            class="btn btn-outline-secondary quick-action-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-edit fs-4 mb-2"></i>
                            <span class="small">Tulis Log</span>
                        </button>
                    </div>
                    <div class="col-6 col-md-3">
                        <button
                            class="btn btn-outline-secondary quick-action-btn w-100 h-100 d-flex flex-column align-items-center justify-content-center">
                            <i class="fas fa-user-edit fs-4 mb-2"></i>
                            <span class="small">Edit Profil</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Input MRJ -->
    <div class="modal fade" id="mrjModal" tabindex="-1" aria-labelledby="mrjModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-purple text-white">
                    <h5 class="modal-title" id="mrjModalLabel">Catat Konsumsi MRJ</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('ibu_hamil.mrj.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="mrj_tracker_id" value="{{ $stokKader->id ?? '' }}">

                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal"
                                value="{{ date('Y-m-d') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="konsumsi_harian" class="form-label">Jumlah Dikonsumsi</label>
                            <input type="number" class="form-control" name="konsumsi_harian" id="konsumsi_harian"
                                min="1" max="2" required>
                        </div>

                        <button type="submit" class="btn btn-purple w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <style>
        /* Custom Colors */

        :root {
            --pink-color: #ec4899;
            --purple-color: #8b5cf6;
            --purple-light: rgba(139, 92, 246, 0.1);
        }

        modal-header.bg-purple {
            background-color: var(--purple-color) !important;
        }

        .modal-content {
            border: none;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
        }

        /* Form Styling */
        .form-label.fw-semibold {
            color: #495057;
            font-size: 0.9rem;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--purple-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25);
        }

        .form-check-input:checked {
            background-color: var(--purple-color);
            border-color: var(--purple-color);
        }

        .form-check-input:focus {
            border-color: var(--purple-color);
            box-shadow: 0 0 0 0.2rem rgba(139, 92, 246, 0.25);
        }

        /* Alert Info Custom */
        .alert-info {
            background-color: rgba(13, 202, 240, 0.1);
            border-color: rgba(13, 202, 240, 0.2);
            color: #055160;
        }

        /* Responsive Modal */
        @media (max-width: 576px) {
            .modal-dialog {
                margin: 1rem;
            }

            .row.mb-3 {
                margin-bottom: 1rem !important;
            }

            .col-sm-4,
            .col-sm-8 {
                margin-bottom: 0.5rem;
            }
        }

        .text-pink {
            color: var(--pink-color) !important;
        }

        .text-purple {
            color: var(--purple-color) !important;
        }

        .bg-pink {
            background-color: var(--pink-color) !important;
        }

        .bg-purple {
            background-color: var(--purple-color) !important;
        }

        .btn-purple {
            background-color: var(--purple-color);
            border-color: var(--purple-color);
            color: white;
        }

        .btn-purple:hover {
            background-color: #7c3aed;
            border-color: #7c3aed;
            color: white;
        }

        .badge.bg-purple {
            background-color: var(--purple-color) !important;
        }

        /* Welcome Card Gradient */
        .welcome-card {
            background: linear-gradient(135deg, var(--pink-color) 0%, var(--purple-color) 100%);
            box-shadow: 0 10px 25px rgba(139, 92, 246, 0.15);
        }

        .welcome-subtitle {
            color: rgba(255, 255, 255, 0.8);
        }

        .baby-icon {
            font-size: 4rem;
            color: rgba(255, 255, 255, 0.6);
        }

        /* Status Badge */
        .status-normal {
            background-color: #DCFCE7;
            color: #166534;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        /* Progress Bar */
        .pregnancy-progress {
            background-color: rgba(255, 255, 255, 0.3);
            height: 12px;
        }

        .pregnancy-progress .progress-bar {
            background-color: white !important;
        }

        /* Metric Cards */
        .metric-card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .metric-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .metric-icon {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Cards Shadow */
        .card {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        }

        /* Reminder Items */
        .reminder-item {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
        }

        /* Quick Action Buttons */
        .quick-action-btn {
            min-height: 100px;
            border: 2px dashed #dee2e6;
            transition: all 0.2s ease;
        }

        .quick-action-btn:hover {
            border-color: var(--purple-color);
            background-color: var(--purple-light);
            color: var(--purple-color);
        }

        /* Responsive adjustments */
        @media (max-width: 576px) {
            .baby-icon {
                font-size: 2.5rem;
            }

            .welcome-card {
                text-align: center;
            }

            .metric-card .card-body {
                padding: 1rem !important;
            }

            .metric-icon {
                width: 40px;
                height: 40px;
            }

            .metric-icon i {
                font-size: 1.25rem !important;
            }

            .quick-action-btn {
                min-height: 80px;
            }
        }

        /* Animation for cards */
        .card,
        .metric-card {
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

        /* Progress bar animation */
        .progress-bar {
            animation: progressAnimation 1.5s ease-out;
        }

        @keyframes progressAnimation {
            from {
                width: 0%;
            }

            to {
                width: var(--progress-width, 50%);
            }
        }
    </style>

    <!-- Font Awesome untuk icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endsection
