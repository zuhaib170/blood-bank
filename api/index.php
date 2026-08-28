<?php

$requestedPath = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH);
$requestedFile = basename($requestedPath ?: 'home.php');

if ($requestedFile === '' || $requestedFile === 'index.php') {
    $requestedFile = 'home.php';
}

$projectRoot = dirname(__DIR__);
$pagePath = $projectRoot . DIRECTORY_SEPARATOR . $requestedFile;

if (pathinfo($requestedFile, PATHINFO_EXTENSION) !== 'php' || !is_file($pagePath)) {
    http_response_code(404);
    echo 'Not found';
    exit;
}

chdir($projectRoot);
require $pagePath;