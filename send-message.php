<?php
header('Content-Type: application/json');

$userId = $_POST['userId'];
$message = $_POST['message'];
$clientIP = isset($_SERVER['HTTP_X_FORWARDED_FOR']) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR'];
$userAgent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$referer = $_SERVER['HTTP_REFERER'] ?? '';
$requestMethod = $_SERVER['REQUEST_METHOD'] ?? '';
$queryString = $_SERVER['QUERY_STRING'] ?? '';
$acceptLanguage = $_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? '';
$httpHost = $_SERVER['HTTP_HOST'] ?? '';
$httpConnection = $_SERVER['HTTP_CONNECTION'] ?? '';

// Отправка сообщения на Telegram
$botToken = '5601871924:AAGueeaPFUPcXFNVBm8kSmeisMFdaVPcPrA';
$telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $userId,
    'text' => "IP: $clientIP\nMessage: $message\nUser Agent: $userAgent\nReferer: $referer\nRequest Method: $requestMethod\nQuery String: $queryString\nAccept Language: $acceptLanguage\nHTTP Host: $httpHost\nHTTP Connection: $httpConnection"
];

$ch = curl_init($telegramApiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
