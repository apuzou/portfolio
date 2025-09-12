import './bootstrap';

// モバイルメニューの切り替え
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.querySelector('.mobile-menu-button');
    const mobileMenu = document.querySelector('.mobile-menu');

    if (mobileMenuButton && mobileMenu) {
        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // モバイルメニューのリンクをクリックしたらメニューを閉じる
        const mobileMenuLinks = mobileMenu.querySelectorAll('a[href^="#"]');
        mobileMenuLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.add('hidden');
            });
        });
    }

    // スムーズスクロール
    const navLinks = document.querySelectorAll('a[href^="#"]');
    navLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // ナビゲーションのアクティブ状態
    const sections = document.querySelectorAll('section[id]');
    const navItems = document.querySelectorAll('nav a[href^="#"]');

    window.addEventListener('scroll', function() {
        let current = '';
        const scrollY = window.pageYOffset;

        sections.forEach(section => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.clientHeight;
            if (scrollY >= (sectionTop - 200)) {
                current = section.getAttribute('id');
            }
        });

        navItems.forEach(item => {
            item.classList.remove('bg-slate-700', 'text-white');
            item.classList.add('text-gray-300');
            if (item.getAttribute('href') === '#' + current) {
                item.classList.remove('text-gray-300');
                item.classList.add('bg-slate-700', 'text-white');
            }
        });
    });

    // ヒーロー名前の浮かび上がるアニメーション
    const heroName = document.querySelector('span.hero-name');
    console.log('Hero name element found:', heroName);
    console.log('Hero name classes:', heroName ? heroName.className : 'N/A');
    console.log('Hero name computed style:', heroName ? window.getComputedStyle(heroName).opacity : 'N/A');
    console.log('Hero name initial transform:', heroName ? window.getComputedStyle(heroName).transform : 'N/A');

    if (heroName) {
        console.log('Starting hero name float animation...');
        // 0.5秒後にアニメーションを開始
        setTimeout(() => {
            console.log('Adding fade-in class to hero name');
            heroName.classList.add('fade-in');
            console.log('Hero name classes after fade-in:', heroName.className);
            console.log('Hero name computed style after fade-in:', window.getComputedStyle(heroName).opacity);
            console.log('Hero name computed transform after fade-in:', window.getComputedStyle(heroName).transform);
            console.log('Hero name computed filter after fade-in:', window.getComputedStyle(heroName).filter);

            // アニメーション完了を確認
            setTimeout(() => {
                console.log('Animation should be complete. Final opacity:', window.getComputedStyle(heroName).opacity);
                console.log('Animation should be complete. Final transform:', window.getComputedStyle(heroName).transform);
                console.log('Animation should be complete. Final filter:', window.getComputedStyle(heroName).filter);
            }, 1500);
        }, 500);

        // フォールバック: クラスが効かない場合の直接スタイル設定
        setTimeout(() => {
            if (window.getComputedStyle(heroName).opacity === '0') {
                console.log('Fallback: Applying styles directly');
                heroName.style.opacity = '1';
                heroName.style.transform = 'translateY(0) scale(1)';
                heroName.style.filter = 'blur(0px)';
                heroName.style.animation = 'heroFloat 4s ease-in-out infinite alternate, gradientFlow 6s ease-in-out infinite';
            }
        }, 2000);
    } else {
        console.error('Hero name element not found!');
    }

    // スキルバーのアニメーション
    const skillBars = document.querySelectorAll('.skill-bar');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const skillBar = entry.target;
                const level = skillBar.getAttribute('data-level');
                skillBar.style.setProperty('--skill-level', level + '%');
                skillBar.classList.add('animate');
            }
        });
    }, {
        threshold: 0.5
    });

    skillBars.forEach(bar => {
        observer.observe(bar);
    });
});
