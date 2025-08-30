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
        Schema::create('beers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // e.g. Lager, IPA, Stout
            $table->string('image')->nullable(); // store beer image path
            $table->integer('stock')->default(0); // number of bottles/cans available
            $table->decimal('price', 8, 2); // beer price
            $table->text('description')->nullable(); // optional description
            $table->decimal('alcohol_percentage', 4, 2)->nullable(); // ABV %
            $table->string('origin')->nullable(); // country or brewery name
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('beers');
    }
};
