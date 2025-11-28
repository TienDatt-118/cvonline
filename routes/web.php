<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// ==========================================
// IMPORT CONTROLLERS (Khai báo để dùng bên dưới)
// ==========================================

// 1. Controller Chung
use App\Http\Controllers\HomeController;

// 2. Controller Nhà tuyển dụng (Employer)
use App\Http\Controllers\Employer\DashboardController as EmployerDashboard;
use App\Http\Controllers\Employer\JobController;
use App\Http\Controllers\Employer\CompanyController;
use App\Http\Controllers\Employer\CandidateController as EmployerCandidate;

// 3. Controller Ứng viên (Candidate)
use App\Http\Controllers\Candidate\DashboardController as CandidateDashboard;
use App\Http\Controllers\Candidate\ProfileController;
use App\Http\Controllers\Candidate\ApplicationController;

// 4. Controller Admin
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;

/*
|--------------------------------------------------------------------------
| Web Routes (Cấu hình toàn bộ đường dẫn)
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. KHU VỰC CÔNG KHAI (Ai cũng vào được)
// ==========================================

// Trang chủ
Route::get('/', [HomeController::class, 'index'])->name('home');

// Xem chi tiết việc làm
Route::get('/job/{id}', [HomeController::class, 'show'])->name('job.show');


// ==========================================
// 2. AUTHENTICATION (Login/Register/Logout)
// ==========================================
// Gọi file auth.php của Laravel Breeze
require __DIR__.'/auth.php';


// ==========================================
// 3. LOGIC ĐIỀU HƯỚNG DASHBOARD CHUNG
// ==========================================
// Route này xử lý khi user đăng nhập xong hoặc bấm vào nút Dashboard trên menu
Route::get('/dashboard', function () {
    $user = Auth::user();

    if ($user->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    if ($user->role === 'employer') {
        return redirect()->route('employer.dashboard');
    }
    if ($user->role === 'candidate') {
        return redirect()->route('candidate.dashboard');
    }

    return redirect()->route('home'); // Mặc định về trang chủ nếu không có role
})->middleware(['auth', 'verified'])->name('dashboard');


// ==========================================
// 4. KHU VỰC NHÀ TUYỂN DỤNG (EMPLOYER)
// ==========================================
Route::middleware(['auth'])->prefix('employer')->name('employer.')->group(function () {

    // Dashboard Thống kê
    Route::get('/dashboard', [EmployerDashboard::class, 'index'])->name('dashboard');

    // Quản lý Tin tuyển dụng (CRUD)
    Route::resource('jobs', JobController::class);

    // Quản lý Hồ sơ Công ty (Logo, Địa chỉ...)
    Route::get('/company', [CompanyController::class, 'edit'])->name('company.edit');
    Route::put('/company', [CompanyController::class, 'update'])->name('company.update');

    // Xem danh sách Ứng viên đã nộp đơn
    Route::get('/candidates', [EmployerCandidate::class, 'index'])->name('candidates.index');
});


// ==========================================
// 5. KHU VỰC ỨNG VIÊN (CANDIDATE)
// ==========================================
// (Phần này bạn đang thiếu trong đoạn code gửi cho tôi)
Route::middleware(['auth'])->group(function () {

    // Hành động Nộp đơn (Apply)
    Route::post('/job/{id}/apply', [ApplicationController::class, 'store'])->name('job.apply');

    // Các trang quản lý riêng của ứng viên
    Route::prefix('candidate')->name('candidate.')->group(function () {

        // Dashboard (Xem lịch sử nộp đơn)
        Route::get('/dashboard', [CandidateDashboard::class, 'index'])->name('dashboard');

        // Hồ sơ cá nhân (Cập nhật thông tin & Upload CV)
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    });
});


// ==========================================
// 6. KHU VỰC QUẢN TRỊ VIÊN (ADMIN)
// ==========================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {

    // Admin Dashboard
    Route::get('/dashboard', [AdminDashboard::class, 'index'])->name('dashboard');

    // Sau này có thể thêm: Quản lý Users, Quản lý Danh mục...
});
