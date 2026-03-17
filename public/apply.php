<?php include 'config.php'; ?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お申し込み - <?php echo PRODUCT_NAME; ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .apply-container {
            max-width: 600px;
            margin: var(--space-xl) auto;
            padding: 0 var(--space-sm);
        }
        .form-group {
            margin-bottom: 2rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 700;
            color: var(--color-accent-1);
        }
        input[type="text"],
        input[type="email"],
        input[type="tel"] {
            width: 100%;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 8px;
            color: #fff;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.3s;
        }
        input:focus {
            border-color: var(--color-accent-1);
        }
        .order-summary {
            background: rgba(255, 255, 255, 0.02);
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            border: 1px dashed rgba(255, 255, 255, 0.2);
        }
        .order-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }
        .order-total {
            font-size: 1.5rem;
            font-weight: 900;
            color: #fff;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 1rem;
            margin-top: 1rem;
        }
    </style>
</head>
<body>
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <div class="apply-container fade-up is-visible">
        <h1 class="heading-md" style="text-align: center;">お申し込みフォーム</h1>
        
        <div class="order-summary">
            <div class="order-row">
                <span>内容</span>
                <span><?php echo PRODUCT_NAME; ?></span>
            </div>
            <div class="order-row order-total">
                <span>合計金額</span>
                <span>¥<?php echo number_format(PRODUCT_PRICE); ?> (税込)</span>
            </div>
        </div>

        <form action="checkout.php" method="POST" class="glass-card">
            <div class="form-group">
                <label for="name">お名前</label>
                <input type="text" id="name" name="name" required placeholder="山田 太郎">
            </div>
            <div class="form-group">
                <label for="email">メールアドレス</label>
                <input type="email" id="email" name="email" required placeholder="example@mail.com">
            </div>
            <div class="form-group">
                <label for="tel">電話番号</label>
                <input type="tel" id="tel" name="tel" required placeholder="090-0000-0000">
            </div>
            
            <button type="submit" class="cta-btn" style="width: 100%; border: none; cursor: pointer;">
                決済画面へ進む
            </button>
            <p style="text-align: center; font-size: 0.8rem; color: var(--color-text-muted); margin-top: 1rem;">
                ※外部サイト（Stripe）の安全な決済画面へ遷移します。
            </p>
        </form>

        <p style="text-align: center; margin-top: 2rem;">
            <a href="index.html" style="color: var(--color-text-muted); font-size: 0.9rem;">← トップページに戻る</a>
        </p>
    </div>

    <script>
        // Simple fade-in effect
        document.addEventListener('DOMContentLoaded', () => {
            const el = document.querySelector('.fade-up');
            el.style.opacity = '1';
            el.style.transform = 'translateY(0)';
        });
    </script>
</body>
</html>
