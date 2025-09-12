<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '管理画面') - Portfolio CMS</title>

    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <!-- サイドバー -->
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h1 class="text-xl font-bold">Portfolio CMS</h1>
            </div>
            <nav class="mt-8">
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.dashboard') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    ダッシュボード
                </a>
                <a href="{{ route('admin.profile.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.profile.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-user mr-3"></i>
                    プロフィール
                </a>
                <a href="{{ route('admin.skills.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.skills.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-code mr-3"></i>
                    スキル管理
                </a>
                <a href="{{ route('admin.skill-radar-chart.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.skill-radar-chart.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-chart-radar mr-3"></i>
                    レーダーチャート
                </a>
                <a href="{{ route('admin.projects.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.projects.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-briefcase mr-3"></i>
                    プロジェクト管理
                </a>
                <a href="{{ route('admin.contacts.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white {{ request()->routeIs('admin.contacts.*') ? 'bg-gray-700 text-white' : '' }}">
                    <i class="fas fa-envelope mr-3"></i>
                    お問い合わせ
                </a>
                <a href="{{ route('portfolio.index') }}"
                    class="flex items-center px-4 py-2 text-gray-300 hover:bg-gray-700 hover:text-white"
                    target="_blank">
                    <i class="fas fa-external-link-alt mr-3"></i>
                    サイトを表示
                </a>
            </nav>
        </div>

        <!-- メインコンテンツ -->
        <div class="flex-1 flex flex-col">
            <!-- ヘッダー -->
            <header class="bg-white shadow-sm border-b">
                <div class="px-6 py-4 flex justify-between items-center">
                    <h2 class="text-2xl font-semibold text-gray-800">@yield('page-title', '管理画面')</h2>
                    <div class="flex items-center space-x-4">
                        <span class="text-gray-600">{{ Auth::user()->name }}</span>
                        <form method="POST" action="{{ route('admin.logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-800">
                                <i class="fas fa-sign-out-alt"></i>
                                ログアウト
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- コンテンツ -->
            <main class="flex-1 p-6">
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    @stack('scripts')
</body>

</html>
