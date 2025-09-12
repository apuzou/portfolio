<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileService
{
  public function createProfile(array $data, int $userId): Profile
  {
    $data['user_id'] = $userId;

    if (isset($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
      $data['avatar'] = $this->handleAvatarUpload($data['avatar']);
    }

    return Profile::create($data);
  }

  public function updateProfile(Profile $profile, array $data): Profile
  {
    if (isset($data['avatar']) && $data['avatar'] instanceof UploadedFile) {
      $this->deleteOldAvatar($profile);
      $data['avatar'] = $this->handleAvatarUpload($data['avatar']);
    }

    $profile->update($data);
    return $profile;
  }

  public function updateUserPassword(User $user, string $currentPassword, string $newPassword): bool
  {
    if (!password_verify($currentPassword, $user->password)) {
      return false;
    }

    $user->update(['password' => bcrypt($newPassword)]);
    return true;
  }

  private function handleAvatarUpload(UploadedFile $file): string
  {
    if (!$this->isValidImageFile($file)) {
      throw new \InvalidArgumentException('無効なファイル形式です。');
    }

    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
    return $file->storeAs('avatars', $filename, 'public');
  }

  private function deleteOldAvatar(Profile $profile): void
  {
    if ($profile->avatar) {
      Storage::disk('public')->delete($profile->avatar);
    }
  }

  private function isValidImageFile(UploadedFile $file): bool
  {
    // ファイルサイズチェック（2MB以下）
    if ($file->getSize() > 2 * 1024 * 1024) {
      return false;
    }

    // MIMEタイプチェック
    $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    if (!in_array($file->getMimeType(), $allowedMimes)) {
      return false;
    }

    // ファイル拡張子チェック
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
    $extension = strtolower($file->getClientOriginalExtension());
    if (!in_array($extension, $allowedExtensions)) {
      return false;
    }

    // 実際のファイル内容をチェック
    $imageInfo = getimagesize($file->getPathname());
    if ($imageInfo === false) {
      return false;
    }

    // 画像の幅と高さをチェック（最大4000px）
    if ($imageInfo[0] > 4000 || $imageInfo[1] > 4000) {
      return false;
    }

    return true;
  }
}
