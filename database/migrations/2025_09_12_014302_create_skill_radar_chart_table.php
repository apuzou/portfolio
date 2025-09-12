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
        Schema::create('skill_radar_chart', function (Blueprint $table) {
            $table->id();
            $table->integer('frontend_level')->default(0)->comment('フロントエンド 1-5段階評価');
            $table->integer('backend_level')->default(0)->comment('バックエンド 1-5段階評価');
            $table->integer('infrastructure_level')->default(0)->comment('インフラ 1-5段階評価');
            $table->integer('ai_level')->default(0)->comment('AI 1-5段階評価');
            $table->integer('tools_level')->default(0)->comment('その他ツール 1-5段階評価');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('skill_radar_chart');
    }
};
