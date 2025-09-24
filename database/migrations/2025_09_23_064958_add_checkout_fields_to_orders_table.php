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
        Schema::table('orders', function (Blueprint $table) {
            $table->text('delivery_note')->nullable()->after('status');
            $table->string('delivery_slot')->nullable()->after('delivery_note');
            $table->boolean('is_recurring')->default(false)->after('delivery_slot');
            $table->string('recurring_interval')->nullable()->after('is_recurring');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['delivery_note', 'delivery_slot', 'is_recurring', 'recurring_interval']);
        });
    }
};
