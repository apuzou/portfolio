@extends('admin.layouts.app')

@section('title', 'プロジェクトカテゴリ作成')
@section('page-title', 'プロジェクトカテゴリ作成')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-lg font-medium text-gray-900">プロジェクトカテゴリを追加</h1>
            </div>

            <form method="POST" action="{{ route('admin.project-categories.store') }}" class="p-6 space-y-6">
                @csrf

                <!-- カテゴリ名 -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">カテゴリ名 <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 説明 -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">説明</label>
                    <textarea id="description" name="description" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror">{{ old('description') }}</textarea>
                    @error('description')
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

                <!-- ステータス -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">有効にする</span>
                    </label>
                </div>

                <!-- ボタン -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.project-categories.index') }}"
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
@endsection
