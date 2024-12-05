<?php

use App\Enums\AppointmentStatus;
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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tenant_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('service_id')->constrained('offered_services')->onDelete('cascade');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->string('status')->default(AppointmentStatus::PENDING);
            $table->decimal('total_price', 10, 2)->nullable();
            $table->integer('duration_minutes')->nullable();
            $table->text('notes')->nullable();
            $table->integer('rating')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
