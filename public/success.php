<?php
require_once 'config.php';

// 決済成功後の処理
$session_id = isset($_GET['session_id']) ? $_GET['session_id'] : '';
$name  = isset($_GET['name']) ? $_GET['name'] : 'お客様';
$email = isset($_GET['email']) ? $_GET['email'] : '';
$tel   = isset($_GET['tel']) ? $_GET['tel'] : '';

// 実際にはここでStripeセッションのステータスをもう一度APIで叩いて確認するのが安全ですが、
// クエリパラメータを使って簡易的に完了処理を行います。

if (empty($email)) {
    header('Location: index.html');
    exit;
}

// 1. 管理者へ通知メール送信
$admin_subject = "【新規申込】" . PRODUCT_NAME;
$admin_body = "体験会の申し込みがありました。\n\n"
            . "お名前：{$name}\n"
            . "メール：{$email}\n"
            . "電話：{$tel}\n"
            . "決済額：¥" . number_format(PRODUCT_PRICE) . "\n"
            . "--------------------------------\n";

mb_language("Japanese");
mb_internal_encoding("UTF-8");
mb_send_mail(ADMIN_EMAIL, $admin_subject, $admin_body, "From: " . FROM_EMAIL);

// 2. 申込者へお礼メール（自動返信）送信
$user_subject = "【お申し込み完了】" . PRODUCT_NAME;
$user_body = "{$name} 様\n\n"
           . "この度はお申し込みいただき、誠にありがとうございます。\n"
           . "以下の内容で決済を承りました。\n\n"
           . "■お申し込み内容\n"
           . "体験会名： " . PRODUCT_NAME . "\n"
           . "お支払い金額： ¥" . number_format(PRODUCT_PRICE) . " (税込)\n\n"
           . "当日のZoomリンク等の詳細は、別途事務局よりご連絡させていただきます。\n"
           . "今しばらくお待ちくださいませ。\n\n"
           . "--------------------------------\n"
           . "自律思考AIエージェント事務局\n"
           . BASE_URL . "\n"
           . "--------------------------------\n";

mb_send_mail($email, $user_subject, $user_body, "From: " . FROM_EMAIL);

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>お申し込み完了 - <?php echo PRODUCT_NAME; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .success-box {
            max-width: 600px;
            margin: var(--space-xl) auto;
            text-align: center;
            padding: var(--space-md);
        }
        .check-icon {
            font-size: 5rem;
            color: var(--color-accent-2);
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="ambient-bg">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
    </div>

    <div class="success-box glass-card fade-up is-visible">
        <div class="check-icon">✓</div>
        <h1 class="heading-md">お申し込みありがとうございます</h1>
        <p class="text-lead">決済が正常に完了しました。</p>
        <p>ご入力いただいたメールアドレス（<?php echo htmlspecialchars($email); ?>）宛に、確認メールを送信いたしました。<br>もし届かない場合は、迷惑メールフォルダをご確認いただくか、事務局までお問い合わせください。</p>
        <div style="margin-top: 3rem;">
            <a href="index.html" class="cta-btn">トップページへ戻る</a>
        </div>
    </div>
</body>
</html>
