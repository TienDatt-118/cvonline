<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Các trường được phép lưu vào database (Mass Assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // <--- QUAN TRỌNG: Phải có dòng này mới lưu được vai trò
        'avatar',
    ];

    /**
     * Các trường cần ẩn đi khi trả về JSON
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Định dạng dữ liệu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * Quan hệ: 1 User (Employer) có 1 Công ty
     */
    public function company()
    {
        return $this->hasOne(Company::class);
    }

    /**
     * Quan hệ: 1 User (Candidate) có 1 Hồ sơ ứng viên
     */
    public function candidate()
    {
        return $this->hasOne(Candidate::class);
    }
}
