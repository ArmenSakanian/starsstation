<?php
declare(strict_types=1);

function loadEnvFile(string $path): void
{
    if (!is_file($path)) {
        return;
    }

    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    if ($lines === false) {
        return;
    }

    foreach ($lines as $line) {
        $line = trim($line);
        if ($line === '' || str_starts_with($line, '#') || !str_contains($line, '=')) {
            continue;
        }

        [$key, $value] = array_map('trim', explode('=', $line, 2));
        if ($key === '') {
            continue;
        }

        if (strlen($value) >= 2) {
            $first = $value[0];
            $last = $value[strlen($value) - 1];
            if (($first === '"' && $last === '"') || ($first === "'" && $last === "'")) {
                $value = substr($value, 1, -1);
            }
        }

        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
        putenv($key . '=' . $value);
    }
}

loadEnvFile(dirname(__DIR__) . '/.env');

function envValue(string $key, ?string $default = null): ?string
{
    $value = $_ENV[$key] ?? $_SERVER[$key] ?? getenv($key);
    if ($value === false || $value === null || $value === '') {
        return $default;
    }
    return (string) $value;
}

function envBool(string $key, bool $default = false): bool
{
    $value = strtolower((string) envValue($key, $default ? 'true' : 'false'));
    return in_array($value, ['1', 'true', 'yes', 'on'], true);
}

function jsonResponse(array $payload, int $status = 200): never
{
    http_response_code($status);
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store');
    echo json_encode($payload, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    exit;
}

function startAppSession(): void
{
    if (session_status() === PHP_SESSION_ACTIVE) {
        return;
    }

    $secure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off');
    session_set_cookie_params([
        'httponly' => true,
        'secure' => $secure,
        'samesite' => 'Lax',
        'path' => '/',
    ]);
    session_start();
}

function csrfToken(): string
{
    startAppSession();
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function verifyCsrf(?string $token): bool
{
    startAppSession();
    return is_string($token)
        && isset($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

function database(): mysqli
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    $host = envValue('DB_HOST', 'localhost');
    $port = (int) envValue('DB_PORT', '3306');
    $name = envValue('DB_DATABASE', 'starsstation');
    $user = envValue('DB_USERNAME');
    $password = envValue('DB_PASSWORD');
    $charset = envValue('DB_CHARSET', 'utf8mb4');

    if (!$user || $password === null) {
        throw new RuntimeException('Database credentials are not configured.');
    }

    $db = new mysqli($host, $user, $password, $name, $port);
    $db->set_charset($charset);
    return $db;
}

function textLength(string $value): int
{
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

function requestRateLimited(string $key, int $seconds): bool
{
    startAppSession();
    $now = time();
    $last = (int) ($_SESSION['rate_limit'][$key] ?? 0);
    if ($last > 0 && ($now - $last) < $seconds) {
        return true;
    }
    $_SESSION['rate_limit'][$key] = $now;
    return false;
}

function safePublicBaseUrl(): string
{
    return rtrim((string) envValue('APP_URL', 'https://starsstation.ch'), '/');
}
