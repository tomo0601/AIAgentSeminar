<?php
require_once 'config.php';

// お申し込みデータの取得
$name  = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$tel   = isset($_POST['tel']) ? $_POST['tel'] : '';

if (empty($name) || empty($email) || empty($tel)) {
    header('Location: apply.php');
    exit;
}

/**
 * Stripe 決済セッションの作成
 * 本来は composer require stripe/stripe-php が必要ですが、
 * 簡易的なcURL実装、またはスクリプトタグ方式がありますが、
 * XServer環境での確実性を期すため、ここでは公式ライブラリと同様のcURLリクエストを行います。
 */

function create_stripe_session($email, $name, $tel) {
    $url = "https://api.stripe.com/v1/checkout/sessions";
    $api_key = STRIPE_SECRET_KEY;

    $params = [
        'payment_method_types[]' => 'card',
        'line_items[0][price_data][currency]' => CURRENCY,
        'line_items[0][price_data][product_data][name]' => PRODUCT_NAME,
        'line_items[0][price_data][unit_amount]' => PRODUCT_PRICE,
        'line_items[0][quantity]' => 1,
        'mode' => 'payment',
        'success_url' => BASE_URL . '/success.php?session_id={CHECKOUT_SESSION_ID}&name=' . urlencode($name) . '&email=' . urlencode($email) . '&tel=' . urlencode($tel),
        'cancel_url' => BASE_URL . '/cancel.php',
        'customer_email' => $email,
        // カスタムデータに名前と電話番号を保持（後でメール送信に使用）
        'payment_intent_data[metadata][name]' => $name,
        'payment_intent_data[metadata][tel]' => $tel,
    ];

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
    curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':');

    $response = curl_exec($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($http_code !== 200) {
        return ['error' => 'Stripe API Error: ' . $response];
    }

    return json_decode($response, true);
}

$session = create_stripe_session($email, $name, $tel);

if (isset($session['id'])) {
    header('Location: ' . $session['url']);
} else {
    echo "決済エラーが発生しました。申し訳ございませんが、事務局までお問い合わせください。<br>";
    echo "エラー詳細: " . (isset($session['error']) ? $session['error'] : 'Unknown Error');
}
exit;
