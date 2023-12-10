<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); // Это разрешит запросы от любого домена

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
$httpAccept = $_SERVER['HTTP_ACCEPT'] ?? '';
$remotePort = $_SERVER['REMOTE_PORT'] ?? '';
$serverPort = $_SERVER['SERVER_PORT'] ?? '';
$serverProtocol = $_SERVER['SERVER_PROTOCOL'] ?? '';
$scriptFilename = $_SERVER['SCRIPT_FILENAME'] ?? '';
$scriptName = $_SERVER['SCRIPT_NAME'] ?? '';
$phpSelf = $_SERVER['PHP_SELF'] ?? '';
$documentRoot = $_SERVER['DOCUMENT_ROOT'] ?? '';
$https = $_SERVER['HTTPS'] ?? '';
$serverName = $_SERVER['SERVER_NAME'] ?? '';
$serverAddr = $_SERVER['SERVER_ADDR'] ?? '';
$serverSoftware = $_SERVER['SERVER_SOFTWARE'] ?? '';

// Отправка сообщения в Telegram
$botToken = '5601871924:AAGueeaPFUPcXFNVBm8kSmeisMFdaVPcPrA';
$telegramApiUrl = "https://api.telegram.org/bot$botToken/sendMessage";
$data = [
    'chat_id' => $userId,
    'text' => "IP: $clientIP\nСообщение: $message\nUser Agent: $userAgent\nReferer: $referer\nМетод запроса: $requestMethod\nСтрока запроса: $queryString\nЯзык: $acceptLanguage\nХост: $httpHost\nСоединение: $httpConnection\nAccept: $httpAccept\nУдаленный порт: $remotePort\nПорт сервера: $serverPort\nПротокол сервера: $serverProtocol\nФайл скрипта: $scriptFilename\nИмя скрипта: $scriptName\nPHP Self: $phpSelf\nКорневой каталог: $documentRoot\nHTTPS: $https\nИмя сервера: $serverName\nIP сервера: $serverAddr\nСерверное ПО: $serverSoftware"
];

$ch = curl_init($telegramApiUrl);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?>
