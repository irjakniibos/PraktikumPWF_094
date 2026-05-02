<?php

namespace App\Providers;

use App\Models\Product;
use App\Policies\ProductPolicy;
use Dedoc\Scramble\Scramble;
use Dedoc\Scramble\Support\Generator\OpenApi;
use Dedoc\Scramble\Support\Generator\SecurityScheme;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Illuminate\Routing\Route;

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

        // =========================================================
        // Scramble API Docs Configuration
        // =========================================================
        Scramble::configure()
            ->routes(function (Route $route) {
                return Str::startsWith($route->uri, 'api/');
            })
            ->withDocumentTransformers(function (OpenApi $openApi) {
                $openApi->secure(
                    SecurityScheme::http('bearer')
                );
            });

        Gate::define('viewApiDocs', function () {
            return true;
        });
    }
}
