<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JobPilot - Tuyển dụng & Tìm việc</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <style>
        /* Animation cho Dropdown */
        @keyframes fadeInDown {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-down { animation: fadeInDown 0.2s ease-out; }
    </style>
</head>
<body class="art-bg text-gray-800 font-[Outfit]">

    <nav class="glass-header fixed w-full z-50 transition-all duration-300 top-0 h-20">
        <div class="max-w-9xl mx-auto px-4 sm:px-6 lg:px-8 h-full">
            <div class="flex justify-between h-full items-center">

                <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                    <img src="{{ asset('images/logocv2.png') }}"
                         class="w-26 h-28 object-contain group-hover:scale-105 transition duration-300 drop-shadow-lg"
                         alt="Logo">
                </a>

                <div class="flex items-center space-x-6 h-full">

                    <a href="{{ route('home') }}" class="text-gray-100 hover:text-pink-400 font-bold transition hidden md:block text-sm uppercase tracking-wide">
                        Khám phá
                    </a>

                    @auth
                        <div class="relative group h-full flex items-center">

                            <button class="flex items-center gap-3 focus:outline-none transition h-full border-b-2 border-transparent group-hover:border-pink-500 px-2">
                                <div class="text-right hidden md:block leading-tight">
                                    <div class="text-[10px] text-gray-400 font-bold uppercase tracking-wider">Xin chào</div>
                                    <div class="font-bold text-white text-sm">{{ Auth::user()->name }}</div>
                                </div>

                                <div class="relative">
                                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=EAB308&color=fff&size=128"
                                         class="w-10 h-10 rounded-full border-2 border-white/20 shadow-md group-hover:border-yellow-400 transition duration-300">
                                    <span class="absolute bottom-0 right-0 block h-2.5 w-2.5 rounded-full ring-2 ring-gray-900 bg-green-400"></span>
                                </div>
                            </button>

                            <div class="absolute right-0 top-full pt-4 w-64 hidden group-hover:block z-50 animate-fade-in-down">

                                <div class="bg-white rounded-xl shadow-2xl border border-gray-100 overflow-hidden">

                                    <div class="px-5 py-3 border-b border-gray-100 bg-gray-50/50">
                                        <p class="font-bold text-gray-900 truncate">{{ Auth::user()->email }}</p>
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wide
                                            {{ Auth::user()->role == 'employer' ? 'bg-blue-100 text-blue-700' :
                                              (Auth::user()->role == 'admin' ? 'bg-red-100 text-red-700' : 'bg-pink-100 text-pink-700') }}">
                                            {{ Auth::user()->role == 'employer' ? 'Nhà tuyển dụng' : (Auth::user()->role == 'admin' ? 'Quản trị viên' : 'Ứng viên') }}
                                        </span>
                                    </div>

                                    <div class="py-2">
                                        @if(Auth::user()->role == 'employer')
                                            <a href="{{ route('employer.dashboard') }}" class="flex items-center px-5 py-3 hover:bg-blue-50 text-sm text-gray-700 hover:text-blue-600 transition">
                                                <span class="mr-3 text-lg">📊</span> Quản lý Tuyển dụng
                                            </a>
                                        @elseif(Auth::user()->role == 'admin')
                                            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-5 py-3 hover:bg-red-50 text-sm text-gray-700 hover:text-red-600 transition">
                                                <span class="mr-3 text-lg">🛡️</span> Trang Admin
                                            </a>
                                        @else
                                            <a href="#" class="flex items-center px-5 py-3 hover:bg-pink-50 text-sm text-gray-700 hover:text-pink-600 transition">
                                                <span class="mr-3 text-lg">📄</span> Hồ sơ của tôi
                                            </a>
                                        @endif
                                    </div>

                                    <div class="border-t border-gray-100 bg-gray-50">
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="w-full text-left flex items-center px-5 py-3 hover:bg-red-50 text-sm text-red-600 font-bold transition group/logout">
                                                <svg class="w-5 h-5 mr-3 group-hover/logout:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                                Đăng xuất
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="text-white hover:text-pink-400 font-bold text-sm transition">Đăng nhập</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="bg-white text-gray-900 px-5 py-2.5 rounded-full shadow-lg transition transform hover:-translate-y-1 hover:bg-gray-100 font-extrabold text-sm flex items-center gap-2">
                                <span>🚀</span> Đăng ký
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main>
        @yield('content')
    </main>

    <footer class="bg-black/40 backdrop-blur-md text-center text-gray-400 py-10 text-sm mt-20 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-center gap-6 mb-4">
                <a href="#" class="hover:text-white transition">Về chúng tôi</a>
                <a href="#" class="hover:text-white transition">Điều khoản</a>
                <a href="#" class="hover:text-white transition">Liên hệ</a>
            </div>
            <p>© 2025 JobPilot Project. Designed by Student IT.</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
