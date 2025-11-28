@extends('layouts.artistic')

@section('content')
<div class="page-content">

    <div class="glass-card rounded-2xl p-8 mb-8 flex flex-col md:flex-row justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-800 mb-2">👋 Xin chào, {{ Auth::user()->name }}</h1>
            <p class="text-gray-500">Quản lý hồ sơ và các công việc bạn đã ứng tuyển.</p>
        </div>
        <div class="flex gap-3 mt-4 md:mt-0">
            <a href="{{ route('candidate.profile.edit') }}" class="bg-white border border-gray-200 text-gray-700 px-6 py-3 rounded-full font-bold shadow-sm hover:bg-gray-50 transition">
                📄 Cập nhật CV
            </a>
            <a href="{{ route('home') }}" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-full font-bold shadow-lg hover:shadow-xl transition">
                🔍 Tìm việc mới
            </a>
        </div>
    </div>

    <div class="glass-card rounded-2xl overflow-hidden shadow-xl min-h-[400px]">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="font-bold text-gray-700">Lịch sử ứng tuyển</h3>
        </div>

        @if($appliedJobs->isEmpty())
            <div class="text-center py-20">
                <div class="text-6xl mb-4 opacity-30 grayscale">💼</div>
                <p class="text-gray-500">Bạn chưa ứng tuyển công việc nào.</p>
                <a href="{{ route('home') }}" class="text-pink-600 font-bold hover:underline mt-2 inline-block">Khám phá việc làm ngay</a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-gray-50 text-gray-500 text-xs uppercase">
                        <tr>
                            <th class="px-6 py-3">Công việc</th>
                            <th class="px-6 py-3">Công ty</th>
                            <th class="px-6 py-3">Ngày nộp</th>
                            <th class="px-6 py-3 text-center">Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($appliedJobs as $app)
                        <tr class="hover:bg-white transition">
                            <td class="px-6 py-4 font-bold text-blue-600">
                                <a href="{{ route('job.show', $app->job->id) }}" target="_blank">{{ $app->job->title }}</a>
                            </td>
                            <td class="px-6 py-4">{{ $app->job->company->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $app->created_at->format('d/m/Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($app->status == 'pending')
                                    <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-bold">Đang chờ</span>
                                @elseif($app->status == 'reviewed')
                                    <span class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-xs font-bold">Đã xem</span>
                                @elseif($app->status == 'interview')
                                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">Phỏng vấn</span>
                                @else
                                    <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-xs font-bold">Từ chối</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
