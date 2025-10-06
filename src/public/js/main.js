// ポートフォリオサイトのメインJavaScript

document.addEventListener("DOMContentLoaded", function () {
    // スムーススクロール機能
    const navLinks = document.querySelectorAll('.nav-menu a[href^="#"]');

    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();

            const targetId = this.getAttribute("href");
            const targetElement = document.querySelector(targetId);

            if (targetElement) {
                const headerHeight =
                    document.querySelector(".header").offsetHeight;
                const targetPosition = targetElement.offsetTop - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: "smooth",
                });
            }
        });
    });

    // ナビゲーションのアクティブ状態管理
    const sections = document.querySelectorAll("section[id]");
    const navMenu = document.querySelector(".nav-menu");

    function updateActiveNav() {
        const scrollPosition = window.scrollY + 100;

        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            const sectionHeight = section.offsetHeight;
            const sectionId = section.getAttribute("id");
            const navLink = navMenu.querySelector(`a[href="#${sectionId}"]`);

            if (
                scrollPosition >= sectionTop &&
                scrollPosition < sectionTop + sectionHeight
            ) {
                // アクティブなリンクのスタイルを更新
                navMenu.querySelectorAll("a").forEach((link) => {
                    link.classList.remove("active");
                });
                if (navLink) {
                    navLink.classList.add("active");
                }
            }
        });
    }

    // スクロールイベントリスナー
    window.addEventListener("scroll", updateActiveNav);

    // 初期状態でアクティブなリンクを設定
    updateActiveNav();

    // // フォームの基本的なバリデーション
    // const contactForm = document.querySelector(".contact-form form");

    // if (contactForm) {
    //     contactForm.addEventListener("submit", function (e) {
    //         e.preventDefault();

    //         const formData = new FormData(this);
    //         const name = this.querySelector(
    //             'input[placeholder="ご氏名/会社名"]'
    //         ).value.trim();
    //         const email = this.querySelector(
    //             'input[placeholder="メールアドレス"]'
    //         ).value.trim();
    //         const message = this.querySelector(
    //             'textarea[placeholder="お問い合わせ内容"]'
    //         ).value.trim();

    //         // 基本的なバリデーション
    //         if (!name) {
    //             alert("お名前を入力してください。");
    //             return;
    //         }

    //         if (!email) {
    //             alert("メールアドレスを入力してください。");
    //             return;
    //         }

    //         if (!isValidEmail(email)) {
    //             alert("正しいメールアドレスを入力してください。");
    //             return;
    //         }

    //         if (!message) {
    //             alert("お問い合わせ内容を入力してください。");
    //             return;
    //         }

    //         // フォーム送信の処理（実際の実装ではここでサーバーに送信）
    //         alert("お問い合わせありがとうございます。内容を確認いたします。");
    //         this.reset();
    //     });
    // }

    // // メールアドレス形式チェック
    // function isValidEmail(email) {
    //     const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    //     return emailRegex.test(email);
    // }

    // スキルカテゴリのアニメーション（オプション）
    const skillItems = document.querySelectorAll(".skill-item");

    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    // スキルアイテムにアニメーション効果を適用
    skillItems.forEach((item, index) => {
        item.style.opacity = "0";
        item.style.transform = "translateY(20px)";
        item.style.transition = `opacity 0.6s ease ${
            index * 0.1
        }s, transform 0.6s ease ${index * 0.1}s`;
        observer.observe(item);
    });

    // レスポンシブ対応：メニューの切り替え（モバイル用）
    function initMobileMenu() {
        const nav = document.querySelector(".navigation");
        const navMenu = document.querySelector(".nav-menu");

        // モバイル用メニューボタンを作成
        const menuButton = document.createElement("button");
        menuButton.className = "mobile-menu-button";
        menuButton.innerHTML = "☰";
        menuButton.style.display = "none";
        menuButton.style.background = "none";
        menuButton.style.border = "none";
        menuButton.style.fontSize = "20px";
        menuButton.style.cursor = "pointer";

        nav.appendChild(menuButton);

        // メニューの表示/非表示切り替え
        menuButton.addEventListener("click", function () {
            navMenu.classList.toggle("mobile-menu-open");
        });

        // ウィンドウサイズ変更時の処理
        window.addEventListener("resize", function () {
            if (window.innerWidth <= 768) {
                menuButton.style.display = "block";
                navMenu.classList.add("mobile-menu");
            } else {
                menuButton.style.display = "none";
                navMenu.classList.remove("mobile-menu", "mobile-menu-open");
            }
        });

        // 初期状態の設定
        if (window.innerWidth <= 768) {
            menuButton.style.display = "block";
            navMenu.classList.add("mobile-menu");
        }
    }

    initMobileMenu();

    // ページ読み込み完了時の処理
    console.log("ポートフォリオサイトが正常に読み込まれました。");
});
