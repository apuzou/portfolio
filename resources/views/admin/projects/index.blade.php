@extends('admin.layouts.app')

@section('title', 'プロジェクト管理')
@section('page-title', 'プロジェクト管理')

@section('content')
    <div class="space-y-6">
        <!-- ヘッダー -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">プロジェクト一覧</h1>
            <a href="{{ route('admin.projects.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                プロジェクトを追加
            </a>
        </div>

        <!-- プロジェクト一覧 -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">プロジェクト
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">カテゴリ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">技術</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">期間</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($projects as $project)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if ($project->featured_image)
                                        <img class="h-12 w-12 rounded-lg object-cover mr-4"
                                            src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}">
                                    @else
                                        <div class="h-12 w-12 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900 flex items-center">
                                            {{ $project->title }}
                                            @if ($project->is_featured)
                                                <span
                                                    class="ml-2 px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                                    おすすめ
                                                </span>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($project->description, 60) }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $project->status === 'published'
                                    ? 'bg-green-100 text-green-800'
                                    : ($project->status === 'draft'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : 'bg-gray-100 text-gray-800') }}">
                                    {{ $project->status === 'published' ? '公開' : ($project->status === 'draft' ? '下書き' : 'アーカイブ') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($project->categories->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($project->categories as $category)
                                            <span class="px-2 py-1 text-xs bg-blue-100 text-blue-800 rounded-full">
                                                {{ $category->name }}
                                            </span>
                                        @endforeach
                                    </div>
                                @else
                                    <span class="text-gray-400">未設定</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($project->technologies->count() > 0)
                                    <div class="flex flex-wrap gap-1">
                                        @foreach ($project->technologies->take(3) as $tech)
                                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">
                                                {{ $tech->name }}
                                            </span>
                                        @endforeach
                                        @if ($project->technologies->count() > 3)
                                            <span class="px-2 py-1 text-xs bg-gray-100 text-gray-800 rounded-full">
                                                +{{ $project->technologies->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-gray-400">未設定</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                @if ($project->start_date)
                                    <div>{{ $project->start_date->format('Y/m') }}</div>
                                    @if ($project->end_date)
                                        <div class="text-gray-500">〜 {{ $project->end_date->format('Y/m') }}</div>
                                    @else
                                        <div class="text-gray-500">〜 現在</div>
                                    @endif
                                @else
                                    <span class="text-gray-400">未設定</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.projects.show', $project) }}"
                                    class="text-indigo-600 hover:text-indigo-900">詳細</a>
                                <a href="{{ route('admin.projects.edit', $project) }}"
                                    class="text-blue-600 hover:text-blue-900">編集</a>
                                <form method="POST" action="{{ route('admin.projects.destroy', $project) }}"
                                    class="inline" onsubmit="return confirm('このプロジェクトを削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">削除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                プロジェクトが登録されていません。
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
