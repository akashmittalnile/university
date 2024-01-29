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
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable();
            $table->text("audio_file")->nullable();
            $table->text("audio_file_size")->nullable();
            $table->text("thumbnail")->nullable();
            $table->boolean("free")->default(false);
            $table->string("price")->nullable();
            $table->text("plans")->nullable();
            $table->string("trial_mins")->nullable();
            $table->text("description")->nullable();
            $table->text("cancellation_policy")->nullable();
            $table->string("status")->nullable();
            $table->bigInteger("views")->nullable();
            $table->bigInteger("listens")->nullable();
            $table->bigInteger("likes")->nullable();
            $table->longText("comments")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('podcasts');
    }
};
