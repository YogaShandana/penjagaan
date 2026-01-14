<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class PenjagaPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('penjaga')
            ->path('penjaga')
            ->login(\App\Filament\Penjaga\Pages\Auth\Login::class)
            ->brandName('Penjaga')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->darkMode(false)
            ->discoverResources(in: app_path('Filament/Penjaga/Resources'), for: 'App\\Filament\\Penjaga\\Resources')
            ->discoverPages(in: app_path('Filament/Penjaga/Pages'), for: 'App\\Filament\\Penjaga\\Pages')
            ->pages([
                \App\Filament\Penjaga\Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Penjaga/Widgets'), for: 'App\\Filament\\Penjaga\\Widgets')
            ->widgets([
                // Remove default widgets for cleaner dashboard
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
                \App\Http\Middleware\CheckPenjagaRole::class,
            ]);
    }
}
