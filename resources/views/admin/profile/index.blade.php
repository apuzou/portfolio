@extends('admin.layouts.app')

@section('title', 'プロフィール管理')
@section('page-title', 'プロフィール管理')

@section('content')
    <div class="space-y-6">
        <!-- ヘッダー -->
        <div class="flex justify-between items-center">
            <h2 class="text-2xl font-bold text-gray-900">プロフィール一覧</h2>
            <a href="{{ route('admin.profile.create') }}"
                class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                <i class="fas fa-plus mr-2"></i>新規作成
            </a>
        </div>

        <!-- プロフィール一覧 -->
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($profiles->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    アバター
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    名前
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    タイトル
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    ステータス
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    作成日
                                </th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    操作
                                </th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($profiles as $profile)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($profile->avatar)
                                            <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $profile->full_name }}"
                                                class="w-10 h-10 rounded-full object-cover">
                                        @else
                                            <div
                                                class="w-10 h-10 bg-gray-300 rounded-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-600"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">{{ $profile->full_name }}</div>
                                        <div class="text-sm text-gray-500">{{ $profile->user->email }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $profile->title ?: '未設定' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if ($profile->is_active)
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                                アクティブ
                                            </span>
                                        @else
                                            <span
                                                class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">
                                                非アクティブ
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $profile->created_at->format('Y/m/d') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                        <a href="{{ route('admin.profile.edit', $profile) }}"
                                            class="text-blue-600 hover:text-blue-900 mr-3">
                                            <i class="fas fa-edit"></i> 編集
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- ページネーション -->
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $profiles->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-user text-4xl text-gray-400 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">プロフィールがありません</h3>
                    <p class="text-gray-500 mb-4">最初のプロフィールを作成してください。</p>
                    <a href="{{ route('admin.profile.create') }}"
                        class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 transition duration-200">
                        <i class="fas fa-plus mr-2"></i>プロフィールを作成
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
