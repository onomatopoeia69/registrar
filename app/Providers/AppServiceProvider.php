<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

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
        $this->app['events']->listen(BuildingMenu::class, function (BuildingMenu $event) {
            
            $user = auth()->user();

            config([
                'adminlte.logo' => "<b> Registrar System </b>",
            ]);
        
            
        });
    }
}
