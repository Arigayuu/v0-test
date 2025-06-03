<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class MigrationHelper
{
    /**
     * Check if all required tables and columns exist
     */
    public static function checkRequiredTables(): array
    {
        $status = [
            'carts_table' => Schema::hasTable('carts'),
            'profile_image_column' => Schema::hasColumn('users', 'profile_image'),
        ];

        return $status;
    }

    /**
     * Run missing migrations
     */
    public static function runMissingMigrations(): void
    {
        $status = self::checkRequiredTables();

        if (!$status['carts_table']) {
            Artisan::call('migrate', ['--path' => 'database/migrations/2024_03_20_000001_create_carts_table.php']);
        }

        if (!$status['profile_image_column']) {
            Artisan::call('migrate', ['--path' => 'database/migrations/2024_03_20_000002_add_profile_image_to_users_table.php']);
        }
    }
}
