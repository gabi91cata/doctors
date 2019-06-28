<?php

namespace Consultadoctor\Doctors;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DoctorsServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    { 
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/migrations');
      //  Route::model('test', LaboratoryTest::class);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadViewsFrom(__DIR__.'/views', 'doctors');
    }

    public function adminMenu()
    {
        return view('doctors::menu.admin')->render();
    }
}
