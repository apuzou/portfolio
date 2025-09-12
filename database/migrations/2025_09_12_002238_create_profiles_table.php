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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name', 100);
            $table->string('last_name', 100);
            $table->string('title', 200);
            $table->text('bio')->nullable();
            $table->string('location', 200)->nullable();
            $table->string('email_public', 255)->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('avatar', 500)->nullable();
            $table->string('github_url', 500)->nullable();
            $table->string('linkedin_url', 500)->nullable();
            $table->string('twitter_url', 500)->nullable();
            $table->string('website_url', 500)->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
