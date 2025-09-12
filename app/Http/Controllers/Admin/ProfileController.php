<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AdminLoginRequest;
use App\Models\Profile;
use App\Services\ProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
  public function __construct(
    private ProfileService $profileService
  ) {}

  public function index()
  {
    $profiles = Profile::with('user')->paginate(20);
    return view('admin.profile.index', compact('profiles'));
  }

  public function create()
  {
    return view('admin.profile.create');
  }

  public function store(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:200',
      'title' => 'required|string|max:200',
      'top_message' => 'nullable|string|max:200',
      'bio' => 'nullable|string|max:1000',
      'location' => 'nullable|string|max:200',
      'email_public' => 'nullable|email|max:255',
      'phone' => 'nullable|string|max:50',
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
      'github_url' => 'nullable|url|max:500',
      'linkedin_url' => 'nullable|url|max:500',
      'twitter_url' => 'nullable|url|max:500',
      'instagram_url' => 'nullable|url|max:500',
    ]);

    try {
      $this->profileService->createProfile($request->all(), Auth::id());
      return redirect()->route('admin.profile.index')
        ->with('success', 'プロフィールが作成されました。');
    } catch (\InvalidArgumentException $e) {
      return redirect()->back()
        ->withErrors(['avatar' => $e->getMessage()])
        ->withInput();
    }
  }

  public function edit(Profile $profile)
  {
    return view('admin.profile.edit', compact('profile'));
  }

  public function update(Request $request, Profile $profile)
  {
    $request->validate([
      'name' => 'required|string|max:200',
      'title' => 'required|string|max:200',
      'top_message' => 'nullable|string|max:200',
      'bio' => 'nullable|string|max:1000',
      'location' => 'nullable|string|max:200',
      'email_public' => 'nullable|email|max:255',
      'phone' => 'nullable|string|max:50',
      'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
      'github_url' => 'nullable|url|max:500',
      'linkedin_url' => 'nullable|url|max:500',
      'twitter_url' => 'nullable|url|max:500',
      'instagram_url' => 'nullable|url|max:500',
      'current_password' => 'nullable|string',
      'password' => 'nullable|string|min:8|confirmed',
    ]);

    $data = $request->all();

    // パスワード変更の処理
    if ($request->filled('current_password') && $request->filled('password')) {
      if (!$this->profileService->updateUserPassword(
        Auth::user(),
        $request->current_password,
        $request->password
      )) {
        return redirect()->back()
          ->withErrors(['current_password' => '現在のパスワードが正しくありません。'])
          ->withInput();
      }
    }

    // パスワード関連のフィールドを除外
    unset($data['current_password'], $data['password'], $data['password_confirmation']);

    try {
      $this->profileService->updateProfile($profile, $data);
      return redirect()->route('admin.profile.index')
        ->with('success', 'プロフィールが更新されました。');
    } catch (\InvalidArgumentException $e) {
      return redirect()->back()
        ->withErrors(['avatar' => $e->getMessage()])
        ->withInput();
    }
  }
}
