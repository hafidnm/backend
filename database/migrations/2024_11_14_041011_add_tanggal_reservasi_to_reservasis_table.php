<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->date('tanggal_reservasi')->nullable(); // Add the column for the reservation date
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn('tanggal_reservasi');
        });
    }

};
