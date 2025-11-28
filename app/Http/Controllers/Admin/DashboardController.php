<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Company;
use App\Models\Job;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Thống kê số liệu cho các thẻ Widget
        $totalCandidates = User::where('role', 'candidate')->count();
        $totalCompanies = Company::count();
        $totalJobs = Job::count();

        // Việc làm đang chờ duyệt
        $pendingJobs = Job::where('status', 'pending')->count();

        // Việc làm đang hoạt động
        $activeJobs = Job::where('status', 'active')->count();

        // 2. Lấy danh sách việc làm mới nhất để hiện bảng
        $recentJobs = Job::with('company')
                        ->orderBy('created_at', 'desc')
                        ->take(5)
                        ->get();

        // 3. Lấy danh sách công ty chờ xác minh
        $pendingCompanies = Company::where('is_verified', false)->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCandidates',
            'totalCompanies',
            'totalJobs',
            'pendingJobs',
            'activeJobs',
            'recentJobs',
            'pendingCompanies'
        ));
    }
}
