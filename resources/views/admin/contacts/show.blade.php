@extends('admin.layouts.app')

@section('title', 'お問い合わせ詳細')
@section('page-title', 'お問い合わせ詳細')

@section('content')
    <div class="max-w-4xl">
        <div class="bg-white shadow-sm rounded-lg">
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h1 class="text-lg font-medium text-gray-900">お問い合わせ詳細</h1>
                <div class="space-x-2">
                    <a href="{{ route('admin.contacts.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">
                        一覧に戻る
                    </a>
                    <form method="POST" action="{{ route('admin.contacts.destroy', $contact) }}" class="inline"
                        onsubmit="return confirm('このお問い合わせを削除しますか？')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">
                            削除
                        </button>
                    </form>
                </div>
            </div>

            <div class="p-6 space-y-6">
                <!-- 基本情報 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h3 class="text-sm font-medium text-gray-500">送信者名</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $contact->name }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">メールアドレス</h3>
                        <p class="mt-1 text-lg text-gray-900">
                            <a href="mailto:{{ $contact->email }}" class="text-blue-600 hover:text-blue-900">
                                {{ $contact->email }}
                            </a>
                        </p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">件名</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $contact->subject }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">ステータス</h3>
                        <form method="POST" action="{{ route('admin.contacts.update', $contact) }}" class="inline">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()"
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                <option value="unread" {{ $contact->status === 'unread' ? 'selected' : '' }}>未読</option>
                                <option value="read" {{ $contact->status === 'read' ? 'selected' : '' }}>既読</option>
                                <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>返信済み</option>
                                <option value="archived" {{ $contact->status === 'archived' ? 'selected' : '' }}>アーカイブ
                                </option>
                            </select>
                        </form>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">送信日時</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $contact->created_at->format('Y年m月d日 H:i') }}</p>
                    </div>

                    <div>
                        <h3 class="text-sm font-medium text-gray-500">IPアドレス</h3>
                        <p class="mt-1 text-lg text-gray-900">{{ $contact->ip_address ?? '不明' }}</p>
                    </div>
                </div>

                <!-- メッセージ内容 -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-2">メッセージ内容</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-900 whitespace-pre-line">{{ $contact->message }}</p>
                    </div>
                </div>

                <!-- 返信履歴 -->
                <div>
                    <h3 class="text-sm font-medium text-gray-500 mb-4">返信履歴 ({{ $contact->replies->count() }}件)</h3>
                    @if ($contact->replies->count() > 0)
                        <div class="space-y-4">
                            @foreach ($contact->replies as $reply)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-2">
                                        <div class="flex items-center">
                                            <div
                                                class="h-8 w-8 rounded-full bg-blue-100 flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-blue-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">{{ $reply->user->name }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ $reply->created_at->format('Y/m/d H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="ml-11">
                                        <p class="text-gray-900 whitespace-pre-line">{{ $reply->message }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">まだ返信がありません。</p>
                    @endif
                </div>

                <!-- 返信フォーム -->
                <div class="border-t pt-6">
                    <h3 class="text-sm font-medium text-gray-500 mb-4">返信を送信</h3>
                    <form method="POST" action="{{ route('admin.contact-replies.store') }}" class="space-y-4">
                        @csrf
                        <input type="hidden" name="contact_id" value="{{ $contact->id }}">

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700">返信内容 <span
                                    class="text-red-500">*</span></label>
                            <textarea id="message" name="message" rows="6" required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('message') border-red-300 @enderror"
                                placeholder="返信内容を入力してください">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex justify-end">
                            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                                返信を送信
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
