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
            $table->foreignId('customer_id')->constrained('users');
            $table->foreignId('staff_id')->nullable()->constrained('users');
            $table->foreignId('offered_service_id')->constrained('offered_services');
            $table->date('appointment_date');
            $table->time('appointment_time');
            $table->enum('status', array_column(AppointmentStatus::cases(), 'value'))->default(AppointmentStatus::SCHEDULED->value);
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
