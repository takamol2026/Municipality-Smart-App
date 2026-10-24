<?php

namespace App\Providers;

use App\Enums\AuditAction;
use App\Services\AuditLogger;
use Illuminate\Auth\Events\Failed;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Event;
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
        Paginator::defaultView('pagination.bootstrap');

        foreach (['created', 'updated', 'deleted', 'restored'] as $event) {
            Event::listen('eloquent.'.$event.': *', function (string $eventName, array $payload) use ($event) {
                AuditLogger::model($event, $payload[0] ?? null);
            });
        }

        Event::listen(function (Login $event) {
            AuditLogger::auth(AuditAction::Login, $event->user);
        });

        Event::listen(function (Logout $event) {
            AuditLogger::auth(AuditAction::Logout, $event->user);
        });

        Event::listen(function (Failed $event) {
            $login = $event->credentials['username']
                ?? $event->credentials['email']
                ?? $event->credentials['login']
                ?? null;

            AuditLogger::auth(AuditAction::LoginFailed, $event->user, [
                'login' => $login,
            ]);
        });
    }
}
