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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('اسم وصفي للأصل');
            $table->string('number')->unique()->comment('الرقم التسلسلي أو رقم الأصل الفريد');
            $table->string('manufacturer_serial')->nullable()->comment('الرقم التسلسلي للشركة المصنعة');
            $table->date('purchase_date')->nullable()->comment('تاريخ شراء الأصل');
            $table->enum('status', [
                'in_use',
                'in_storage',
                'maintenance',
                'damaged'
            ])->default('in_storage')->comment('حالة الأصل');
            $table->text('notes')->nullable()->comment('ملاحظات إضافية');

            // Foreign Keys
            $table->foreignId('type_id')
                ->nullable()
                ->constrained('types')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('نوع الأصل');

            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('employees')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('الموظف المستخدم للأصل حالياً');

            $table->foreignId('location_id')
                ->nullable()
                ->constrained('locations')
                ->onDelete('set null')
                ->onUpdate('cascade')
                ->comment('موقع تخزين الأصل');

            $table->timestamps();

            // Indexes for better performance
            $table->index('status');
            // $table->index(['type_id', 'status']);
            // $table->index(['location_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
