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
            $table->json('shoes')->nullable(); // Kolom JSON untuk menyimpan pasangan shoe_merch & shoe_color
            $table->enum('service', ['Cuci Biasa', 'Deep Clean', 'Unyellowing', 'Repaint', 'Repair', 'Fast Service (Express)']);
            $table->integer('price');
            $table->string('note')->nullable(); // note sebaiknya nullable
            $table->enum('payment_method', ['Cash', 'Bayar Akhir', 'Transfer', 'Qris']);
            $table->enum('payment_status', ['Belum Bayar', 'Sudah Bayar']);
            $table->enum('working_status', ['Belum', 'On Progress', 'Finish']);
            $table->date('order_start');
            $table->date('estimated');
            $table->date('order_finish')->nullable();
            $table->string('address');
            $table->string('picture')->nullable(); // untuk menyimpan gambar jika ada
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