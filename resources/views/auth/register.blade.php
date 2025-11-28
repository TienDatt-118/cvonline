<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Tạo tài khoản mới</h2>

        <div class="mb-6">
            <label class="block font-medium text-sm text-gray-700 mb-2">Bạn là ai?</label>

            <div class="grid grid-cols-3 gap-3">

                <label class="cursor-pointer">
                    <input type="radio" name="role" value="candidate" class="peer sr-only" checked>
                    <div class="p-3 rounded-xl border-2 border-gray-200 hover:border-pink-500 peer-checked:border-pink-500 peer-checked:bg-pink-50 transition text-center h-full flex flex-col justify-center">
                        <div class="text-2xl mb-1">👨‍🎓</div>
                        <div class="font-bold text-gray-700 peer-checked:text-pink-600 text-sm">Ứng viên</div>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="role" value="employer" class="peer sr-only">
                    <div class="p-3 rounded-xl border-2 border-gray-200 hover:border-blue-500 peer-checked:border-blue-500 peer-checked:bg-blue-50 transition text-center h-full flex flex-col justify-center">
                        <div class="text-2xl mb-1">🏢</div>
                        <div class="font-bold text-gray-700 peer-checked:text-blue-600 text-sm">Tuyển dụng</div>
                    </div>
                </label>

                <label class="cursor-pointer">
                    <input type="radio" name="role" value="admin" class="peer sr-only">
                    <div class="p-3 rounded-xl border-2 border-gray-200 hover:border-red-500 peer-checked:border-red-500 peer-checked:bg-red-50 transition text-center h-full flex flex-col justify-center">
                        <div class="text-2xl mb-1">🛡️</div>
                        <div class="font-bold text-gray-700 peer-checked:text-red-600 text-sm">Admin</div>
                    </div>
                </label>

            </div>
            <x-input-error :messages="$errors->get('role')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-text-input id="name" class="block w-full px-4 py-3 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 shadow-sm" type="text" name="name" :value="old('name')" required autofocus placeholder="Họ và tên của bạn" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-text-input id="email" class="block w-full px-4 py-3 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 shadow-sm" type="email" name="email" :value="old('email')" required placeholder="Địa chỉ Email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-4">
            <x-text-input id="password" class="block w-full px-4 py-3 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 shadow-sm"
                            type="password"
                            name="password"
                            required autocomplete="new-password" placeholder="Mật khẩu" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-6">
            <x-text-input id="password_confirmation" class="block w-full px-4 py-3 rounded-lg border-gray-300 focus:border-pink-500 focus:ring-pink-500 shadow-sm"
                            type="password"
                            name="password_confirmation" required placeholder="Nhập lại mật khẩu" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex flex-col items-center gap-4">
            <x-primary-button class="w-full justify-center py-3 text-lg">
                {{ __('Đăng ký ngay') }}
            </x-primary-button>

            <a class="underline text-sm text-gray-600 hover:text-pink-600 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Đã có tài khoản? Đăng nhập') }}
            </a>
        </div>
    </form>
</x-guest-layout>
