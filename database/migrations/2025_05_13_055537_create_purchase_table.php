<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('purchase', function (Blueprint $table) {
            $table->id();
            $table->string('object_name');
            $table->string('quantity');
            $table->enum('unit', ['Ml', 'Paket', 'Pcs', 'Gram']);
            $table->string('price');
            $table->string('total_price');
            $table->date('purchase_date');
            $table->string('pict_nota')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchase');
    }
};