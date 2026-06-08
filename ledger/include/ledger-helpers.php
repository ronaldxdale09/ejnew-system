<?php
/**
 * Ledger UI helpers — shared with admin design tokens
 */
require_once __DIR__ . '/../../admin/include/adm-helpers.php';

if (!function_exists('ledger_nav_active')) {
    function ledger_nav_active($pages, string $currentPage): string
    {
        $pages = (array) $pages;
        return in_array($currentPage, $pages, true) ? ' active' : '';
    }
}

if (!function_exists('ledger_nav_open')) {
    function ledger_nav_open(array $pages, string $currentPage): string
    {
        return in_array($currentPage, $pages, true) ? ' open' : '';
    }
}

function ledger_shell_open(string $title, string $subtitle = '', array $badges = []): void
{
    echo '<div class="main-content admin-page ledger-page">';
    adm_page_header($title, $subtitle, $badges);
}

function ledger_shell_close(): void
{
    echo '</div></body></html>';
}

if (!function_exists('ledger_require_location')) {
    function ledger_require_location(): string
    {
        if (empty($_SESSION['loc'])) {
            header('Location: function/logout.php');
            exit();
        }
        return (string) $_SESSION['loc'];
    }
}

if (!function_exists('ledger_is_zamboanga')) {
    function ledger_is_zamboanga(?string $loc = null): bool
    {
        $loc = $loc ?? ($_SESSION['loc'] ?? '');
        return strcasecmp(trim(str_replace(' ', '', $loc)), 'Zamboanga') === 0;
    }
}
