@extends('admin.layouts.app')

@section('title', 'プロジェクトカテゴリ詳細')
@section('page-title', 'プロジェクトカテゴリ詳細')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-lg font-medium text-gray-900">プロジェクトカテゴリ詳細</h1>
                <div class="space-x-2">
                    <a href="{{ route('admin.project-categories.edit', $projectCategory) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        編集
                    </a>
                    <a href="{{ route('admin.project-categories.index') }}"
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
                        <p class="mt-1 text-lg font-medium text-gray-900">{{ $projectCategory->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">スラッグ</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $projectCategory->slug }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ステータス</h3>
                        <span
                            class="mt-1 inline-flex px-2 py-1 text-sm font-semibold rounded-full {{ $projectCategory->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $projectCategory->is_active ? '有効' : '無効' }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">並び順</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $projectCategory->sort_order }}</p>
                    </div>
                </div>

                <!-- 説明 -->
                @if ($projectCategory->description)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">説明</h3>
                        <p class="mt-1 text-gray-900 whitespace-pre-line">{{ $projectCategory->description }}</p>
                    </div>
                @endif

                <!-- 関連プロジェクト -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-4">関連プロジェクト ({{ $projectCategory->projects->count() }}件)
                    </h3>
                    @if ($projectCategory->projects->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($projectCategory->projects as $project)
                                <div class="border rounded-lg p-4">
                                    <div class="flex items-center mb-2">
                                        @if ($project->featured_image)
                                            <img class="h-8 w-8 rounded object-cover mr-3"
                                                src="{{ Storage::url($project->featured_image) }}"
                                                alt="{{ $project->title }}">
                                        @else
                                            <div class="h-8 w-8 bg-gray-200 rounded mr-3 flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-xs"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1">
                                            <div class="text-sm font-medium text-gray-900 flex items-center">
                                                {{ $project->title }}
                                                @if ($project->is_featured)
                                                    <span
                                                        class="ml-2 px-1 py-0.5 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                                        おすすめ
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="text-xs text-gray-500">{{ Str::limit($project->description, 40) }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <span
                                            class="px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $project->status === 'published'
                                            ? 'bg-green-100 text-green-800'
                                            : ($project->status === 'draft'
                                                ? 'bg-yellow-100 text-yellow-800'
                                                : 'bg-gray-100 text-gray-800') }}">
                                            {{ $project->status === 'published' ? '公開' : ($project->status === 'draft' ? '下書き' : 'アーカイブ') }}
                                        </span>
                                        <a href="{{ route('admin.projects.show', $project) }}"
                                            class="text-blue-600 hover:text-blue-900 text-xs">
                                            詳細
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">このカテゴリにはプロジェクトが登録されていません。</p>
                    @endif
                </div>

                <!-- 作成・更新日時 -->
                <div class="border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium">作成日時:</span> {{ $projectCategory->created_at->format('Y年m月d日 H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">更新日時:</span> {{ $projectCategory->updated_at->format('Y年m月d日 H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
