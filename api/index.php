<?php

// Force error display so blank white screen never happens on Vercel
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// Fix Vercel Serverless SCRIPT_NAME & REQUEST_URI routing
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

if (isset($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($uri === '/api/index.php' || $uri === '/api' || $uri === '/api/' || empty($uri)) {
        $_SERVER['REQUEST_URI'] = '/';
    } else if (str_starts_with($uri, '/api/index.php/')) {
        $_SERVER['REQUEST_URI'] = substr($uri, 14);
    }
}

// Prepare writable storage directory in /tmp for Vercel Serverless environment
$storagePath = '/tmp/storage';
$viewCompiledPath = $storagePath . '/framework/views';
$databaseTmpPath = '/tmp/database.sqlite';
$sqliteOriginal = __DIR__ . '/../database/database.sqlite';

$directories = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/cache/data',
    $storagePath . '/logs',
    $storagePath . '/app/public',
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Copy SQLite database to writable /tmp directory if file exists
if (!file_exists($databaseTmpPath) && file_exists($sqliteOriginal)) {
    copy($sqliteOriginal, $databaseTmpPath);
}

// Set storage & view compile paths
putenv("APP_STORAGE={$storagePath}");
$_ENV['APP_STORAGE'] = $storagePath;
$_SERVER['APP_STORAGE'] = $storagePath;

putenv("VIEW_COMPILED_PATH={$viewCompiledPath}");
$_ENV['VIEW_COMPILED_PATH'] = $viewCompiledPath;
$_SERVER['VIEW_COMPILED_PATH'] = $viewCompiledPath;

// Force APP_DEBUG=true for troubleshooting
putenv("APP_DEBUG=true");
$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';

// Fallback APP_KEY if missing in environment variables
$currentAppKey = $_ENV['APP_KEY'] ?? getenv('APP_KEY');
if (empty($currentAppKey)) {
    $defaultKey = 'base64:n+5Zn+lWscc86aiTyMSeDHKzG6dEebWrSpIx5Z3iXfo=';
    putenv("APP_KEY={$defaultKey}");
    $_ENV['APP_KEY'] = $defaultKey;
    $_SERVER['APP_KEY'] = $defaultKey;
}

// Force SQLite connection fallback if DB_HOST is invalid or infinityfree
$dbHost = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
if (empty($_ENV['DB_CONNECTION']) || $_ENV['DB_CONNECTION'] === 'sqlite' || str_contains((string)$dbHost, 'infinityfree')) {
    putenv("DB_CONNECTION=sqlite");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';

    putenv("DB_DATABASE={$databaseTmpPath}");
    $_ENV['DB_DATABASE'] = $databaseTmpPath;
    $_SERVER['DB_DATABASE'] = $databaseTmpPath;
}

// Load normal Laravel entrypoint
require __DIR__ . '/../public/index.php';
