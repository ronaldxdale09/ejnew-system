<?php
/**
 * Operations section pages — shared layout helpers.
 */

if (!function_exists('adm_ops_pages')) {
    function adm_ops_pages(): array
    {
        return [
            'plant_basilan_recording.php',
            'plant_kid_recording.php',
            'inv_bale.php',
            'bale_record.php',
            'bale_sale_record.php',
            'container_record.php',
            'bale_shipment_record.php',
            'inv_cuplump.php',
            'cuplump_sale_record.php',
            'cuplump_container_record.php',
            'cuplump_shipment_record.php',
            'coffee_list.php',
            'coffee_production.php',
            'coffee_sale_record.php',
        ];
    }
}

if (!function_exists('adm_ops_meta')) {
    function adm_ops_meta(): array
    {
        return [
            'plant_basilan_recording.php' => [
                'title' => 'Basilan Plant Recording',
                'subtitle' => 'Rubber processing pipeline — receiving through bale production.',
                'badges' => ['Basilan', 'Operations'],
            ],
            'plant_kid_recording.php' => [
                'title' => 'Kidapawan Plant Recording',
                'subtitle' => 'Rubber processing pipeline — receiving through bale production.',
                'badges' => ['Kidapawan', 'Operations'],
            ],
            'inv_bale.php' => [
                'title' => 'Bales Inventory',
                'subtitle' => 'Finished bale stock by location — Basilan and Kidapawan.',
                'badges' => ['Bales'],
            ],
            'bale_record.php' => [
                'title' => 'Bales Production Records',
                'subtitle' => 'Historical bale production and inventory by location.',
                'badges' => ['Bales'],
            ],
            'bale_sale_record.php' => [
                'title' => 'Bales Sales',
                'subtitle' => 'Sale contracts, payments, balances, and profit tracking.',
                'badges' => ['Bales', 'Sales'],
            ],
            'container_record.php' => [
                'title' => 'Bales Container Records',
                'subtitle' => 'Container loading, weights, and shipment preparation.',
                'badges' => ['Bales'],
            ],
            'bale_shipment_record.php' => [
                'title' => 'Bales Shipment Records',
                'subtitle' => 'Outbound shipment tracking and documentation.',
                'badges' => ['Bales'],
            ],
            'inv_cuplump.php' => [
                'title' => 'Cuplump Field Inventory',
                'subtitle' => 'Field stock levels across plantation locations.',
                'badges' => ['Cuplump'],
            ],
            'cuplump_sale_record.php' => [
                'title' => 'Cuplump Sales',
                'subtitle' => 'Cuplump sale contracts, receivables, and revenue.',
                'badges' => ['Cuplump', 'Sales'],
            ],
            'cuplump_container_record.php' => [
                'title' => 'Cuplump Container Records',
                'subtitle' => 'Container loading for cuplump exports.',
                'badges' => ['Cuplump'],
            ],
            'cuplump_shipment_record.php' => [
                'title' => 'Cuplump Shipment Records',
                'subtitle' => 'Cuplump shipment tracking and status.',
                'badges' => ['Cuplump'],
            ],
            'coffee_list.php' => [
                'title' => 'Coffee Inventory',
                'subtitle' => 'Product catalog, stock levels, and inventory value.',
                'badges' => ['Coffee'],
            ],
            'coffee_production.php' => [
                'title' => 'Coffee Production',
                'subtitle' => 'Production batches and output tracking.',
                'badges' => ['Coffee'],
            ],
            'coffee_sale_record.php' => [
                'title' => 'Coffee Sales',
                'subtitle' => 'Coffee sale transactions and customer records.',
                'badges' => ['Coffee', 'Sales'],
            ],
        ];
    }
}

if (!function_exists('adm_is_ops_page')) {
    function adm_is_ops_page(?string $page = null): bool
    {
        $page = $page ?? basename($_SERVER['PHP_SELF'] ?? '');
        return in_array($page, adm_ops_pages(), true);
    }
}

if (!function_exists('adm_ops_shell_open')) {
    function adm_ops_shell_open(?string $title = null, string $subtitle = '', array $badges = []): void
    {
        $page = basename($_SERVER['PHP_SELF'] ?? '');
        $meta = adm_ops_meta()[$page] ?? null;

        if ($title === null && $meta) {
            $title = $meta['title'];
            $subtitle = $meta['subtitle'];
            $badges = $meta['badges'];
        }

        echo '<div class="main-content admin-page ops-page">';
        if ($title !== null && $title !== '') {
            adm_page_header($title, $subtitle, $badges);
        }
    }
}

if (!function_exists('adm_ops_shell_close')) {
    function adm_ops_shell_close(): void
    {
        echo '</div>';
    }
}

if (!function_exists('adm_nav_group_open')) {
    function adm_nav_group_open(array $pages, string $currentPage): string
    {
        return in_array($currentPage, $pages, true) ? ' open' : '';
    }
}

/**
 * Shared segmented tab bar for operations pages.
 *
 * @param array<int, array{id:string, label:string, icon?:string, badge?:string|int, panel:string}> $tabs
 */
if (!function_exists('adm_ops_tabs_open')) {
    function adm_ops_tabs_open(string $groupId, array $tabs, ?string $activeTabId = null, string $navLabel = 'Section tabs'): void
    {
        $activeTabId = $activeTabId ?? ($tabs[0]['id'] ?? '');
        echo '<div class="ops-tabs-shell"><div class="wrapper ops-tabs" id="' . adm_esc($groupId) . '">';

        foreach ($tabs as $tab) {
            $checked = ($tab['id'] === $activeTabId) ? ' checked' : '';
            echo '<input type="radio" name="' . adm_esc($groupId) . '" id="' . adm_esc($tab['id']) . '"' . $checked . '>';
        }

        echo '<nav aria-label="' . adm_esc($navLabel) . '">';
        foreach ($tabs as $tab) {
            $icon = !empty($tab['icon']) ? '<i class="fas fa-' . adm_esc($tab['icon']) . '"></i> ' : '';
            $badge = isset($tab['badge']) && $tab['badge'] !== '' && $tab['badge'] !== null
                ? ' <span class="badge">' . adm_esc((string) $tab['badge']) . '</span>'
                : '';
            echo '<label for="' . adm_esc($tab['id']) . '">' . $icon . adm_esc($tab['label']) . $badge . '</label>';
        }
        echo '</nav><section>';
    }
}

if (!function_exists('adm_ops_tab_begin')) {
    function adm_ops_tab_begin(string $panelClass = 'content-1'): void
    {
        echo '<div class="content ' . adm_esc($panelClass) . '">';
    }
}

if (!function_exists('adm_ops_tab_end')) {
    function adm_ops_tab_end(): void
    {
        echo '</div>';
    }
}

if (!function_exists('adm_ops_tabs_close')) {
    function adm_ops_tabs_close(): void
    {
        echo '</section></div></div>';
    }
}

if (!function_exists('adm_ops_plant_active_tab')) {
    /** Map ?tab= query param to plant pipeline tab id. */
    function adm_ops_plant_active_tab(?string $tabParam = null): string
    {
        $map = [
            '' => 'tab-receiving',
            '2' => 'tab-milling',
            '3' => 'tab-drying',
            '4' => 'tab-pressing',
            '5' => 'tab-produced',
        ];
        $tabParam = $tabParam ?? ($_GET['tab'] ?? '');
        return $map[(string) $tabParam] ?? 'tab-receiving';
    }
}
