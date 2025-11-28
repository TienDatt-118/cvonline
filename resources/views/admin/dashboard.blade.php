<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - JobArt</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
</head>
<body class="flex bg-gray-100 font-sans">

    <aside class="w-64 admin-sidebar min-h-screen flex flex-col hidden md:flex fixed top-0 left-0 bottom-0 z-50 shadow-xl" style="background-color: #0B1A33; color: white;">
        <div class="h-20 flex items-center justify-center border-b border-gray-700">
            <h1 class="text-3xl font-extrabold">Job<span class="text-blue-500">Art</span>.</h1>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 bg-blue-600 rounded-lg text-white shadow-lg">
                <span class="mr-3 text-xl">📊</span>
                <span class="font-medium">Tổng quan</span>
            </a>

            <p class="text-xs text-gray-500 uppercase mt-6 mb-2 px-4 font-bold tracking-wider">Quản lý</p>

            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-white/10 hover:text-white rounded-lg transition group">
                <span class="mr-3 text-xl group-hover:scale-110 transition">🏢</span> Công ty
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-white/10 hover:text-white rounded-lg transition group">
                <span class="mr-3 text-xl group-hover:scale-110 transition">👨‍🎓</span> Ứng viên
            </a>
            <a href="#" class="flex items-center px-4 py-3 text-gray-400 hover:bg-white/10 hover:text-white rounded-lg transition group justify-between">
                <div class="flex items-center">
                    <span class="mr-3 text-xl group-hover:scale-110 transition">💼</span> Việc làm
                </div>
                @if(isset($pendingJobs) && $pendingJobs > 0)
                    <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full font-bold">{{ $pendingJobs }}</span>
                @endif
            </a>
        </nav>

        <div class="p-4 border-t border-gray-700">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="flex items-center text-gray-400 hover:text-white w-full py-2 hover:bg-white/5 rounded-lg px-2 transition">
                    <span class="mr-3">🚪</span> Đăng xuất
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 flex flex-col ml-64 min-h-screen">

        <header class="h-20 bg-white shadow-sm flex items-center justify-between px-8 sticky top-0 z-40">
            <h2 class="text-xl font-bold text-gray-800">Tổng quan hệ thống</h2>
            <div class="flex items-center gap-4">
                <div class="text-right hidden sm:block">
                    <p class="text-sm font-bold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">Quản trị viên</p>
                </div>
                <div class="w-10 h-10 bg-gray-200 rounded-full overflow-hidden border-2 border-blue-500">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=0D8ABC&color=fff" alt="Admin">
                </div>
            </div>
        </header>

        <div class="p-8">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-blue-500 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Tổng số Ứng viên</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalCandidates ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-blue-50 rounded-lg text-blue-600 text-xl">👥</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-green-500 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Tổng số Công ty</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $totalCompanies ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-green-50 rounded-lg text-green-600 text-xl">🏢</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-yellow-500 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Việc làm chờ duyệt</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $pendingJobs ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-yellow-50 rounded-lg text-yellow-600 text-xl">⏳</div>
                    </div>
                </div>

                <div class="bg-white p-6 rounded-xl shadow-sm border-l-4 border-purple-500 hover:shadow-md transition">
                    <div class="flex justify-between items-start">
                        <div>
                            <p class="text-gray-500 text-sm font-medium mb-1">Tin đang chạy</p>
                            <h3 class="text-3xl font-extrabold text-gray-800">{{ $activeJobs ?? 0 }}</h3>
                        </div>
                        <div class="p-2 bg-purple-50 rounded-lg text-purple-600 text-xl">🚀</div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <h3 class="font-bold text-lg text-gray-800">Việc làm mới đăng</h3>
                    <button class="text-blue-600 text-sm font-medium hover:underline">Xem tất cả</button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-500 text-xs uppercase font-semibold">
                            <tr>
                                <th class="px-6 py-3">Tiêu đề</th>
                                <th class="px-6 py-3">Công ty</th>
                                <th class="px-6 py-3">Ngày đăng</th>
                                <th class="px-6 py-3">Trạng thái</th>
                                <th class="px-6 py-3 text-right">Hành động</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm divide-y divide-gray-100">
                            @forelse($recentJobs as $job)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-blue-600 cursor-pointer">{{ $job->title }}</td>
                                <td class="px-6 py-4 text-gray-700">{{ $job->company->name ?? 'N/A' }}</td>
                                <td class="px-6 py-4 text-gray-500">{{ $job->created_at->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    @if($job->status == 'active')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            Hoạt động
                                        </span>
                                    @elseif($job->status == 'pending')
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            Chờ duyệt
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            {{ $job->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-gray-400 hover:text-blue-600 transition p-1 hover:bg-blue-50 rounded">
                                        👁️ Xem
                                    </button>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                                    Chưa có dữ liệu việc làm nào.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
