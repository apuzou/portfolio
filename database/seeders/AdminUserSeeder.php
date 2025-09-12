<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => '管理者',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => '山田太郎',
                'title' => 'フルスタック開発者',
                'top_message' => '美しく機能的なウェブアプリケーションを創造する',
                'bio' => '美しく機能的なウェブアプリケーションを作成することに情熱を注ぐ開発者です。モダンなテクノロジーを使って、ユーザー体験を向上させるソリューションを提供します。',
                'location' => '東京都',
                'email_public' => 'contact@example.com',
                'instagram_url' => 'https://www.instagram.com/example',
                'is_active' => true,
            ]
        );
    }
}
