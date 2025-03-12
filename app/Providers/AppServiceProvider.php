<?php

namespace App\Providers;

use App\Filament\Actions\AuthenticateLogin;
use App\Services\Soap\EliecontService\LoginService;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
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
        FilamentColor::register([
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
