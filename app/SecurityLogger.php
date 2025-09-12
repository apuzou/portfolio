<?php

declare(strict_types=1);

namespace App;

use Illuminate\Support\Facades\Log;

class SecurityLogger
{
    /**
     * ログイン成功をログに記録
     */
    public static function logLoginSuccess(string $email, string $ip, string $userAgent): void
    {
        Log::channel('security')->info('Login successful', [
            'event' => 'login_success',
            'email' => $email,
            'ip' => $ip,
            'user_agent' => $userAgent,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * ログイン失敗をログに記録
     */
    public static function logLoginFailure(string $email, string $ip, string $userAgent): void
    {
        Log::channel('security')->warning('Login failed', [
            'event' => 'login_failure',
            'email' => $email,
            'ip' => $ip,
            'user_agent' => $userAgent,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * ログアウトをログに記録
     */
    public static function logLogout(string $email, string $ip): void
    {
        Log::channel('security')->info('Logout', [
            'event' => 'logout',
            'email' => $email,
            'ip' => $ip,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * お問い合わせ送信をログに記録
     */
    public static function logContactSubmission(string $email, string $ip, string $userAgent): void
    {
        Log::channel('security')->info('Contact form submission', [
            'event' => 'contact_submission',
            'email' => $email,
            'ip' => $ip,
            'user_agent' => $userAgent,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * ファイルアップロード失敗をログに記録
     */
    public static function logFileUploadFailure(string $filename, string $reason, string $ip): void
    {
        Log::channel('security')->warning('File upload failed', [
            'event' => 'file_upload_failure',
            'filename' => $filename,
            'reason' => $reason,
            'ip' => $ip,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * レート制限超過をログに記録
     */
    public static function logRateLimitExceeded(string $route, string $ip): void
    {
        Log::channel('security')->warning('Rate limit exceeded', [
            'event' => 'rate_limit_exceeded',
            'route' => $route,
            'ip' => $ip,
            'timestamp' => now()->toISOString(),
        ]);
    }

    /**
     * 不正なリクエストをログに記録
     */
    public static function logSuspiciousActivity(string $description, array $data = []): void
    {
        Log::channel('security')->warning('Suspicious activity detected', [
            'event' => 'suspicious_activity',
            'description' => $description,
            'data' => $data,
            'timestamp' => now()->toISOString(),
        ]);
    }
}
