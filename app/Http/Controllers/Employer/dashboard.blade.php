@extends('layouts.artistic')

@section('content')
<div class="max-w-7xl mx-auto mt-10">
    <div class="glass-card rounded-3xl p-8 text-center">
        <h2 class="text-3xl font-bold text-gray-800 mb-4">👋 Chào mừng Nhà tuyển dụng!</h2>
        <p class="text-gray-600 mb-8">Đây là bảng điều khiển dành riêng cho công ty của bạn.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <div class="text-4xl mb-2">📢</div>
                <h3 class="font-bold text-xl mb-2">Đăng tin mới</h3>
                <a href="{{ route('employer.jobs.create') }}" class="text-pink-600 hover:underline">Tạo tin ngay &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <div class="text-4xl mb-2">📂</div>
                <h3 class="font-bold text-xl mb-2">Quản lý tin đăng</h3>
                <a href="{{ route('employer.jobs.index') }}" class="text-blue-600 hover:underline">Xem danh sách &rarr;</a>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition">
                <div class="text-4xl mb-2">🏢</div>
                <h3 class="font-bold text-xl mb-2">Hồ sơ công ty</h3>
                <span class="text-gray-400 text-sm">Đang cập nhật...</span>
            </div>
        </div>
    </div>
</div>
@endsection
