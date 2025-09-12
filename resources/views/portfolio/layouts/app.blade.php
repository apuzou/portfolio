<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '山田太郎 - フルスタック開発者')</title>
    <meta name="description" content="@yield('description', '美しく機能的なウェブアプリケーションを作成することに情熱を注ぐ開発者です。モダンなテクノロジーを使って、ユーザー体験を向上させるソリューションを提供します。')">

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    @stack('styles')
</head>

<body class="bg-gradient-to-br from-slate-900 via-indigo-900 to-purple-900 min-h-screen">
    <!-- ナビゲーション -->
    <nav class="fixed top-0 left-0 right-0 z-50 bg-slate-900/80 backdrop-blur-md border-b border-indigo-500/30">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- ロゴ -->
                <div class="flex-shrink-0">
                    <a href="{{ route('portfolio.index') }}" class="text-2xl font-bold">
                        <span class="text-blue-400">Port</span><span class="text-green-400">folio</span>
                    </a>
                </div>

                <!-- ナビゲーションメニュー -->
                <div class="hidden md:block">
                    <div class="ml-10 flex items-baseline space-x-4">
                        <a href="#hero"
                            class="px-3 py-2 rounded-md text-sm font-medium transition duration-200 text-gray-300 hover:bg-indigo-600/50 hover:text-white">
                            <i class="fas fa-home mr-2"></i>ホーム
                        </a>
                        <a href="#profile"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-indigo-600/50 hover:text-white transition duration-200">
                            <i class="fas fa-user mr-2"></i>プロフィール
                        </a>
                        <a href="#skills"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-indigo-600/50 hover:text-white transition duration-200">
                            <i class="fas fa-code mr-2"></i>スキル
                        </a>
                        <a href="#projects"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-indigo-600/50 hover:text-white transition duration-200">
                            <i class="fas fa-briefcase mr-2"></i>プロジェクト
                        </a>
                        <a href="#contact"
                            class="px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-indigo-600/50 hover:text-white transition duration-200">
                            <i class="fas fa-envelope mr-2"></i>お問い合わせ
                        </a>
                    </div>
                </div>

                <!-- モバイルメニューボタン -->
                <div class="md:hidden">
                    <button type="button"
                        class="mobile-menu-button text-gray-300 hover:text-white focus:outline-none focus:text-white">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- モバイルメニュー -->
        <div class="mobile-menu hidden md:hidden">
            <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-slate-800">
                <a href="#hero"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700 transition duration-200">
                    <i class="fas fa-home mr-2"></i>ホーム
                </a>
                <a href="#profile"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700 transition duration-200">
                    <i class="fas fa-user mr-2"></i>プロフィール
                </a>
                <a href="#skills"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700 transition duration-200">
                    <i class="fas fa-code mr-2"></i>スキル
                </a>
                <a href="#projects"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700 transition duration-200">
                    <i class="fas fa-briefcase mr-2"></i>プロジェクト
                </a>
                <a href="#contact"
                    class="block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-slate-700 transition duration-200">
                    <i class="fas fa-envelope mr-2"></i>お問い合わせ
                </a>
            </div>
        </div>
    </nav>

    <!-- メインコンテンツ -->
    <main class="pt-16">
        @yield('content')
    </main>

    <!-- フッター -->
    <footer class="bg-slate-900 border-t border-slate-700">
        <div class="max-w-7xl mx-auto py-8 px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <p class="text-gray-400">&copy; {{ date('Y') }} {{ $profile->full_name ?? '山田太郎' }}. All rights
                    reserved.</p>
            </div>
        </div>
    </footer>


    @stack('scripts')
</body>

</html>
