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
        // アイコンと色のフィールドは既に存在しないため、スキップ

        // 既存のスキルを削除
        DB::table('skills')->delete();

        // 既存のスキルカテゴリを削除
        DB::table('skill_categories')->delete();

        // 固定カテゴリを挿入
        DB::table('skill_categories')->insert([
            ['name' => 'フロントエンド', 'slug' => 'frontend', 'sort_order' => 1, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'バックエンド', 'slug' => 'backend', 'sort_order' => 2, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'インフラ', 'slug' => 'infrastructure', 'sort_order' => 3, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'ツール', 'slug' => 'tools', 'sort_order' => 4, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'その他', 'slug' => 'others', 'sort_order' => 5, 'is_active' => true, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // アイコンと色のフィールドを復元
        Schema::table('skills', function (Blueprint $table) {
            $table->string('icon', 100)->nullable();
            $table->string('color', 7)->nullable();
        });
    }
};
