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
use Illuminate\Support\HtmlString;

class AdminPanelProvider extends PanelProvider
{

    public function boot(): void
    {
        date_default_timezone_set(config('app.timezone'));
    }
    
    private function getBrandLogo(string $colorClass = 'text-orange-500', string $size = 'md'): HtmlString
    {

        $sizeClass = match($size) {
            'sm' => 'h-6 w-auto',
            'md' => 'h-8 w-auto',
            'lg' => 'h-12 w-auto',
            'xl' => 'h-16 w-auto',
            default => 'h-8 w-auto'
        };
        return new HtmlString("
            <svg class=\"{$colorClass} {$sizeClass}\" version=\"1.0\" xmlns=\"http://www.w3.org/2000/svg\" width=\"552pt\" height=\"124pt\" viewBox=\"0 0 552 124\" preserveAspectRatio=\"xMidYMid meet\">
                <g transform=\"matrix(0.1, 0, 0, -0.1, -1, 122.000003)\" fill=\"currentColor\" stroke=\"none\">
                    <path d=\"M700 1195 c-349 -55 -601 -243 -666 -496 -72 -281 170 -572 556 -669 41 -10 91 -20 110 -22 l35 -3 23 325 c12 179 25 331 27 338 3 9 28 12 92 10 l88 -3 23 -334 c12 -184 24 -336 26 -338 6 -7 167 28 234 51 136 46 230 104 323 196 98 97 140 171 160 284 70 405 -467 749 -1031 661z m383 -66 c246 -50 436 -178 516 -349 22 -47 25 -69 26 -150 0 -86 -3 -101 -31 -160 -61 -128 -196 -240 -362 -300 -46 -17 -86 -29 -87 -28 -4 4 -75 597 -75 621 0 16 -15 17 -197 15 l-197 -3 -40 -315 c-21 -173 -40 -316 -42 -318 -5 -8 -149 49 -211 83 -90 50 -201 162 -239 240 -26 54 -29 70 -29 160 0 92 3 105 33 169 78 166 296 304 542 345 104 17 284 13 393 -10z\"/>
                    <path d=\"M660 925 l0 -95 213 2 212 3 3 93 3 92 -216 0 -215 0 0 -95z\"/>
                    <path d=\"M1940 575 l0 -335 85 0 85 0 0 335 0 335 -85 0 -85 0 0 -335z\"/>
                    <path d=\"M2394 790 c-12 -5 -25 -13 -29 -19 -9 -16 -25 -13 -25 4 0 12 -16 15 -85 15 l-85 0 0 -275 0 -275 87 0 86 0 -7 162 c-8 198 0 290 23 286 20 -4 28 -82 30 -295 l1 -153 83 0 82 0 0 238 c0 259 -4 281 -56 308 -31 16 -73 17 -105 4z\"/>
                    <path d=\"M2705 790 c-85 -26 -120 -125 -113 -316 6 -149 21 -188 88 -221 62 -32 164 -32 210 0 48 32 72 78 78 152 l5 65 -77 0 -76 0 -1 -37 c-2 -61 -13 -98 -30 -101 -11 -2 -18 7 -23 29 -10 52 -7 286 5 316 10 27 11 27 25 9 8 -11 14 -39 14 -63 l0 -43 81 0 82 0 -6 55 c-7 66 -37 119 -80 142 -37 19 -140 26 -182 13z\"/>
                    <path d=\"M3136 789 c-48 -12 -103 -44 -116 -69 -6 -10 -10 -48 -10 -84 l0 -66 75 0 75 0 0 53 c0 59 11 83 34 74 12 -5 16 -20 16 -57 l0 -50 -90 -45 c-49 -25 -94 -54 -100 -64 -13 -25 -13 -176 0 -202 26 -47 118 -64 163 -29 30 24 37 25 37 5 0 -12 16 -15 80 -15 l80 0 0 223 c0 248 -6 274 -67 310 -38 22 -123 30 -177 16z m74 -379 c0 -56 -3 -72 -16 -77 -24 -9 -35 16 -31 69 4 46 20 78 38 78 5 0 9 -32 9 -70z\"/>
                    <path d=\"M3440 575 l0 -335 86 0 86 0 -3 132 -4 133 70 3 c54 2 75 8 92 24 31 29 46 112 38 206 -15 157 -35 172 -235 172 l-130 0 0 -335z m210 189 c22 -56 9 -144 -21 -144 -17 0 -19 8 -19 85 0 70 3 85 15 85 9 0 20 -12 25 -26z\"/>
                    <path d=\"M3955 789 c-95 -23 -120 -89 -113 -305 6 -212 36 -254 181 -255 99 -1 139 17 168 73 20 38 24 61 27 191 3 120 1 156 -12 191 -37 97 -126 134 -251 105z m89 -106 c3 -10 6 -89 8 -175 3 -165 -3 -196 -37 -168 -12 10 -15 40 -15 167 0 145 7 193 30 193 5 0 11 -8 14 -17z\"/>
                    <path d=\"M4447 783 c-4 -3 -7 -19 -7 -34 0 -16 -5 -75 -12 -131 -13 -116 -17 -110 -39 64 l-12 98 -69 0 c-46 0 -68 -4 -68 -12 0 -13 57 -446 65 -495 l6 -33 88 0 88 0 12 88 c6 49 11 98 11 111 0 12 4 20 9 17 4 -3 14 -53 21 -111 l12 -106 92 3 91 3 27 230 c14 127 27 249 27 273 l1 43 -67 -3 -67 -3 -18 -124 c-22 -158 -23 -161 -32 -71 -3 41 -9 103 -12 138 l-6 62 -67 0 c-37 0 -71 -3 -74 -7z\"/>
                    <path d=\"M4933 791 c-100 -26 -117 -67 -118 -276 0 -144 2 -165 22 -208 28 -61 68 -79 170 -79 124 1 172 47 181 173 l5 69 -76 0 -76 0 -3 -67 c-3 -65 -4 -68 -28 -68 -24 0 -25 2 -28 83 l-3 82 105 0 104 0 6 38 c8 45 -7 140 -28 180 -32 62 -142 96 -233 73z m95 -150 c3 -50 2 -52 -20 -49 -18 2 -24 10 -26 35 -4 37 14 76 31 70 7 -2 13 -27 15 -56z\"/>
                    <path d=\"M5463 784 c-18 -9 -33 -20 -33 -25 0 -5 -4 -9 -10 -9 -5 0 -10 9 -10 20 0 20 -5 21 -82 18 l-83 -3 0 -270 0 -270 82 -3 82 -3 3 162 c3 155 4 161 27 180 13 10 34 19 47 19 24 0 24 1 24 100 0 55 -3 100 -7 100 -5 0 -23 -8 -40 -16z\"/>
                </g>
            </svg>
        ");
    }

    public function panel(Panel $panel): Panel
    {

        return $panel
            ->default()
            ->viteTheme('resources/css/filament/admin/theme.css')
            // ->brandLogo(fn () => $this->getBrandLogo('text-red-600', 'md'))  // Cambiar aquí: color y tamaño
            ->brandLogoHeight('2rem')
            ->favicon(asset('/images/incapower_ico2.svg'))
            ->brandName('CRM')
            ->sidebarWidth('250px')
            ->maxContentWidth('full')
            ->spa()
            ->id('admin')
            ->path('admin')
            ->colors([
                'primary' => Color::Red,
                'secondary' => Color::Cyan,
                'success' => Color::Lime,
                'warning' => Color::Amber,
                'danger' => Color::Orange,
                'gray' => Color::Gray,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->discoverClusters(in: app_path('Filament/Clusters'), for: 'App\Filament\Clusters')
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([
                Widgets\AccountWidget::class,
                Widgets\FilamentInfoWidget::class,
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
            ])
            ->sidebarCollapsibleOnDesktop()
            ->plugins([
                \BezhanSalleh\FilamentShield\FilamentShieldPlugin::make(),
                // \Visualbuilder\EmailTemplates\EmailTemplatesPlugin::make(),
            ])
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->font('Poppins')
            ->globalSearch(false)

        ;
    }
}
