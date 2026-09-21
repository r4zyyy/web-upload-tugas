<?php

/**
 * Vercel Serverless PHP Entry Point for Laravel
 * 
 * This file bootstraps Laravel in a serverless environment where
 * the filesystem is read-only except for /tmp.
 */

// Show errors instead of blank white page
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

// ─── Fix Vercel SCRIPT_NAME / REQUEST_URI ───
$_SERVER['SCRIPT_NAME'] = '/index.php';
$_SERVER['SCRIPT_FILENAME'] = __DIR__ . '/../public/index.php';

if (isset($_SERVER['REQUEST_URI'])) {
    $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    if ($uri === '/api/index.php' || $uri === '/api' || $uri === '/api/' || empty($uri)) {
        $_SERVER['REQUEST_URI'] = '/';
    } elseif (str_starts_with($uri, '/api/index.php/')) {
        $_SERVER['REQUEST_URI'] = substr($uri, 14);
    }
}

// ─── Prepare writable /tmp directories ───
$storagePath = '/tmp/storage';
$bootstrapCachePath = '/tmp/bootstrap-cache';

$directories = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/sessions',
    $storagePath . '/framework/cache/data',
    $storagePath . '/logs',
    $storagePath . '/app/public',
    $bootstrapCachePath,
];

foreach ($directories as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// ─── Copy SQLite database to writable /tmp ───
$databaseTmpPath = '/tmp/database.sqlite';
$sqliteOriginal = __DIR__ . '/../database/database.sqlite';

if (!file_exists($databaseTmpPath) && file_exists($sqliteOriginal)) {
    copy($sqliteOriginal, $databaseTmpPath);
}

// ─── Set environment variables for Laravel ───

// Storage path → /tmp/storage
putenv("APP_STORAGE={$storagePath}");
$_ENV['APP_STORAGE'] = $storagePath;
$_SERVER['APP_STORAGE'] = $storagePath;

// View compiled path → /tmp/storage/framework/views
$viewCompiledPath = $storagePath . '/framework/views';
putenv("VIEW_COMPILED_PATH={$viewCompiledPath}");
$_ENV['VIEW_COMPILED_PATH'] = $viewCompiledPath;
$_SERVER['VIEW_COMPILED_PATH'] = $viewCompiledPath;

// Bootstrap cache paths → /tmp/bootstrap-cache
putenv("APP_CONFIG_CACHE={$bootstrapCachePath}/config.php");
$_ENV['APP_CONFIG_CACHE'] = "{$bootstrapCachePath}/config.php";

putenv("APP_SERVICES_CACHE={$bootstrapCachePath}/services.php");
$_ENV['APP_SERVICES_CACHE'] = "{$bootstrapCachePath}/services.php";

putenv("APP_PACKAGES_CACHE={$bootstrapCachePath}/packages.php");
$_ENV['APP_PACKAGES_CACHE'] = "{$bootstrapCachePath}/packages.php";

putenv("APP_ROUTES_CACHE={$bootstrapCachePath}/routes-v7.php");
$_ENV['APP_ROUTES_CACHE'] = "{$bootstrapCachePath}/routes-v7.php";

putenv("APP_EVENTS_CACHE={$bootstrapCachePath}/events.php");
$_ENV['APP_EVENTS_CACHE'] = "{$bootstrapCachePath}/events.php";

// Debug on for troubleshooting
putenv("APP_DEBUG=true");
$_ENV['APP_DEBUG'] = 'true';
$_SERVER['APP_DEBUG'] = 'true';

// Fallback APP_KEY
$currentAppKey = $_ENV['APP_KEY'] ?? getenv('APP_KEY');
if (empty($currentAppKey)) {
    $defaultKey = 'base64:n+5Zn+lWscc86aiTyMSeDHKzG6dEebWrSpIx5Z3iXfo=';
    putenv("APP_KEY={$defaultKey}");
    $_ENV['APP_KEY'] = $defaultKey;
    $_SERVER['APP_KEY'] = $defaultKey;
}

// Force SQLite if no proper DB configured
$dbHost = $_ENV['DB_HOST'] ?? getenv('DB_HOST');
if (empty($_ENV['DB_CONNECTION']) || $_ENV['DB_CONNECTION'] === 'sqlite' || str_contains((string)$dbHost, 'infinityfree')) {
    putenv("DB_CONNECTION=sqlite");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';

    putenv("DB_DATABASE={$databaseTmpPath}");
    $_ENV['DB_DATABASE'] = $databaseTmpPath;
    $_SERVER['DB_DATABASE'] = $databaseTmpPath;
}

// Session driver = file (stored in /tmp)
putenv("SESSION_DRIVER=file");
$_ENV['SESSION_DRIVER'] = 'file';
$_SERVER['SESSION_DRIVER'] = 'file';

// ─── Set ALL driver defaults (since .env is not on Vercel) ───
$defaults = [
    'APP_NAME'              => 'Pengembangan Aplikasi Web',
    'APP_ENV'               => 'production',
    'APP_URL'               => $_ENV['APP_URL'] ?? 'https://web-upload-tugas.vercel.app',
    'APP_MAINTENANCE_DRIVER'=> 'file',
    'APP_MAINTENANCE_STORE' => 'database',
    'CACHE_STORE'           => 'file',
    'QUEUE_CONNECTION'      => 'sync',
    'BROADCAST_CONNECTION'  => 'log',
    'FILESYSTEM_DISK'       => 'local',
    'MAIL_MAILER'           => 'log',
    'LOG_CHANNEL'           => 'single',
    'LOG_LEVEL'             => 'debug',
    'SESSION_LIFETIME'      => '120',
    'SESSION_ENCRYPT'       => 'false',
    'SESSION_PATH'          => '/',
    'SESSION_DOMAIN'        => '',
];

foreach ($defaults as $key => $value) {
    $curr = getenv($key);
    if ($curr === false || trim((string)$curr) === '' || empty($_ENV[$key])) {
        putenv("{$key}={$value}");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}

// ─── Load Laravel ───
require __DIR__ . '/../public/index.php';

