@extends('layouts.app')

@section('title', 'apuzou\'s portfolio')

@section('content')
<!-- Header -->
<header class="header">
    <nav class="navigation">
        <div class="nav-brand">apuzou's portfolio</div>
        <div class="nav-menu">
            <a href="#about">about</a>
            <a href="#skills">skills</a>
            <a href="#works">works</a>
            <a href="#contact">contact</a>
        </div>
    </nav>
</header>

<!-- Hero Section -->
<section id="hero" class="hero-section">
    <h1 class="section-title">Welcome!</h1>
    <div class="hero-image-container">
        <img class="hero-image" src="/images/deskwork.png" alt="デスクトップ画像">
        <div class="hero-overlay">
            <p>フルスタックエンジニアとして</p>
            <p>みなさまの課題解決へ</p>
        </div>
    </div>
    <div class="accent-bar accent-bar-orange"></div>
</section>

<!-- About Section -->
<section id="about" class="section-content">
    <h2 class="section-title">About Me</h2>
    <div class="about-content">
        <div class="about-left">
            <img src="/images/icon_2.PNG" alt="SEITA MAEDA" class="profile-photo">
            <div class="profile-text-overlay">SEITA MAEDA</div>
        </div>
        <div class="about-right">
            <h3 class="profile-name">前田 聖太</h3>
            <div class="profile-text">
                <p>アパレル企業での職務経験を通じて、業務効率化の重要性を学びました。</p>
                <p>IT業界への興味から2025年よりエンジニアとしてキャリアをスタートします。</p>
                <p>小売業界で培った「業務効率化」を得意分野とし、フルスタックエンジニアを目指します。</p>
                <p>どうぞよろしくお願いいたします。</p>
            </div>
            <div class="profile-info">
                <div class="location">
                    <span class="icon">✓</span>
                    <span>東京都</span>
                </div>
                <div class="social-links">
                    <span class="icon github-icon">🐙</span>
                    <span class="icon instagram-icon">📷</span>
                    <span>1児の父です。プライベートな一面もご興味がある方はぜひご覧ください。</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Skills Section -->
<section id="skills" class="section-content">
    <h2 class="section-title">Skills</h2>
    <div class="skills-container">
        <div class="skills-frame">
            <dl class="skill-category">
                <dt>フロントエンド</dt>
                <dd>
                    <ul>
                        <li>JavaScript/React</li>
                        <li>Next.js</li>
                    </ul>
                </dd>
            </dl>
            <dl class="skill-category">
                <dt>バックエンド/データベース</dt>
                <dd>
                    <ul>
                        <li>PHP/Laravel</li>
                        <li>MySQL</li>
                    </ul>
                </dd>
            </dl>
            <dl class="skill-category">
                <dt>環境構築/その他</dt>
                <dd>
                    <ul>
                        <li>AWS</li>
                        <li>Linux</li>
                        <li>GitHub</li>
                        <li>Docker</li>
                    </ul>
                </dd>
            </dl>
            <dl class="skill-category">
                <dt>開発ツール</dt>
                <dd>
                    <ul>
                        <li>Cursor</li>
                        <li>Figma</li>
                    </ul>
                </dd>
            </dl>
            <dl class="skill-category">
                <dt>ソフトスキル</dt>
                <dd>
                    <ul>
                        <li>チーム管理</li>
                    </ul>
                </dd>
            </dl>
        </div>
    </div>
    <div class="accent-bar accent-green"></div>
</section>

<!-- Works Section -->
<section id="works" class="section-content">
    <h2 class="section-title">Works</h2>
    <div class="works-grid">
        <div class="work-card work-card-large">
            <div class="work-thumbnail">サムネイル画像</div>
            <div class="work-content">
                <div class="work-overview">概要</div>
                <div class="work-tech">使用技術</div>
            </div>
        </div>
        <div class="work-card work-card-small">
            <div class="work-thumbnail">サムネイル<br>画像</div>
            <div class="work-content">
                <div class="work-overview">概要</div>
                <div class="work-tech">使用技術</div>
            </div>
        </div>
        <div class="work-card work-card-medium">
            <div class="work-thumbnail">サムネイル画像</div>
            <div class="work-content">
                <div class="work-overview">概要</div>
            </div>
        </div>
        <div class="work-card work-card-medium">
            <div class="work-thumbnail">サムネイル画像</div>
            <div class="work-content">
                <div class="work-overview">概要</div>
            </div>
        </div>
    </div>
    <div class="works-more">その他 →</div>
</section>

<!-- Contact Section -->
<section id="contact" class="section-content">
    <h2 class="section-title">Contact</h2>
    <div class="contact-form-container">
        <div class="contact-form">
            <p class="form-description">ご相談など各種お問い合わせは下記フォームにてご連絡ください</p>
            <form>
                <div class="form-group">
                    <input type="text" placeholder="ご氏名/会社名" class="form-input">
                </div>
                <div class="form-group">
                    <input type="email" placeholder="メールアドレス" class="form-input">
                </div>
                <div class="form-group">
                    <textarea placeholder="お問い合わせ内容" class="form-textarea"></textarea>
                </div>
                <div class="form-submit">
                    <button type="submit" class="submit-btn">確認</button>
                </div>
            </form>
        </div>
    </div>
    <div class="accent-bar accent-bar-orange"></div>
</section>

<!-- Footer -->
<footer class="footer">
</footer>
@endsection