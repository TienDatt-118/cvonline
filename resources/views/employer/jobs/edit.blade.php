@extends('layouts.artistic')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin=""/>

<div class="page-content">

    <div class="max-w-3xl mx-auto mb-6 flex items-center gap-4">
        <a href="{{ route('employer.jobs.index') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-100 transition">←</a>
        <h1 class="text-2xl font-bold text-gray-800">Chỉnh sửa tin tuyển dụng</h1>
    </div>

    <div class="max-w-3xl mx-auto">
        <div class="glass-card p-8 rounded-3xl shadow-xl border border-white/40">
            <form action="{{ route('employer.jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label class="block font-bold mb-2 text-sm uppercase">Tiêu đề công việc *</label>
                    <input type="text" name="title" value="{{ $job->title }}" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 outline-none" required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block font-bold mb-2 text-sm uppercase">Ngành nghề</label>
                        <select name="job_category_id" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 bg-white">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $job->job_category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-bold mb-2 text-sm uppercase">Loại hình làm việc</label>
                        <select name="job_type" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 bg-white">
                            <option value="Full-time" {{ $job->job_type == 'Full-time' ? 'selected' : '' }}>🟢 Toàn thời gian</option>
                            <option value="Part-time" {{ $job->job_type == 'Part-time' ? 'selected' : '' }}>🟡 Bán thời gian</option>
                            <option value="Freelance" {{ $job->job_type == 'Freelance' ? 'selected' : '' }}>🟣 Freelance</option>
                            <option value="Internship" {{ $job->job_type == 'Internship' ? 'selected' : '' }}>🔵 Thực tập sinh</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div>
                        <label class="block font-bold mb-2 text-sm uppercase">Lương Min</label>
                        <input type="number" name="min_salary" value="{{ $job->min_salary }}" class="w-full px-4 py-3 rounded-xl border focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block font-bold mb-2 text-sm uppercase">Lương Max</label>
                        <input type="number" name="max_salary" value="{{ $job->max_salary }}" class="w-full px-4 py-3 rounded-xl border focus:border-blue-500">
                    </div>
                    <div>
                        <label class="block font-bold mb-2 text-sm uppercase">Hạn nộp</label>
                        <input type="date" name="deadline" value="{{ $job->deadline }}" class="w-full px-4 py-3 rounded-xl border focus:border-blue-500" required>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block font-bold mb-2 text-sm uppercase">Địa điểm & Bản đồ</label>
                    <input type="text" name="location" id="location_input" value="{{ $job->location }}" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 mb-3 bg-white/50">

                    <div id="map" class="w-full h-64 rounded-xl border-2 border-white shadow-inner z-0"></div>

                    <input type="hidden" name="latitude" id="lat" value="{{ $job->latitude }}">
                    <input type="hidden" name="longitude" id="lng" value="{{ $job->longitude }}">
                </div>

                <div class="mb-8">
                    <label class="block font-bold mb-2 text-sm uppercase">Mô tả chi tiết</label>
                    <textarea name="description" rows="6" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 outline-none" required>{{ $job->description }}</textarea>
                </div>

                <div class="mb-6">
                    <label class="block font-bold mb-2 text-sm uppercase">Trạng thái tin</label>
                    <select name="status" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 bg-white">
                        <option value="active" {{ $job->status == 'active' ? 'selected' : '' }}>Hiển thị công khai</option>
                        <option value="expired" {{ $job->status != 'active' ? 'selected' : '' }}>Ẩn tin này</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold py-4 rounded-xl shadow-lg hover:shadow-xl transition transform hover:scale-[1.01]">
                    LƯU THAY ĐỔI
                </button>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Lấy tọa độ cũ từ Database, nếu không có thì lấy Hà Nội
        var savedLat = {{ $job->latitude ?? 21.0285 }};
        var savedLng = {{ $job->longitude ?? 105.8542 }};

        var map = L.map('map').setView([savedLat, savedLng], 13);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var marker;

        // Nếu đã có tọa độ cũ, hiển thị ghim ngay lập tức
        if ({{ $job->latitude ? 'true' : 'false' }}) {
            marker = L.marker([savedLat, savedLng]).addTo(map);
        }

        // Sự kiện click để đổi vị trí
        map.on('click', function(e) {
            var lat = e.latlng.lat;
            var lng = e.latlng.lng;

            if (marker) map.removeLayer(marker);
            marker = L.marker([lat, lng]).addTo(map);

            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if(data.display_name) {
                        document.getElementById('location_input').value = data.display_name;
                    }
                });
        });
    });
</script>
@endsection
