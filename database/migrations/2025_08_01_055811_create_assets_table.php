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
            $table->string('asset_name')->comment('اسم وصفي للأصل');
            $table->string('asset_number')->unique()->comment('الرقم التسلسلي أو رقم الأصل الفريد');
            $table->date('purchase_date')->nullable()->comment('تاريخ شراء الأصل');
            $table->enum('status', [
                'in_use',
                'in_storage',
                'maintenance',
                'damaged'
            ])->default('in_storage')->comment('حالة الأصل');
            $table->text('notes')->nullable()->comment('ملاحظات إضافية');

            // Foreign Keys
            // $table->foreignId('asset_type_id')
            //     ->constrained('asset_types')
            //     ->onDelete('restrict')
            //     ->onUpdate('cascade');

            // $table->foreignId('current_user_id')
            //     ->nullable()
            //     ->constrained('users')
            //     ->onDelete('set null')
            //     ->onUpdate('cascade')
            //     ->comment('الموظف المستخدم للأصل حالياً');

            // $table->foreignId('location_id')
            //     ->nullable()
            //     ->constrained('locations')
            //     ->onDelete('set null')
            //     ->onUpdate('cascade');

            $table->timestamps();

            // Indexes for better performance
            $table->index('status');
            // $table->index(['asset_type_id', 'status']);
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
