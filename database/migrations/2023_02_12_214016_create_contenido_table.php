<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // 
    public function up()
    {
        Schema::create('contenido', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('categoria_id')->nullable();
            $table->bigInteger('idioma_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->longText('body')->nullable();
            $table->timestamps();
        });
    }

    // 
    public function down()
    {
        Schema::dropIfExists('contenido');
    }
};
