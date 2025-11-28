<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Hiển thị form đăng ký
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Xử lý lưu user mới và chuyển hướng
     */
    public function store(Request $request): RedirectResponse
    {
        // 1. Validate dữ liệu đầu vào
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:candidate,employer,admin'], // Chấp nhận cả 3 vai trò
        ]);

        // 2. Tạo User mới vào Database
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        event(new Registered($user));

        // 3. Tự động đăng nhập
        Auth::login($user);

        // 4. CHUYỂN HƯỚNG THÔNG MINH (Router Logic)

        // Nếu là Admin -> Vào trang quản trị
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        // Nếu là Nhà tuyển dụng -> Vào trang quản lý tin
        if ($user->role === 'employer') {
            return redirect()->route('employer.dashboard');
        }

        // Nếu là Ứng viên (Candidate) -> Về trang chủ
        return redirect()->route('home');
    }
}
