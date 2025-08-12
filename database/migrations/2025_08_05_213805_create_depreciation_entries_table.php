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
        Schema::create('depreciation_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->nullable()->constrained()->cascadeOnDelete();

            $table->string('entry_number')->nullable();
            $table->date('date')->nullable();
            $table->text('description')->nullable();
            $table->decimal('depreciation_rate', 5, 2)->nullable();
            $table->date('depreciation_start_date')->nullable();
            $table->date('depreciation_year')->nullable();
            // $table->date('depreciation_start_date')->nullable();
            $table->integer('days_count')->nullable();

            $table->decimal('purchase_cost', 15, 2)->default(0);
            $table->decimal('additions', 15, 2)->default(0);
            $table->decimal('exclusions', 15, 2)->default(0);
            $table->decimal('asset_cost_at_end', 15, 2)->default(0);

            $table->decimal('accumulated_depreciation_at_start', 15, 2)->default(0);
            $table->decimal('current_year_depreciation', 15, 2)->default(0);
            $table->decimal('excluded_depreciation', 15, 2)->default(0);
            $table->decimal('accumulated_depreciation_at_end', 15, 2)->default(0);

            $table->decimal('net_book_value', 15, 2)->default(0);

            $table->string('classification')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('depreciation_entries');
    }
};
