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
            $table->boolean('status_reservasi')->default(false);
        });
    }
    
    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn('status_reservasi');
        });
    }
    
    
    
    
    
};
