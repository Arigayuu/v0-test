<?php

namespace App\Http\Controllers;

use App\Helpers\MigrationHelper;
use Illuminate\Http\Request;

class MigrationController extends Controller
{
    public function status()
    {
        $status = MigrationHelper::checkRequiredTables();
        
        return view('admin.migrations.status', compact('status'));
    }

    public function run()
    {
        MigrationHelper::runMissingMigrations();
        
        return redirect()->route('admin.migrations.status')
            ->with('success', 'Migrations have been run successfully!');
    }
}
