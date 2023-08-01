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
        Schema::create('manfaat_parkirkan', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('subjudul');
            $table->string('image');
            $table->string('manfaat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manfaat_parkirkan');
    }
};
