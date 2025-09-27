{{-- resources/views/ibu_hamil/monitoring.blade.php --}}
@extends('layouts.ibu_hamil')

@section('content')
    <style>
        .bg-gradient-green-teal {
            background: linear-gradient(135deg, #10b981 0%, #0d9488 100%);
        }

        .text-green-100 {
            color: rgba(220, 252, 231, 1);
        }

        .bg-green-600 {
            background-color: #16a34a;
        }

        .hover\:bg-green-700:hover {
            background-color: #15803d;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }

        .status-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            display: inline-block;
        }

        .status-normal {
            background-color: #22c55e;
        }

        .status-warning {
            background-color: #eab308;
        }

        .status-critical {
            background-color: #ef4444;
        }

        .metric-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .metric-card:hover {
            transform: scale(1.02);
        }

        .progress-bar-custom {
            height: 24px;
            border-radius: 12px;
            position: relative;
            overflow: hidden;
        }

        .progress-fill {
            height: 100%;
            border-radius: 12px;
            transition: width 0.5s ease;
        }

        .btn-indigo-custom {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
        }

        .btn-indigo-custom:hover {
            background-color: #4338ca;
            border-color: #4338ca;
            color: white;
        }

        .btn-outline-indigo-custom {
            color: #4f46e5;
            border-color: #4f46e5;
        }

        .btn-outline-indigo-custom:hover {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
        }

        .metric-button.active {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
        }

        .recommendation-bullet {
            width: 8px;
            height: 8px;
            background-color: #3b82f6;
            border-radius: 50%;
            margin-top: 8px;
            flex-shrink: 0;
        }

        .table-hover tbody tr:hover {
            background-color: #f9fafb;
        }
    </style>

    <div class="py-4">
        {{-- Header Section --}}
        <div class="p-4 p-md-5 rounded-3 bg-gradient-green-teal text-white mb-4">
            <h1 class="h2 fw-bold mb-2">Monitoring Kehamilan</h1>
            <p class="mb-0 text-green-100">
                Pantau perkembangan kesehatan ibu dan bayi
            </p>
        </div>

        {{-- Status Overview --}}
        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Status Kesehatan Saat Ini</h5>
                <span class="badge bg-{{ $badgeColor }} d-flex align-items-center">
                    <span
                        class="status-dot 
        @if ($status === 'Tinggi') status-critical 
        @elseif($status === 'Sedang') status-warning 
        @else status-normal @endif me-2"></span>
                    {{ $status ?? '-' }}
                </span>

            </div>
            <div class="card-body">
                {{-- Key Metrics Grid --}}
                <div class="row g-3 g-md-4 mb-4">
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 p-md-4 bg-primary bg-opacity-10 rounded-3 metric-card">
                            <i class="bi bi-scale fs-2 text-primary mb-2"></i>
                            <p class="small text-muted mb-1">Berat Badan</p>
                            <p class="h5 fw-bold text-primary mb-0">{{ $latest->berat_badan ?? '-' }} kg</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 p-md-4 bg-success bg-opacity-10 rounded-3 metric-card">
                            <i class="bi bi-activity fs-2 text-success mb-2"></i>
                            <p class="small text-muted mb-1">LILA</p>
                            <p class="h5 fw-bold text-success mb-0">{{ $latest->lila ?? '-' }} cm</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 p-md-4 bg-danger bg-opacity-10 rounded-3 metric-card">
                            <i class="bi bi-droplet fs-2 text-danger mb-2"></i>
                            <p class="small text-muted mb-1">Hemoglobin</p>
                            <p class="h5 fw-bold text-danger mb-0">{{ $latest->hb ?? '-' }} g/dL</p>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="text-center p-3 p-md-4 bg-info bg-opacity-10 rounded-3 metric-card">
                            <i class="bi bi-calendar fs-2 text-info mb-2"></i>
                            <p class="small text-muted mb-1">Usia Kehamilan</p>
                            <p class="h5 fw-bold text-info mb-0">{{ $latest->usia_kehamilan ?? '-' }} minggu</p>
                        </div>
                    </div>
                </div>

                {{-- Recommendations --}}
                <div class="bg-light rounded-3 p-4">
                    <h6 class="fw-semibold mb-3 d-flex align-items-center">
                        <i class="bi bi-info-circle text-primary me-2"></i>
                        Rekomendasi
                    </h6>
                    <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-start mb-2">
                            <span class="recommendation-bullet me-3"></span>
                            <span class="small text-muted">Pertahankan pola makan yang sehat dan seimbang</span>
                        </li>
                        <li class="d-flex align-items-start mb-2">
                            <span class="recommendation-bullet me-3"></span>
                            <span class="small text-muted">Lanjutkan konsumsi MRJ sesuai anjuran</span>
                        </li>
                        <li class="d-flex align-items-start mb-0">
                            <span class="recommendation-bullet me-3"></span>
                            <span class="small text-muted">Rutin kontrol kehamilan sesuai jadwal</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        {{-- Progress Chart --}}
        <div class="card border-0 shadow-lg mb-4">
            <div class="card-header d-flex align-items-center">
                <i class="bi bi-graph-up text-indigo-600 me-2"></i>
                <h5 class="card-title mb-0">Grafik Perkembangan</h5>
            </div>
            <div class="card-body">
                {{-- Metric Selection Buttons --}}
                <div class="d-flex gap-2 mb-4 flex-wrap">
                    <button class="btn btn-indigo-custom btn-sm metric-button active" data-metric="weight">
                        <i class="bi bi-scale me-2"></i>Berat Badan
                    </button>
                    <button class="btn btn-outline-indigo-custom btn-sm metric-button" data-metric="lila">
                        <i class="bi bi-activity me-2"></i>LILA
                    </button>
                    <button class="btn btn-outline-indigo-custom btn-sm metric-button" data-metric="hb">
                        <i class="bi bi-droplet me-2"></i>Hemoglobin
                    </button>

                </div>

                {{-- Chart Area --}}
                <div class="bg-light rounded-3 p-4">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h6 class="fw-semibold mb-0">
                            <span id="chartTitle">Berat Badan</span> per Minggu
                        </h6>
                        <span class="small text-muted" id="chartUnit">kg</span>
                    </div>
                    <div id="chartContainer"></div>
                </div>
            </div>
        </div>

        {{-- History Table --}}
        <div class="card border-0 shadow-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Riwayat Pemeriksaan</h5>
                <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#tambahDataModal">
                    <i class="bi bi-plus-lg me-2"></i>Tambah Data
                </button>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light">
                            <tr>
                                <th class="py-3">Tanggal</th>
                                <th class="py-3">Minggu</th>
                                <th class="py-3">BB (kg)</th>
                                <th class="py-3">LILA (cm)</th>
                                <th class="py-3">HB (g/dL)</th>
                                <th class="py-3">Tekanan Darah</th>
                                <th class="py-3">Status</th>
                                <th class="py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($monitorings as $item)
                                <tr>
                                    <td class="py-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                                    <td class="py-3">{{ $item->usia_kehamilan }}</td>
                                    <td class="py-3 fw-medium">{{ $item->berat_badan }}</td>
                                    <td class="py-3 fw-medium">{{ $item->lila }}</td>
                                    <td class="py-3 fw-medium">{{ $item->hb }}</td>
                                    <td class="py-3 fw-medium">
                                        @if ($item->tekanan_darah_sistolik && $item->tekanan_darah_diastolik)
                                            {{ $item->tekanan_darah_sistolik }}/{{ $item->tekanan_darah_diastolik }} mmHg
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="py-3">
                                        @php
                                            $status = app(
                                                \App\Http\Controllers\MonitoringController::class,
                                            )->getStatusKehamilan($item);
                                            $badge = app(
                                                \App\Http\Controllers\MonitoringController::class,
                                            )->getBadgeColor($status);
                                        @endphp
                                        <span class="badge bg-{{ $badge }}">{{ $status }}</span>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit -->
                                        <button class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editDataModal{{ $item->id }}">
                                            <i class="bi bi-pencil-square"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                                <!-- Modal Edit -->
                                <div class="modal fade" id="editDataModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="editDataLabel{{ $item->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <form action="{{ route('ibu_hamil.monitoring.update', $item->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title fw-bold"
                                                        id="editDataLabel{{ $item->id }}">
                                                        <i class="bi bi-pencil-square me-2 text-warning"></i> Edit Data
                                                        Pemeriksaan
                                                    </h5>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row g-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Tanggal</label>
                                                            <input type="date" name="tanggal" class="form-control"
                                                                value="{{ $item->tanggal->format('Y-m-d') }}" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Usia Kehamilan (minggu)</label>
                                                            <input type="number" name="usia_kehamilan"
                                                                class="form-control" value="{{ $item->usia_kehamilan }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Berat Badan (kg)</label>
                                                            <input type="number" step="0.1" name="berat_badan"
                                                                class="form-control" value="{{ $item->berat_badan }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">LILA (cm)</label>
                                                            <input type="number" step="0.1" name="lila"
                                                                class="form-control" value="{{ $item->lila }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="form-label">Hemoglobin (g/dL)</label>
                                                            <input type="number" step="0.1" name="hb"
                                                                class="form-control" value="{{ $item->hb }}"
                                                                required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Tekanan Darah (Sistolik)</label>
                                                            <input type="number" name="tekanan_darah_sistolik"
                                                                class="form-control"
                                                                value="{{ $item->tekanan_darah_sistolik }}">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="form-label">Tekanan Darah (Diastolik)</label>
                                                            <input type="number" name="tekanan_darah_diastolik"
                                                                class="form-control"
                                                                value="{{ $item->tekanan_darah_diastolik }}">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning">
                                                        <i class="bi bi-save me-2"></i> Update
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-3 text-muted">Belum ada data</td>
                                </tr>
                            @endforelse
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Data -->
    <div class="modal fade" id="tambahDataModal" tabindex="-1" aria-labelledby="tambahDataLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="{{ route('ibu_hamil.monitoring.store') }}" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="tambahDataLabel">
                            <i class="bi bi-plus-circle me-2 text-success"></i> Tambah Data Pemeriksaan
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Tanggal</label>
                                <input type="date" name="tanggal" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Usia Kehamilan (minggu)</label>
                                <input type="number" name="usia_kehamilan" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Berat Badan (kg)</label>
                                <input type="number" step="0.1" name="berat_badan" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">LILA (cm)</label>
                                <input type="number" step="0.1" name="lila" class="form-control" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Hemoglobin (g/dL)</label>
                                <input type="number" step="0.1" name="hb" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tekanan Darah (Sistolik)</label>
                                <input type="number" name="tekanan_darah_sistolik" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tekanan Darah (Diastolik)</label>
                                <input type="number" name="tekanan_darah_diastolik" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save me-2"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const metricButtons = document.querySelectorAll('.metric-button');
            const chartTitle = document.getElementById('chartTitle');
            const chartUnit = document.getElementById('chartUnit');
            const chartContainer = document.getElementById('chartContainer');

            const metricsData = {
                weight: {
                    title: 'Berat Badan',
                    unit: 'kg',
                    color: 'linear-gradient(90deg, #3b82f6 0%, #1d4ed8 100%)',
                    data: @json($weightData)
                },
                lila: {
                    title: 'LILA',
                    unit: 'cm',
                    color: 'linear-gradient(90deg, #22c55e 0%, #16a34a 100%)',
                    data: @json($lilaData)
                },
                hb: {
                    title: 'Hemoglobin',
                    unit: 'g/dL',
                    color: 'linear-gradient(90deg, #e11d48 0%, #9f1239 100%)',
                    data: @json($hbData)
                }

            };

            function updateChart(metric) {
                const data = metricsData[metric];
                chartTitle.textContent = data.title;
                chartUnit.textContent = data.unit;

                // batasi maksimal 5 data terakhir
                const limitedData = data.data.slice(-5);

                chartContainer.innerHTML = limitedData.map((item, i) => `
                    <div class="d-flex align-items-center ${i < limitedData.length - 1 ? 'mb-3' : ''}">
                        <div class="text-muted small me-3" style="min-width: 40px;">${item.week}</div>
                        <div class="flex-grow-1 me-3 position-relative">
                            <div class="progress-bar-custom bg-white">
                                <div class="progress-fill" style="width:${item.percentage}%;background:${data.color};"></div>
                                <span class="position-absolute end-0 top-50 translate-middle-y me-2 small fw-medium">${item.value}</span>
                            </div>
                        </div>
                        <div class="text-muted small" style="min-width: 80px;">${item.date}</div>
                    </div>
                `).join('');
            }


            metricButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Reset semua tombol
                    metricButtons.forEach(btn => {
                        btn.classList.remove('active', 'btn-indigo-custom');
                        btn.classList.add('btn-outline-indigo-custom');
                    });

                    // Aktifkan tombol yg diklik
                    button.classList.remove('btn-outline-indigo-custom');
                    button.classList.add('btn-indigo-custom', 'active');

                    // Update chart
                    updateChart(button.dataset.metric);
                });
            });

            updateChart('weight');
        });
    </script>
@endsection
