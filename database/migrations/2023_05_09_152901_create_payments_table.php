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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('consultant_id')->nullable();
            $table->integer('certificate_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_balance')->nullable();
            $table->enum('status', ["A", "R"])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
