<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    // Cho phép lưu tất cả các cột
    protected $guarded = [];

    /**
     * Quan hệ: Một Đơn ứng tuyển thuộc về một Công việc (Job)
     * Đây là hàm bạn đang thiếu gây ra lỗi
     */
    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    /**
     * Quan hệ: Một Đơn ứng tuyển thuộc về một Ứng viên (User)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
