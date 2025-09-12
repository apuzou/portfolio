@extends('admin.layouts.app')

@section('title', 'お問い合わせ管理')
@section('page-title', 'お問い合わせ管理')

@section('content')
    <div class="space-y-6">
        <!-- ヘッダー -->
        <div class="flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-900">お問い合わせ一覧</h1>
        </div>

        <!-- お問い合わせ一覧 -->
        <div class="bg-white shadow-sm rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">送信者</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">件名</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ステータス</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">送信日時</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">操作</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($contacts as $contact)
                        <tr class="{{ $contact->status === 'unread' ? 'bg-yellow-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <div class="h-10 w-10 rounded-full bg-gray-300 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-600"></i>
                                        </div>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $contact->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $contact->email }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-900">{{ Str::limit($contact->subject, 50) }}</div>
                                <div class="text-sm text-gray-500">{{ Str::limit($contact->message, 80) }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $contact->status === 'unread'
                                    ? 'bg-yellow-100 text-yellow-800'
                                    : ($contact->status === 'read'
                                        ? 'bg-blue-100 text-blue-800'
                                        : ($contact->status === 'replied'
                                            ? 'bg-green-100 text-green-800'
                                            : 'bg-gray-100 text-gray-800')) }}">
                                    {{ $contact->status === 'unread'
                                        ? '未読'
                                        : ($contact->status === 'read'
                                            ? '既読'
                                            : ($contact->status === 'replied'
                                                ? '返信済み'
                                                : 'アーカイブ')) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $contact->created_at->format('Y/m/d H:i') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                <a href="{{ route('admin.contacts.show', $contact) }}"
                                    class="text-indigo-600 hover:text-indigo-900">詳細</a>
                                @if ($contact->status === 'unread')
                                    <form method="POST" action="{{ route('admin.contacts.update', $contact) }}"
                                        class="inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="read">
                                        <button type="submit" class="text-blue-600 hover:text-blue-900">既読にする</button>
                                    </form>
                                @endif
                                <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}"
                                    class="inline" onsubmit="return confirm('このお問い合わせを削除しますか？')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">削除</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                お問い合わせがありません。
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- ページネーション -->
        @if ($contacts->hasPages())
            <div class="px-6 py-3">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
@endsection
