<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    
    public function up() {
        Schema::create('image', function (Blueprint $table) {
            $table->id();
            //$table->foreignId('idreview');
            $table->string('name', 30);
            
            $table->timestamps();
            
            //$table->foreign('idreview')->references('id')->on('review')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('image');
    }
};
