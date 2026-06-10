<?php

/**
 * Application version helpers.
 *
 * Semantic version lives in /VERSION (e.g. 2.0.1).
 * Build number lives in /BUILD and should be incremented on each deployment
 * via: php scripts/bump-build.php
 */

function ejn_version_root(): string
{
    static $root = null;
    if ($root === null) {
        $root = dirname(__DIR__);
    }

    return $root;
}

function ejn_read_version_file(string $filename, string $default = ''): string
{
    $path = ejn_version_root() . DIRECTORY_SEPARATOR . $filename;
    if (!is_readable($path)) {
        return $default;
    }

    $value = trim((string) file_get_contents($path));
    return $value !== '' ? $value : $default;
}

function ejn_app_version(): string
{
    return ejn_read_version_file('VERSION', '2.0.1');
}

function ejn_app_build(): int
{
    $raw = ejn_read_version_file('BUILD', '1');
    if (preg_match('/^\d+$/', $raw) !== 1) {
        return 1;
    }

    return max(1, (int) $raw);
}

function ejn_app_version_label(): string
{
    return 'v' . ejn_app_version() . ' · build ' . ejn_app_build();
}
