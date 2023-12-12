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
        Schema::create('package_user', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('package_id');
            $table->date('register_day')->nullable();
            $table->date('activity_day')->nullable();
            $table->date('expiration_date')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->bigInteger('rank_id')->nullable();
            $table->bigInteger('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('package_user');
    }
};