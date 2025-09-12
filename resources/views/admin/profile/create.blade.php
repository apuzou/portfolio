@extends('admin.layouts.app')

@section('title', 'プロフィール作成')
@section('page-title', 'プロフィール作成')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">プロフィール作成</h3>
            </div>
            <form method="POST" action="{{ route('admin.profile.store') }}" enctype="multipart/form-data" class="p-6">
                @csrf
                <div class="space-y-6">
                    <!-- 基本情報 -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                            名前 <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">
                            職業・肩書き <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">
                            自己紹介
                        </label>
                        <textarea id="bio" name="bio" rows="4"
                            placeholder="自己紹介を入力してください。&#10;改行も可能です。&#10;例：&#10;美しく機能的なウェブアプリケーションを作成することに情熱を注ぐ開発者です。&#10;モダンなテクノロジーを使って、ユーザー体験を向上させるソリューションを提供します。"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('bio') border-red-500 @enderror">{{ old('bio') }}</textarea>
                        <p class="text-gray-500 text-sm mt-1">改行はそのまま表示されます。Enterキーで改行できます。</p>
                        @error('bio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- 連絡先情報 -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="location" class="block text-sm font-medium text-gray-700 mb-2">
                                所在地
                            </label>
                            <input type="text" id="location" name="location" value="{{ old('location') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('location') border-red-500 @enderror">
                            @error('location')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                電話番号
                            </label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                            @error('phone')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="email_public" class="block text-sm font-medium text-gray-700 mb-2">
                            公開メールアドレス
                        </label>
                        <input type="email" id="email_public" name="email_public" value="{{ old('email_public') }}"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email_public') border-red-500 @enderror">
                        @error('email_public')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- アバター -->
                    <div>
                        <label for="avatar" class="block text-sm font-medium text-gray-700 mb-2">
                            アバター画像
                        </label>
                        <input type="file" id="avatar" name="avatar" accept="image/*"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('avatar') border-red-500 @enderror">
                        @error('avatar')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-sm text-gray-500 mt-1">JPEG, PNG, JPG, GIF, WebP形式、最大2MB</p>
                    </div>

                    <!-- SNSリンク -->
                    <div class="space-y-4">
                        <h4 class="text-lg font-medium text-gray-900">SNS・リンク</h4>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="github_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    GitHub URL
                                </label>
                                <input type="url" id="github_url" name="github_url" value="{{ old('github_url') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('github_url') border-red-500 @enderror">
                                @error('github_url')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="linkedin_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    LinkedIn URL
                                </label>
                                <input type="url" id="linkedin_url" name="linkedin_url"
                                    value="{{ old('linkedin_url') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('linkedin_url') border-red-500 @enderror">
                                @error('linkedin_url')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="twitter_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    Twitter URL
                                </label>
                                <input type="url" id="twitter_url" name="twitter_url" value="{{ old('twitter_url') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('twitter_url') border-red-500 @enderror">
                                @error('twitter_url')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="website_url" class="block text-sm font-medium text-gray-700 mb-2">
                                    ウェブサイト URL
                                </label>
                                <input type="url" id="website_url" name="website_url"
                                    value="{{ old('website_url') }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('website_url') border-red-500 @enderror">
                                @error('website_url')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- ボタン -->
                    <div class="flex justify-end space-x-4">
                        <a href="{{ route('admin.dashboard') }}"
                            class="px-4 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 transition duration-200">
                            キャンセル
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            作成
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
