<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\Job;
use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class JobController extends Controller
{
    // 1. Hiển thị Form Đăng tin
    public function create()
    {
        $categories = JobCategory::all();
        // Dữ liệu mẫu nếu chưa có danh mục
        if($categories->isEmpty()) {
            $categories = [
                (object)['id' => 1, 'name' => 'IT Phần mềm'],
                (object)['id' => 2, 'name' => 'Marketing / Truyền thông'],
                (object)['id' => 3, 'name' => 'Kế toán / Kiểm toán'],
                (object)['id' => 4, 'name' => 'Hành chính / Nhân sự'],
            ];
        }
        return view('employer.jobs.create', compact('categories'));
    }

    // 2. Xử lý Lưu tin (STORE)
    public function store(Request $request)
    {
        // Validate dữ liệu đầu vào
        $request->validate([
            'title' => 'required|min:5|max:255',
            'job_category_id' => 'required',
            'job_type' => 'required', // Bắt buộc chọn Full-time/Part-time
            'deadline' => 'required|date|after:today', // Hạn nộp phải là tương lai
            'location' => 'required',
            'description' => 'required|min:20',
        ], [
            'title.required' => 'Tiêu đề không được để trống',
            'deadline.after' => 'Hạn nộp hồ sơ phải là ngày trong tương lai',
            'location.required' => 'Vui lòng nhập địa chỉ hoặc ghim trên bản đồ',
        ]);

        $user = Auth::user();

        // Tự động tạo công ty nếu chưa có (Tránh lỗi)
        if (!$user->company) {
            $user->company()->create(['name' => 'Công ty của ' . $user->name, 'user_id' => $user->id]);
            $user->refresh();
        }

        // Lưu vào Database
        Job::create([
            'company_id'      => $user->company->id,
            'job_category_id' => $request->job_category_id,
            'title'           => $request->title,
            'slug'            => Str::slug($request->title) . '-' . uniqid(),

            // Các trường quan trọng
            'job_type'        => $request->job_type, // Full-time / Part-time
            'min_salary'      => $request->min_salary,
            'max_salary'      => $request->max_salary,
            'deadline'        => $request->deadline,
            'description'     => $request->description,

            // Thông tin bản đồ
            'location'        => $request->location,
            'latitude'        => $request->latitude,
            'longitude'       => $request->longitude,

            'status'          => 'active'
        ]);

        return redirect()->route('employer.jobs.index')->with('success', 'Đăng tin tuyển dụng thành công!');
    }

    // ... (Giữ nguyên các hàm index, edit, update, destroy cũ) ...
    public function index() { /* Code cũ */ return view('employer.jobs.index', ['jobs' => Job::where('company_id', Auth::user()->company->id ?? 0)->latest()->paginate(10)]); }
}
