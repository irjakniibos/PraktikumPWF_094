<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // =========================================================
        // Gate: export-product
        // Hanya user dengan role 'admin' yang bisa melakukan export
        // =========================================================
        Gate::define('export-product', function ($user) {
            return $user->role === 'admin';
        });

        Gate::define('manage-category', function ($user) {
            return $user->role === 'admin';
        });

        // =========================================================
        // Policy: ProductPolicy untuk Model Product
        // =========================================================
        Gate::policy(Product::class, ProductPolicy::class);
    }
}
