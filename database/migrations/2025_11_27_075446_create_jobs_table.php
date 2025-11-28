<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Xóa bảng cũ nếu tồn tại để tạo lại cho sạch
        Schema::dropIfExists('jobs');

        Schema::create('jobs', function (Blueprint $table) {
            $table->id();

            // 1. Liên kết với Công ty
            $table->foreignId('company_id')->constrained('companies')->onDelete('cascade');

            // 2. Thông tin cơ bản
            $table->string('title'); // Tiêu đề
            $table->string('slug')->nullable();
            $table->text('description'); // Mô tả

            // 3. Phân loại & Hạn nộp
            $table->unsignedBigInteger('job_category_id')->default(1);
            $table->string('job_type')->default('Full-time'); // Full-time / Part-time
            $table->date('deadline');

            // 4. Lương & Địa điểm (QUAN TRỌNG: ĐÃ THÊM CỘT TỌA ĐỘ)
            $table->decimal('min_salary', 15, 0)->nullable();
            $table->decimal('max_salary', 15, 0)->nullable();
            $table->string('location')->nullable(); // Tên địa chỉ
            $table->string('latitude')->nullable(); // Vĩ độ (Map) -> CỘT BẠN ĐANG THIẾU
            $table->string('longitude')->nullable(); // Kinh độ (Map) -> CỘT BẠN ĐANG THIẾU

            // 5. Trạng thái & Thống kê
            $table->string('status')->default('active'); // active, expired
            $table->integer('views')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
