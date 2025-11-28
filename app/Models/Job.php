<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    // Cho phép lưu mọi trường dữ liệu
    protected $guarded = [];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
