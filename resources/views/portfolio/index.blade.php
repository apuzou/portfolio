@extends('portfolio.layouts.app')

@section('title', $profile->full_name ?? '山田太郎')
@section('description', $profile->bio ?? 'Welcome!')

@section('content')
    <!-- Thanks メッセージ -->
    <div id="thanks-message"
        class="hidden fixed top-16 left-0 right-0 z-50 bg-green-600 text-white text-center py-3 px-4 shadow-lg">
        <div class="max-w-4xl mx-auto flex items-center justify-center">
            <i class="fas fa-check-circle mr-2"></i>
            <span class="font-medium">お問い合わせを送信しました。ありがとうございます！</span>
        </div>
    </div>

    <!-- ヒーローセクション -->
    <section id="hero" class="min-h-screen flex items-center justify-center px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto text-center">
            <!-- メインメッセージ -->
            <div class="mb-12">
                <h1 class="text-5xl md:text-7xl font-bold mb-6">
                    <span
                        class="hero-name bg-gradient-to-r from-blue-400 via-purple-400 to-green-400 bg-clip-text text-transparent">
                        {{ $profile->full_name ?? '山田太郎' }}
                    </span>
                </h1>

                <!-- 職業 -->
                <h2 class="text-2xl md:text-3xl text-gray-300 mb-8">
                    {{ $profile->title ?? 'フルスタック開発者' }}
                </h2>

                <!-- トップメッセージ -->
                <div
                    class="text-xl md:text-2xl text-gray-200 max-w-3xl mx-auto leading-relaxed font-light whitespace-pre-line">
                    {{ $profile->top_message ?? '美しく機能的なウェブアプリケーションを創造する' }}
                </div>
            </div>


            <!-- スクロールダウンインジケーター -->
            <div class="scroll-indicator mt-12">
                <a href="#profile" class="inline-block animate-bounce">
                    <i class="fas fa-chevron-down text-2xl text-gray-400 hover:text-white transition duration-200"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- プロフィールセクション -->
    <section id="profile" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-white mb-16 relative">
                プロフィール
                <div
                    class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-green-400 rounded-full">
                </div>
            </h2>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <!-- プロフィール画像 -->
                <div class="text-center lg:text-left">
                    @if ($profile && $profile->avatar)
                        <img src="{{ Storage::url($profile->avatar) }}" alt="{{ $profile->full_name }}"
                            class="w-64 h-64 rounded-full object-cover mx-auto lg:mx-0 border-4 border-blue-500/30 shadow-2xl">
                    @else
                        <div
                            class="w-64 h-64 bg-gradient-to-br from-blue-600 to-purple-600 rounded-full mx-auto lg:mx-0 flex items-center justify-center border-4 border-blue-500/30 shadow-2xl">
                            <i class="fas fa-user text-6xl text-white opacity-50"></i>
                        </div>
                    @endif
                </div>

                <!-- プロフィール情報 -->
                <div class="space-y-6">
                    <div>
                        <h3 class="text-3xl font-bold text-white mb-4">{{ $profile->full_name ?? '山田太郎' }}</h3>
                        <p class="text-gray-300 leading-relaxed text-lg whitespace-pre-line">
                            {{ $profile->bio ?? '美しく機能的なウェブアプリケーションを作成することに情熱を注ぐ開発者です。モダンなテクノロジーを使って、ユーザー体験を向上させるソリューションを提供します。' }}
                        </p>
                    </div>

                    <!-- 連絡先情報 -->
                    <div class="space-y-3">
                        @if ($profile && $profile->location)
                            <div class="flex items-center text-gray-300">
                                <i class="fas fa-map-marker-alt text-blue-400 mr-3"></i>
                                <span>{{ $profile->location }}</span>
                            </div>
                        @endif

                    </div>

                    <!-- SNSリンク -->
                    @if ($profile && ($profile->github_url || $profile->linkedin_url || $profile->twitter_url || $profile->instagram_url))
                        <div class="flex space-x-4">
                            @if ($profile->github_url)
                                <a href="{{ $profile->github_url }}" target="_blank"
                                    class="w-12 h-12 bg-indigo-600/50 hover:bg-indigo-500 rounded-full flex items-center justify-center text-white transition duration-200 transform hover:scale-110 shadow-lg">
                                    <i class="fab fa-github text-xl"></i>
                                </a>
                            @endif

                            @if ($profile->linkedin_url)
                                <a href="{{ $profile->linkedin_url }}" target="_blank"
                                    class="w-12 h-12 bg-purple-600/50 hover:bg-purple-500 rounded-full flex items-center justify-center text-white transition duration-200 transform hover:scale-110 shadow-lg">
                                    <i class="fab fa-linkedin text-xl"></i>
                                </a>
                            @endif

                            @if ($profile->twitter_url)
                                <a href="{{ $profile->twitter_url }}" target="_blank"
                                    class="w-12 h-12 bg-blue-600/50 hover:bg-blue-500 rounded-full flex items-center justify-center text-white transition duration-200 transform hover:scale-110 shadow-lg">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                            @endif

                            @if ($profile->instagram_url)
                                <a href="{{ $profile->instagram_url }}" target="_blank"
                                    class="w-12 h-12 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 rounded-full flex items-center justify-center text-white transition duration-200 transform hover:scale-110 shadow-lg">
                                    <i class="fab fa-instagram text-xl"></i>
                                </a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- スキルセクション -->
    <section id="skills" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-white mb-16 relative">
                スキル
                <div
                    class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-green-400 rounded-full">
                </div>
            </h2>

            @if ($radarChart)
                <div class="flex flex-col lg:flex-row items-center justify-center gap-12">
                    <!-- レーダーチャート -->
                    <div class="w-full lg:w-1/2">
                        <canvas id="skillRadarChart" width="400" height="400" class="radar-chart-transparent"></canvas>
                    </div>

                    <!-- スキル詳細 -->
                    <div class="w-full lg:w-1/2">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach ($skillCategories as $category)
                                <div
                                    class="bg-slate-800/30 backdrop-blur-md rounded-lg p-6 border border-indigo-500/30 shadow-xl">
                                    <h3 class="text-xl font-semibold text-white mb-4">{{ $category->name }}</h3>

                                    @if ($category->activeSkills->count() > 0)
                                        <div class="space-y-3">
                                            @foreach ($category->activeSkills as $skill)
                                                <div class="flex items-center justify-between">
                                                    <span class="text-gray-300">{{ $skill->name }}</span>
                                                    <div class="flex items-center">
                                                        <div class="w-20 bg-gray-700 rounded-full h-2 mr-2 overflow-hidden">
                                                            <div class="skill-progress-bar h-2 rounded-full transition-all duration-1000 ease-out hover:from-green-300 hover:to-emerald-400 hover:shadow-lg hover:shadow-green-500/30"
                                                                style="width: {{ $skill->level_percentage }}%"></div>
                                                        </div>
                                                        <span class="text-sm text-gray-400">{{ $skill->level }}/5</span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-gray-400 text-sm">スキルが登録されていません</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-chart-radar text-6xl text-gray-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-white mb-2">レーダーチャートが設定されていません</h3>
                    <p class="text-gray-400">管理画面からレーダーチャートを設定してください。</p>
                </div>
            @endif
        </div>
    </section>

    <!-- プロジェクトセクション -->
    <section id="projects" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-6xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-white mb-16 relative">
                プロジェクト
                <div
                    class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-green-400 rounded-full">
                </div>
            </h2>

            @if ($featuredProjects->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($featuredProjects as $project)
                        <div
                            class="bg-slate-800/30 backdrop-blur-md rounded-lg overflow-hidden border border-indigo-500/30 hover:border-purple-400 transition duration-300 transform hover:scale-105 shadow-xl">
                            @if ($project->featured_image)
                                <img src="{{ Storage::url($project->featured_image) }}" alt="{{ $project->title }}"
                                    class="w-full h-48 object-cover">
                            @else
                                <div
                                    class="w-full h-48 bg-gradient-to-br from-blue-600 to-purple-600 flex items-center justify-center">
                                    <i class="fas fa-image text-4xl text-white opacity-50"></i>
                                </div>
                            @endif

                            <div class="p-6">
                                <h3 class="text-xl font-semibold text-white mb-2">{{ $project->title }}</h3>
                                <p class="text-gray-300 mb-4 line-clamp-3">{{ $project->description }}</p>

                                @if ($project->start_date || $project->end_date)
                                    <div class="text-sm text-gray-400 mb-4">
                                        @if ($project->start_date)
                                            <i class="fas fa-calendar-alt mr-1"></i>
                                            {{ $project->start_date->format('Y年m月') }}
                                            @if ($project->end_date)
                                                - {{ $project->end_date->format('Y年m月') }}
                                            @else
                                                - 現在
                                            @endif
                                        @endif
                                    </div>
                                @endif

                                <div class="flex flex-wrap gap-2 mb-4">
                                    @foreach ($project->technologies as $tech)
                                        <span class="px-2 py-1 bg-indigo-600/20 text-indigo-300 text-xs rounded-full">
                                            {{ $tech->name }}
                                        </span>
                                    @endforeach
                                </div>

                                <div class="flex gap-2">
                                    @if ($project->demo_url)
                                        <a href="{{ $project->demo_url }}" target="_blank"
                                            class="flex-1 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white text-center py-2 px-4 rounded transition duration-200 shadow-lg">
                                            <i class="fas fa-external-link-alt mr-1"></i>デモ
                                        </a>
                                    @endif
                                    @if ($project->github_url)
                                        <a href="{{ $project->github_url }}" target="_blank"
                                            class="flex-1 bg-slate-700 hover:bg-slate-600 text-white text-center py-2 px-4 rounded transition duration-200 shadow-lg">
                                            <i class="fab fa-github mr-1"></i>GitHub
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-briefcase text-6xl text-gray-600 mb-4"></i>
                    <h3 class="text-2xl font-semibold text-white mb-2">プロジェクトがありません</h3>
                    <p class="text-gray-400">管理画面からプロジェクトを登録してください。</p>
                </div>
            @endif
        </div>
    </section>

    <!-- お問い合わせセクション -->
    <section id="contact" class="py-20 px-4 sm:px-6 lg:px-8">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl font-bold text-center text-white mb-16 relative">
                お問い合わせ
                <div
                    class="absolute -bottom-2 left-1/2 transform -translate-x-1/2 w-24 h-1 bg-gradient-to-r from-blue-400 via-purple-400 to-green-400 rounded-full">
                </div>
            </h2>

            <!-- お問い合わせフォーム -->
            <div class="max-w-2xl mx-auto">
                <div class="bg-slate-800/30 backdrop-blur-md rounded-lg p-8 border border-indigo-500/30 shadow-xl">
                    <h3 class="text-2xl font-semibold text-white mb-6 text-center">メッセージを送信</h3>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('portfolio.contact.store') }}">
                        @csrf
                        <div class="space-y-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-300 mb-2">
                                    お名前 <span class="text-red-400">*</span>
                                </label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}"
                                    required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror"
                                    placeholder="山田太郎">
                                @error('name')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-300 mb-2">
                                    メールアドレス <span class="text-red-400">*</span>
                                </label>
                                <input type="email" id="email" name="email" value="{{ old('email') }}"
                                    required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                    placeholder="example@email.com">
                                @error('email')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-medium text-gray-300 mb-2">
                                    件名 <span class="text-red-400">*</span>
                                </label>
                                <input type="text" id="subject" name="subject" value="{{ old('subject') }}"
                                    required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('subject') border-red-500 @enderror"
                                    placeholder="お問い合わせの件名">
                                @error('subject')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="message" class="block text-sm font-medium text-gray-300 mb-2">
                                    メッセージ <span class="text-red-400">*</span>
                                </label>
                                <textarea id="message" name="message" rows="6" required
                                    class="w-full px-4 py-3 bg-slate-700 border border-slate-600 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('message') border-red-500 @enderror"
                                    placeholder="お問い合わせ内容をご記入ください">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="w-full bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white py-3 px-6 rounded-lg font-semibold transition duration-200 transform hover:scale-105 shadow-lg">
                                <i class="fas fa-paper-plane mr-2"></i>
                                送信する
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .radar-chart-transparent {
            filter: drop-shadow(0 0 10px rgba(59, 130, 246, 0.3));
        }

        .skill-progress-bar {
            background: linear-gradient(90deg, #4ade80, #10b981);
            box-shadow: 0 0 10px rgba(16, 185, 129, 0.4);
            position: relative;
            overflow: hidden;
        }

        .skill-progress-bar::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }

            100% {
                left: 100%;
            }
        }

        #thanks-message {
            transform: translateY(-100%);
            opacity: 0;
            transition: all 0.3s ease-in-out;
        }

        #thanks-message.show {
            transform: translateY(0);
            opacity: 1;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
        }

        .skill-bar {
            width: 0%;
        }

        .skill-bar.animate {
            width: var(--skill-level);
        }
    </style>
@endpush

@push('scripts')
    <script>
        // レーダーチャート
        @if ($radarChart)
            console.log('Radar Chart Data:', {
                frontend: {{ $radarChart->frontend_level ?? 0 }},
                backend: {{ $radarChart->backend_level ?? 0 }},
                infrastructure: {{ $radarChart->infrastructure_level ?? 0 }},
                ai: {{ $radarChart->ai_level ?? 0 }},
                tools: {{ $radarChart->tools_level ?? 0 }}
            });
            console.log('Radar Chart ID:', {{ $radarChart->id ?? 'null' }});
            console.log('Radar Chart Updated At:', '{{ $radarChart->updated_at ?? 'null' }}');

            const radarCtx = document.getElementById('skillRadarChart');
            if (radarCtx) {
                const ctx = radarCtx.getContext('2d');
                const radarChart = new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: ['フロントエンド', 'バックエンド', 'インフラ', 'AI', 'その他ツール'],
                        datasets: [{
                            label: 'スキルレベル',
                            data: [
                                {{ $radarChart->frontend_level ?? 0 }},
                                {{ $radarChart->backend_level ?? 0 }},
                                {{ $radarChart->infrastructure_level ?? 0 }},
                                {{ $radarChart->ai_level ?? 0 }},
                                {{ $radarChart->tools_level ?? 0 }}
                            ],
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderColor: 'rgba(59, 130, 246, 0.8)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(59, 130, 246, 0.7)',
                            pointBorderColor: 'rgba(255, 255, 255, 0.9)',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: 'rgba(59, 130, 246, 0.9)',
                            pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                            pointBorderWidth: 2,
                            pointHoverBorderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        elements: {
                            point: {
                                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                borderColor: 'rgba(255, 255, 255, 0.9)',
                                borderWidth: 2,
                                radius: 5,
                                hoverRadius: 7,
                                hoverBackgroundColor: 'rgba(59, 130, 246, 0.9)',
                                hoverBorderColor: 'rgba(255, 255, 255, 1)',
                                hoverBorderWidth: 3
                            },
                            line: {
                                borderWidth: 2,
                                borderColor: 'rgba(59, 130, 246, 0.8)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)'
                            }
                        },
                        scales: {
                            r: {
                                beginAtZero: true,
                                max: 5,
                                min: 0,
                                ticks: {
                                    stepSize: 1,
                                    color: 'rgba(255, 255, 255, 0.9)',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    },
                                    backdropColor: 'rgba(0, 0, 0, 0.05)',
                                    backdropPadding: 2
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.2)',
                                    lineWidth: 1
                                },
                                pointLabels: {
                                    color: 'rgba(255, 255, 255, 1)',
                                    font: {
                                        size: 16,
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'rgba(255, 255, 255, 1)',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    }
                });
            } else {
                console.error('Radar chart canvas not found');
            }
        @else
            console.log('No radar chart data available');
            // デフォルトデータでレーダーチャートを表示
            const radarCtx = document.getElementById('skillRadarChart');
            if (radarCtx) {
                const ctx = radarCtx.getContext('2d');
                const radarChart = new Chart(ctx, {
                    type: 'radar',
                    data: {
                        labels: ['フロントエンド', 'バックエンド', 'インフラ', 'AI', 'その他ツール'],
                        datasets: [{
                            label: 'スキルレベル',
                            data: [0, 0, 0, 0, 0],
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderColor: 'rgba(59, 130, 246, 0.8)',
                            borderWidth: 2,
                            pointBackgroundColor: 'rgba(59, 130, 246, 0.7)',
                            pointBorderColor: 'rgba(255, 255, 255, 0.9)',
                            pointRadius: 5,
                            pointHoverRadius: 7,
                            pointHoverBackgroundColor: 'rgba(59, 130, 246, 0.9)',
                            pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                            pointBorderWidth: 2,
                            pointHoverBorderWidth: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        elements: {
                            point: {
                                backgroundColor: 'rgba(59, 130, 246, 0.7)',
                                borderColor: 'rgba(255, 255, 255, 0.9)',
                                borderWidth: 2,
                                radius: 5,
                                hoverRadius: 7,
                                hoverBackgroundColor: 'rgba(59, 130, 246, 0.9)',
                                hoverBorderColor: 'rgba(255, 255, 255, 1)',
                                hoverBorderWidth: 3
                            },
                            line: {
                                borderWidth: 2,
                                borderColor: 'rgba(59, 130, 246, 0.8)',
                                backgroundColor: 'rgba(59, 130, 246, 0.1)'
                            }
                        },
                        scales: {
                            r: {
                                beginAtZero: true,
                                max: 5,
                                min: 0,
                                ticks: {
                                    stepSize: 1,
                                    color: 'rgba(255, 255, 255, 0.9)',
                                    font: {
                                        size: 12,
                                        weight: 'bold'
                                    },
                                    backdropColor: 'rgba(0, 0, 0, 0.05)',
                                    backdropPadding: 2
                                },
                                grid: {
                                    color: 'rgba(255, 255, 255, 0.2)',
                                    lineWidth: 1
                                },
                                pointLabels: {
                                    color: 'rgba(255, 255, 255, 1)',
                                    font: {
                                        size: 16,
                                        weight: 'bold'
                                    }
                                }
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    color: 'rgba(255, 255, 255, 1)',
                                    font: {
                                        size: 14,
                                        weight: 'bold'
                                    }
                                }
                            }
                        }
                    }
                });
            }
        @endif

        // Thanks メッセージ表示機能
        function showThanksMessage() {
            const thanksMessage = document.getElementById('thanks-message');
            if (thanksMessage) {
                thanksMessage.classList.remove('hidden');
                thanksMessage.style.transform = 'translateY(0)';
                thanksMessage.style.opacity = '1';

                // 5秒後に非表示
                setTimeout(() => {
                    thanksMessage.style.transform = 'translateY(-100%)';
                    thanksMessage.style.opacity = '0';
                    setTimeout(() => {
                        thanksMessage.classList.add('hidden');
                    }, 300);
                }, 5000);
            }
        }

        // フォーム送信成功時の処理
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', function() {
                showThanksMessage();
            });
        @endif

        // フォーム送信時の処理
        const contactForm = document.querySelector('form[action="{{ route('portfolio.contact.store') }}"]');
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>送信中...';
                    submitBtn.disabled = true;
                }
            });
        }
    </script>
@endpush
