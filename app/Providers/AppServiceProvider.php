<?php

namespace App\Providers;


use Illuminate\Support\Facades\Cookie;
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
                'adminlte.logo_img' =>  $user->profile
                        ? asset('images/'.$user->profile) 
                        : asset('images/default.png'),

                'adminlte.classes_sidebar' => Cookie::get('custom') ? 
                                                'sidebar-dark-custom elevation-4' :
                                                'sidebar-dark-primary elevation-4',
            ]);
        
            
        });
    }
}
