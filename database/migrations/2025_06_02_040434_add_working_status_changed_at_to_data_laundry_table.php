<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('data_laundry', function (Blueprint $table) {
            $table->timestamp('working_status_changed_at')->nullable();
            $table->timestamp('finished_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('data_laundry', function (Blueprint $table) {
            $table->dropColumn('working_status_changed_at');
            $table->dropColumn('finished_at');
        });
    }

};