@extends('layouts.artistic')

@section('content')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<div class="page-content">

    <div class="max-w-3xl mx-auto mb-6 flex items-center gap-4">
        <a href="{{ route('employer.jobs.index') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-100 transition transform hover:-translate-x-1 text-gray-600">
            ←
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Đăng tin tuyển dụng mới</h1>
            <p class="text-sm text-gray-500">Điền thông tin chi tiết và ghim vị trí làm việc</p>
        </div>
    </div>

    <div class="max-w-3xl mx-auto">
        @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                <p class="font-bold mb-1">⚠️ Vui lòng kiểm tra lại:</p>
                <ul class="list-disc pl-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="glass-card p-8 rounded-3xl shadow-xl border border-white/40">
            <form action="{{ route('employer.jobs.store') }}" method="POST">
                @csrf

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Tiêu đề công việc <span class="text-red-500">*</span></label>
                    <input type="text" name="title" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-pink-500 focus:ring-4 focus:ring-pink-100 outline-none transition bg-white/80 font-medium text-lg" placeholder="VD: Nhân viên phục vụ Part-time" required value="{{ old('title') }}">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Ngành nghề</label>
                        <select name="job_category_id" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80 cursor-pointer">
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Loại hình làm việc</label>
                        <select name="job_type" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80 cursor-pointer font-medium">
                            <option value="Full-time">🟢 Toàn thời gian (Full-time)</option>
                            <option value="Part-time">🟡 Bán thời gian (Part-time)</option>
                            <option value="Freelance">🟣 Freelance / Tự do</option>
                            <option value="Internship">🔵 Thực tập sinh</option>
                        </select>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Lương tối thiểu</label>
                        <div class="relative">
                            <input type="number" name="min_salary" class="w-full pl-5 pr-12 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80" placeholder="0">
                            <span class="absolute right-4 top-3 text-gray-400 text-sm font-bold">VND</span>
                        </div>
                    </div>
                    <div>
                        <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Lương tối đa</label>
                        <div class="relative">
                            <input type="number" name="max_salary" class="w-full pl-5 pr-12 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80" placeholder="0">
                            <span class="absolute right-4 top-3 text-gray-400 text-sm font-bold">VND</span>
                        </div>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Hạn nộp hồ sơ <span class="text-red-500">*</span></label>
                    <input type="date" name="deadline" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80" required>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Địa điểm làm việc <span class="text-red-500">*</span></label>

                    <input type="text" name="location" id="location_input" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80 mb-3 shadow-sm" placeholder="Nhập địa chỉ hoặc ghim trên bản đồ..." required>

                    <div id="map" class="w-full rounded-xl border-2 border-white shadow-inner z-0" style="height: 400px;"></div>

                    <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                        <span>💡</span> Mẹo: Bạn có thể kéo thả cái ghim để chọn vị trí chính xác hơn.
                    </p>

                    <input type="hidden" name="latitude" id="lat">
                    <input type="hidden" name="longitude" id="lng">
                </div>

                <div class="mb-8">
                    <label class="block text-gray-700 font-bold mb-2 text-sm uppercase tracking-wide">Mô tả chi tiết <span class="text-red-500">*</span></label>
                    <textarea name="description" rows="6" class="w-full px-5 py-3 rounded-xl border border-gray-200 focus:border-pink-500 outline-none bg-white/80" placeholder="Mô tả công việc, Yêu cầu ứng viên, Quyền lợi..." required></textarea>
                </div>

                <div class="flex items-center justify-end gap-4 pt-4 border-t border-gray-100">
                    <a href="{{ route('employer.jobs.index') }}" class="px-6 py-3 text-gray-600 font-bold hover:bg-gray-100 rounded-xl transition">Hủy bỏ</a>
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl hover:scale-[1.02] transition transform">
                        ĐĂNG TIN NGAY
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tọa độ mặc định (Hà Nội)
        var defaultLat = 21.0285;
        var defaultLng = 105.8542;

        // 1. Cấu hình các lớp bản đồ
        var streetMap = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap'
        });

        var satelliteMap = L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
            attribution: 'Tiles &copy; Esri'
        });

        // 2. Khởi tạo bản đồ
        var map = L.map('map', {
            center: [defaultLat, defaultLng],
            zoom: 13,
            layers: [streetMap] // Mặc định là đường phố
        });

        // 3. Thêm nút chuyển đổi (Góc phải trên)
        var baseMaps = {
            "🗺️ Đường phố": streetMap,
            "🛰️ Vệ tinh": satelliteMap
        };
        L.control.layers(baseMaps).addTo(map);

        var marker;

        // 4. Hàm xử lý khi click/kéo ghim
        function updateMarker(lat, lng) {
            // Cập nhật input ẩn
            document.getElementById('lat').value = lat;
            document.getElementById('lng').value = lng;

            // Gọi API lấy tên đường
            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`)
                .then(response => response.json())
                .then(data => {
                    if(data.display_name) {
                        // Cắt ngắn địa chỉ hiển thị 4 cấp
                        let shortName = data.display_name.split(',').slice(0, 4).join(',');
                        document.getElementById('location_input').value = shortName;
                    }
                });
        }

        // Sự kiện click vào bản đồ
        map.on('click', function(e) {
            if (marker) map.removeLayer(marker);

            // Tạo marker có thể kéo thả (draggable)
            marker = L.marker(e.latlng, {draggable: true}).addTo(map);
            updateMarker(e.latlng.lat, e.latlng.lng);

            // Sự kiện khi kéo xong marker
            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                updateMarker(position.lat, position.lng);
            });
        });

        // Fix lỗi hiển thị map khi load lần đầu
        setTimeout(function(){ map.invalidateSize()}, 400);
    });
</script>
@endsection
