<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job; // <--- QUAN TRỌNG: Phải có dòng này mới gọi được Job::
use App\Models\JobCategory;

class HomeController extends Controller
{
    /**
     * Hiển thị Trang chủ
     */
    public function index()
    {
        // Lấy dữ liệu từ Database
        // Thêm kiểm tra ->exists() để tránh lỗi nếu bảng trống
        $jobs = Job::with('company')
                    ->where('status', 'active')
                    ->latest()
                    ->take(9)
                    ->get();

        // Trả về View (Dùng mảng [] để truyền biến an toàn nhất)
        return view('home', [
            'jobs' => $jobs
        ]);
    }

    /**
     * Hiển thị Chi tiết việc làm
     */
    public function show($id)
    {
        // Tìm việc làm theo ID
        // Sử dụng findOrFail: Nếu không thấy ID này trong DB -> Tự động báo lỗi 404
        $job = Job::with('company')->findOrFail($id);

        return view('jobs.show', [
            'job' => $job
        ]);
    }
}
