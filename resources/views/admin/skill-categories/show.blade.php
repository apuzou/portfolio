@extends('admin.layouts.app')

@section('title', 'スキルカテゴリ詳細')
@section('page-title', 'スキルカテゴリ詳細')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-lg font-medium text-gray-900">スキルカテゴリ詳細</h1>
                <div class="space-x-2">
                    <a href="{{ route('admin.skill-categories.edit', $skillCategory) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        編集
                    </a>
                    <a href="{{ route('admin.skill-categories.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        一覧に戻る
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- 基本情報 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">カテゴリ名</h3>
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $skillCategory->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">スラッグ</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $skillCategory->slug }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ステータス</h3>
                        <span
                            class="mt-1 inline-flex px-2 py-1 text-sm font-semibold rounded-full {{ $skillCategory->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $skillCategory->is_active ? '有効' : '無効' }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">並び順</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $skillCategory->sort_order }}</p>
                    </div>
                </div>

                <!-- 関連スキル -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-4">関連スキル ({{ $skillCategory->skills->count() }}件)</h3>
                    @if ($skillCategory->skills->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($skillCategory->skills as $skill)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        @if ($skill->icon)
                                            <i class="{{ $skill->icon }} mr-2 text-lg"
                                                style="color: {{ $skill->color ?? '#6B7280' }}"></i>
                                        @endif
                                        <span class="font-medium text-gray-900">{{ $skill->name }}</span>
                                    </div>
                                    <div class="flex items-center mb-2">
                                        <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                            <div class="bg-blue-600 h-2 rounded-full"
                                                style="width: {{ $skill->level_percentage }}%"></div>
                                        </div>
                                        <span class="text-sm text-gray-600">{{ $skill->level }}/5</span>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full {{ $skill->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ $skill->is_active ? '有効' : '無効' }}
                                        </span>
                                        <a href="{{ route('admin.skills.show', $skill) }}"
                                            class="text-blue-600 hover:text-blue-900 text-sm">
                                            詳細
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">このカテゴリにはスキルが登録されていません。</p>
                    @endif
                </div>

                <!-- 作成・更新日時 -->
                <div class="border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium">作成日時:</span> {{ $skillCategory->created_at->format('Y年m月d日 H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">更新日時:</span> {{ $skillCategory->updated_at->format('Y年m月d日 H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
