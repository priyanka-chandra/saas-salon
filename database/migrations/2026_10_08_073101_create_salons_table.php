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
        Schema::create('salons', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('tagline')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('currency', 10)->default('$');
            $table->decimal('tax_percentage', 5, 2)->default(8.50);
            $table->string('logo_url')->nullable();
            $table->string('subscription_plan')->default('growth'); // starter, growth, enterprise
            $table->string('subscription_status')->default('active'); // active, trial, past_due, cancelled
            $table->timestamp('trial_ends_at')->nullable();
            $table->string('primary_color', 20)->default('#D48166');
            $table->string('accent_color', 20)->default('#1E293B');
            $table->string('opening_time', 10)->default('09:00');
            $table->string('closing_time', 10)->default('20:00');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salons');
    }
};
