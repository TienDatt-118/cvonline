<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;

class CandidateController extends Controller
{
    /**
     * Hiển thị danh sách ứng viên đã nộp đơn
     */
    public function index()
    {
        // Lấy ID công ty của user đang đăng nhập
        $companyId = Auth::user()->company->id ?? 0;

        // Truy vấn: Tìm các đơn ứng tuyển (JobApplication)
        // Mà công việc (job) của đơn đó thuộc về công ty này
        $applications = JobApplication::query()
            ->whereHas('job', function($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->with(['job', 'user']) // Lấy kèm thông tin Job và User nộp đơn
            ->latest()
            ->paginate(10);

        return view('employer.candidates.index', compact('applications'));
    }
}
