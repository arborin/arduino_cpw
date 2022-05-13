<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        $pay_status = ['not_payed'=>'გადასახდელი',
                        'payed'=>'გადახილი',
                        'control'=>'კონტროლზე',
                        'archive'=>'არქივში',
                    ];
        
        View::share('pay_status', $pay_status);
                    
    }
}
