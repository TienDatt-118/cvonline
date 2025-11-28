@extends('layouts.artistic')

@section('content')

<div class="hero-bg h-[500px] flex flex-col justify-center items-center text-center px-4">
    <h1 class="text-3xl md:text-5xl font-bold text-white mb-4 leading-tight">
        Việc làm Jobpilot số 1 để tuyển dụng <br> hoặc tìm việc làm tiếp theo của bạn
    </h1>
    <p class="text-gray-200 text-lg mb-8 max-w-2xl">
        Hơn 3 triệu người tìm việc truy cập mỗi ngày, tạo ra hơn 140.000 đơn xin việc mới.
    </p>

    <div class="bg-white p-2 rounded shadow-lg flex flex-col md:flex-row gap-2 w-full max-w-4xl">
        <div class="flex-1 flex items-center border-b md:border-b-0 md:border-r px-4 py-3">
            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" placeholder="Tiêu đề công việc, từ khóa..." class="w-full outline-none text-gray-700">
        </div>

        <div class="flex-1 flex items-center px-4 py-3 border-b md:border-b-0">
            <svg class="w-5 h-5 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
            <input type="text" placeholder="Nhập vị trí (Hà Nội, TP.HCM)" class="w-full outline-none text-gray-700">
        </div>

        <button class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded font-bold transition">
            Tìm việc ngay
        </button>
    </div>

    <div class="mt-4 text-gray-300 text-sm">
        Gợi ý: <span class="hover:text-white cursor-pointer underline">CNTT & Viễn thông</span>, <span class="hover:text-white cursor-pointer underline">Marketing</span>, <span class="hover:text-white cursor-pointer underline">Kế toán</span>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 py-16">
    <h2 class="text-2xl font-bold text-gray-800 mb-8">Danh mục hàng đầu</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white border hover:border-blue-500 hover:shadow-md rounded p-6 flex items-center gap-4 transition cursor-pointer group">
            <div class="bg-blue-50 text-blue-600 p-3 rounded group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 group-hover:text-blue-600">CNTT & Phần mềm</h3>
                <p class="text-xs text-gray-500">120 vị trí đang mở</p>
            </div>
        </div>

        <div class="bg-white border hover:border-blue-500 hover:shadow-md rounded p-6 flex items-center gap-4 transition cursor-pointer group">
            <div class="bg-blue-50 text-blue-600 p-3 rounded group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6 3 3 0 000 6v6a1 1 0 001 1h1v4h-4v-4h1a1 1 0 001-1v-3.5a1.5 1.5 0 013 0V13z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 group-hover:text-blue-600">Marketing</h3>
                <p class="text-xs text-gray-500">85 vị trí đang mở</p>
            </div>
        </div>

        <div class="bg-white border hover:border-blue-500 hover:shadow-md rounded p-6 flex items-center gap-4 transition cursor-pointer group">
            <div class="bg-blue-50 text-blue-600 p-3 rounded group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 group-hover:text-blue-600">Kế toán / Kiểm toán</h3>
                <p class="text-xs text-gray-500">42 vị trí đang mở</p>
            </div>
        </div>

        <div class="bg-white border hover:border-blue-500 hover:shadow-md rounded p-6 flex items-center gap-4 transition cursor-pointer group">
            <div class="bg-blue-50 text-blue-600 p-3 rounded group-hover:bg-blue-600 group-hover:text-white transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
            </div>
            <div>
                <h3 class="font-bold text-gray-800 group-hover:text-blue-600">Y tế / Dược</h3>
                <p class="text-xs text-gray-500">22 vị trí đang mở</p>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-2xl font-bold text-gray-800 mb-8 text-center">Việc làm nổi bật</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            @foreach($jobs as $job)
            <div class="bg-white border p-6 rounded hover:shadow-lg transition flex gap-4">
                <div class="w-16 h-16 bg-gray-100 rounded flex items-center justify-center font-bold text-gray-500 text-xl">
                    {{ substr($job->company->name ?? 'C', 0, 1) }}
                </div>

                <div class="flex-1">
                    <h3 class="font-bold text-lg text-gray-800 hover:text-blue-600 mb-1">
                        <a href="{{ route('job.show', $job->id) }}">{{ $job->title }}</a>
                    </h3>
                    <div class="flex items-center text-sm text-gray-500 mb-3 gap-3">
                        <span class="text-green-600 font-medium">{{ $job->job_type ?? 'Full Time' }}</span>
                        <span>• {{ $job->company->name ?? 'Ẩn danh' }}</span>
                        <span>• {{ $job->location ?? 'Toàn quốc' }}</span>
                    </div>
                </div>

                <div class="flex flex-col justify-between items-end">
                    <button class="text-gray-400 hover:text-blue-600">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path></svg>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection
