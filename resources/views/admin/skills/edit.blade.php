@extends('admin.layouts.app')

@section('title', 'スキル編集')
@section('page-title', 'スキル編集')

@section('content')
    <div class="max-w-2xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200">
                <h1 class="text-lg font-medium text-gray-900">スキルを編集</h1>
            </div>

            <form method="POST" action="{{ route('admin.skills.update', $skill) }}" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <!-- スキル名 -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">スキル名 <span
                            class="text-red-500">*</span></label>
                    <input type="text" id="name" name="name" value="{{ old('name', $skill->name) }}" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-300 @enderror">
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- カテゴリ -->
                <div>
                    <label for="skill_category_id" class="block text-sm font-medium text-gray-700">カテゴリ <span
                            class="text-red-500">*</span></label>
                    <select id="skill_category_id" name="skill_category_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('skill_category_id') border-red-300 @enderror">
                        <option value="">カテゴリを選択してください</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('skill_category_id', $skill->skill_category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('skill_category_id')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- レベル -->
                <div>
                    <label for="level" class="block text-sm font-medium text-gray-700">レベル <span
                            class="text-red-500">*</span></label>
                    <select id="level" name="level" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('level') border-red-300 @enderror">
                        <option value="">レベルを選択してください</option>
                        @for ($i = 1; $i <= 5; $i++)
                            <option value="{{ $i }}" {{ old('level', $skill->level) == $i ? 'selected' : '' }}>
                                {{ $i }} -
                                {{ $i == 1 ? '初心者' : ($i == 2 ? '初級' : ($i == 3 ? '中級' : ($i == 4 ? '上級' : 'エキスパート'))) }}
                            </option>
                        @endfor
                    </select>
                    @error('level')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- 説明 -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700">説明</label>
                    <textarea id="description" name="description" rows="3"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-300 @enderror">{{ old('description', $skill->description) }}</textarea>
                    @error('description')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>


                <!-- 並び順 -->
                <div>
                    <label for="sort_order" class="block text-sm font-medium text-gray-700">並び順</label>
                    <input type="number" id="sort_order" name="sort_order"
                        value="{{ old('sort_order', $skill->sort_order) }}" min="0"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('sort_order') border-red-300 @enderror">
                    @error('sort_order')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- ステータス -->
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $skill->is_active) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">有効にする</span>
                    </label>
                </div>

                <!-- ボタン -->
                <div class="flex justify-end space-x-3">
                    <a href="{{ route('admin.skills.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        キャンセル
                    </a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        更新
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
