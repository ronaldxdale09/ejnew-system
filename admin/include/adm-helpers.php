<?php
/**
 * Admin UI helpers — include via header.php
 */

if (!function_exists('adm_esc')) {
    function adm_esc($value): string
    {
        return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
    }
}

if (!function_exists('adm_peso')) {
    function adm_peso($amount, int $decimals = 0): string
    {
        return '₱' . number_format((float) $amount, $decimals, '.', ',');
    }
}

if (!function_exists('adm_page_header')) {
    function adm_page_header(string $title, string $subtitle = '', array $badges = []): void
    {
        echo '<header class="adm-page-header">';
        echo '<h1>' . adm_esc($title) . '</h1>';
        if ($subtitle !== '') {
            echo '<p>' . adm_esc($subtitle) . '</p>';
        }
        if (!empty($badges)) {
            echo '<div class="adm-page-badges">';
            foreach ($badges as $badge) {
                echo '<span class="adm-section__badge">' . adm_esc($badge) . '</span>';
            }
            echo '</div>';
        }
        echo '</header>';
    }
}

if (!function_exists('adm_kpi_strip')) {
    /** @param array<int, array{label:string,value:string,sub?:string,variant?:string}> $items */
    function adm_kpi_strip(array $items): void
    {
        echo '<div class="adm-kpi-grid adm-kpi-grid--strip">';
        foreach ($items as $item) {
            $variant = $item['variant'] ?? '';
            $class = $variant ? ' adm-kpi--' . $variant : '';
            echo '<div class="adm-kpi' . $class . '">';
            echo '<div class="adm-kpi__label">' . adm_esc($item['label']) . '</div>';
            echo '<div class="adm-kpi__value">' . $item['value'] . '</div>';
            if (!empty($item['sub'])) {
                echo '<div class="adm-kpi__sub">' . adm_esc($item['sub']) . '</div>';
            }
            echo '</div>';
        }
        echo '</div>';
    }
}

if (!function_exists('adm_panel_open')) {
    function adm_panel_open(string $title = '', string $extraClass = ''): void
    {
        echo '<div class="adm-card' . ($extraClass ? ' ' . $extraClass : '') . '">';
        if ($title !== '') {
            echo '<div class="adm-card__head"><h3>' . adm_esc($title) . '</h3></div>';
        }
        echo '<div class="adm-card__body">';
    }
}

if (!function_exists('adm_panel_close')) {
    function adm_panel_close(): void
    {
        echo '</div></div>';
    }
}
