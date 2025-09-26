{{-- resources/views/ibu_hamil/education.blade.php --}}
@extends('layouts.ibu_hamil')

@section('content')
    <style>
        .bg-gradient-indigo-purple {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .bg-gradient-pink-purple {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .text-purple-600 {
            color: #9333ea;
        }

        .bg-purple-600 {
            background-color: #9333ea;
        }

        .hover\:bg-purple-700:hover {
            background-color: #7c3aed;
        }

        .card-hover {
            transition: all 0.3s ease;
        }

        .card-hover:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10 -5 rgba(0, 0, 0, 0.04);
        }

        .image-hover {
            transition: transform 0.3s ease;
            overflow: hidden;
        }

        .image-hover:hover img {
            transform: scale(1.05);
        }

        .play-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(0, 0, 0, 0.5);
            border-radius: 50%;
            padding: 10px 14px;
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
            display: inline-block;
        }

        .play-overlay a {
            color: white !important;
            text-decoration: none;
            display: inline-block;
        }

        .btn-purple-custom {
            background-color: #9333ea;
            border-color: #9333ea;
            color: white;
        }

        .btn-purple-custom:hover {
            background-color: #7c3aed;
            border-color: #7c3aed;
            color: white;
        }

        .btn-outline-purple-custom {
            color: #9333ea;
            border-color: #9333ea;
        }

        .btn-outline-purple-custom:hover {
            background-color: #9333ea;
            border-color: #9333ea;
            color: white;
        }

        .content-item {
            transition: opacity 0.3s ease, transform 0.3s ease;
        }

        .content-item.hidden {
            display: none;
        }

        .star-yellow {
            color: #eab308;
        }

        .badge-video {
            background-color: #FEE2E2 !important;
            color: #991B1B;
        }

        .badge-ebook {
            background-color: #DBEAFE !important;
            color: #1E40AF;
        }

        .badge-infographic {
            background-color: #22c55e !important;
        }

       .featured-title,
.featured-desc,
.featured-type {
    margin: 0 !important; /* hapus semua margin */
    line-height: 1.2;     /* rapatkan teks */
}

.featured-item > * {
    margin-bottom: 0 !important; /* pastikan semua anak elemen rapat */
}
    </style>

    <div class=" py-2">
        {{-- Header Section --}}
        <div class="p-3 p-md-4 rounded-3 bg-gradient-indigo-purple text-white mb-4">
            <h1 class="h2 fw-bold mb-2">Edukasi Kehamilan</h1>
            <p class="mb-0" style="color: rgba(255,255,255,0.8);">
                Pelajari nutrisi dan kesehatan untuk kehamilan yang sehat
            </p>
        </div>

        {{-- Search and Filter Section --}}
        <div class="card border-0 shadow-lg mb-4 rounded-4">
            <div class="card-body p-3 p-md-4">
                <div class="row g-3 g-md-4 ">
                    <div class="col-12 col-md-8">
                        <div class="position-relative">
                            <i class="fa-solid fa-magnifying-glass position-absolute start-0 top-50 translate-middle-y ms-3 text-muted"
                                style="z-index:10;"></i>
                            <input type="text" id="searchInput" class="form-control ps-5"
                                placeholder="Cari materi edukasi..." style="height:48px;">
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="d-flex gap-1 flex-wrap">
                            @php
                                $types = [
                                    'all' => 'Semua',
                                    'video' => 'Video',
                                    'ebook' => 'E-Book',
                                    'poster' => 'Infografis',
                                ];
                                $counts = [
                                    'video' => $educations->where('type', 'video')->count(),
                                    'ebook' => $educations->where('type', 'ebook')->count(),
                                    'poster' => $educations->where('type', 'poster')->count(),
                                    'all' => $educations->count(),
                                ];
                            @endphp
                            @foreach ($types as $key => $label)
                                <button
                                    class="btn {{ $key == 'all' ? 'btn-purple-custom' : 'btn-outline-purple-custom' }} btn-sm"
                                    data-filter="{{ $key }}" data-count="{{ $counts[$key] }}">
                                    {{ $label }} ({{ $counts[$key] }})
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Featured Content Section --}}
        @php
            $featured = $educations->where('is_popular', true)->take(2);
        @endphp
        @if ($featured->count() > 0)
            <div class="card border-0 shadow-lg bg-white mb-4">
                <div class="card-header bg-transparent border-0">
                    <h5 class="card-title mb-0 d-flex align-items-center">
                        <i class="bi bi-star-fill star-yellow me-2"></i>
                        Konten Unggulan
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-1 g-md-2">
                        @foreach ($featured as $edu)
                            <div class="col-12 col-md-6">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-2 me-md-3">
                                        <img src="{{ asset('storage/' . $edu->thumbnail_url) }}" alt="{{ $edu->title }}"
                                            class="rounded" style="width:80px; height:64px; object-fit:cover;">
                                    </div>
                                    <div class="flex-grow-1">
                                        <h6 class="fw-semibold text-gray-900 featured-title">{{ $edu->title }}</h6>
                                        <p class="featured-desc">{!! $edu->description !!}</p>
                                        
                                        <div class="">
                                            <span
                                            class="badge featured-type
                            @if ($edu->type == 'video') badge-video
                            @elseif($edu->type == 'ebook') badge-ebook
                            @else badge-infographic @endif">
                                            {{ ucfirst($edu->type) }}
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        {{-- Content Grid --}}
        <div id="contentGrid" class="row g-2 g-md-3">
            @foreach ($educations as $edu)
                <div class="col-12 col-md-6 col-lg-4 content-item" data-type="{{ $edu->type }}"
                    data-title="{{ strtolower($edu->title) }}" data-description="{{ strtolower($edu->description) }}">
                    <div class="card h-100 border-0 shadow-lg card-hover">
                        <div class="position-relative image-hover">
                            <img src="{{ asset('storage/' . $edu->thumbnail_url) }}" alt="{{ $edu->title }}"
                                class="card-img-top" style="height: 192px; object-fit: cover;">
                            <div class="position-absolute top-0 start-0 m-3">
                                <span
                                    class="badge
                            @if ($edu->type == 'video') badge-video
                            @elseif($edu->type == 'ebook') badge-ebook
                            @else badge-infographic @endif">
                                    @if ($edu->type == 'video')
                                        <i class="bi bi-play-fill me-1"></i>Video
                                    @elseif($edu->type == 'ebook')
                                        <i class="bi bi-book me-1"></i>E-Book
                                    @else
                                        Infografis
                                    @endif
                                </span>
                            </div>
                            @if ($edu->type == 'video')
                                <div class="play-overlay">
                                    <a href="{{ $edu->content_url }}">
                                        <i class="fa-solid fa-play"></i>
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div class="card-body p-4">
                            <h5 class="card-title fw-semibold text-gray-900 mb-2">{{ $edu->title }}</h5>
                            <p class="card-text text-muted small mb-3">{!! $edu->description !!}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center text-muted small">
                                    {{-- bisa isi durasi atau halaman --}}
                                </div>
                                <a href="{{ $edu->content_url }}" class="btn btn-purple-custom btn-sm">
                                    @if ($edu->type == 'video')
                                        Tonton
                                    @else
                                        Baca
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- No Results --}}
        <div id="noResults" class="card border-0 shadow-lg mt-4" style="display:none;">
            <div class="card-body p-5 text-center">
                <i class="bi bi-book fs-1 text-muted mb-4"></i>
                <h3 class="h5 fw-semibold text-gray-900 mb-2">Tidak ada konten ditemukan</h3>
                <p class="text-muted mb-0">Coba ubah kata kunci pencarian atau pilih kategori yang berbeda</p>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const filterButtons = document.querySelectorAll('[data-filter]');
            const contentItems = document.querySelectorAll('.content-item');
            const noResults = document.getElementById('noResults');
            let currentFilter = 'all';

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => {
                        btn.classList.remove('btn-purple-custom');
                        btn.classList.add('btn-outline-purple-custom');
                    });
                    this.classList.remove('btn-outline-purple-custom');
                    this.classList.add('btn-purple-custom');
                    currentFilter = this.getAttribute('data-filter');
                    filterContent();
                });
            });

            searchInput.addEventListener('input', filterContent);

            function filterContent() {
                const term = searchInput.value.toLowerCase().trim();
                let visibleCount = 0;
                contentItems.forEach(item => {
                    const type = item.getAttribute('data-type');
                    const title = item.getAttribute('data-title');
                    const desc = item.getAttribute('data-description');
                    const matchesFilter = currentFilter == 'all' || type == currentFilter;
                    const matchesSearch = title.includes(term) || desc.includes(term);
                    if (matchesFilter && matchesSearch) {
                        item.style.display = 'block';
                        visibleCount++;
                    } else {
                        item.style.display = 'none';
                    }
                });
                noResults.style.display = visibleCount === 0 ? 'block' : 'none';
            }
        });
    </script>
@endsection
