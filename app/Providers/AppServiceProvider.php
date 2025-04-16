<?php

namespace App\Providers;

// use \Log;
use App\Services\FirebaseNotificationService;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->singleton(FirebaseNotificationService::class, function ($app) {
            $projectId = config('firebase.project_id'); // الحصول على projectId من ملف الإعدادات
            return new FirebaseNotificationService($projectId);
        });

        // Log::info('تم ربط GuzzleHttp\ClientInterface بـ GuzzleHttp\Client');
        // $this->app->bind(ClientInterface::class, Client::class);

        // تسجيل FirebaseNotificationService كخدمة Singleton
        // $this->app->singleton(FirebaseNotificationService::class, function ($app) {
        //     return new FirebaseNotificationService($app->make(Messaging::class));
        // });
    }



    public function boot(): void
    {

        Paginator::useBootstrapFive();
        DB::listen(function ($query) {
            Log::info("=====================================");
            Log::info("📌 Query Executed:");
            Log::info("SQL      => " . $query->sql);
            Log::info("Bindings => " . json_encode($query->bindings));
            Log::info("Time     => " . $query->time . " ms");
            Log::info("=====================================\n\n");
        });

    }
}
