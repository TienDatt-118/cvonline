@extends('layouts.artistic')

@section('content')
<div class="page-content">

    <div class="max-w-6xl mx-auto mb-6 flex items-center gap-4">
        <a href="{{ route('employer.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-100 transition transform hover:-translate-x-1 text-gray-600">
            ←
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Hồ sơ Ứng viên</h1>
            <p class="text-sm text-gray-500">Quản lý các hồ sơ đã nộp vào tin đăng của bạn</p>
        </div>
    </div>

    <div class="max-w-6xl mx-auto">
        <div class="glass-card rounded-2xl overflow-hidden shadow-xl min-h-[400px]">

            @if($applications->isEmpty())
                <div class="flex flex-col items-center justify-center py-20 text-center">
                    <div class="text-6xl mb-4 opacity-30 grayscale">📂</div>
                    <h3 class="text-xl font-bold text-gray-600">Chưa có ứng viên nào</h3>
                    <p class="text-gray-500 max-w-md mt-2">Hiện tại chưa có ai nộp đơn. Hãy kiểm tra lại nội dung tin đăng để thu hút ứng viên hơn nhé.</p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50/80 border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Ứng viên</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Vị trí ứng tuyển</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase">Ngày nộp</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-center">Trạng thái</th>
                                <th class="px-6 py-4 text-xs font-bold text-gray-500 uppercase text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white/50">
                            @foreach($applications as $app)
                            <tr class="hover:bg-white transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-pink-100 flex items-center justify-center text-pink-600 font-bold text-lg">
                                            {{ substr($app->user->name ?? 'U', 0, 1) }}
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800">{{ $app->user->name ?? 'Người dùng ẩn' }}</div>
                                            <div class="text-xs text-gray-500">{{ $app->user->email ?? '' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-blue-600 font-medium">{{ $app->job->title ?? 'Tin đã xóa' }}</span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500">
                                    {{ $app->created_at->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700">Chờ duyệt</span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold shadow-sm hover:bg-blue-50 hover:text-blue-600 transition">
                                        Xem CV
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $applications->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
