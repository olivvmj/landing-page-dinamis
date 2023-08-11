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
        Schema::create('solusi_parkirkan', function (Blueprint $table) {
            $table->id();
            $table->string('judul')->nullable();
            $table->string('subjudul')->nullable();
            $table->string('image')->nullable();
            $table->string('solusi');
            $table->string('desk_solusi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solusi_parkirkan');
    }
};
