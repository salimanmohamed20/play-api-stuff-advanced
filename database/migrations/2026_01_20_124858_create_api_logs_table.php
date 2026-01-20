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
        Schema::create('api_logs', function (Blueprint $table) {
            $table->id();
            $table->string("request_id")->unique();
            $table->string('uri');
            $table->string('method');
            $table->unsignedInteger('status_code');
            $table->unsignedBigInteger('duration')->default(0);
            $table->json('request');
            $table->json('response');
            $table->text('token')->nullable();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('api_logs');
    }
};
