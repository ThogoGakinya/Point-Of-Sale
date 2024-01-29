<?php

namespace App\Providers;
use App\Admin\CompanyDetail;

use Illuminate\Support\ServiceProvider;

class CompanyDetailsProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){
            $view->with('company', CompanyDetail::all()->take(1));
       });
    }
}
