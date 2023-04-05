<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notify', function (Blueprint $table) {
            $table->id();
            $table->string('userComment', 255);
            $table->string('commentContent', 255);
            $table->string('dateComment', 255);
            $table->string('linkPost', 255);
            $table->timestamps();
            $table->string('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notify');
    }
};
