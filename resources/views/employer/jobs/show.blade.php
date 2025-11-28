@extends('layouts.artistic')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>

<div class="page-content">

    <div class="glass-card rounded-3xl p-8 mb-8 relative overflow-hidden">
        <div class="absolute top-0 right-0 w-64 h-64 bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>

        <div class="relative z-10 flex flex-col md:flex-row gap-6 items-start">
            <div class="w-24 h-24 bg-white rounded-2xl flex items-center justify-center shadow-lg p-2 shrink-0">
                @if($job->company->logo)
                    <img src="{{ asset('storage/' . $job->company->logo) }}" class="w-full h-full object-contain">
                @else
                    <span class="text-4xl">🏢</span>
                @endif
            </div>

            <div class="flex-1">
                <h1 class="text-3xl font-extrabold text-gray-800 mb-2 leading-tight">{{ $job->title }}</h1>

                <div class="flex flex-wrap items-center gap-3 text-gray-600 mb-4 text-sm font-medium">
                    <span class="text-blue-600 uppercase tracking-wide flex items-center gap-1">
                        🏢 {{ $job->company->name }}
                    </span>
                    <span class="text-gray-300">|</span>
                    <span class="flex items-center gap-1">
                        📍 {{ $job->location ?? 'Toàn quốc' }}
                    </span>
                    <span class="text-gray-300">|</span>
                    <span class="flex items-center gap-1 text-red-500">
                        🕒 Hết hạn: {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                    </span>
                </div>

                <div class="flex flex-wrap gap-3">
                    <span class="px-4 py-1.5 bg-green-100 text-green-700 rounded-full text-sm font-bold shadow-sm">
                        💰 {{ $job->min_salary ? number_format($job->min_salary/1000000) . ' - ' . number_format($job->max_salary/1000000) . ' Triệu' : 'Thỏa thuận' }}
                    </span>
                    <span class="px-4 py-1.5 bg-purple-100 text-purple-700 rounded-full text-sm font-bold shadow-sm">
                        {{ $job->job_type ?? 'Full-time' }}
                    </span>
                </div>
            </div>

            <div class="w-full md:w-auto mt-4 md:mt-0">
                @auth
                    @if(Auth::user()->role == 'candidate')
                        <form action="{{ route('job.apply', $job->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full bg-gradient-to-r from-pink-500 to-purple-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:shadow-xl hover:scale-105 transition transform flex items-center justify-center gap-2 text-lg" onclick="return confirm('Bạn có chắc chắn muốn ứng tuyển vị trí này?');">
                                <span>🚀</span> Ứng tuyển ngay
                            </button>
                        </form>
                    @elseif(Auth::user()->role == 'employer')
                        <div class="bg-gray-100 text-gray-500 px-6 py-3 rounded-xl font-bold text-center border border-gray-200">
                            Bạn đang là Nhà tuyển dụng
                        </div>
                    @else
                        <a href="{{ route('admin.dashboard') }}" class="block bg-gray-800 text-white px-6 py-3 rounded-xl font-bold text-center shadow-lg">
                            Quản lý tin này
                        </a>
                    @endif
                @else
                    <a href="{{ route('login') }}" class="block bg-blue-600 text-white px-8 py-4 rounded-xl font-bold shadow-lg hover:bg-blue-700 text-center transition">
                        Đăng nhập để ứng tuyển
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

        <div class="md:col-span-2 space-y-8">
            <div class="glass-card p-8 rounded-3xl shadow-sm">
                <h3 class="text-xl font-bold text-gray-800 mb-6 border-l-4 border-pink-500 pl-3">Mô tả công việc</h3>
                <div class="prose max-w-none text-gray-600 leading-relaxed whitespace-pre-line text-justify">
                    {{ $job->description }}
                </div>
            </div>

            @if($job->latitude && $job->longitude)
            <div class="glass-card p-8 rounded-3xl shadow-sm">
                <h3 class="text-xl font-bold text-gray-800 mb-4 border-l-4 border-green-500 pl-3">Địa điểm làm việc</h3>
                <p class="text-gray-500 mb-4 text-sm flex items-center gap-1">
                    <span>📍</span> {{ $job->location }}
                </p>
                <div id="view-map" class="w-full h-72 rounded-xl shadow-inner border-2 border-white z-0"></div>
            </div>
            @endif
        </div>

        <div>
            <div class="glass-card p-6 rounded-3xl sticky top-24 shadow-lg border-t-4 border-blue-500">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    🏢 Về công ty
                </h3>
                <p class="text-gray-600 text-sm mb-6 leading-relaxed">
                    {{ $job->company->about ?? 'Công ty chưa cập nhật thông tin giới thiệu.' }}
                </p>

                <div class="space-y-3 pt-4 border-t border-gray-100">
                    @if($job->company->website)
                    <a href="{{ $job->company->website }}" target="_blank" class="flex items-center gap-3 text-gray-600 hover:text-blue-600 transition group p-2 hover:bg-blue-50 rounded-lg">
                        <span class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 group-hover:bg-blue-600 group-hover:text-white transition">🌐</span>
                        <span class="text-sm font-bold">Website công ty</span>
                    </a>
                    @endif

                    @if($job->company->address)
                    <div class="flex items-center gap-3 text-gray-600 p-2">
                        <span class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center text-gray-500">📍</span>
                        <span class="text-sm">{{ $job->company->address }}</span>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@if($job->latitude && $job->longitude)
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Khởi tạo bản đồ xem trước (Chế độ Read-only)
        var map = L.map('view-map', {
            center: [{{ $job->latitude }}, {{ $job->longitude }}],
            zoom: 15,
            scrollWheelZoom: false // Tắt cuộn chuột để dễ đọc trang web
        });

        // Lớp nền đường phố
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        }).addTo(map);

        // Thêm ghim vị trí
        L.marker([{{ $job->latitude }}, {{ $job->longitude }}]).addTo(map)
            .bindPopup("<b>{{ $job->company->name }}</b><br>{{ $job->title }}")
            .openPopup();
    });
</script>
@endif

@endsection
