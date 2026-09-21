<?php

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

// If DB_CONNECTION is not set or set to infinityfree host which fails, default to bundled SQLite
$dbHost = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
if (empty($_ENV['DB_CONNECTION']) || $_ENV['DB_CONNECTION'] === 'sqlite' || str_contains($dbHost, 'infinityfree')) {
    putenv("DB_CONNECTION=sqlite");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';

    putenv("DB_DATABASE={$databaseTmpPath}");
    $_ENV['DB_DATABASE'] = $databaseTmpPath;
    $_SERVER['DB_DATABASE'] = $databaseTmpPath;
}

// Load normal Laravel entrypoint
require __DIR__ . '/../public/index.php';
