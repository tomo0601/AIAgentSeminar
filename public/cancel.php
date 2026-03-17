<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>決済キャンセル - <?php echo PRODUCT_NAME; ?></title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .cancel-box {
            max-width: 600px;
            margin: var(--space-xl) auto;
            text-align: center;
            padding: var(--space-md);
        }
    </style>
</head>
<body>
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
    </div>

    <div class="cancel-box glass-card fade-up is-visible">
        <h1 class="heading-md">決済が取り消されました</h1>
        <p class="text-lead">決済の手続きが中断されました。お支払いは発生していません。</p>
        <p>お申し込みを継続される場合は、再度フォームからお手続きをお願いいたします。</p>
        <div style="margin-top: 3rem;">
            <a href="apply.php" class="cta-btn">申し込みフォームに戻る</a>
        </div>
    </div>
</body>
</html>
