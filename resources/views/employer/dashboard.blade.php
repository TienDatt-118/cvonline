@extends('layouts.artistic')

@section('content')

<div class="page-content">

    <div class="glass-card rounded-2xl p-8 mb-8 flex flex-col md:flex-row justify-between items-center animate-fade-in-down">
        <div class="mb-4 md:mb-0">
            <h1 class="text-3xl font-bold text-gray-800 mb-2 flex items-center gap-2">
                👋 Xin chào, <span class="text-blue-600">{{ Auth::user()->name }}</span>
            </h1>
            <p class="text-gray-500">Quản lý hoạt động tuyển dụng của bạn tại đây.</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('home') }}" class="bg-white text-gray-700 border border-gray-200 px-6 py-3 rounded-full font-bold shadow-sm hover:shadow-md hover:bg-gray-50 hover:text-blue-600 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                <span>🏠</span> Xem Website
            </a>

            <a href="{{ route('employer.jobs.create') }}" class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 flex items-center gap-2">
                <span>+</span> Đăng tin mới
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        <div class="glass-card p-6 rounded-2xl flex items-center gap-4 hover:bg-white/90 transition">
            <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                📢
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Tin đang hiển thị</p>
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $activeJobs }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 rounded-2xl flex items-center gap-4 hover:bg-white/90 transition">
            <div class="w-14 h-14 bg-pink-100 text-pink-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                📄
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Hồ sơ nhận được</p>
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalApplications }}</h3>
            </div>
        </div>

        <div class="glass-card p-6 rounded-2xl flex items-center gap-4 hover:bg-white/90 transition">
            <div class="w-14 h-14 bg-green-100 text-green-600 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                👁️
            </div>
            <div>
                <p class="text-gray-500 text-sm font-medium">Tổng lượt xem</p>
                <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalViews }}</h3>
            </div>
        </div>
    </div>

    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
        <span class="w-2 h-6 bg-pink-500 rounded-full"></span> Chức năng quản lý
    </h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <a href="{{ route('employer.jobs.index') }}" class="glass-card p-8 rounded-2xl hover:bg-white transition group cursor-pointer border border-transparent hover:border-blue-300 shadow-sm hover:shadow-md relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 text-9xl -mr-4 -mt-4 rotate-12 group-hover:scale-110 transition">📋</div>
            <div class="text-4xl mb-4 group-hover:scale-110 transition duration-300 relative z-10">📋</div>
            <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-blue-600 relative z-10">Quản lý Tin đăng</h3>
            <p class="text-sm text-gray-500 leading-relaxed relative z-10">Xem danh sách, sửa nội dung hoặc ẩn các tin tuyển dụng của bạn.</p>
        </a>

        <a href="{{ route('employer.candidates.index') }}" class="glass-card p-8 rounded-2xl hover:bg-white transition group cursor-pointer border border-transparent hover:border-pink-300 shadow-sm hover:shadow-md relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 text-9xl -mr-4 -mt-4 rotate-12 group-hover:scale-110 transition">👥</div>
            <div class="text-4xl mb-4 group-hover:scale-110 transition duration-300 relative z-10">👥</div>
            <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-pink-600 relative z-10">Hồ sơ Ứng viên</h3>
            <p class="text-sm text-gray-500 leading-relaxed relative z-10">Xem CV chi tiết và liên hệ với các ứng viên tiềm năng.</p>
        </a>

        <a href="{{ route('employer.company.edit') }}" class="glass-card p-8 rounded-2xl hover:bg-white transition group cursor-pointer border border-transparent hover:border-green-300 shadow-sm hover:shadow-md relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 opacity-10 text-9xl -mr-4 -mt-4 rotate-12 group-hover:scale-110 transition">🏢</div>
            <div class="text-4xl mb-4 group-hover:scale-110 transition duration-300 relative z-10">🏢</div>
            <h3 class="font-bold text-lg text-gray-800 mb-2 group-hover:text-green-600 relative z-10">Hồ sơ Công ty</h3>
            <p class="text-sm text-gray-500 leading-relaxed relative z-10">Cập nhật logo, địa chỉ và thông tin giới thiệu doanh nghiệp.</p>
        </a>

    </div>
</div>
@endsection
