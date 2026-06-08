<?php
/**
 * Database environment detection and credentials.
 *
 * Automatically uses local (XAMPP) or production settings based on where
 * the app is running. No manual commenting/uncommenting required.
 *
 * Override priority (highest first):
 *   1. EJN_APP_ENV environment variable ("local" or "production")
 *   2. function/db.local.php (copy from db.local.php.example, gitignored)
 *   3. HTTP host detection (see ejn_get_production_hosts / ejn_get_local_hosts)
 *   4. CLI defaults to local
 *
 * Production site: https://en-rubber.online/
 */

if (!function_exists('ejn_normalize_host')) {
    function ejn_normalize_host(): string
    {
        $host = $_SERVER['HTTP_HOST'] ?? $_SERVER['SERVER_NAME'] ?? '';
        return strtolower(preg_replace('/:\d+$/', '', $host));
    }
}

if (!function_exists('ejn_get_production_hosts')) {
    function ejn_get_production_hosts(): array
    {
        return [
            'en-rubber.online',
            'www.en-rubber.online',
        ];
    }
}

if (!function_exists('ejn_get_local_hosts')) {
    function ejn_get_local_hosts(): array
    {
        return ['localhost', '127.0.0.1', '[::1]'];
    }
}

if (!function_exists('ejn_detect_environment')) {
    function ejn_detect_environment(): string
    {
        $forced = getenv('EJN_APP_ENV');
        if ($forced === 'local' || $forced === 'production') {
            return $forced;
        }

        $localFile = __DIR__ . '/db.local.php';
        if (is_file($localFile)) {
            $local = require $localFile;
            if (is_array($local) && !empty($local['environment'])) {
                $env = $local['environment'];
                if ($env === 'local' || $env === 'production') {
                    return $env;
                }
            }
        }

        if (PHP_SAPI === 'cli') {
            return 'local';
        }

        $host = ejn_normalize_host();

        if (in_array($host, ejn_get_local_hosts(), true)) {
            return 'local';
        }

        if (in_array($host, ejn_get_production_hosts(), true)) {
            return 'production';
        }

        if ($host !== '' && preg_match('/\.(local|test)$/', $host)) {
            return 'local';
        }

        // Any other public host (staging subdomain, etc.) uses production DB
        return 'production';
    }
}

if (!function_exists('ejn_get_db_config')) {
    function ejn_get_db_config(): array
    {
        static $config = null;
        if ($config !== null) {
            return $config;
        }

        $profiles = [
            'local' => [
                'host' => 'localhost',
                'user' => 'root',
                'pass' => '',
                'name' => 'ejn_db',
            ],
            'production' => [
                'host' => 'localhost',
                'user' => 'u607598273_ejn',
                'pass' => 'qBrj7QcA;9',
                'name' => 'u607598273_ejn_db',
            ],
        ];

        $environment = ejn_detect_environment();
        $config = $profiles[$environment] ?? $profiles['production'];
        $config['environment'] = $environment;

        $localFile = __DIR__ . '/db.local.php';
        if (is_file($localFile)) {
            $overrides = require $localFile;
            if (is_array($overrides)) {
                unset($overrides['environment']);
                $config = array_merge($config, array_filter(
                    $overrides,
                    static fn($value) => $value !== null && $value !== ''
                ));
            }
        }

        return $config;
    }
}

if (!function_exists('ejn_create_connection')) {
    /**
     * @return mysqli|false
     */
    function ejn_create_connection(bool $required = true)
    {
        $db = ejn_get_db_config();
        $timeout = 5;

        ini_set('default_socket_timeout', (string) $timeout);

        $con = @mysqli_connect($db['host'], $db['user'], $db['pass'], $db['name']);

        if (!$con || mysqli_connect_errno()) {
            error_log(
                'Database connection failed [' . $db['environment'] . ']: ' . mysqli_connect_error()
            );

            if ($required) {
                if (PHP_SAPI !== 'cli') {
                    http_response_code(503);
                }
                exit('Database connection failed. Please try again later.');
            }

            return false;
        }

        mysqli_set_charset($con, 'utf8mb4');
        @mysqli_query($con, 'SET SESSION wait_timeout=300');
        @mysqli_query($con, 'SET SESSION interactive_timeout=300');

        return $con;
    }
}
