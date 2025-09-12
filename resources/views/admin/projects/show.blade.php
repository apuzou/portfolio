@extends('admin.layouts.app')

@section('title', 'プロジェクト詳細')
@section('page-title', 'プロジェクト詳細')

@section('content')
    <div class="max-w-6xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-lg font-medium text-gray-900">プロジェクト詳細</h1>
                <div class="space-x-2">
                    <a href="{{ route('admin.projects.edit', $project) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        編集
                    </a>
                    <a href="{{ route('admin.projects.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        一覧に戻る
                    </a>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- プロジェクト画像 -->
                @if ($project->featured_image)
                    <div>
                        <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}"
                            class="w-full h-64 object-cover rounded-lg">
                    </div>
                @endif

                <!-- 基本情報 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">プロジェクト名</h3>
                        <div class="mt-1 flex items-center">
                            <p class="text-lg font-medium text-gray-900">{{ $project->title }}</p>
                            @if ($project->is_featured)
                                <span
                                    class="ml-2 px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                    おすすめ
                                </span>
                            @endif
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ステータス</h3>
                        <span
                            class="mt-1 inline-flex px-2 py-1 text-sm font-semibold rounded-full 
                        {{ $project->status === 'published'
                            ? 'bg-green-100 text-green-800'
                            : ($project->status === 'draft'
                                ? 'bg-yellow-100 text-yellow-800'
                                : 'bg-gray-100 text-gray-800') }}">
                            {{ $project->status === 'published' ? '公開' : ($project->status === 'draft' ? '下書き' : 'アーカイブ') }}
                        </span>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">並び順</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $project->sort_order }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">期間</h3>
                        @if ($project->start_date)
                            <p class="mt-1 text-lg text-gray-900">
                                {{ $project->start_date->format('Y年m月') }}
                                @if ($project->end_date)
                                    〜 {{ $project->end_date->format('Y年m月') }}
                                @else
                                    〜 現在
                                @endif
                            </p>
                        @else
                            <p class="mt-1 text-lg text-gray-500">未設定</p>
                        @endif
                    </div>
                </div>

                <!-- 説明 -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500">説明</h3>
                    <p class="mt-1 text-gray-900">{{ $project->description }}</p>
                </div>

                <!-- 詳細内容 -->
                @if ($project->content)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">詳細内容</h3>
                        <div class="mt-1 bg-gray-50 rounded-lg p-4">
                            <p class="text-gray-900 whitespace-pre-line">{{ $project->content }}</p>
                        </div>
                    </div>
                @endif

                <!-- カテゴリ -->
                @if ($project->categories->count() > 0)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">カテゴリ</h3>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach ($project->categories as $category)
                                <span class="px-3 py-1 text-sm bg-blue-100 text-blue-800 rounded-full">
                                    {{ $category->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- 技術スタック -->
                @if ($project->technologies->count() > 0)
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">技術スタック</h3>
                        <div class="mt-1 flex flex-wrap gap-2">
                            @foreach ($project->technologies as $tech)
                                <span class="px-3 py-1 text-sm bg-gray-100 text-gray-800 rounded-full">
                                    {{ $tech->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- URL -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @if ($project->demo_url)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">デモURL</h3>
                            <a href="{{ $project->demo_url }}" target="_blank"
                                class="mt-1 text-blue-600 hover:text-blue-900 break-all">
                                {{ $project->demo_url }}
                            </a>
                        </div>
                    @endif

                    @if ($project->github_url)
                        <div>
                            <h3 class="text-sm font-medium text-gray-500">GitHub URL</h3>
                            <a href="{{ $project->github_url }}" target="_blank"
                                class="mt-1 text-blue-600 hover:text-blue-900 break-all">
                                {{ $project->github_url }}
                            </a>
                        </div>
                    @endif
                </div>

                <!-- 作成・更新日時 -->
                <div class="border-t pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm text-gray-500">
                        <div>
                            <span class="font-medium">作成日時:</span> {{ $project->created_at->format('Y年m月d日 H:i') }}
                        </div>
                        <div>
                            <span class="font-medium">更新日時:</span> {{ $project->updated_at->format('Y年m月d日 H:i') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
