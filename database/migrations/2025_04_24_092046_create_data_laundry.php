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
        Schema::create('data_laundry', function (Blueprint $table) {
            $table->id();
            $table->string('order_id')->unique();
            $table->string('customer_name');
            $table->string('phone_number');
            $table->string('shoe_merch');
            $table->string('shoe_color');
            $table->enum('service', ['Cuci Biasa', 'Deep Clean', 'Unyellowing', 'Repaint', 'Repair', 'Fast Service (Express)']);
            $table->integer('price');
            $table->string('note');
            $table->enum('payment_method', ['Cash', 'Transfer', 'Qris']);
            $table->enum('payment_status', ['Belum Bayar', 'Sudah Bayar']);
            $table->enum('working_status', ['On Progress', 'Finish']);
            $table->date('order_start');
            $table->date('estimated');
            $table->date('order_finish')->nullable();
            $table->string('address');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_laundry');
    }
};
