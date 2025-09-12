@extends('admin.layouts.app')

@section('title', 'レーダーチャート管理')
@section('page-title', 'レーダーチャート管理')

@section('content')
    <div class="max-w-4xl mx-auto">
        <div class="bg-white rounded-lg shadow">
            <div class="px-6 py-4 border-b border-gray-200">
                <h3 class="text-lg font-medium text-gray-900">スキルレーダーチャート編集</h3>
                <p class="text-sm text-gray-600 mt-1">各カテゴリのスキルレベルを5段階で評価してください。</p>
            </div>

            <form method="POST" action="{{ route('admin.skill-radar-chart.update', $radarChart) }}" class="p-6">
                @csrf
                @method('PUT')


                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- フロントエンド -->
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <label for="frontend_level" class="block text-sm font-medium text-blue-900 mb-2">
                            <i class="fas fa-paint-brush mr-2"></i>フロントエンド
                        </label>
                        <select id="frontend_level" name="frontend_level"
                            class="w-full px-3 py-2 border border-blue-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('frontend_level') border-red-500 @enderror">
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('frontend_level', $radarChart->frontend_level) == $i ? 'selected' : '' }}>
                                    {{ $i === 0 ? '未設定' : $i . '段階' }}
                                </option>
                            @endfor
                        </select>
                        @error('frontend_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- バックエンド -->
                    <div class="bg-green-50 p-4 rounded-lg">
                        <label for="backend_level" class="block text-sm font-medium text-green-900 mb-2">
                            <i class="fas fa-server mr-2"></i>バックエンド
                        </label>
                        <select id="backend_level" name="backend_level"
                            class="w-full px-3 py-2 border border-green-300 rounded-md focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('backend_level') border-red-500 @enderror">
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('backend_level', $radarChart->backend_level) == $i ? 'selected' : '' }}>
                                    {{ $i === 0 ? '未設定' : $i . '段階' }}
                                </option>
                            @endfor
                        </select>
                        @error('backend_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- インフラ -->
                    <div class="bg-yellow-50 p-4 rounded-lg">
                        <label for="infrastructure_level" class="block text-sm font-medium text-yellow-900 mb-2">
                            <i class="fas fa-cloud mr-2"></i>インフラ
                        </label>
                        <select id="infrastructure_level" name="infrastructure_level"
                            class="w-full px-3 py-2 border border-yellow-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent @error('infrastructure_level') border-red-500 @enderror">
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('infrastructure_level', $radarChart->infrastructure_level) == $i ? 'selected' : '' }}>
                                    {{ $i === 0 ? '未設定' : $i . '段階' }}
                                </option>
                            @endfor
                        </select>
                        @error('infrastructure_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- AI -->
                    <div class="bg-purple-50 p-4 rounded-lg">
                        <label for="ai_level" class="block text-sm font-medium text-purple-900 mb-2">
                            <i class="fas fa-robot mr-2"></i>AI
                        </label>
                        <select id="ai_level" name="ai_level"
                            class="w-full px-3 py-2 border border-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('ai_level') border-red-500 @enderror">
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('ai_level', $radarChart->ai_level) == $i ? 'selected' : '' }}>
                                    {{ $i === 0 ? '未設定' : $i . '段階' }}
                                </option>
                            @endfor
                        </select>
                        @error('ai_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- その他ツール -->
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <label for="tools_level" class="block text-sm font-medium text-gray-900 mb-2">
                            <i class="fas fa-tools mr-2"></i>その他ツール
                        </label>
                        <select id="tools_level" name="tools_level"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-gray-500 focus:border-transparent @error('tools_level') border-red-500 @enderror">
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}"
                                    {{ old('tools_level', $radarChart->tools_level) == $i ? 'selected' : '' }}>
                                    {{ $i === 0 ? '未設定' : $i . '段階' }}
                                </option>
                            @endfor
                        </select>
                        @error('tools_level')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- ボタン -->
                <div class="flex justify-end mt-6">
                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                        更新
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
