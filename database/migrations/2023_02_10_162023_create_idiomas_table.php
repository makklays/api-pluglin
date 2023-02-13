<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 
    public function up()
    {
        Schema::create('idiomas', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->timestamps();
        });
    }

    // 
    public function down()
    {
        Schema::dropIfExists('idiomas');
    }
};
