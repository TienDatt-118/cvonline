<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;

class CandidateController extends Controller
{
    public function index()
    {
        // Logic: Lấy các đơn ứng tuyển (JobApplication) thuộc về các Job của Công ty này
        // Lưu ý: Cần đảm bảo model JobApplication và quan hệ đã được khai báo

        $companyId = Auth::user()->company->id ?? 0;

        $applications = JobApplication::query()
            ->whereHas('job', function($query) use ($companyId) {
                $query->where('company_id', $companyId);
            })
            ->with(['job', 'user']) // Eager load để lấy thông tin job và user nộp đơn
            ->latest()
            ->paginate(10);

        return view('employer.candidates.index', compact('applications'));
    }
}
