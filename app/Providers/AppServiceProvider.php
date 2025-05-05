<?php

namespace App\Providers;

use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Filament\Support\Facades\FilamentView;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(\App\Services\Soap\SoapService::class, function () {
            return new \App\Services\Soap\SoapService;
        });

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // prevents (N+1 Query) Lazy Loading...
        Model::shouldBeStrict(! $this->app->isProduction());
        DB::prohibitDestructiveCommands($this->app->isProduction());

        FilamentView::registerRenderHook(
            'panels::body.start',
            function () {
                return Blade::render('
                <div
                    id="filament-loading-modal"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-gray-900/50 dark:bg-gray-900/75"
                    style="display: none;"
                >
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl p-6 flex flex-col items-center">
                        <div class="rounded-full h-16 w-16 flex items-center justify-center mb-4">
                            <x-filament::loading-indicator class="h-12 w-12" />
                        </div>
                        <p class="text-gray-700 dark:text-gray-300 text-lg font-medium">Loading data...</p>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", () => {

                        const loadingModal = document.getElementById("filament-loading-modal");

                        document.addEventListener("click", (event) => {
                            const sidebarItem = event.target.closest(".fi-sidebar-item-button");
                            if (sidebarItem) {console.log("sidebar link clicked");
                                loadingModal.style.display = "flex";
                            }
                        });

                        // hide when data is loaded...
                        document.addEventListener("livewire:navigated", () => {console.log("loading done");
                            loadingModal.style.display = "none";
                        });

                    });
                </script>
            ');
            }
        );

        FilamentColor::register([
            'teal' => Color::hex('#90e4c1'), // 008080
            'darkteal' => Color::hex('#236863'),
            'darkgreen' => Color::hex('#006400'),
            'darkred' => Color::hex('#8B0000'),
            'darkblue' => Color::hex('#00008B'),
            'darkorange' => Color::hex('#FF8C00'),
            'cornflowerblue' => Color::hex('#6495ED'),
            'darkcyan' => Color::hex('#008B8B'),
            'darkgray' => Color::hex('#A9A9A9'),
            'darkslategray' => Color::hex('#2F4F4F'),
            'darkslateblue' => Color::hex('#483D8B'),
            'darkseagreen' => Color::hex('#8FBC8F'),
            'darkorchid' => Color::hex('#9932CC'),
            'darkmagenta' => Color::hex('#8B008B'),
            'darkviolet' => Color::hex('#9400D3'),
            'darkgoldenrod' => Color::hex('#B8860B'),
            'darkkhaki' => Color::hex('#BDB76B'),
            'darkolivegreen' => Color::hex('#556B2F'),
            'darkturquoise' => Color::hex('#00CED1'),
        ]);
    }
}
