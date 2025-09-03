# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## System Architecture

This is a PHP-based web application for a rubber, copra, and coffee trading system running on XAMPP (Apache/MySQL/PHP). The system manages multiple business modules including purchasing, processing, inventory, sales, and financial tracking.

### Module Structure
- **admin/** - Administrative dashboard and main system management
- **rubber/** - Rubber purchasing, inventory, and processing management
- **copra/** - Copra (coconut) trading and transaction management  
- **coffee/** - Coffee product management and sales
- **plantation/** - Rubber plantation processing (drying, milling, pressing)
- **sales/** - Sales management for bales and cuplump products
- **ledger/** - Financial ledger and expense tracking

### Database
- Database: `ejn_db` (MySQL/MariaDB)
- Connection config: `/function/db.php`
- Schema: `ejn_db.sql`
- Default connection: localhost, root user, no password

## Development Environment

### Server Requirements
- XAMPP stack (Apache, MySQL, PHP 8.0+, MariaDB 10.4+)
- Web root: `/Applications/XAMPP/xamppfiles/htdocs/ejnew-system`

### No Build Process
This is a traditional PHP application with no build system, package managers, or automated testing setup. Development is done directly on PHP files.

## User Authentication & Access Control

The system uses role-based access with the following user types:
- `admin` - Full system access via `/admin/dashboard.php`
- `copra` - Copra trading access via `/copra/transaction.php` 
- `finance` - Financial ledger access via `/ledger/ledger-expense.php`
- `rubber` - Rubber operations via `/rubber/dry_receiving_record.php`
- `planta` - Plantation processing via `/plantation/dashboard.php`
- `sales` - Sales management via `/sales/dashboard.php`

## Common File Patterns

### Frontend Technologies
- Bootstrap 4/5 for UI framework
- jQuery for JavaScript functionality
- DataTables for table management with export features
- Chart.js for data visualization
- SweetAlert2 for user notifications
- Chosen.js for enhanced select dropdowns

### Backend Patterns
- PHP sessions for authentication (`session_start()` in most files)
- MySQLi for database connections
- Modular structure with `/function/`, `/include/`, `/modal/` directories
- AJAX endpoints in `/fetch/` directories
- Report generation with export capabilities

### Key Directories
- `/function/` - Core business logic and database operations
- `/include/` - Reusable PHP components (headers, navigation, scripts)
- `/modal/` - Modal dialog components for data entry/editing
- `/table/` - Data table components and AJAX endpoints
- `/statistical_card/` - Dashboard metrics and charts
- `/css/` - Styling (responsive design, custom themes)
- `/js/` - JavaScript functionality and computations

## Business Logic Overview

This system tracks the complete supply chain from raw material purchase to final sales:

1. **Purchasing** - Buy rubber, copra, coffee from suppliers
2. **Processing** - Transform raw materials (drying, milling, pressing for rubber)
3. **Inventory** - Track processed goods in different locations (Basilan, Kidapawan)
4. **Container Management** - Package products for shipment
5. **Sales & Shipping** - Sell to customers with delivery tracking
6. **Financial** - Track expenses, cash advances, payments, profitability

## Working with AJAX

The system heavily uses AJAX for dynamic data loading. Always follow the established pattern:
- AJAX endpoints in `/fetch/` directories
- JSON responses for data tables
- Form submissions use POST with SweetAlert2 feedback
- Always include proper error handling and user feedback