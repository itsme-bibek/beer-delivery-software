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
        Schema::create('llbo_verifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('license_number')->unique();
            $table->string('license_type')->default('LLBO'); // LLBO, Retail, etc.
            $table->date('issue_date');
            $table->date('expiry_date');
            $table->string('status')->default('pending'); // pending, verified, expired, rejected
            $table->text('verification_notes')->nullable();
            $table->string('document_path')->nullable(); // Path to uploaded license document
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->timestamp('reminder_sent_at')->nullable();
            $table->timestamps();
            
            $table->index(['expiry_date', 'status']);
            $table->index(['user_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('llbo_verifications');
    }
};