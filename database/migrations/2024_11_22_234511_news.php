<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void{
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->integer('age')->nullable();
            $table->string('attachment')->nullable();
            $table->timestamps();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
        });
    }

    public function down(): void{
        Schema::dropIfExists('news');
    }
};
