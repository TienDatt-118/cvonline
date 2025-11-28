<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="text-center">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/logo.jpg') }}" class="auth-logo" alt="Logo">
            </a>
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Chào mừng trở lại!</h2>
        </div>

        <div class="mb-6">
            <label class="block font-medium text-sm text-gray-700 mb-2">Đăng nhập với vai trò:</label>

            <div class="grid grid-cols-3 gap-3">
                <label class="cursor-pointer">
                    <input type="radio" name="login_role" value="candidate" class="peer sr-only" checked>
                    <div class="p-2 rounded-xl border-2 border-gray-200 hover:border-pink-500 peer-checked:border-pink-500 peer-checked:bg-pink-50 transition text-center h-full flex flex-col justify-center">
                        <div class="text-xl mb-1">👨‍🎓</div>
                        <div class="font-bold text-gray-700 peer-checked:text-pink-600 text-xs">Ứng viên</div>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="login_role" value="employer" class="peer sr-only">
                    <div class="p-2 rounded-xl border-2 border-gray-200 hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition text-center h-full flex flex-col justify-center">
                        <div class="text-xl mb-1">🏢</div>
                        <div class="font-bold text-gray-700 peer-checked:text-blue-600 text-xs">Tuyển dụng</div>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="login_role" value="admin" class="peer sr-only">
                    <div class="p-2 rounded-xl border-2 border-gray-200 hover:border-red-500 peer-checked:border-red-500 peer-checked:bg-red-50 transition text-center h-full flex flex-col justify-center">
                        <div class="text-xl mb-1">🛡️</div>
                        <div class="font-bold text-gray-700 peer-checked:text-red-600 text-xs">Admin</div>
                    </div>
                </label>
            </div>
        </div>

        <div class="mb-4">
            <x-text-input id="email"
                class="custom-input"
                type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" placeholder="Địa chỉ Email" />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-text-input id="password"
                class="custom-input"
                type="password" name="password"
                required autocomplete="current-password" placeholder="Mật khẩu" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-between items-center mb-6">
            <label for="remember_me" class="inline-flex items-center cursor-pointer">
                <input id="remember_me" type="checkbox"
                    class="custom-checkbox shadow-sm"
                    name="remember">
                <span class="ml-2 text-sm text-gray-600">{{ __('Ghi nhớ') }}</span>
            </label>

            @if (Route::has('password.request'))
                <a class="custom-link font-medium" href="{{ route('password.request') }}">
                    {{ __('Quên mật khẩu?') }}
                </a>
            @endif
        </div>

        <div class="mb-6">
            <x-primary-button class="w-full justify-center py-3 text-lg shadow-lg hover:shadow-xl transition transform hover:-translate-y-0.5">
                {{ __('Đăng nhập') }}
            </x-primary-button>
        </div>

        <div class="text-center border-t border-gray-200 pt-4">
            <p class="text-sm text-gray-600">
                Bạn chưa có tài khoản?
                <a href="{{ route('register') }}" class="custom-link font-bold text-pink-600 hover:text-pink-800">
                    Đăng ký ngay
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
