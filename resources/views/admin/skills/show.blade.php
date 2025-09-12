@extends('admin.layouts.app')

@section('title', 'スキル詳細')
@section('page-title', 'スキル詳細')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-lg font-medium text-gray-900">スキル詳細</h1>
                <div class="space-x-2">
                    <a href="{{ route('admin.skills.edit', $skill) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        編集
                    </a>
                    <a href="{{ route('admin.skills.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        一覧に戻る
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- 基本情報 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">スキル名</h3>
                        <div class="mt-1 flex items-center">
                            @if ($skill->icon)
                                <i class="{{ $skill->icon }} mr-2 text-lg"
                                    style="color: {{ $skill->color ?? '#6B7280' }}"></i>
                            @endif
                            <span class="text-lg font-medium text-gray-900">{{ $skill->name }}</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">カテゴリ</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $skill->skillCategory->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">レベル</h3>
                        <div class="mt-1 flex items-center">
                            <div class="w-32 bg-gray-200 rounded-full h-3 mr-3">
                                <div class="bg-blue-600 h-3 rounded-full" style="width: {{ $skill->level_percentage }}%">
                                </div>
                            </div>
                            <span class="text-lg font-medium text-gray-900">{{ $skill->level }}/5</span>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ステータス</h3>
                        <span
                            class="mt-1 inline-flex px-2 py-1 text-sm font-semibold rounded-full {{ $skill->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $skill->is_active ? '有効' : '無効' }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">並び順</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $skill->sort_order }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">色</h3>
                        <div class="mt-1 flex items-center">
                            <div class="w-6 h-6 rounded-full mr-2"
                                style="background-color: {{ $skill->color ?? '#6B7280' }}"></div>
                            <span class="text-sm text-gray-600">{{ $skill->color ?? '#6B7280' }}</span>
                        </div>
                    </div>
                </div>

                <!-- 説明 -->
                @if ($skill->description)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">説明</h3>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $skill->description }}</p>
                    </div>
                @endif

                <!-- 作成・更新日時 -->
                <div class="border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium">作成日時:</span> {{ $skill->created_at->format('Y年m月d日 H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">更新日時:</span> {{ $skill->updated_at->format('Y年m月d日 H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
