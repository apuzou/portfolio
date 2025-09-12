@extends('admin.layouts.app')

@section('title', 'ダッシュボード')
@section('page-title', 'ダッシュボード')

@section('content')
    <div class="space-y-6">
        <!-- 統計カード -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-envelope text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">お問い合わせ</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $contactCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600">
                        <i class="fas fa-briefcase text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">プロジェクト</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $projectCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                        <i class="fas fa-code text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">スキル</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $skillCount }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                        <i class="fas fa-eye text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-sm font-medium text-gray-600">公開プロジェクト</p>
                        <p class="text-2xl font-semibold text-gray-900">{{ $publishedProjectCount }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 最新のお問い合わせ -->
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">最新のお問い合わせ</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">名前
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">件名
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">日時
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($recentContacts as $contact)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    {{ $contact->name }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ Str::limit($contact->subject, 50) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                    @if ($contact->status === 'unread') bg-red-100 text-red-800
                                    @elseif($contact->status === 'read') bg-yellow-100 text-yellow-800
                                    @elseif($contact->status === 'replied') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                        @switch($contact->status)
                                            @case('unread')
                                                未読
                                            @break

                                            @case('read')
                                                既読
                                            @break

                                            @case('replied')
                                                返信済み
                                            @break

                                            @case('archived')
                                                アーカイブ
                                            @break
                                        @endswitch
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    {{ $contact->created_at->format('Y/m/d H:i') }}
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-sm text-gray-500">
                                        お問い合わせがありません
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if ($recentContacts->count() > 0)
                    <div class="px-6 py-3 bg-gray-50 text-right">
                        <a href="{{ route('admin.contacts.index') }}" class="text-sm text-blue-600 hover:text-blue-800">
                            すべて表示 →
                        </a>
                    </div>
                @endif
            </div>
        </div>
    @endsection
