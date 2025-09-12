@extends('admin.layouts.app')

@section('title', 'プロジェクト作成')
@section('page-title', 'プロジェクト作成')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-lg font-medium text-gray-900">プロジェクトを追加</h1>
            </div>

            <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf

                <!-- プロジェクト名 -->
                <div>
                    <label for="title" class="block text-sm font-medium text-gray-700">プロジェクト名 <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-300 @enderror">
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 説明 -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">説明 <span
                            class="text-red-500">*</span></label>
                    <textarea id="description" name="description" rows="3" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 詳細内容 -->
                <div>
                    <label for="content" class="block text-sm font-medium text-gray-700">詳細内容</label>
                    <textarea id="content" name="content" rows="6"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-300 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 画像 -->
                <div>
                    <label for="featured_image" class="block text-sm font-medium text-gray-700">メイン画像</label>
                    <input type="file" id="featured_image" name="featured_image" accept="image/*"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('featured_image') border-red-300 @enderror">
                    @error('featured_image')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- URL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="demo_url" class="block text-sm font-medium text-gray-700">デモURL</label>
                        <input type="url" id="demo_url" name="demo_url" value="{{ old('demo_url') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('demo_url') border-red-300 @enderror">
                        @error('demo_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="github_url" class="block text-sm font-medium text-gray-700">GitHub URL</label>
                        <input type="url" id="github_url" name="github_url" value="{{ old('github_url') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('github_url') border-red-300 @enderror">
                        @error('github_url')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- 期間 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="start_date" class="block text-sm font-medium text-gray-700">開始日</label>
                        <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('start_date') border-red-300 @enderror">
                        @error('start_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="end_date" class="block text-sm font-medium text-gray-700">終了日</label>
                        <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('end_date') border-red-300 @enderror">
                        @error('end_date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ステータス -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">ステータス <span
                            class="text-red-500">*</span></label>
                    <select id="status" name="status" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-300 @enderror">
                        <option value="">ステータスを選択してください</option>
                        <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>下書き</option>
                        <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>公開</option>
                        <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>アーカイブ</option>
                    </select>
                    @error('status')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- カテゴリ -->
                <div>
                    <label class="block text-sm font-medium text-gray-700">カテゴリ</label>
                    <div class="mt-2 space-y-2">
                        @foreach ($categories as $category)
                            <label class="flex items-center">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', [])) ? 'checked' : '' }}
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <span class="ml-2 text-sm text-gray-700">{{ $category->name }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <!-- 技術スタック -->
                <div>
                    <label for="technologies" class="block text-sm font-medium text-gray-700">技術スタック（カンマ区切り）</label>
                    <input type="text" id="technologies" name="technologies_input"
                        value="{{ old('technologies_input') }}" placeholder="例: PHP, Laravel, MySQL, JavaScript, Vue.js"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('technologies') border-red-300 @enderror">
                    <p class="mt-1 text-sm text-gray-500">カンマ区切りで入力してください</p>
                    @error('technologies')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 並び順 -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">並び順</label>
                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}"
                        min="0"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-300 @enderror">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- おすすめ -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ old('is_featured') ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">おすすめプロジェクトにする</span>
                    </label>
                </div>

                <!-- ボタン -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.projects.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        キャンセル
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        作成
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const technologiesInput = document.getElementById('technologies');
                const form = document.querySelector('form');

                form.addEventListener('submit', function(e) {
                    const technologies = technologiesInput.value.split(',').map(tech => tech.trim()).filter(
                        tech => tech);

                    // 既存のhidden inputを削除
                    const existingInputs = form.querySelectorAll('input[name="technologies[]"]');
                    existingInputs.forEach(input => input.remove());

                    // 技術スタックをhidden inputとして追加
                    technologies.forEach(tech => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'technologies[]';
                        input.value = tech;
                        form.appendChild(input);
                    });
                });
            });
        </script>
    @endpush
@endsection
