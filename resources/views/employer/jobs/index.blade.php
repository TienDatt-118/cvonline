@extends('layouts.artistic')

@section('content')
<div class="page-content">

    <div class="max-w-6xl mx-auto mb-8 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4 w-full md:w-auto">
            <a href="{{ route('employer.dashboard') }}" class="w-12 h-12 flex items-center justify-center bg-white rounded-full shadow-md hover:bg-gray-50 transition transform hover:-translate-x-1 text-gray-600 text-xl font-bold">
                ←
            </a>
            <div>
                <h1 class="text-3xl font-bold text-white drop-shadow-md">Quản lý Tin đăng</h1>
                <p class="text-sm text-gray-200 font-medium">Danh sách các vị trí đang tuyển dụng</p>
            </div>
        </div>

        <a href="{{ route('employer.jobs.create') }}" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white px-8 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition transform hover:-translate-y-1 text-sm flex items-center gap-2 border border-white/20">
            <span class="text-xl">+</span> Đăng tin mới
        </a>
    </div>

    <div class="max-w-6xl mx-auto">

        @if(session('success'))
            <div class="mb-8 animate-fade-in-down">
                <div class="glass-card bg-white/95 border-l-8 border-green-500 p-6 rounded-2xl shadow-2xl flex items-center justify-between relative overflow-hidden">

                    <div class="flex items-center gap-5 relative z-10">
                        <div class="w-14 h-14 bg-green-100 rounded-full flex items-center justify-center text-3xl text-green-600 shadow-inner">
                            ✅
                        </div>
                        <div>
                            <h3 class="font-bold text-xl text-gray-800">Thao tác thành công!</h3>
                            <p class="text-green-700 font-medium text-lg">{{ session('success') }}</p>
                        </div>
                    </div>

                    <button onclick="this.parentElement.parentElement.style.display='none'" class="text-gray-400 hover:text-gray-600 text-2xl font-bold px-4 relative z-10">
                        ×
                    </button>

                    <div class="absolute right-0 top-0 bottom-0 w-64 bg-gradient-to-l from-green-50 to-transparent opacity-50 pointer-events-none"></div>
                </div>
            </div>
        @endif
        <div class="glass-card rounded-3xl overflow-hidden shadow-2xl border border-white/30">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-100/80 border-b border-gray-200 backdrop-blur-md">
                        <tr>
                            <th class="px-8 py-5 font-extrabold text-gray-700 uppercase text-xs tracking-wider">Tiêu đề công việc</th>
                            <th class="px-8 py-5 font-extrabold text-gray-700 uppercase text-xs tracking-wider">Mức lương</th>
                            <th class="px-8 py-5 font-extrabold text-gray-700 uppercase text-xs tracking-wider">Hạn nộp</th>
                            <th class="px-8 py-5 font-extrabold text-gray-700 uppercase text-xs tracking-wider text-center">Trạng thái</th>
                            <th class="px-8 py-5 font-extrabold text-gray-700 uppercase text-xs tracking-wider text-right">Hành động</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 bg-white/60">
                        @forelse($jobs as $job)
                        <tr class="hover:bg-white/90 transition duration-200 group">
                            <td class="px-8 py-5">
                                <div class="font-bold text-gray-800 text-lg group-hover:text-pink-600 transition">{{ $job->title }}</div>
                                <div class="text-xs text-gray-500 flex items-center gap-1 mt-1 font-medium">
                                    <span>📍 {{ $job->location }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-5 text-gray-700 font-bold">
                                @if($job->min_salary)
                                    {{ number_format($job->min_salary/1000000) }} - {{ number_format($job->max_salary/1000000) }} <span class="text-xs text-gray-500">Tr</span>
                                @else
                                    Thỏa thuận
                                @endif
                            </td>
                            <td class="px-8 py-5 text-sm font-medium text-gray-600">
                                {{ \Carbon\Carbon::parse($job->deadline)->format('d/m/Y') }}
                            </td>
                            <td class="px-8 py-5 text-center">
                                @if($job->status == 'active')
                                    <span class="px-4 py-1.5 bg-green-100 text-green-700 rounded-full text-xs font-bold border border-green-200 shadow-sm">Hiển thị</span>
                                @else
                                    <span class="px-4 py-1.5 bg-gray-100 text-gray-600 rounded-full text-xs font-bold border border-gray-200 shadow-sm">Đã ẩn</span>
                                @endif
                            </td>
                            <td class="px-8 py-5 text-right space-x-2">
                                <a href="{{ route('employer.jobs.edit', $job->id) }}" class="inline-flex items-center justify-center w-10 h-10 bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white rounded-xl transition shadow-sm" title="Sửa">
                                    ✏️
                                </a>
                                <form action="{{ route('employer.jobs.destroy', $job->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa tin này? Hành động này không thể hoàn tác.');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center w-10 h-10 bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded-xl transition shadow-sm" title="Xóa">
                                        🗑️
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-20 text-center text-gray-400 bg-white/50">
                                <div class="text-6xl mb-4 grayscale opacity-50">📭</div>
                                <p class="text-lg font-medium">Bạn chưa đăng tin tuyển dụng nào.</p>
                                <a href="{{ route('employer.jobs.create') }}" class="text-pink-600 hover:underline mt-2 inline-block font-bold">Đăng tin đầu tiên ngay</a>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($jobs->hasPages())
            <div class="px-8 py-5 border-t border-gray-100 bg-white/40">
                {{ $jobs->links() }}
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
