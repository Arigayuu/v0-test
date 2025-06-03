<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class SetupCartSystem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the cart system by running necessary migrations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up cart system...');

        if (!Schema::hasTable('carts')) {
            $this->info('Running migrations for carts table...');
            Artisan::call('migrate', ['--path' => 'database/migrations/2024_03_20_000001_create_carts_table.php']);
            $this->info('Carts table created successfully!');
        } else {
            $this->info('Carts table already exists.');
        }

        if (!Schema::hasColumn('users', 'profile_image')) {
            $this->info('Adding profile_image column to users table...');
            Artisan::call('migrate', ['--path' => 'database/migrations/2024_03_20_000002_add_profile_image_to_users_table.php']);
            $this->info('Profile image column added successfully!');
        } else {
            $this->info('Profile image column already exists.');
        }

        $this->info('Cart system setup completed successfully!');
    }
}
