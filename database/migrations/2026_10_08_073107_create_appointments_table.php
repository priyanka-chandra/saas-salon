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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('salon_id')->constrained('salons')->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('staff_member_id')->constrained('staff_members')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->cascadeOnDelete();
            $table->date('appointment_date');
            $table->string('start_time', 10);
            $table->string('end_time', 10);
            $table->string('status', 30)->default('confirmed'); // pending, confirmed, in_progress, completed, cancelled, no_show
            $table->decimal('price', 10, 2);
            $table->decimal('discount', 10, 2)->default(0.00);
            $table->decimal('final_price', 10, 2);
            $table->string('payment_status', 30)->default('unpaid'); // unpaid, paid, partially_paid
            $table->text('notes')->nullable();
            $table->string('booking_source', 30)->default('internal'); // portal, internal, walk_in, phone
            $table->timestamps();

            $table->index(['salon_id', 'appointment_date']);
            $table->index(['salon_id', 'status']);
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
