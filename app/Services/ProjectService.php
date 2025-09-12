<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Project;
use App\Models\ProjectCategory;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectService
{
  public function getFeaturedProjects(int $limit = 6)
  {
    return Project::published()
      ->featured()
      ->orderBy('sort_order')
      ->take($limit)
      ->get();
  }

  public function createProject(array $data): Project
  {
    if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
      $data['image'] = $this->handleImageUpload($data['image']);
    }

    return Project::create($data);
  }

  public function updateProject(Project $project, array $data): Project
  {
    if (isset($data['image']) && $data['image'] instanceof UploadedFile) {
      $this->deleteOldImage($project);
      $data['image'] = $this->handleImageUpload($data['image']);
    }

    $project->update($data);
    return $project;
  }

  public function deleteProject(Project $project): bool
  {
    $this->deleteOldImage($project);
    return $project->delete();
  }

  public function getProjectCategories()
  {
    return ProjectCategory::where('is_active', true)
      ->orderBy('sort_order')
      ->get();
  }

  private function handleImageUpload(UploadedFile $file): string
  {
    if (!$this->isValidImageFile($file)) {
      throw new \InvalidArgumentException('無効なファイル形式です。');
    }

    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
    return $file->storeAs('projects', $filename, 'public');
  }

  private function deleteOldImage(Project $project): void
  {
    if ($project->image) {
      Storage::disk('public')->delete($project->image);
    }
  }

  private function isValidImageFile(UploadedFile $file): bool
  {
    // ファイルサイズチェック（5MB以下）
    if ($file->getSize() > 5 * 1024 * 1024) {
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

    return true;
  }
}
