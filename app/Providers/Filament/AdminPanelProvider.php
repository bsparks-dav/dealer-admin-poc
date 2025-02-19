<?php

namespace App\Providers\Filament;

use App\Filament\Pages\Tenancy\EditDealerProfile;
use App\Http\Middleware\ApplyTenantScopes;
use App\Models\Dealer;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationGroup;
use Filament\Navigation\NavigationItem;
use Filament\Pages;
use Filament\Support\Facades\FilamentView;
use Illuminate\View\View;
use Illuminate\Support\Facades\Blade;
use Filament\Pages\Auth\Register;
use Filament\Pages\Tenancy\EditTenantProfile;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\View\PanelsRenderHook;
use Filament\Widgets;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use pxlrbt\FilamentEnvironmentIndicator\EnvironmentIndicatorPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        $dealer = Dealer::class;

        return $panel
            ->spa()
            ->favicon(asset('../images/favicon.ico'))
            ->brandName(" Davidson's Inc.")
            ->darkModeBrandLogo(fn () => view('vendor.filament.components.logo'))
            ->brandLogo(fn () => view('vendor.filament.components.logo2'))
            ->tenantMenu(false)
            ->default()
            ->tenant(Dealer::class)
            //->tenantProfile(EditDealerProfile::class)
            ->tenantRoutePrefix('dealer')
            ->id('admin')
            ->path('admin')
            ->login()
            ->registration()
            ->passwordReset()
            ->colors([
                'primary' => Color::Blue,
                'gray' => Color::Slate,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->pages([
                Pages\Dashboard::class,
            ])
//            ->navigationItems([
//                NavigationItem::make('My Orders')
//                    ->icon('heroicon-o-shopping-bag'),
//                NavigationItem::make('Licensing')
//                    ->icon('heroicon-o-identification'),
//                NavigationItem::make('My Lists')
//                    ->icon('heroicon-o-table-cells'),
//            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
            ])
            ->renderHook(
                'panels::body.end',
                fn () => view('customFooter')
            )
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
            ])
            ->tenantMiddleware([
                ApplyTenantScopes::class,
            ], isPersistent: true)
            ->plugins([
                EnvironmentIndicatorPlugin::make()
                    ->showGitBranch()
                    ->color(fn () => match (app()->environment()) {
                        'production' => null,
                        'staging' => Color::Rose,
                        'local' => Color::Green,
                        default => Color::Blue,
                    }),
            ]);
    }

    public function register(): void
    {
        parent::register();
        FilamentView::registerRenderHook('panels::body.end', fn (): string => Blade::render("@vite('resources/js/app.js')"));
    }
}
