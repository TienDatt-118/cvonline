<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JobApplication;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy danh sách việc làm đã nộp của ứng viên
        $appliedJobs = JobApplication::with('job.company')
                        ->where('user_id', Auth::id())
                        ->latest()
                        ->paginate(10);

        return view('candidate.dashboard', compact('appliedJobs'));
    }
}
