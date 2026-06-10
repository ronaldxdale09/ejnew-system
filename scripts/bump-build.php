#!/usr/bin/env php
<?php

/**
 * Increment the deployment build number.
 * Run this as part of every deploy, e.g.:
 *   php scripts/bump-build.php
 */

$root = dirname(__DIR__);
$buildFile = $root . DIRECTORY_SEPARATOR . 'BUILD';

$current = 1;
if (is_readable($buildFile)) {
    $raw = trim((string) file_get_contents($buildFile));
    if (preg_match('/^\d+$/', $raw) === 1) {
        $current = max(1, (int) $raw);
    }
}

$next = $current + 1;

if (file_put_contents($buildFile, $next . PHP_EOL, LOCK_EX) === false) {
    fwrite(STDERR, "Failed to write BUILD file.\n");
    exit(1);
}

$versionFile = $root . DIRECTORY_SEPARATOR . 'VERSION';
$version = is_readable($versionFile)
    ? trim((string) file_get_contents($versionFile))
    : '2.0.1';

fwrite(STDOUT, "Deployment build bumped to v{$version} · build {$next}\n");
