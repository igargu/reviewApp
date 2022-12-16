<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
   
    public function up() {
        Schema::create('review', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['book', 'disc', 'movie'])->default('book');
            $table->string('title', 50);
            $table->string('review', 200);
            $table->foreignId('iduser');
            $table->foreignId('idimage');
            $table->foreignId('idcategory');
            $table->enum('rate', [0, 1, 2, 3, 4, 5])->default(0);
            
            $table->timestamps();
            
            $table->foreign('iduser')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('idimage')->references('id')->on('image')->onDelete('cascade');
            $table->foreign('idcategory')->references('id')->on('category')->onDelete('cascade');
        });
    }

    public function down() {
        Schema::dropIfExists('review');
    }
};
