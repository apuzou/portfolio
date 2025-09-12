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
        Schema::table('profiles', function (Blueprint $table) {
            // first_nameとlast_nameを結合してnameカラムを作成
            $table->string('name', 200)->nullable()->after('user_id');
        });

        // 既存データを移行
        \DB::statement('UPDATE profiles SET name = CONCAT(first_name, " ", last_name)');

        Schema::table('profiles', function (Blueprint $table) {
            // nameカラムを必須に変更
            $table->string('name', 200)->nullable(false)->change();
            // first_nameとlast_nameカラムを削除
            $table->dropColumn(['first_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // first_nameとlast_nameカラムを復元
            $table->string('first_name', 100)->after('user_id');
            $table->string('last_name', 100)->after('first_name');
        });

        // nameカラムからfirst_nameとlast_nameを分離（簡単な実装）
        \DB::statement('UPDATE profiles SET first_name = SUBSTRING_INDEX(name, " ", 1), last_name = SUBSTRING_INDEX(name, " ", -1)');

        Schema::table('profiles', function (Blueprint $table) {
            // nameカラムを削除
            $table->dropColumn('name');
        });
    }
};
