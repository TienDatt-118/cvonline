@extends('layouts.artistic')

@section('content')
<div class="page-content">
    <div class="max-w-3xl mx-auto mb-6 flex items-center gap-4">
        <a href="{{ route('employer.dashboard') }}" class="w-10 h-10 flex items-center justify-center bg-white rounded-full shadow hover:bg-gray-100 transition">←</a>
        <h1 class="text-2xl font-bold text-gray-800">Hồ sơ Công ty</h1>
    </div>

    <div class="max-w-3xl mx-auto">
        @if(session('success'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm">✅ {{ session('success') }}</div>
        @endif

        <div class="glass-card p-8 rounded-3xl shadow-xl border border-white/40">
            <form action="{{ route('employer.company.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-8 flex items-center gap-6">
                    <div class="shrink-0">
                        @if($company->logo)
                            <img class="h-24 w-24 object-cover rounded-full border-4 border-white shadow-md" src="{{ asset('storage/' . $company->logo) }}" alt="Logo">
                        @else
                            <div class="h-24 w-24 rounded-full bg-gray-200 flex items-center justify-center text-4xl border-4 border-white shadow-md">🏢</div>
                        @endif
                    </div>
                    <div class="flex-1">
                        <label class="block font-bold mb-2 text-sm uppercase">Logo công ty</label>
                        <input type="file" name="logo" class="block w-full text-sm text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:bg-pink-50 file:text-pink-700 hover:file:bg-pink-100"/>
                    </div>
                </div>

                <div class="mb-6">
                    <label class="block font-bold mb-2">Tên Công ty *</label>
                    <input type="text" name="name" value="{{ old('name', $company->name) }}" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 outline-none" required>
                </div>

                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block font-bold mb-2">Website</label>
                        <input type="url" name="website" value="{{ old('website', $company->website) }}" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 outline-none">
                    </div>
                    <div>
                        <label class="block font-bold mb-2">Trụ sở chính</label>
                        <input type="text" name="address" value="{{ old('address', $company->address) }}" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 outline-none">
                    </div>
                </div>

                <div class="mb-8">
                    <label class="block font-bold mb-2">Giới thiệu</label>
                    <textarea name="about" rows="5" class="w-full px-5 py-3 rounded-xl border focus:border-blue-500 outline-none">{{ old('about', $company->about) }}</textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 text-white font-bold px-8 py-3 rounded-xl shadow-lg hover:shadow-xl transition">Lưu Thay Đổi</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
