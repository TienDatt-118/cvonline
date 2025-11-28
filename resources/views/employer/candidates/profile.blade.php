@extends('layouts.artistic')

@section('content')
<div class="page-content">
    <div class="max-w-3xl mx-auto">

        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">✅ {{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">⚠️ {{ session('error') }}</div>
        @endif

        <div class="glass-card p-8 rounded-3xl shadow-xl">
            <h2 class="text-2xl font-bold text-gray-800 mb-6 border-b pb-4">Hồ sơ cá nhân & CV</h2>

            <form action="{{ route('candidate.profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-8 bg-blue-50 p-6 rounded-xl border-2 border-dashed border-blue-200 text-center">
                    <label class="block font-bold text-gray-700 mb-2">CV / Sơ yếu lý lịch (PDF, Word)</label>

                    @if($candidate->cv_path)
                        <div class="mb-4 text-green-600 font-bold flex items-center justify-center gap-2">
                            <span>✅ Đã có CV:</span>
                            <a href="{{ asset('storage/' . $candidate->cv_path) }}" target="_blank" class="underline hover:text-green-800">Xem file hiện tại</a>
                        </div>
                    @else
                        <div class="mb-4 text-red-500 text-sm">⚠️ Bạn chưa tải lên CV nào. Hãy tải lên để ứng tuyển.</div>
                    @endif

                    <input type="file" name="cv_file" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 mx-auto max-w-xs">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block font-bold mb-2 text-sm">Họ và tên</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-3 rounded-xl border focus:border-pink-500 outline-none" required>
                    </div>
                    <div>
                        <label class="block font-bold mb-2 text-sm">Chức danh (VD: Java Developer)</label>
                        <input type="text" name="title" value="{{ old('title', $candidate->title) }}" class="w-full px-4 py-3 rounded-xl border focus:border-pink-500 outline-none" placeholder="VD: Fresher Marketing...">
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block font-bold mb-2 text-sm">Số điện thoại</label>
                        <input type="text" name="phone" value="{{ old('phone', $candidate->phone) }}" class="w-full px-4 py-3 rounded-xl border focus:border-pink-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-bold mb-2 text-sm">Địa chỉ</label>
                        <input type="text" name="address" value="{{ old('address', $candidate->address) }}" class="w-full px-4 py-3 rounded-xl border focus:border-pink-500 outline-none">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block font-bold mb-2 text-sm">Giới thiệu bản thân</label>
                    <textarea name="bio" rows="4" class="w-full px-4 py-3 rounded-xl border focus:border-pink-500 outline-none">{{ old('bio', $candidate->bio) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-gradient-to-r from-pink-500 to-purple-600 text-white font-bold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        Lưu Hồ Sơ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
