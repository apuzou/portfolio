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
            // hero_messageをtop_messageに変更
            $table->renameColumn('hero_message', 'top_message');
            // website_urlをinstagram_urlに変更
            $table->renameColumn('website_url', 'instagram_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            // 元に戻す
            $table->renameColumn('top_message', 'hero_message');
            $table->renameColumn('instagram_url', 'website_url');
        });
    }
};
