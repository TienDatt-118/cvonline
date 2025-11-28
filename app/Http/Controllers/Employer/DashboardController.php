<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\JobApplication;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. TỰ ĐỘNG KHẮC PHỤC LỖI "NO COMPANY"
        // Nếu user này chưa có hồ sơ công ty -> Tự tạo một cái mặc định
        if (!$user->company) {
            $user->company()->create([
                'name' => 'Công ty của ' . $user->name,
                'user_id' => $user->id
            ]);
            $user->refresh(); // Làm mới dữ liệu để lấy ID công ty vừa tạo
        }

        $companyId = $user->company->id;

        // 2. LẤY SỐ LIỆU THỐNG KÊ
        // Đếm số tin đang hiển thị (Active)
        $activeJobs = Job::where('company_id', $companyId)
                        ->where('status', 'active')
                        ->count();

        // Đếm tổng số hồ sơ ứng tuyển vào các job của công ty này
        $totalApplications = JobApplication::whereHas('job', function($query) use ($companyId) {
            $query->where('company_id', $companyId);
        })->count();

        // Đếm tổng lượt xem (Giả sử bạn có cột views, nếu chưa có thì mặc định 0)
        $totalViews = Job::where('company_id', $companyId)->sum('views') ?? 0;

        // 3. TRẢ VỀ GIAO DIỆN
        return view('employer.dashboard', compact('activeJobs', 'totalApplications', 'totalViews'));
    }
}
