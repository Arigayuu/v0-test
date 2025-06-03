@extends('layouts.admin')

@section('title', 'Migration Status')

@section('content')
<div class="container-fluid px-4">
    <h1 class="mt-4">Migration Status</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
        <li class="breadcrumb-item active">Migration Status</li>
    </ol>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-database me-1"></i>
            Database Migration Status
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Migration</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Carts Table</td>
                            <td>
                                @if($status['carts_table'])
                                    <span class="badge bg-success">Migrated</span>
                                @else
                                    <span class="badge bg-danger">Not Migrated</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Profile Image Column</td>
                            <td>
                                @if($status['profile_image_column'])
                                    <span class="badge bg-success">Migrated</span>
                                @else
                                    <span class="badge bg-danger">Not Migrated</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            @if(!$status['carts_table'] || !$status['profile_image_column'])
                <div class="mt-4">
                    <form action="{{ route('admin.migrations.run') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-play me-1"></i> Run Missing Migrations
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>

    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-info-circle me-1"></i>
            Migration Information
        </div>
        <div class="card-body">
            <p>The following migrations are required for the application to function properly:</p>
            <ul>
                <li><strong>Carts Table</strong> - Required for shopping cart functionality</li>
                <li><strong>Profile Image Column</strong> - Required for user profile images</li>
            </ul>
            
            <div class="alert alert-info">
                <h5>Manual Migration Instructions</h5>
                <p>If the automatic migration doesn't work, you can run the following commands in your terminal:</p>
                <pre><code>php artisan migrate --path=database/migrations/2024_03_20_000001_create_carts_table.php
php artisan migrate --path=database/migrations/2024_03_20_000002_add_profile_image_to_users_table.php</code></pre>
            </div>
        </div>
    </div>
</div>
@endsection
