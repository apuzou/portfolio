@extends('admin.layouts.app')

@section('title', 'スキル管理')
@section('page-title', 'スキル管理')

@section('content')
    <div class="space-y-6">
        <!-- ヘッダー -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">スキル一覧</h1>
            <a href="{{ route('admin.skills.create') }}"
                class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg flex items-center">
                <i class="fas fa-plus mr-2"></i>
                スキルを追加
            </a>
        </div>

        <!-- スキル一覧 -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">スキル名</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">カテゴリ</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">レベル</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">並び順</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($skills as $skill)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    @if ($skill->icon)
                                        <i class="{{ $skill->icon }} mr-2 text-lg"
                                            style="color: {{ $skill->color ?? '#6B7280' }}"></i>
                                    @endif
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $skill->name }}</div>
                                        @if ($skill->description)
                                            <div class="text-sm text-gray-500">{{ Str::limit($skill->description, 50) }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $skill->skillCategory->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="w-16 bg-gray-200 rounded-full h-2 mr-2">
                                        <div class="bg-blue-600 h-2 rounded-full"
                                            style="width: {{ $skill->level_percentage }}%"></div>
                                    </div>
                                    <span class="text-sm text-gray-900">{{ $skill->level }}/5</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $skill->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $skill->is_active ? '有効' : '無効' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                {{ $skill->sort_order }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.skills.show', $skill) }}"
                                    class="text-indigo-600 hover:text-indigo-900">詳細</a>
                                <a href="{{ route('admin.skills.edit', $skill) }}"
                                    class="text-blue-600 hover:text-blue-900">編集</a>
                                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="inline"
                                    onsubmit="return confirm('このスキルを削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">削除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                スキルが登録されていません。
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
