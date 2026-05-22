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
        Schema::create('padron', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->string('delegacion');
            $table->string('nivel');
            $table->string('sede');
            $table->boolean('padron')->default(false);            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('padron');
    }
};
