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
        Schema::create('certifications', function (Blueprint $table) {
            $table->id();
            $table->string('consultant_id')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->string('standerd')->nullable();
            $table->string('certificate_template')->nullable();
            $table->string('certificate_status')->nullable();
            $table->string('business_name')->nullable();
            $table->string('scope_registration')->nullable();
            $table->string('registered_site')->nullable();
            $table->string('certificate_number')->nullable();
            $table->string('date_registration')->nullable();
            $table->string('first_surveillance_audit')->nullable();
            $table->string('second_surveillance_audit')->nullable();
            $table->string('certification_due_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('certifications');
    }
};